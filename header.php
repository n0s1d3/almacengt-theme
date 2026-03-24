<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >

<?php wp_body_open(); ?>

<div class="topbar">
  <div class="container topbar-inner">
    <span><?php esc_html_e( 'Envío gratis en compras mayores a Q499', 'almacengt' ); ?></span>
    <span><?php esc_html_e( 'Soporte 24/7 · Whatsapp: +502 1234 5678', 'almacengt' ); ?></span>
  </div>
</div>

<div class="site-header">
<header class="navbar">
  <div class="navbar-inner">
    <!-- Logo + site name -->
    <a class="site-branding" href="<?php echo esc_url( home_url( '/' ) ); ?>">
      <span class="logo-wrapper">
        <?php if ( has_custom_logo() ) : the_custom_logo(); else : ?>
          <span class="logo-mark">AGT</span>
        <?php endif; ?>
      </span>
    </a>

    <!-- Search — post_type=product filters results to WooCommerce products only -->
    <form class="search-bar" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
      <input type="hidden" name="post_type" value="product">
      <input type="search" name="s"
             placeholder="<?php esc_attr_e( 'Buscar productos...', 'almacengt' ); ?>"
             value="<?php echo esc_attr( get_search_query() ); ?>"
             maxlength="100"
             autocomplete="off">
      <button type="submit" aria-label="<?php esc_attr_e( 'Buscar', 'almacengt' ); ?>">
        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
      </button>
    </form>

    <!-- Account + Cart + Subnav Toggle (mobile) -->
    <div class="actions">
        <?php if ( function_exists( 'wc_get_page_permalink' ) ) : ?>
        <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="action-link">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          <span><?php esc_html_e( 'Cuenta', 'almacengt' ); ?></span>
        </a>
        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="action-link action-cart">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
          <span><?php esc_html_e( 'Carrito', 'almacengt' ); ?></span>
          <?php if ( function_exists( 'WC' ) && ! is_null( WC()->cart ) ) :
            $count = absint( WC()->cart->get_cart_contents_count() );
            if ( $count > 0 ) : ?>
              <span class="cart-count"><?php echo $count; ?></span>
            <?php endif;
          endif; ?>
        </a>
      <?php endif; ?>
    </div>

    <!-- Nav — moved after actions so search bar owns the center space -->
    <nav class="main-nav">
      <?php wp_nav_menu( array(
        'theme_location' => 'menu-1',
        'menu_id'        => 'primary-menu',
        'container'      => false,
        'fallback_cb'    => false,
      ) ); ?>
    </nav>
  </div>
</header>

<!-- Secondary nav — category quick links -->
<nav class="subnav" aria-label="<?php esc_attr_e( 'Categorías', 'almacengt' ); ?>">
  <div class="container subnav-inner">
    <?php
    $subnav_cats = get_terms( [
      'taxonomy'   => 'product_cat',
      'hide_empty' => true,
      'number'     => 8,
      'orderby'    => 'count',
      'order'      => 'DESC',
      'parent'     => 0,
    ] );
    if ( ! empty( $subnav_cats ) && ! is_wp_error( $subnav_cats ) ) :
      foreach ( $subnav_cats as $sncat ) :
        $children = get_terms( [
          'taxonomy'   => 'product_cat',
          'hide_empty' => true,
          'parent'     => $sncat->term_id,
          'orderby'    => 'name',
          'order'      => 'ASC',
        ] );
        if ( ! empty( $children ) && ! is_wp_error( $children ) ) : ?>
          <div class="subnav-item">
            <a href="<?php echo esc_url( get_term_link( $sncat ) ); ?>" class="subnav-link subnav-link--parent">
              <?php echo esc_html( $sncat->name ); ?>
              <svg class="subnav-chevron" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
            </a>
            <div class="subnav-dropdown">
              <?php foreach ( $children as $child ) : ?>
                <a href="<?php echo esc_url( get_term_link( $child ) ); ?>" class="subnav-drop-link">
                  <?php echo esc_html( $child->name ); ?>
                </a>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif;
      endforeach;
    endif; ?>
    <a href="<?php echo esc_url( home_url( '/?post_type=product' ) ); ?>" class="subnav-link subnav-link--accent">
      <?php esc_html_e( 'Ofertas del Día', 'almacengt' ); ?>
    </a>
  </div>
</nav>
</div><!-- /.site-header -->

<main>
