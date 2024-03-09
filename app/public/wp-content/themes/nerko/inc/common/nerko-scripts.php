<?php

/**
 * nerko_scripts description
 * @return [type] [description]
 */
function nerko_scripts() {


    /**
     * ALL CSS FILES
    */
    if( is_rtl() ){
        wp_enqueue_style( 'bootstrap-rtl', NERKO_THEME_CSS_DIR.'bootstrap.rtl.min.css', array() );
    }else{
        wp_enqueue_style( 'bootstrap', NERKO_THEME_CSS_DIR.'bootstrap.min.css', array() );
    }
    wp_enqueue_style( 'animate', NERKO_THEME_CSS_DIR . 'animate.min.css', [] );
    wp_enqueue_style( 'nerko-fontAwesome', NERKO_THEME_CSS_DIR . 'fontawesome-all.min.css', [] );
    wp_enqueue_style( 'swiper-bundle', NERKO_THEME_CSS_DIR . 'swiper-bundle.min.css', [] );
    wp_enqueue_style( 'nerko-icons', NERKO_THEME_CSS_DIR . 'default-icons.css', [] );
    wp_enqueue_style( 'unicons', NERKO_THEME_CSS_DIR . 'unicons.css', [] );
    wp_enqueue_style( 'nerko-fonts', NERKO_THEME_CSS_DIR . 'fonts.css', [] );
    wp_enqueue_style( 'nerko-spacing', NERKO_THEME_CSS_DIR . 'spacing.css', [] );
    wp_enqueue_style( 'nerko-core', NERKO_THEME_CSS_DIR . 'nerko-core.css', [] );
    wp_enqueue_style( 'nerko-unit', NERKO_THEME_CSS_DIR . 'nerko-unit.css', [] );
    wp_enqueue_style( 'nerko-custom', NERKO_THEME_CSS_DIR . 'nerko-custom.css', [] );
    wp_enqueue_style( 'nerko-style', get_stylesheet_uri() );


    // ALL JS FILES
    $nerko_preloader = get_theme_mod( 'nerko_preloader', false );
    if ( !empty( $nerko_preloader ) ){
        wp_enqueue_script( 'tg-page-head', NERKO_THEME_JS_DIR . 'tg-page-head.js', [ 'jquery' ], '', false );
    }
    wp_enqueue_script( 'bootstrap-bundle', NERKO_THEME_JS_DIR . 'bootstrap.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'swiper-bundle', NERKO_THEME_JS_DIR . 'swiper-bundle.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'anime-main', NERKO_THEME_JS_DIR . 'anime.min.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'anime-helper', NERKO_THEME_JS_DIR . 'anime-helper.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'anime-defined-timelines', NERKO_THEME_JS_DIR . 'anime-helper-defined-timelines.js', [ 'jquery' ], '', true );
    wp_enqueue_script( 'jquery-easing', NERKO_THEME_JS_DIR . 'jquery.easing.js', [ 'jquery' ], false, true );
    wp_enqueue_script( 'nerko-main', NERKO_THEME_JS_DIR . 'main.js', [ 'jquery' ], false, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'nerko_scripts' );