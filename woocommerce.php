<?php
/**
 * WooCommerce fallback template.
 * Wraps all WC pages (cart, checkout, account, order confirmation) in the theme container.
 *
 * NOTE: WooCommerce's template loader checks for woocommerce.php FIRST — before
 * archive-product.php — for every WooCommerce page type. We must manually redirect
 * product archives and product searches to archive-product.php here.
 */

// Product archives, taxonomy pages, and product search → archive-product.php
if (
    is_post_type_archive( 'product' ) ||
    is_product_taxonomy() ||
    ( is_search() && 'product' === get_query_var( 'post_type' ) )
) {
    include( get_template_directory() . '/archive-product.php' );
    return;
}

get_header();
?>

<div class="container" style="padding-top: 40px; padding-bottom: 60px;">
  <?php
  if ( function_exists( 'woocommerce_content' ) ) {
    woocommerce_content();
  }
  ?>
</div>

<?php
get_footer();
