<?php
/**
 * The Template for displaying product archives, including the main shop page.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="container" style="padding-top: 32px; padding-bottom: 60px;">
  <div class="shop-layout">

    <aside class="shop-sidebar">
      <?php get_sidebar( 'shop' ); ?>
    </aside>

    <section class="shop-content">
      <header class="shop-header">
        <h1 class="shop-title"><?php woocommerce_page_title(); ?></h1>
        <?php woocommerce_breadcrumb(); ?>
      </header>

      <?php if ( have_posts() ) : ?>

        <?php woocommerce_output_all_notices(); ?>

        <div class="shop-controls">
          <?php woocommerce_result_count(); ?>
          <?php woocommerce_catalog_ordering(); ?>
        </div>

        <div class="products-grid">
          <?php
          while ( have_posts() ) :
            the_post();
            // Explicitly set up the product object — required when bypassing woocommerce_product_loop_start()
            global $product;
            $product = wc_get_product( get_the_ID() );
            if ( $product && $product->is_visible() ) :
              wc_get_template_part( 'content', 'product' );
            endif;
          endwhile;
          ?>
        </div>

        <?php woocommerce_pagination(); ?>

      <?php else : ?>
        <?php wc_get_template( 'loop/no-products-found.php' ); ?>
      <?php endif; ?>

    </section>
  </div>
</div>

<?php get_footer(); ?>
