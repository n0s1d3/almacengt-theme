<?php
/**
 * Template Name: AlmacenGT — Tienda
 *
 * Asigna este template a la página "Tienda" desde el editor de WordPress.
 * Páginas → Tienda → Atributos de página → Plantilla → AlmacenGT — Tienda
 *
 * También configura esa misma página como "Página de la tienda" en:
 * WooCommerce → Ajustes → Productos → Página de la tienda.
 *
 * @package almacengt
 * @version 2.0
 */

defined( 'ABSPATH' ) || exit;

get_header();

// ── Parámetros de URL ────────────────────────────────────────────────────────
$current_cat   = isset( $_GET['cat'] )     ? sanitize_title( wp_unslash( $_GET['cat'] ) )     : '';
$orderby_param = isset( $_GET['orderby'] ) ? sanitize_text_field( wp_unslash( $_GET['orderby'] ) ) : 'date';
$paged         = isset( $_GET['pg'] )      ? max( 1, absint( $_GET['pg'] ) )                  : 1;

// ── Mapa de ordenamiento ─────────────────────────────────────────────────────
$sort_map = array(
	'date'       => array( 'orderby' => 'date',           'order' => 'DESC' ),
	'popularity' => array( 'orderby' => 'meta_value_num', 'order' => 'DESC', 'meta_key' => 'total_sales' ),
	'rating'     => array( 'orderby' => 'meta_value_num', 'order' => 'DESC', 'meta_key' => '_wc_average_rating' ),
	'price'      => array( 'orderby' => 'meta_value_num', 'order' => 'ASC',  'meta_key' => '_price' ),
	'price-desc' => array( 'orderby' => 'meta_value_num', 'order' => 'DESC', 'meta_key' => '_price' ),
);
$sort = isset( $sort_map[ $orderby_param ] ) ? $sort_map[ $orderby_param ] : $sort_map['date'];

// ── Tax query: visibilidad + categoría ──────────────────────────────────────
$tax_query = array(
	array(
		'taxonomy' => 'product_visibility',
		'field'    => 'name',
		'terms'    => array( 'exclude-from-catalog' ),
		'operator' => 'NOT IN',
	),
);
if ( $current_cat ) {
	$tax_query['relation'] = 'AND';
	$tax_query[]           = array(
		'taxonomy' => 'product_cat',
		'field'    => 'slug',
		'terms'    => $current_cat,
	);
}

// ── Consulta principal ───────────────────────────────────────────────────────
$shop_query = new WP_Query( array_merge(
	array(
		'post_type'      => 'product',
		'post_status'    => 'publish',
		'posts_per_page' => 12,
		'paged'          => $paged,
		'tax_query'      => $tax_query,
	),
	$sort
) );

// ── Categorías para el sidebar ───────────────────────────────────────────────
$all_cats = get_terms( array(
	'taxonomy'   => 'product_cat',
	'orderby'    => 'name',
	'hide_empty' => true,
	'exclude'    => array( get_option( 'default_product_cat' ) ),
) );
?>

