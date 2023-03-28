<?php

/******************************************************
*
* 独自関数
*
*******************************************************/
// デバッグ用
function pr($data){
	echo "<pre>";
	var_dump($data);
	echo "</pre>";
}

// デバイス判定
function is_iphone() {
		$is_iphone = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPhone');
		if ($is_iphone) {
				return true;
		} else {
				return false;
		}
}
function is_android() {
		$is_android = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'Android');
		if ($is_android) {
				return true;
		} else {
				return false;
		}
}
function is_ipad() {
		$is_ipad = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'iPad');
		if ($is_ipad) {
				return true;
		} else {
				return false;
		}
}
function is_kindle() {
		$is_kindle = (bool) strpos($_SERVER['HTTP_USER_AGENT'],'Kindle');
		if ($is_kindle) {
				return true;
		} else {
				return false;
		}
}
// function is_mobile(){
// 		$useragents = array(
// 				'iPhone',          // iPhone
// 				'iPod',            // iPod touch
// 				'Android',         // 1.5+ Android
// 				'dream',           // Pre 1.5 Android
// 				'CUPCAKE',         // 1.5+ Android
// 				'blackberry9500',  // Storm
// 				'blackberry9530',  // Storm
// 				'blackberry9520',  // Storm v2
// 				'blackberry9550',  // Storm v2
// 				'blackberry9800',  // Torch
// 				'webOS',           // Palm Pre Experimental
// 				'incognito',       // Other iPhone browser
// 				'webmate'          // Other iPhone browser
// 		);
// 		$pattern = '/'.implode('|', $useragents).'/i';
// 		return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
// }
function isBot() {
		$bot_list = array (
			'Googlebot',
			'Yahoo! Slurp',
			'Mediapartners-Google',
			'msnbot',
			'bingbot',
			'MJ12bot',
			'Ezooms',
			'pirst; MSIE 8.0;',
			'Google Web Preview',
			'ia_archiver',
			'Sogou web spider',
			'Googlebot-Mobile',
			'AhrefsBot',
			'YandexBot',
			'Purebot',
			'Baiduspider',
			'UnwindFetchor',
			'TweetmemeBot',
			'MetaURI',
			'PaperLiBot',
			'Showyoubot',
			'JS-Kit',
			'PostRank',
			'Crowsnest',
			'PycURL',
			'bitlybot',
			'Hatena',
			'facebookexternalhit',
			'NINJA bot',
			'YahooCacheSystem',
		);
		$is_bot = false;
		foreach ($bot_list as $bot) {
				if (stripos($_SERVER['HTTP_USER_AGENT'], $bot) !== false) {
						$is_bot = true;
						break;
				}
		}
		return $is_bot;
}

//カテゴリー　リンクを表示
function ahrcive_link($slug){
	if(empty($slug)){ return; }
	$category_id = get_category_by_slug( $slug );
	$category_link = get_category_link($category_id->cat_ID);
	echo esc_url($category_link);
}

//親子関係のページ判定
function is_tree( $slug ) {
	global $post;
	if(empty($slug) || !is_page()){ return; }
	$postlist = get_posts(array( 'posts_per_page' => 1,'name' => $slug, 'post_type'=> 'page' ));
	$pageid=array();
	foreach($postlist as $list){
		$pageid[]=$list->ID;
	}
	if ( is_page( $slug ) ) return true;
	$anc = get_post_ancestors( $post->ID );
	foreach ( $anc as $ancestor ) {
		if( is_page() && in_array($ancestor, $pageid) ) {
			return true;
		}
	}
	return false;
}

//固定ページで親をもっているか判定
function is_subpage() {
	global $post;
	if (is_page() && $post->post_parent){
		$parentID = $post->post_parent;
		return $parentID;
	} else {
		return false;
	};
};

// 多次元配列の値が空かどうか
function custom_array_filter($var){
	$return = false;
	if( is_array($var) ){
		foreach( $var as $v ){
			if( !empty($v) ){ $return = true; }
		}
	}elseif( !empty($var) ){
		$return = true;
	}
	return $return;
}

// 配列の最後のキーを得る
if (! function_exists("array_key_last")) {
	function array_key_last($array) {
			if (!is_array($array) || empty($array)) {
					return NULL;
			}

			return key(array_slice($array, -1));
	}
}

// mainタグのクラスを取得する
function get_main_class(){
	if( is_home() || is_front_page() ){
		return 'top_main';
	}else{
		return 'sub_main';
	}
}

// 投稿のカテゴリから最下層のカテゴリを取得
function get_the_category_layer($post_id){
	return get_the_term_layer($post_id, 'category');
}

