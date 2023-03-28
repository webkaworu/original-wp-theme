<?php

// 初期データのインポート
function wrt_import_initial_setting(){
	$logo = update_custom_attachment(get_theme_file_path('src/img/common/sample-logo.png'));
	$footer_logo = update_custom_attachment(get_theme_file_path('src/img/common/sample-footer-logo.png'));
	$mv = update_custom_attachment(get_theme_file_path('src/img/top/sample-mv.jpg'));
	$mv_sp = update_custom_attachment(get_theme_file_path('src/img/top/sample-mv-sp.jpg'));

	$custom_wrt_data = [
		'logo' => [
			'header-img' => $logo,
			'footer-img' => $footer_logo,
		],
		'post' => [
			'default' => [
				'label' => 'お知らせ',
				'slug' => 'news',
			],
			'custom' => [
				[
					'label' => '事業内容',
					'slug' => 'business',
					'archive' => 'list',
					'pages' => 10,
					'side' => 'none',
					'single_side' => 'none',
				]
			]
		],
		'top'=>[
			'main-img' => $mv,
			'main-img-sp' => $mv_sp,
		]
	];

	return $custom_wrt_data;
}

// コンタクトフォームの自動生成
function insert_contact_meta(){
	$check = get_page_by_path('wrt_contact_form', OBJECT, 'wpcf7_contact_form');
	if( !empty($check->ID) ){
		return;
	}
	$post_id = insert_contact_post();
	if( is_wp_error( $post_id ) ) {
		echo $post_id->get_error_message();
		return;
	}

	$args = array(
		'_form' => get_contact_meta_form(),
		'_mail' => get_contact_meta_mail(),
		'_mail_2' => get_contact_meta_mail2(),
		'_messages' => get_contact_meta_messages(),
		'_additional_settings' => NULL,
		'_locale' => 'ja'
	);
	foreach( $args as $meta_key => $meta_value ){
		update_post_meta( $post_id, $meta_key, $meta_value );
	}
}
function insert_contact_post(){
	$post = array(
		// 'ID'             => 2,
		'post_content'   => '',
		'post_title'     => 'お問い合わせ',
		'post_name'      => 'wrt_contact_form',
		'post_status'    => 'publish',
		'post_type'      => 'wpcf7_contact_form',
		'post_author'    => 1,
		'ping_status'    => 'closed',
		'comment_status' => 'closed'
	);
	$post_id = wp_insert_post( $post, true );
	return $post_id;
}
function get_contact_meta_form(){
	$contents = '';
	if ( file_exists(get_theme_file_path('view/text/contact.txt')) ) {
		$contents = file_get_contents(get_theme_file_path('view/text/contact.txt'));
	}
	return trim($contents, " \t\n");
}
function get_contact_meta_mail(){
	$contents = '';
	if ( file_exists(get_theme_file_path('view/text/reply-admin.txt')) ) {
		$contents = file_get_contents(get_theme_file_path('view/text/reply-admin.txt'));
	}

	$args = array(
		'subject' => '[_site_title] "お問い合わせ"',// 題名
		'sender' => '[your-name] <info@'.$_SERVER['HTTP_HOST'].'>',// 送信元
		'body' => $contents,// メッセージ本文
		'recipient' => '[_site_admin_email]',// 送信先
		'additional_headers' => 'Reply-To: [your-email]',// 追加ヘッダー
		'attachments' => '',// ファイル添付
		'use_html' => false,// HTML 形式のメールを使用する
		'exclude_blank' => false// 空のメールタグを含む行を出力から除外する
	);
	return $args;
}
function get_contact_meta_mail2(){
	$contents = '';
	if ( file_exists(get_theme_file_path('view/text/reply-user.txt')) ) {
		$contents = file_get_contents(get_theme_file_path('view/text/reply-user.txt'));
	}

	$args = array(
		'active' => true,// メール (2) を使用
		'subject' => '[_site_title] "お問い合わせ頂きありがとうございます。"',// 題名
		'sender' => '[_site_title] <info@'.$_SERVER['HTTP_HOST'].'>',// 送信元
		'body' => $contents,// メッセージ本文
		'recipient' => '[your-email]',// 送信先
		'additional_headers' => '',// 追加ヘッダー
		'attachments' => '',// ファイル添付
		'use_html' => false,// HTML 形式のメールを使用する
		'exclude_blank' => false// 空のメールタグを含む行を出力から除外する
	);
	return $args;
}
function get_contact_meta_messages(){
	$args = array(
		'mail_sent_ok' => 'ありがとうございます。メッセージは送信されました。',
		'mail_sent_ng' => 'メッセージの送信に失敗しました。後でまたお試しください。',
		'validation_error' => '入力内容に問題があります。確認して再度お試しください。',
		'spam' => 'メッセージの送信に失敗しました。後でまたお試しください。',
		'accept_terms' => 'メッセージを送信する前に承諾確認が必要です。',
		'invalid_required' => '必須項目に入力してください。',
		'invalid_too_long' => '入力されたテキストが長すぎます。',
		'invalid_too_short' => '入力されたテキストが短すぎます。',
		'upload_failed' => 'ファイルのアップロード時に不明なエラーが発生しました。',
		'upload_file_type_invalid' => 'この形式のファイルはアップロードできません。',
		'upload_file_too_large' => 'ファイルが大きすぎます。',
		'upload_failed_php_error' => 'ファイルのアップロード中にエラーが発生しました。',
		'invalid_date' => '日付の形式が正しくありません。',
		'date_too_early' => '選択された日付は早すぎます。',
		'date_too_late' => '選択された日付は遅すぎます。',
		'invalid_number' => '数値の形式に間違いがあります。',
		'number_too_small' => '入力された数値が小さすぎます。',
		'number_too_large' => '数値が最大許容値を超えています。',
		'quiz_answer_not_correct' => 'クイズの答えが正しくありません。',
		'invalid_email' => '入力されたメールアドレスに間違いがあります。',
		'invalid_url' => 'URL に間違いがあります。',
		'invalid_tel' => '電話番号に間違いがあります。',
	);
	return $args;
}