<div class="container woocommerce" style="padding-top: 32px; padding-bottom: 60px;">
  <div class="shop-layout">

    <!-- ===== SIDEBAR ===== -->
    <aside class="shop-sidebar">
      <div class="widget widget_product_categories">
        <h3><?php esc_html_e( 'Categorías', 'almacengt' ); ?></h3>
        <ul>
          <li>
            <a href="<?php echo esc_url( remove_query_arg( array( 'cat', 'pg' ) ) ); ?>"
               <?php if ( ! $current_cat ) echo 'style="color:var(--accent);font-weight:700;"'; ?>>
              <?php esc_html_e( 'Todos los productos', 'almacengt' ); ?>
            </a>
          </li>
          <?php foreach ( (array) $all_cats as $cat ) :
            if ( is_wp_error( $cat ) ) continue;
            $is_active = ( $current_cat === $cat->slug );
          ?>
          <li>
            <a href="<?php echo esc_url( add_query_arg( array( 'cat' => $cat->slug, 'pg' => false ) ) ); ?>"
               <?php if ( $is_active ) echo 'style="color:var(--accent);font-weight:700;"'; ?>>
              <?php echo esc_html( $cat->name ); ?>
              <small>(<?php echo absint( $cat->count ); ?>)</small>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </aside>

    <!-- ===== CONTENIDO ===== -->
    <section class="shop-content">

      <header class="shop-header">
        <h1 class="shop-title">
          <?php if ( $current_cat ) :
            $cat_obj = get_term_by( 'slug', $current_cat, 'product_cat' );
            echo $cat_obj ? esc_html( $cat_obj->name ) : esc_html__( 'Almacen', 'almacengt' );
          else :
            esc_html_e( 'Almacen', 'almacengt' );
          endif; ?>
        </h1>
      </header>

      <?php woocommerce_output_all_notices(); ?>

      <?php if ( $shop_query->have_posts() ) :
        $total = $shop_query->found_posts;
        $from  = ( $paged - 1 ) * 12 + 1;
        $to    = min( $paged * 12, $total );
      ?>

        <div class="shop-controls">
          <p class="woocommerce-result-count">
            <?php printf(
              esc_html__( 'Mostrando %1$s–%2$s de %3$s resultados', 'almacengt' ),
              $from, $to, $total
            ); ?>
          </p>
          <form class="woocommerce-ordering" method="get">
            <select name="orderby" onchange="this.form.submit()">
              <?php
              $sort_labels = array(
                'date'       => __( 'Más recientes',           'almacengt' ),
                'popularity' => __( 'Popularidad',             'almacengt' ),
                'rating'     => __( 'Valoración',              'almacengt' ),
                'price'      => __( 'Precio: menor a mayor',   'almacengt' ),
                'price-desc' => __( 'Precio: mayor a menor',   'almacengt' ),
              );
              foreach ( $sort_labels as $val => $label ) :
                printf(
                  '<option value="%s"%s>%s</option>',
                  esc_attr( $val ),
                  selected( $orderby_param, $val, false ),
                  esc_html( $label )
                );
              endforeach;
              ?>
            </select>
            <?php if ( $current_cat ) : ?>
              <input type="hidden" name="cat" value="<?php echo esc_attr( $current_cat ); ?>">
            <?php endif; ?>
          </form>
        </div>

        <div class="products-grid">
          <?php while ( $shop_query->have_posts() ) :
            $shop_query->the_post();
            $product = wc_get_product( get_the_ID() );
            if ( ! $product ) continue;

            $img_url = get_the_post_thumbnail_url( get_the_ID(), 'woocommerce_thumbnail' )
                    ?: 'https://placehold.co/250x200/e5e5e5/555555?text=' . rawurlencode( get_the_title() );

            $can_add = $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock();
            $btn_url  = $can_add
              ? esc_url( add_query_arg( 'add-to-cart', get_the_ID(), wc_get_cart_url() ) )
              : esc_url( get_permalink() );
            $btn_cls  = $can_add
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
          <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <?php
        $pagination_html = paginate_links( array(
          'base'      => add_query_arg( 'pg', '%#%' ),
          'format'    => '',
          'current'   => $paged,
          'total'     => $shop_query->max_num_pages,
          'prev_text' => '&laquo;',
          'next_text' => '&raquo;',
        ) );
        if ( $pagination_html ) : ?>
        <nav class="woocommerce-pagination">
          <?php echo $pagination_html; ?>
        </nav>
        <?php endif; ?>

      <?php else : ?>

        <div style="padding:48px 0;text-align:center;">
          <p style="font-size:16px;color:var(--text-muted);margin:0 0 16px;">
            <?php esc_html_e( 'No se encontraron productos.', 'almacengt' ); ?>
          </p>
          <a href="<?php echo esc_url( remove_query_arg( array( 'cat', 'orderby', 'pg' ) ) ); ?>"
             style="display:inline-flex;align-items:center;padding:10px 24px;background:var(--accent);color:#000;font-weight:700;border-radius:4px;text-decoration:none;">
            <?php esc_html_e( 'Ver todos los productos', 'almacengt' ); ?>
          </a>
        </div>

      <?php endif; ?>

    </section>
  </div>
</div>

<?php get_footer(); ?>