// 投稿のカテゴリから最下層のカテゴリを取得
function get_the_term_layer($post_id, $term_name){
	$post_cats = get_the_terms($post_id, $term_name);
	if( empty($post_cats) ){
		return $post_cats;
	}
	$cat = $post_cats[0];
	$anc = get_ancestors($cat->term_id, $term_name);
	foreach( array_slice($post_cats , 1) as $post_cat ){
		$ancestors = get_ancestors($post_cat->term_id, $term_name);
		if( count($ancestors) > count($anc) ){
			$cat = $post_cat;
			$anc = $ancestors;
		}
	}
	return $cat;
}

//指定した文字数毎に挿入
function insert_text_len($text, $insert, $num){
	$returnText = $text;
	$text_len = mb_strlen($text, "utf-8");
	$insert_len = mb_strlen($insert, "utf-8");
	for($i=0; ($i+1)*$num<$text_len; $i++) {
			$current_num = $num+$i*($insert_len+$num);
			$returnText = preg_replace("/^.{0,$current_num}+\K/us", $insert, $returnText);
	}
	return $returnText;
}

// タームが存在した場合そのタームのURLを返す
function custom_get_term_link($term, $taxonomy='category'){
	$exist = term_exists($term, $taxonomy);
	if ($exist !== 0 && $exist !== null) {
		$link = get_term_link($term, $taxonomy);
	}else{
		$link = '#';
	}
	return $link;
}

// 投稿のキャプチャ画像を取得
function custom_get_post_capture($post_id, $size='post-thumbnail', $attr=[], $dummy='noimage.jpg'){
	if ( has_post_thumbnail($post_id) ) {
		return get_the_post_thumbnail( $post_id, $size, $attr );
	} else {

		// $post = get_post($post_id);
		// $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		// // $first_img = $matches [1] [0];
		// if( !empty($matches[1][0]) ){
		// 	$src = $matches[1][0];
		// }else{
		// 	$src = get_stylesheet_directory_uri().'/src/img/dummy/'.$dummy;
		// }
		$src = get_stylesheet_directory_uri().'/src/img/dummy/'.$dummy;

		$default_attr = array(
			'src' => $src,
			'class' => "img-fluid",
			'alt' => trim( strip_tags( get_the_title( $post_id ) ) ),
		);
		$attr = wp_parse_args( $attr, $default_attr );
		$attr = array_map( 'esc_attr', $attr );
		$attribute = '';
		foreach ( $attr as $name => $value ) {
			$attribute .= " $name=" . '"' . $value . '"';
		}

		if( file_exists($src) && $imagesize = get_image_width_and_height($src) ){
			return '<img '.$attribute.' width="'.$imagesize['width'].'" height="'.$imagesize['height'].'" />';
		}

		return '<img '.$attribute.' />';

	}
}

//画像URLから幅と高さを取得する（同サーバー内ファイルURLのみ）
function get_image_width_and_height($image_url){
	$res = null;
	$wp_content_dir = WP_CONTENT_DIR;// wp-contentディレクトリのパス
	$wp_content_url = content_url();// wp-contentディレクトリのURL
	$image_file = str_replace($wp_content_url, $wp_content_dir, $image_url);
	//画像サイズを取得
	$imagesize = getimagesize($image_file);
	if ($imagesize) {
		$res = array();
		$res['width'] = $imagesize[0];
		$res['height'] = $imagesize[1];
	}
	return $res;
}


// post_typeからカスタム投稿のテーマ設定を取得
function get_custom_post_theme_settings($post_type){
	$settings = [];
	$option = get_option( 'custom_wrt_data', array() );
	$obj = get_post_type_object( $post_type );
	if( $post_type === 'post' && isset($option['post']['default']) ){
		$settings = $option['post']['default'];
	}elseif( !empty($obj->rewrite['slug']) && isset($option['post']['custom']) ){
		foreach( $option['post']['custom'] as $custom ){
			if( isset($custom['slug']) && $custom['slug'] === $obj->rewrite['slug'] ){
				$settings = $custom;
				break;
			}
		}
	}
	return $settings;
}

// 画像のアップロード
function update_custom_attachment($dir){

	$name = basename( $dir );

	// アップロード用ディレクトリのパスを取得。
	$wp_upload_dir = wp_upload_dir();
	$filename = $wp_upload_dir['path'].'/'.$name;
	$i = 1;
	while (file_exists($filename)) {
		$filename = $wp_upload_dir['path'].'/'.substr_replace($name, '-'.$i, mb_strrpos($name, '.'), 0);
		$i++;
	}

	if ( !copy($dir, $filename) ) {
			return new WP_Error( 'broke','画像のアップロードに失敗しました。' );
	}
	// ファイルの種類をチェックする。これを 'post_mime_type' に使う。
	$filetype = wp_check_filetype( basename( $filename ), null );

	// 添付ファイル用の投稿データの配列を準備。
	$attachment = array(
		'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ),
		'post_mime_type' => $filetype['type'],
		'post_title'     => preg_replace( '/\.[^.]+$/', '', $name ),
		'post_content'   => '',
		'post_status'    => 'inherit'
	);

	// 添付ファイルを追加。
	$attach_id = wp_insert_attachment( $attachment, $filename );

	// wp_generate_attachment_metadata() の実行に必要なので下記ファイルを含める。
	require_once( ABSPATH . 'wp-admin/includes/image.php' );

	// 添付ファイルのメタデータを生成し、データベースを更新。
	$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
	wp_update_attachment_metadata( $attach_id, $attach_data );

	return $attach_id;
}

