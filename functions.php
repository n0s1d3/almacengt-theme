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
  wp_enqueue_style( 'almacengt-inter', 'https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap', array(), null );
  $ver = '2.1';
  wp_enqueue_style( 'almacengt-style', get_stylesheet_uri(), array('almacengt-inter'), $ver );
  // Opcional: estilos Woocommerce
  wp_enqueue_style( 'almacengt-woocommerce', get_template_directory_uri() . '/woocommerce.css', array('almacengt-style'), $ver );
  // Enqueue WooCommerce scripts
  if ( class_exists( 'WooCommerce' ) ) {
    wp_enqueue_script( 'woocommerce' );
    wp_enqueue_script( 'wc-add-to-cart' );
  }
  // Enqueue carousel script
  wp_enqueue_script( 'almacengt-carousel', get_template_directory_uri() . '/js/carousel.js', array('jquery'), $ver, true );

  // Live search dropdown
  wp_enqueue_script( 'almacengt-live-search', get_template_directory_uri() . '/js/live-search.js', array('jquery'), $ver, true );
  wp_localize_script( 'almacengt-live-search', 'agtSearch', array(
    'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
    'nonce'     => wp_create_nonce( 'agt-live-search' ),
    'searchUrl' => home_url( '/?post_type=product&s=' ),
  ) );
}
add_action( 'wp_enqueue_scripts', 'almacengt_scripts' );

// ── Live search AJAX ────────────────────────────────────────────────────────
add_action( 'wp_ajax_agt_live_search',        'agt_live_search_handler' );
add_action( 'wp_ajax_nopriv_agt_live_search', 'agt_live_search_handler' );

function agt_live_search_handler() {
  check_ajax_referer( 'agt-live-search', 'nonce' );

  $q = isset( $_GET['q'] ) ? sanitize_text_field( wp_unslash( $_GET['q'] ) ) : '';
  if ( mb_strlen( $q ) < 2 ) {
    wp_send_json_success( array() );
  }

  $search = new WP_Query( array(
    'post_type'      => 'product',
    'post_status'    => 'publish',
    'posts_per_page' => 6,
    's'              => $q,
    'tax_query'      => array( array(
      'taxonomy' => 'product_visibility',
      'field'    => 'name',
      'terms'    => array( 'exclude-from-catalog' ),
      'operator' => 'NOT IN',
    ) ),
  ) );

  $results = array();
  while ( $search->have_posts() ) {
    $search->the_post();
    $product = wc_get_product( get_the_ID() );
    if ( ! $product ) continue;
    $title = get_the_title();
    if ( mb_strlen( $title ) > 40 ) {
      $title = mb_substr( $title, 0, 38 ) . '…';
    }
    $cat = wp_strip_all_tags( wc_get_product_category_list( get_the_ID() ) );
    // Keep only the first category if multiple are listed
    $cat = explode( ',', $cat )[0];
    $results[] = array(
      'title' => $title,
      'url'   => get_permalink(),
      'price' => wp_strip_all_tags( $product->get_price_html() ),
      'image' => get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) ?: '',
      'cat'   => trim( $cat ),
    );
  }
  wp_reset_postdata();

  wp_send_json_success( $results );
}

// Remove only WooCommerce's general (color/visual) stylesheet — keep layout CSS for cart/checkout/account
add_filter( 'woocommerce_enqueue_styles', function( $styles ) {
  unset( $styles['woocommerce-general'] );
  return $styles;
} );


