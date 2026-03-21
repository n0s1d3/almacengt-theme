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

<header class="navbar">
  <div class="navbar-inner">
    <a class="site-branding" href="<?php echo esc_url( home_url( '/' ) ); ?>">
      <span class="logo-wrapper">
        <?php
        if ( has_custom_logo() ) {
          the_custom_logo();
        } else {
          ?>
          <span class="logo-mark">AG</span>
          <?php
        }
        ?>
      </span>
      <span class="site-name"><?php bloginfo( 'name' ); ?></span>
    </a>

    <nav class="main-nav">
      <?php
      wp_nav_menu( array(
        'theme_location' => 'menu-1',
        'menu_id'        => 'primary-menu',
        'container'      => false,
        'fallback_cb'    => false,
      ) );
      ?>
    </nav>

    <form class="search-bar" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
      <input type="search" name="s" placeholder="<?php esc_attr_e( 'Buscar productos...', 'almacengt' ); ?>" value="<?php echo get_search_query(); ?>" />
      <button type="submit">🔍</button>
    </form>

    <div class="actions">
      <?php if ( function_exists( 'wc_get_page_permalink' ) ) : ?>
        <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"><?php esc_html_e( 'Cuenta', 'almacengt' ); ?></a>
        <a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
          <?php esc_html_e( 'Carrito', 'almacengt' ); ?>
          <?php if ( ! is_null( WC()->cart ) ) : ?>
            (<?php echo absint( WC()->cart->get_cart_contents_count() ); ?>)
          <?php endif; ?>
        </a>
      <?php endif; ?>
    </div>
  </div>
</header>

<main>
