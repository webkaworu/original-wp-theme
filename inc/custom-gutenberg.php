<?php

// オートセーブ時間を変更する
add_filter( 'block_editor_settings_all', function( $editor_settings ){
  $editor_settings['autosaveInterval'] = 360; // 自動保存360秒
  return $editor_settings;
});

// フロント側のブロックエディターcssを削除
// add_action( 'wp_enqueue_scripts', function(){
// 	wp_dequeue_style('wp-block-library');
// });

add_action( 'after_setup_theme', function(){
	// フロント側にデフォルトのブロックエディタ用CSSの追加
	// add_theme_support( 'wp-block-styles' );
	// エディター用のカスタムスタイルシートを設定
	add_theme_support( 'editor-styles' );
	// エディター用のカスタムスタイルシートの場所を指定
	add_editor_style( '/src/css/block-editor.css' );
	// 幅広・全幅画像のサポート設定
	add_theme_support( 'align-wide' );
	// 埋め込みコンテンツをレスポンシブ対応にする
	add_theme_support( 'responsive-embeds' );
	// テーマの独自のカラーパレットを設定
	global $wrt_site_colors;
	$colors = array(
		array(
			'name' => 'BLACK',
			'slug' => 'black',
			'color' => 'rgb(0, 0, 0)',
		),
		array(
			'name' => 'DARK-GRAY',
			'slug' => 'dark-gray',
			'color' => 'rgb(153, 153, 153)',
		),
		array(
			'name' => 'GRAY',
			'slug' => 'gray',
			'color' => 'rgb(221, 221, 221)',
		),
		array(
			'name' => 'LIGHT-GRAY',
			'slug' => 'light-gray',
			'color' => 'rgb(250, 250, 250)',
		),
		array(
			'name' => 'WHITE',
			'slug' => 'white',
			'color' => 'rgb(255, 255, 255)',
		),
	);
	foreach($wrt_site_colors as $slug => $wrt_site_color){
		$color = array(
			'name' => $wrt_site_color['label'],
			'slug' => $slug,
			'color' => 'rgb('.$wrt_site_color['basic'].')',
		);
		$colors[] = $color;
	}
	add_theme_support('editor-color-palette', $colors);
	// カラーピッカーを無効
	// add_theme_support( 'disable-custom-colors' );
	// テーマの独自のグラデーションを設定
	// add_theme_support( 'editor-gradient-presets', array(
	// 		array(
	// 			'name'     => esc_attr__( 'Vivid cyan blue to vivid purple', 'themeLangDomain' ),
	// 			'gradient' => 'linear-gradient(135deg,rgba(6,147,227,1) 0%,rgb(155,81,224) 100%)',
	// 			'slug'     => 'vivid-cyan-blue-to-vivid-purple'
	// 		),
	// 		array(
	// 			'name'     => esc_attr__( 'Vivid green cyan to vivid cyan blue', 'themeLangDomain' ),
	// 			'gradient' => 'linear-gradient(135deg,rgba(0,208,132,1) 0%,rgba(6,147,227,1) 100%)',
	// 			'slug'     =>  'vivid-green-cyan-to-vivid-cyan-blue',
	// 		)
	// ));
	// カスタムグラデーションを無効
	// add_theme_support( 'disable-custom-gradients' );
	// テーマの独自のフォントサイズを設定します。
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name' => '小',
			'size' => '0.87rem',
			'slug' => 'small'
		),
		array(
			'name' => '標準',
			'size' => '1rem',
			'slug' => 'normal'
		),
		array(
			'name' => '中',
			'size' => '1.14rem',
			'slug' => 'medium'
		),
		array(
			'name' => '大',
			'size' => '1.25rem',
			'slug' => 'large'
		),
		array(
			'name' => '特大',
			'size' => '1.5rem',
			'slug' => 'huge'
		),
	));
	// カスタムフォントサイズの設定を無効
	// add_theme_support('disable-custom-font-sizes');
	// 使用可能な単位を指定
	// add_theme_support( 'custom-units', 'rem' );
	// 文字間隔の制御
	add_theme_support( 'custom-spacing' );
	// 行の高さのカスタマイズをサポート
	add_theme_support( 'custom-line-height' );
	// デフォルトのブロックパターンを無効にします。
	// remove_theme_support( 'core-block-patterns' );
	// ブロックスタイルを追加
	register_block_style('core/heading', array(
		'name' => 'line',
		'label' => 'ライン',
		'isDefault' => false
	));
	register_block_style('core/heading', array(
		'name' => 'band',
		'label' => 'バンド',
		'isDefault' => false
	));
	register_block_style('core/heading', array(
		'name' => 'border',
		'label' => 'ボーダー',
		'isDefault' => false
	));
	register_block_style('core/table', array(
		'name' => 'flash',
		'label' => 'フラッシュ',
	));
}, PHP_INT_MAX);

// ブロックエディタ用のファイル読み込み
add_action( 'enqueue_block_editor_assets', function(){
	$asset_file = include( get_theme_file_path('blocks/build/index.asset.php'));
	wp_enqueue_script( 'original-block', get_theme_file_uri( 'blocks/build/index.js' ), $asset_file['dependencies'], $asset_file['version'], true );
	// wp_enqueue_script( 'new-theme-editor-js', get_theme_file_uri( 'src/js/block-editor.js' ), ['wp-element', 'wp-rich-text'] );
});

// 新しいブロックカテゴリを追加
add_filter( 'block_categories_all', function ( $block_categories, $block_editor_context ) {
	if ( ! ( $block_editor_context instanceof WP_Block_Editor_Context ) ) {
		return $block_categories;
	}

	return array_merge(
		$block_categories,
		[
			[
				'slug'  => 'theme-origin',
				'title' => 'テーマオリジナル',
			],
		]
	);
}, PHP_INT_MAX, 2);
