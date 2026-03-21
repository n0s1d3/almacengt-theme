<?php
/**
 * Shop sidebar — called via get_sidebar('shop') from archive-product.php.
 * The <aside class="shop-sidebar"> wrapper is already provided by the parent template.
 */
?>
<div class="widget widget_product_categories">
  <h3><?php esc_html_e( 'Filtrar por categoría', 'almacengt' ); ?></h3>
  <ul>
    <?php
    $product_cats = get_terms( array(
      'taxonomy'   => 'product_cat',
      'orderby'    => 'name',
      'hide_empty' => true,
    ) );
    if ( ! empty( $product_cats ) && ! is_wp_error( $product_cats ) ) :
      foreach ( $product_cats as $cat ) :
        echo '<li><a href="' . esc_url( get_term_link( $cat ) ) . '">'
          . esc_html( $cat->name )
          . ' <small>(' . absint( $cat->count ) . ')</small>'
          . '</a></li>';
      endforeach;
    endif;
    ?>
  </ul>
</div>

<div class="widget widget_price_filter" style="margin-top: 20px;">
  <h3><?php esc_html_e( 'Rango de precio', 'almacengt' ); ?></h3>
  <?php if ( function_exists( 'woocommerce_price_filter' ) ) { woocommerce_price_filter(); } ?>
</div>
