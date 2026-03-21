<?php
/**
 * The template for displaying single product pages.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="container" style="padding-top: 40px; padding-bottom: 60px;">
  <?php
  while ( have_posts() ) :
    the_post();
    wc_get_template_part( 'content', 'single-product' );
  endwhile;
  ?>
</div>

<?php
get_footer();
