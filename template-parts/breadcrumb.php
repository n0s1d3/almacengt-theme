<?php
/**
 * Breadcrumb template
 */

if ( ! function_exists( 'almacengt_breadcrumbs' ) ) :
  function almacengt_breadcrumbs() {
    if ( function_exists( 'woocommerce_breadcrumb' ) ) {
      woocommerce_breadcrumb( array(
        'delimiter'   => ' <span aria-hidden="true">›</span> ',
        'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
        'wrap_after'  => '</nav>',
        'home'        => _x( 'Inicio', 'breadcrumb', 'almacengt' ),
      ) );
    }
  }
endif;

almacengt_breadcrumbs();