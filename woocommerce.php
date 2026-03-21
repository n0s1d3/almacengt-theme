<?php
/**
 * WooCommerce fallback template.
 * Wraps all WC pages (cart, checkout, account, order confirmation) in the theme container.
 */

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
