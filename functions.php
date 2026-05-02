<?php

function wp_personalproject_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

    register_nav_menus( array(
        'primary' => esc_html__( 'Primary Menu', 'wp-personalproject' ),
    ) );
}
add_action( 'after_setup_theme', 'wp_personalproject_setup' );

function wp_personalproject_scripts() {
    wp_enqueue_style( 'wp-personalproject-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
    wp_enqueue_script(
        'wp-personalproject-script',
        get_stylesheet_directory_uri() . '/assets/js/theme.js',
        array(),
        wp_get_theme()->get( 'Version' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'wp_personalproject_scripts' );

function wp_personalproject_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'wp_personalproject_excerpt_more' );
