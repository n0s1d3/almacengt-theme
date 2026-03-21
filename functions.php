<?php
/**
 * Almacen GT theme functions and definitions
 */

if ( ! function_exists( 'almacengt_setup' ) ) :
  function almacengt_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    register_nav_menus( array( 'menu-1' => __( 'Primary Menu', 'almacengt' ) ) );
  }
endif;
add_action( 'after_setup_theme', 'almacengt_setup' );

function almacengt_scripts() {
  wp_enqueue_style( 'almacengt-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version') );
  // Opcional: estilos Woocommerce
  wp_enqueue_style( 'almacengt-woocommerce', get_template_directory_uri() . '/woocommerce.css', array('almacengt-style'), wp_get_theme()->get('Version') );
  // Enqueue WooCommerce scripts
  if ( class_exists( 'WooCommerce' ) ) {
    wp_enqueue_script( 'woocommerce' );
    wp_enqueue_script( 'wc-add-to-cart' );
  }
  // Enqueue carousel script
  wp_enqueue_script( 'almacengt-carousel', get_template_directory_uri() . '/js/carousel.js', array('jquery'), wp_get_theme()->get('Version'), true );
}
add_action( 'wp_enqueue_scripts', 'almacengt_scripts' );

// Remove only WooCommerce's general (color/visual) stylesheet — keep layout CSS for cart/checkout/account
add_filter( 'woocommerce_enqueue_styles', function( $styles ) {
  unset( $styles['woocommerce-general'] );
  return $styles;
} );