function wrt_get_inline_style(){
	global $wrt_default_color, $wrt_site_colors, $wrt_site_fsizes;

	$option = get_option( 'custom_wrt_data', array() );
	$sc = (isset($option['setting']['color']))? $wrt_site_colors[$option['setting']['color']]['basic']: $wrt_site_colors[$wrt_default_color]['basic'];
	$dsc = (isset($option['setting']['color']))? $wrt_site_colors[$option['setting']['color']]['dark']: $wrt_site_colors[$wrt_default_color]['dark'];
	$lsc = (isset($option['setting']['color']))? $wrt_site_colors[$option['setting']['color']]['light']: $wrt_site_colors[$wrt_default_color]['light'];
	$fs = (isset($option['setting']['font-size']))? $wrt_site_fsizes[$option['setting']['font-size']]['size']: $wrt_site_fsizes['normal']['size'];

	$inline_style = "
		:root{
			--wrt-site-color: rgb(${sc});
			--wrt-site-dcolor: rgb(${dsc});
			--wrt-site-lcolor: rgb(${lsc});
			--wrt-site-color-trans: rgba(${sc}, 0.1);
			--wrt-font-size: ${fs}px;
		}
	";

	return $inline_style;
}

// 画像ヘッダー部分の色相を判定
function wrt_is_fv_dark() {
	$option = get_option( 'custom_wrt_data', array() );
	if( is_home() || is_front_page() ){
		if( get_option('show_on_front', 'posts') === 'posts' ){
			$mv = ( !empty($option['top']['main-img']) )? wp_get_attachment_url( $option['top']['main-img'], 'full' ): get_stylesheet_directory_uri().'/src/img/top/sample-mv.jpg';
		}else{
			$mv = ( !empty($option['setting']['under-img']) )? wp_get_attachment_url( $option['setting']['under-img'], 'full' ): '';
		}
	}else{
		$mv = ( !empty($option['setting']['under-img']) )? wp_get_attachment_url( $option['setting']['under-img'], 'full' ): '';
	}
	if( !empty($mv) ){
		$mv = str_replace(home_url('/'), ABSPATH, $mv);
		$filetype = wp_check_filetype( basename( $mv ), null );
		switch($filetype['type']){
			case 'image/jpeg':
				$im = imagecreatefromjpeg($mv);
				break;
			case 'image/png':
				$im = imagecreatefrompng($mv);
				break;
			case 'image/gif':
				$im = imagecreatefromgif($mv);
				break;
		}
		$imgX = imagesx($im); //ヨコと
		// $imgY = imagesy($im); //タテのpx数を取得して
		$imgY = 110;
		$imgXY = $imgX*$imgY; //掛けあわせて
		$rSum = 0;
		$gSum = 0;
		$bSum = 0;
		for ($y = 0; $y < $imgY; $y++) { //左上から右下にかけてfor文で走査
			for ($x = 0; $x < $imgX; $x++) {
				$rgb = imagecolorat($im, $x, $y); //rgbコードを取得して
				$colors = imagecolorsforindex($im, $rgb);
				$rSum += $colors['red']; //それぞれを合算していく...
				$gSum += $colors['green'];
				$bSum += $colors['blue'];
			}
		}
		$rgb = array( 'r' => round($rSum / $imgXY), 'g' => round($gSum / $imgXY), 'b' => round($bSum / $imgXY) );
	}else{
		global $wrt_default_color, $wrt_site_colors;
		$sc = (isset($option['setting']['color']))? $wrt_site_colors[$option['setting']['color']]['basic']: $wrt_site_colors[$wrt_default_color]['basic'];
		$scs = explode(',', $sc);
		$rgb = array( 'r' => intval($scs[0]), 'g' => intval($scs[1]), 'b' => intval($scs[2]) );
	}
	$lum = 230;	// 輝度信号 YUV の白黒分岐点

	// RGB から YUV の輝度信号に変換
	$yuv = 0.299 * $rgb['r'] + 0.587 * $rgb['g'] + 0.114 * $rgb['b'];

	// 画像が暗い場合にtrueを返す
	return ( $lum > $yuv ) ? true : false;
}
