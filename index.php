<?php
/**
 * Fallback template — required by WordPress.
 * In production this file should never be reached:
 * all routes are handled by page-home.php, page-shop.php,
 * archive-product.php, search.php, woocommerce.php, or page.php.
 */
defined( 'ABSPATH' ) || exit;

// Safety redirect: if somehow the front page hits this, send to home.
if ( is_front_page() || is_home() ) {
  wp_safe_redirect( home_url( '/' ) );
  exit;
}

get_header();
?>

<div class="container" style="padding: 80px 24px; text-align: center;">
  <h1><?php esc_html_e( 'Página no encontrada', 'almacengt' ); ?></h1>
  <p><?php esc_html_e( 'Lo sentimos, no pudimos encontrar lo que buscas.', 'almacengt' ); ?></p>
  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
    <?php esc_html_e( 'Volver al inicio', 'almacengt' ); ?>
  </a>
</div>

<?php get_footer();
