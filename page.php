<?php
/**
 * The template for displaying static WordPress pages.
 * Prevents cart/checkout/account from falling back to index.php
 * when WooCommerce's template filter doesn't intercept in time.
 */

get_header();
?>

<div class="container" style="padding-top: 40px; padding-bottom: 60px;">
  <?php
  while ( have_posts() ) :
    the_post();
    the_content();
  endwhile;
  ?>
</div>

<?php get_footer(); ?>
