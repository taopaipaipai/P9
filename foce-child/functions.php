<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    // Chargement du style.css du thème parent
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

    // Chargement du style.css du thème enfant
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/asset/css/style.css', array(), filemtime(get_stylesheet_directory() . '/asset/css/style.css'));

    // Chargement du script JS du thème enfant
    wp_enqueue_script('theme-script', get_stylesheet_directory_uri() . '/asset/js/script.js', array('jquery'), '1.0.0', true);

}

// Get customizer options form parent theme
if ( get_stylesheet() !== get_template() ) {
    add_filter( 'pre_update_option_theme_mods_' . get_stylesheet(), function ( $value, $old_value ) {
        update_option( 'theme_mods_' . get_template(), $value );
        return $old_value; // prevent update to child theme mods
    }, 10, 2 );
    add_filter( 'pre_option_theme_mods_' . get_stylesheet(), function ( $default ) {
        return get_option( 'theme_mods_' . get_template(), $default );
    } );
}