<?php
/**
 * Search results template.
 * Handles ?s=query&post_type=product from the header search bar.
 */

defined( 'ABSPATH' ) || exit;

get_header();

$search_query = get_search_query();
$total        = $GLOBALS['wp_query']->found_posts;
$paged        = max( 1, get_query_var( 'paged', 1 ) );
?>

<div class="container woocommerce" style="padding-top: 32px; padding-bottom: 60px;">

  <!-- Page heading -->
  <header style="margin-bottom: 24px;">
    <?php if ( $search_query ) : ?>
      <h1 style="font-size: 22px; font-weight: 800; color: var(--text); margin: 0 0 6px;">
        <?php printf(
          esc_html( _n(
            '%2$s resultado para &ldquo;%1$s&rdquo;',
            '%2$s resultados para &ldquo;%1$s&rdquo;',
            $total,
            'almacengt'
          ) ),
          '<span style="color:var(--accent);">' . esc_html( $search_query ) . '</span>',
          number_format_i18n( $total )
        ); ?>
      </h1>
    <?php else : ?>
      <h1 style="font-size: 22px; font-weight: 800; color: var(--text); margin: 0;">
        <?php esc_html_e( 'Resultados de búsqueda', 'almacengt' ); ?>
      </h1>
    <?php endif; ?>
  </header>

  <?php woocommerce_output_all_notices(); ?>

  <?php if ( have_posts() ) : ?>

    <div class="products-grid">
      <?php while ( have_posts() ) :
        the_post();

        // Only render WooCommerce products
        if ( get_post_type() !== 'product' ) continue;

        $product = wc_get_product( get_the_ID() );
        if ( ! $product ) continue;

        $img_url = get_the_post_thumbnail_url( get_the_ID(), 'woocommerce_thumbnail' )
                ?: 'https://placehold.co/250x200/e5e5e5/555555?text=' . rawurlencode( get_the_title() );

        $can_add = $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock();
        $btn_url = $can_add
          ? esc_url( add_query_arg( 'add-to-cart', get_the_ID(), wc_get_cart_url() ) )
          : esc_url( get_permalink() );
        $btn_cls = $can_add
          ? 'btn btn-primary add_to_cart_button ajax_add_to_cart'
          : 'btn btn-primary';
      ?>
      <div class="card">
        <a href="<?php echo esc_url( get_permalink() ); ?>" class="card-image">
          <img src="<?php echo esc_url( $img_url ); ?>"
               alt="<?php the_title_attribute(); ?>"
               loading="lazy">
        </a>
        <div class="card-body">
          <div class="card-category">
            <?php echo wc_get_product_category_list( get_the_ID(), ', ' ); ?>
          </div>
          <h3 class="card-title">
            <a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
          </h3>
          <div class="card-price"><?php echo $product->get_price_html(); ?></div>
          <a href="<?php echo $btn_url; ?>"
             class="<?php echo esc_attr( $btn_cls ); ?>"
             data-product_id="<?php echo esc_attr( get_the_ID() ); ?>"
             data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>"
             rel="nofollow"
             aria-label="<?php echo esc_attr( $product->add_to_cart_description() ); ?>">
            <?php echo esc_html( $product->add_to_cart_text() ); ?>
          </a>
        </div>
      </div>
      <?php endwhile; ?>
    </div>

    <?php
    $pagination_html = paginate_links( array(
      'total'     => $GLOBALS['wp_query']->max_num_pages,
      'current'   => $paged,
      'prev_text' => '&laquo;',
      'next_text' => '&raquo;',
    ) );
    if ( $pagination_html ) : ?>
      <nav class="woocommerce-pagination" style="margin-top: 32px;">
        <?php echo $pagination_html; ?>
      </nav>
    <?php endif; ?>

  <?php else : ?>

    <!-- No results -->
    <div style="padding: 56px 0; text-align: center; max-width: 480px; margin: 0 auto;">
      <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="var(--surface-dark)" stroke-width="1.5" style="margin-bottom:20px;">
        <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
      </svg>
      <h2 style="font-size: 20px; font-weight: 800; color: var(--text); margin: 0 0 10px;">
        <?php esc_html_e( 'Sin resultados', 'almacengt' ); ?>
      </h2>
      <p style="font-size: 15px; color: var(--text-muted); margin: 0 0 28px;">
        <?php printf(
          esc_html__( 'No encontramos productos para &ldquo;%s&rdquo;. Intenta con otro término.', 'almacengt' ),
          esc_html( $search_query )
        ); ?>
      </p>

      <!-- Inline search to try again -->
      <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>"
            style="display:flex; gap:8px; justify-content:center; max-width:360px; margin: 0 auto 20px;">
        <input type="hidden" name="post_type" value="product">
        <input type="search" name="s"
               placeholder="<?php esc_attr_e( 'Buscar de nuevo...', 'almacengt' ); ?>"
               maxlength="100"
               style="flex:1; padding:10px 14px; border:1px solid var(--border); border-radius:4px; font-size:14px; color:var(--text); overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
        <button type="submit"
                style="padding:10px 20px; background:var(--accent); color:#000; font-weight:700; border:none; border-radius:4px; cursor:pointer; font-size:14px;">
          <?php esc_html_e( 'Buscar', 'almacengt' ); ?>
        </button>
      </form>

      <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>"
         style="font-size:14px; color:var(--primary); font-weight:600; text-decoration:underline;">
        <?php esc_html_e( 'Explorar todos los productos', 'almacengt' ); ?>
      </a>
    </div>

  <?php endif; ?>

</div>

<?php get_footer(); ?>
