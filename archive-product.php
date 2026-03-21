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

        <?php
        // Initialise $GLOBALS['woocommerce_loop'] so wc_product_class() and
        // woocommerce_template_loop_add_to_cart() work correctly.
        wc_setup_loop( array(
          'total'        => $GLOBALS['wp_query']->found_posts,
          'total_pages'  => $GLOBALS['wp_query']->max_num_pages,
          'per_page'     => $GLOBALS['wp_query']->get( 'posts_per_page' ),
          'current_page' => max( 1, $GLOBALS['wp_query']->get( 'paged', 1 ) ),
        ) );

        // Notices only (add-to-cart confirmations, errors, etc.)
        woocommerce_output_all_notices();
        ?>

        <div class="shop-controls">
          <?php woocommerce_result_count(); ?>
          <?php woocommerce_catalog_ordering(); ?>
        </div>

        <div class="products-grid">
          <?php
          while ( have_posts() ) :
            the_post();
            global $product;
            $product = wc_get_product( get_the_ID() );
            if ( $product && $product->is_visible() ) :
              // Use WP's get_template_part — always loads the theme file,
              // bypassing WooCommerce's template cache.
              get_template_part( 'woocommerce/content', 'product' );
            endif;
          endwhile;
          ?>
        </div>

        <?php
        wc_reset_loop();
        woocommerce_pagination();
        ?>

      <?php else : ?>
        <?php wc_get_template( 'loop/no-products-found.php' ); ?>
      <?php endif; ?>

    </section>
  </div>
</div>

<?php get_footer(); ?>