// デモデータのインポート
function wrt_import_demo_setting(){
	// ロゴ画像をアップロード
	$logo = update_custom_attachment(get_theme_file_path('src/img/common/sample-logo.png'));
	if( is_wp_error($logo) ){
		return $logo;
	}
	$footer_logo = update_custom_attachment(get_theme_file_path('src/img/common/sample-footer-logo.png'));
	if( is_wp_error($footer_logo) ){
		return $footer_logo;
	}
	// メイン画像をアップロード
	$mv = update_custom_attachment(get_theme_file_path('src/img/top/mv.jpg'));
	if( is_wp_error($mv) ){
		return $mv;
	}
	// 紹介画像をアップロード
	$introduction = update_custom_attachment(get_theme_file_path('src/img/top/philosophy.jpg'));
	if( is_wp_error($introduction) ){
		return $introduction;
	}
	// カラム画像をアップロード
	$columns1 = update_custom_attachment(get_theme_file_path('src/img/top/staff.jpg'));
	if( is_wp_error($columns1) ){
		return $columns1;
	}
	$columns2 = update_custom_attachment(get_theme_file_path('src/img/top/staff2.jpg'));
	if( is_wp_error($columns2) ){
		return $columns2;
	}
	$columns3 = update_custom_attachment(get_theme_file_path('src/img/top/staff3.jpg'));
	if( is_wp_error($columns3) ){
		return $columns3;
	}
	$columns4 = update_custom_attachment(get_theme_file_path('src/img/top/staff4.jpg'));
	if( is_wp_error($columns4) ){
		return $columns4;
	}
	// 下層タイトル画像をアップロード
	$under_img = update_custom_attachment(get_theme_file_path('src/img/common/page-head.jpg'));
	if( is_wp_error($under_img) ){
		return $under_img;
	}
	// 固定ページを作成
	$company = wp_insert_post([
		'post_type' => 'page',
		'post_title' => '会社案内',
		'post_name' => 'company',
		'post_content' => file_get_contents(get_theme_file_path('view/text/company.txt')),
		'post_status' => 'publish',
		'post_author' => 1,
	], true);
	if( is_wp_error($company) ){
		return $company;
	}
	$faq = wp_insert_post([
		'post_type' => 'page',
		'post_title' => 'よくある質問',
		'post_name' => 'faq',
		'post_content' => file_get_contents(get_theme_file_path('view/text/faq.txt')),
		'post_status' => 'publish',
		'post_author' => 1,
	], true);
	if( is_wp_error($faq) ){
		return $faq;
	}
	// ナビゲーションを作成
	$categories = get_categories(['hide_empty' => false]);
	$current = (!empty($categories))? $categories[0]: [];
	foreach( $categories as $category ){
		if( $category->parent === 0 ){
			$current = $category;
			break;
		}
	}
	$menu_exists = wp_get_nav_menu_object('グローバルメニューデモ');
	if( $menu_exists !== false ){
		wp_delete_nav_menu($menu_exists->term_id);
	}
	$global_menu_id = wp_create_nav_menu('グローバルメニューデモ');
	wp_update_nav_menu_item( $global_menu_id, 0, array(
		'menu-item-title' => 'NEWS',
		'menu-item-type' => 'taxonomy',
		'menu-item-object' => 'category',
		'menu-item-object-id' => $current->term_id,
		'menu-item-status' => 'publish',
		'menu_item_menu_item_parent' => 0,
	));
	wp_update_nav_menu_item( $global_menu_id, 0, array(
		'menu-item-title' => 'BUSINESS',
		'menu-item-type' => 'post_type_archive',
		'menu-item-object' => 'custom_post_1',
		'menu-item-object-id' => -50,
		'menu-item-status' => 'publish',
		'menu_item_menu_item_parent' => 0,
	));
	wp_update_nav_menu_item( $global_menu_id, 0, array(
		'menu-item-title' => 'COMPANY',
		'menu-item-type' => 'post_type',
		'menu-item-object' => 'page',
		'menu-item-object-id' => $company,
		'menu-item-status' => 'publish',
		'menu_item_menu_item_parent' => 0,
	));
	$menu_exists = wp_get_nav_menu_object('フッターメニューデモ');
	if( $menu_exists !== false ){
		wp_delete_nav_menu($menu_exists->term_id);
	}
	$footer_menu_id = wp_create_nav_menu('フッターメニューデモ');
	wp_update_nav_menu_item( $footer_menu_id, 0, array(
		'menu-item-title'   =>  'HOME',
		'menu-item-url'     => home_url( '/' ),
		'menu-item-status'  => 'publish'
	));
	wp_update_nav_menu_item( $footer_menu_id, 0, array(
		'menu-item-title' => 'NEWS',
		'menu-item-type' => 'taxonomy',
		'menu-item-object' => 'category',
		'menu-item-object-id' => $current->term_id,
		'menu-item-status' => 'publish',
		'menu_item_menu_item_parent' => 0,
	));
	wp_update_nav_menu_item( $footer_menu_id, 0, array(
		'menu-item-title' => 'BUSINESS',
		'menu-item-type' => 'post_type_archive',
		'menu-item-object' => 'custom_post_1',
		'menu-item-object-id' => -50,
		'menu-item-status' => 'publish',
		'menu_item_menu_item_parent' => 0,
	));
	wp_update_nav_menu_item( $footer_menu_id, 0, array(
		'menu-item-title' => 'COMPANY',
		'menu-item-type' => 'post_type',
		'menu-item-object' => 'page',
		'menu-item-object-id' => $company,
		'menu-item-status' => 'publish',
		'menu_item_menu_item_parent' => 0,
	));
	wp_update_nav_menu_item( $footer_menu_id, 0, array(
		'menu-item-title' => 'FAQ',
		'menu-item-type' => 'post_type',
		'menu-item-object' => 'page',
		'menu-item-object-id' => $faq,
		'menu-item-status' => 'publish',
		'menu_item_menu_item_parent' => 0,
	));
	set_theme_mod( 'nav_menu_locations', ['global-menu'=>$global_menu_id, 'footer-menu'=>$footer_menu_id]);
	// テーマ設定を反映
	global $wrt_default_color, $wrt_catch_copy;
	$custom_wrt_data =  get_option('custom_wrt_data');
	$demo_wrt_data = [
		'logo' => [
			'header-img' => $logo,
			'footer-img' => $footer_logo,
		],
		'post' => $custom_wrt_data['post'],
		'top' => [
			'main-img' => $mv,
			'main-img-sp' => '',
			'catch_s' => 'ここには任意のテキストを入れることができます。',
			'catch_s_color' => $wrt_catch_copy['small']['color'],
			'catch_s_back' => $wrt_catch_copy['small']['back'],
			'catch_l' => 'SAMPLESITE',
			'catch_l_color' => $wrt_catch_copy['strong']['color'],
			'catch_l_back' => $wrt_catch_copy['strong']['back'],
			'catch_position' => 'left-center',
			'contents' => [
				[
					'type' => 'introduction',
					'title' => 'PHILOSOPHY',
					'subtitle' => 'わたしたちの理念',
					'img' => $introduction,
					'img_position' => 'right',
					'text' => "ここには任意のテキストを入れることができます。\n現在表示されている文章はダミーです。ここには任意のテキストを入れることができます。現在表示されている文章はダミーです。ここには任意のテキストを入れることができます。現在表示されている文章はダミーです。ここには任意のテキストを入れることができます。\n\n現在表示されている文章はダミーです。ここには任意のテキストを入れることができます。\n\n現在表示されている文章はダミーです。ここには任意のテキストを入れることができます。"
				],
				[
					'type' => 'postlist',
					'post_type' => 'custom_post_1',
					'title' => 'BUSINESS',
					'subtitle' => '事業内容',
					'pages' => 5,
					'archive' => 'slider',
				],
				[
					'type' => 'youtube',
					'title' => 'VIDEO',
					'subtitle' => '紹介動画',
					'text' => "ここには任意のテキストを入れることができます。現在表示されている文章はダミーです。\n\n現在表示されている文章はダミーです。",
					'youtube' => 'https://www.youtube.com/watch?v=MoO-UsIvFIs',
					'account' => 'https://www.youtube.com/channel/UCoRxcaATU1N9QdXXgmQLBFQ'
				],
				[
					'type' => 'columns',
					'title' => 'STAFF',
					'subtitle' => 'スタッフ',
					'columns' => [
						[
							'img' => $columns1,
							'title' => '田中 佐知子',
							'subtitle' => '代表取締役社長',
							'link' => ''
						],
						[
							'img' => $columns2,
							'title' => '山田 翔太郎',
							'subtitle' => 'システムエンジニア',
							'link' => ''
						],
						[
							'img' => $columns3,
							'title' => '佐藤 華子',
							'subtitle' => 'システムエンジニア',
							'link' => ''
						],
						[
							'img' => $columns4,
							'title' => '林 二郎',
							'subtitle' => 'デザイナー',
							'link' => ''
						],
					]
				],
				[
					'type' => 'postlist',
					'post_type' => 'post',
					'title' => 'NEWS',
					'subtitle' => 'お知らせ',
					'pages' => 5,
					'archive' => 'list',
				],
			]
		],
		'setting' => [
			'color' => $wrt_default_color,
			'font-size' => 'normal',
			'side' => 'none',
			'contact' => $custom_wrt_data['setting']['contact']?? 'none',
			'contact-url' => $custom_wrt_data['setting']['contact-url']?? '',
			'facebook' => $custom_wrt_data['setting']['facebook']?? '',
			'twitter' => $custom_wrt_data['setting']['twitter']?? '',
			'insta' => $custom_wrt_data['setting']['insta']?? '',
			'youtube' => $custom_wrt_data['setting']['youtube']?? '',
			'under-img' => $under_img,
			'under-title-color' => $wrt_catch_copy['under']['color'],
			'widget' => $custom_wrt_data['setting']['widget']?? 'classic'
		]
	];

	return $demo_wrt_data;

}
