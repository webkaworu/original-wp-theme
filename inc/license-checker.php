<?php

/**
 * License Manager for WooCommerce SDK to let communication with the API
 *
 * APIに接続するための基本的な機能を定義します
 *
 */
class LicenseChecker {

	private $api_url;

	private $customer_key;

	private $customer_secret;

	private $valid_status;

	private $product_id;

	private $stored_license;

	private $valid_object;

	private $ttl;

	public function __construct() {
		global $wrt_product_id;

		$this->api_url         = "https://web:rabbit@webrabbit.xsrv.jp/wp-json/lmfwc/v2/";
		$this->customer_key    = 'ck_0f069a8c8e0b174750f15225d7dcf94e51c6b45a';
		$this->customer_secret = 'cs_2c2460981582b8e325ba673497d279315fca1c11';
		$this->product_id = $wrt_product_id;
		$this->stored_license = get_option('wrt_license_key', null);
		$this->valid_object = get_option('wrt_is_valid', []);
		$this->ttl = 30;
	}

	public function get_url(  $endpoint ) {
		return "{$this->api_url}{$endpoint}?consumer_key={$this->customer_key}&consumer_secret={$this->customer_secret}";
	}

	/**
	 * HTTP Request
	 *
	 * @param string $endpoint
	 * @param string $method
	 * @param string $args
	 *
	 * @return array
	 * @throws ErrorException
	 *
	 */
	private function call( $endpoint, $method = 'GET', $args = '' ) {
		$url = $this->get_url($endpoint);

		$headers = array(
			'Accept'       => 'application/json',
			'Content-Type' => 'application/json; charset=UTF-8',
		);

		$wp_args = array(
			'headers' => $headers,
			'method'  => $method,
			'timeout' => 5,
		);

		if ( ! empty( $args ) ) {
			$wp_args['body'] = $args;
		}

		$res = wp_remote_request( $url, $wp_args );

		if ( ! is_wp_error( $res ) && in_array( (int) $res['response']['code'], array( 200, 201 ), true ) ) {
			return json_decode( $res['body'], true );
		} elseif ( is_wp_error( $res ) ) {
			throw new ErrorException( $res->get_error_message(), 500 );
		} else {
			$response = json_decode( $res['body'], true );
			if ( 'rest_no_route' === $response['code'] ) {
				$response['data']['status'] = 500;
			}
			throw new ErrorException( $response['message'], $response['data']['status'] );
		}
	}

	/**
	 * ライセンスをアクティブ化する
	 *
	 * @param $license_key
	 * @return array|null
	 * @throws ErrorException
	 *
	 */
	public function activate( $license_key ) {
		$license = null;
		if ( ! empty( $license_key ) ) {
			try {
				$response = $this->call( "licenses/activate/{$license_key}" );
				if ( isset( $response['success'] ) && (bool) $response['success'] ) {
					$license = $response['data'];
				}else{
					$this->valid_status['is_valid']       = false;
					$this->valid_status['error']          = $response['message'];
					$this->valid_status['nextValidation'] = time();
					update_option( $this->valid_object, $this->valid_status );
					$license = new WP_Error(  $response['code'], $response['message'] );
				}
			} catch ( ErrorException $exception ) {
				$this->valid_status['is_valid']       = false;
				$this->valid_status['error']          = $exception->getMessage();
				$this->valid_status['nextValidation'] = time();
				update_option( $this->valid_object, $this->valid_status );
				$license = new WP_Error(  $exception->getCode(), $exception->getMessage() );
			}
		}

		return $license;
	}

	/**
	 * ライセンスを無効にする
	 *
	 * @param $license_key
	 * @throws ErrorException
	 */
	public function deactivate( $license_key ) {
		$license = true;
		if ( ! empty( $license_key ) ) {
			try {
				$this->call( "licenses/deactivate/{$license_key}" );
				delete_option( $this->valid_object );
			} catch ( ErrorException $exception ) {
				$this->valid_status['is_valid']       = false;
				$this->valid_status['error']          = $exception->getMessage();
				$this->valid_status['nextValidation'] = time();
				update_option( $this->valid_object, $this->valid_status );
				$license = new WP_Error(  $exception->getCode(), $exception->getMessage() );
			}
		}
		return $license;
	}

	/**
	 * ライセンスが有効かどうかを確認します
	 *
	 * @param $license_key
	 * @return array
	 *
	 */
	public function validate_status( $license_key = '' ) {
		$valid_result = array(
			'is_valid' => false,
			'error'    => 'ライセンスはまだアクティブ化されていません',
		);

		$current_time = time();
		$ttl          = 0;

		// 検証を強制しない場合は、検証オブジェクトを使用します
		if (empty( $license_key ) && isset( $this->valid_status['nextValidation'] ) && $this->valid_status['nextValidation'] > $current_time) {
			$valid_result['is_valid'] = $this->valid_status['is_valid'];
			$valid_result['error']    = $this->valid_status['error'];
		} else {

			// ライセンスが送信されない場合は、データベースに保存されているものを探します
			if ( empty( $license_key ) ) {
				$license_key = $this->stored_license;
			}

			// ライセンスがない場合
			if ( empty( $license_key ) ) {
				$valid_result['error'] = 'ライセンスが設定されていません';
			} else {
				try {
					$response = $this->call( "licenses/{$license_key}" );
					if ( isset( $response['success'] ) && (bool) $response['success'] ) {

						// ライセンスの有効期限を計算する
						$this->valid_status['valid_until'] = ( null !== $response['data']['expiresAt'] ) ? strtotime( $response['data']['expiresAt'] ) : null;

						if (!empty( $this->product_id ) && $response['data']['productId'] !=  $this->product_id) {
							// ライセンスキーがプロダクトIDに属していない場合、およびプロダクトIDが定義されていない場合、この検証は省略されます。
							$valid_result['error'] = '入力されたライセンスはこのテーマのものではありません';
						} elseif ($this->valid_status['valid_until'] !== null && $this->valid_status['valid_until'] < $current_time) {
							// ライセンスが有効期限に達していないことを確認してください。 有効期限が設定されていない場合は、これを省略してください
							$valid_result['error'] = 'ライセンスの有効期限が切れました';
						} else {
							$valid_result['is_valid'] = true;
							$valid_result['error']    = '';
							$ttl                      = $this->ttl;
						}
					}
				} catch ( ErrorException $exception ) {
					if ( 500 === $exception->getCode() ) {
						// License server unavailable
						$valid_result['is_valid'] = $this->valid_status['is_valid'];
						$valid_result['error']    = $this->valid_status['error'];
						$ttl                      = 1; // Set 1 day TTL to try the next day
					}elseif ( 404 === $exception->getCode() ) {
						// License not found
						$valid_result['error'] = '入力されたライセンスが見つかりません';
					} else {
						$valid_result['error'] = $exception->getMessage();
					}
				}
			}

			// 検証オブジェクトを更新します
			$this->valid_status['nextValidation'] = strtotime( gmdate( 'Y-m-d' ) . "+ {$ttl} days" );
			$this->valid_status['is_valid']       = $valid_result['is_valid'];
			$this->valid_status['error']          = $valid_result['error'];
			update_option( $this->valid_object, $this->valid_status );

		}

		return $valid_result;

	}

	/**
	 * ライセンスの有効期間を返します
	 *
	 * @return int|null
	 */
	public function valid_until() {
		return isset( $this->valid_status['valid_until'] ) ? $this->valid_status['valid_until'] : null;
	}

	/**
	 * ライセンスを返します
	 *
	 * @return int|null
	 */
	public function get_stored_license() {
		return $this->stored_license;
	}

}
