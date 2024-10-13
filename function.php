<?php

function mytheme_support() {

	// コアブロックの追加分のCSSを読み込む
	add_theme_support( 'wp-block-styles' );

	// テーマのCSS（style.css）をエディターに読み込む
	add_editor_style( 'style.css' );	// theme.jsonだけで全てのスタイルをまかなうのは難しいため、テーマの外部スタイル（wp-content/my-theme/style.css）を読み込む。今回は、Create Block Themeというプラグインで作成した「My Theme」というテーマのスタイルシートを読み込んでいる。そのスタイルシートがwp-content/my-theme/style.css。（スタイルシートは自動で作成される。）

}

/* add_actionについては、下のmytheme_enqueue（フロントにテーマの外部CSSを読み込む処理）の方の説明を参照。 */

add_action( 'after_setup_theme', 'mytheme_support' );	// add_theme_supportで読み込んだCSSをafter_setup_themeフック（テーマがロードされた後に動作する）で動作させる。例えば、個別記事ページで画像ブロックのキャプションのスタイルが、読み込んだコアブロックのCSSで定義したスタイルにかわる。

function mytheme_enqueue() {

	// テーマのCSS（style.css）をフロントに読み込む
	wp_enqueue_style( 
		'mytheme-style', 
		get_stylesheet_uri(),
		array(),
		filemtime( get_theme_file_path( 'style.css' ) )
	);

}
/* add_actionは、特定のポイントで、
あるいはイベントの発生時に、WordPressのコアが起動するフック（フックは、何かしらのアクションを起こす）。
一つ目の引数にフック（で呼び出されるアクション）の名前を指定する。
2つ目の引数には、アクションが呼び出されたときに実行される処理（関数）を指定する。 */
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue' );