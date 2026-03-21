<?php
/**
 * Template Name: AlmacenGT — Home
 *
 * Página principal estilo BestBuy.com para AlmacenGT.
 * Selecciona este template desde el editor de páginas de WordPress.
 *
 * @package almacengt
 * @version 2.0
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<style>
/* ============================================================
   HOME PAGE STYLES — incluidos aquí para portabilidad.
   Si prefieres, mueve estos bloques a style.css.
   ============================================================ */

/* --- Reset / utilidades ----------------------------------- */
.agt-home * { box-sizing: border-box; }
.agt-home a { text-decoration: none; color: inherit; }
.agt-home img { max-width: 100%; height: auto; display: block; }
.agt-home ul { list-style: none; margin: 0; padding: 0; }

/* --- Hero ------------------------------------------------- */
.agt-hero {
  background: linear-gradient(135deg, var(--primary) 0%, #1e3a6e 60%, #0d6e6e 100%);
  min-height: 320px;
  display: flex;
  align-items: center;
  overflow: hidden;
  position: relative;
}
.agt-hero::after {
  content: '';
  position: absolute;
  inset: 0;
  background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
  pointer-events: none;
}
.agt-hero .container {
  position: relative;
  z-index: 1;
  display: flex;
  align-items: center;
  gap: 48px;
  padding: 48px 24px;
  width: 100%;
  max-width: 1120px;
  margin: 0 auto;
}
.agt-hero-badge {
  background: var(--accent);
  color: #000;
  font-weight: 900;
  font-size: 13px;
  text-transform: uppercase;
  letter-spacing: 1px;
  padding: 6px 14px;
  border-radius: 2px;
  display: inline-block;
  margin-bottom: 16px;
}
.agt-hero-text { flex: 1; }
.agt-hero-text h1 {
  color: #fff;
  font-size: clamp(28px, 4vw, 48px);
  font-weight: 900;
  line-height: 1.15;
  margin: 0 0 12px;
}
.agt-hero-text p {
  color: rgba(255,255,255,.75);
  font-size: 18px;
  margin: 0 0 8px;
}
.agt-hero-deadline {
  color: var(--accent);
  font-weight: 700;
  font-size: 16px;
  margin-bottom: 28px !important;
}
.agt-hero-actions { display: flex; gap: 12px; flex-wrap: wrap; }
.agt-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 12px 28px;
  font-size: 15px;
  font-weight: 700;
  border-radius: 4px;
  cursor: pointer;
  transition: filter .15s, transform .1s;
  border: none;
}
.agt-btn:hover { filter: brightness(1.08); transform: translateY(-1px); }
.agt-btn-primary { background: var(--accent); color: #000; }
.agt-btn-outline {
  background: transparent;
  color: #fff;
  border: 2px solid rgba(255,255,255,.5);
}
.agt-btn-outline:hover { border-color: #fff; background: rgba(255,255,255,.08); }
.agt-hero-image {
  flex-shrink: 0;
  width: 280px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.agt-hero-image img {
  width: 100%;
  border-radius: 8px;
  box-shadow: 0 24px 64px rgba(0,0,0,.4);
}

/* --- Section titles --------------------------------------- */
.agt-section-title {
  font-size: 22px;
  font-weight: 800;
  color: var(--text);
  margin: 0 0 20px;
}

/* --- Category Strip -------------------------------------- */
.agt-cats-wrap {
  background: #fff;
  border-bottom: 1px solid var(--border);
  padding: 24px 0;
}
.agt-cats-inner {
  max-width: 1120px;
  margin: 0 auto;
  padding: 0 24px;
}
.agt-cats-scroll {
  display: flex;
  gap: 12px;
  overflow-x: auto;
  scrollbar-width: none;
  -ms-overflow-style: none;
  padding-bottom: 4px;
}
.agt-cats-scroll::-webkit-scrollbar { display: none; }
.agt-cat-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
  min-width: 120px;
  padding: 12px 8px;
  border-radius: 8px;
  cursor: pointer;
  transition: background .15s;
  text-align: center;
  flex-shrink: 0;
}
.agt-cat-item:hover { background: var(--surface); }
.agt-cat-thumb {
  width: 88px;
  height: 88px;
  border-radius: 50%;
  background: var(--surface);
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 2px solid var(--border);
  transition: border-color .15s, box-shadow .15s;
}
.agt-cat-item:hover .agt-cat-thumb {
  border-color: var(--accent);
  box-shadow: 0 0 0 3px rgba(252,163,17,.2);
}
.agt-cat-thumb img { width: 100%; height: 100%; object-fit: cover; }
.agt-cat-thumb .agt-cat-icon {
  font-size: 32px;
  color: var(--text-muted);
}
.agt-cat-label {
  font-size: 13px;
  font-weight: 600;
  color: var(--text);
  line-height: 1.3;
}

/* --- Deals grid ------------------------------------------ */
.agt-deals-wrap {
  background: var(--surface);
  padding: 40px 0;
}
.agt-deals-inner {
  max-width: 1120px;
  margin: 0 auto;
  padding: 0 24px;
}
.agt-deals-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
}
.agt-deal-card {
  background: #fff;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0,0,0,.06);
  transition: box-shadow .2s, transform .2s;
  display: flex;
  flex-direction: column;
}
.agt-deal-card:hover {
  box-shadow: 0 8px 32px rgba(0,0,0,.12);
  transform: translateY(-3px);
}
.agt-deal-card-img {
  position: relative;
  aspect-ratio: 4/3;
  overflow: hidden;
  background: var(--surface);
}
.agt-deal-card-img img {
  width: 100%; height: 100%;
  object-fit: cover;
  transition: transform .3s;
}
.agt-deal-card:hover .agt-deal-card-img img { transform: scale(1.04); }
.agt-deal-badge {
  position: absolute;
  top: 10px; left: 10px;
  background: #d0021b;
  color: #fff;
  font-size: 11px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: .5px;
  padding: 3px 8px;
  border-radius: 2px;
}
.agt-deal-card-body { padding: 14px; flex: 1; display: flex; flex-direction: column; gap: 6px; }
.agt-deal-card-name {
  font-size: 14px;
  font-weight: 600;
  color: var(--text);
  line-height: 1.4;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.agt-deal-card-price {
  display: flex;
  align-items: baseline;
  gap: 8px;
  flex-wrap: wrap;
}
.agt-deal-card-price .price-current {
  font-size: 20px;
  font-weight: 900;
  color: var(--accent);
}
.agt-deal-card-price .price-was {
  font-size: 13px;
  color: var(--text-muted);
  text-decoration: line-through;
}
.agt-deal-card-price .price-save {
  font-size: 12px;
  font-weight: 700;
  color: #d0021b;
}
.agt-deal-card-footer { padding: 0 14px 14px; }
.agt-deal-card-footer .agt-btn {
  width: 100%;
  justify-content: center;
  padding: 10px;
  font-size: 14px;
}

/* --- Category tiles -------------------------------------- */
.agt-tiles-wrap {
  background: #fff;
  padding: 40px 0;
}
.agt-tiles-inner {
  max-width: 1120px;
  margin: 0 auto;
  padding: 0 24px;
}
.agt-tiles-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
}
.agt-tile {
  position: relative;
  border-radius: 8px;
  overflow: hidden;
  aspect-ratio: 3/2;
  cursor: pointer;
  background: var(--primary);
}
.agt-tile img {
  width: 100%; height: 100%;
  object-fit: cover;
  transition: transform .35s;
}
.agt-tile:hover img { transform: scale(1.06); }
.agt-tile-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(0,0,0,.75) 0%, rgba(0,0,0,.1) 55%, transparent 100%);
  display: flex;
  align-items: flex-end;
  padding: 16px;
  transition: background .2s;
}
.agt-tile:hover .agt-tile-overlay {
  background: linear-gradient(to top, rgba(20,33,61,.85) 0%, rgba(20,33,61,.2) 55%, transparent 100%);
}
.agt-tile-label {
  color: #fff;
  font-size: 16px;
  font-weight: 800;
  line-height: 1.3;
  text-shadow: 0 1px 4px rgba(0,0,0,.5);
}
.agt-tile-label span {
  display: block;
  font-size: 12px;
  font-weight: 500;
  color: var(--accent);
  margin-bottom: 4px;
  text-transform: uppercase;
  letter-spacing: 1px;
}

/* --- Featured products ----------------------------------- */
.agt-featured-wrap {
  background: var(--surface);
  padding: 40px 0 56px;
}
.agt-featured-inner {
  max-width: 1120px;
  margin: 0 auto;
  padding: 0 24px;
}
.agt-products-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
}
.agt-product-card {
  background: #fff;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 1px 4px rgba(0,0,0,.06);
  transition: box-shadow .2s, transform .2s;
  display: flex;
  flex-direction: column;
}
.agt-product-card:hover {
  box-shadow: 0 6px 24px rgba(0,0,0,.1);
  transform: translateY(-2px);
}
.agt-product-card-img {
  aspect-ratio: 1;
  background: var(--surface);
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 16px;
}
.agt-product-card-img img {
  width: 100%; height: 100%;
  object-fit: contain;
  transition: transform .3s;
}
.agt-product-card:hover .agt-product-card-img img { transform: scale(1.05); }
.agt-product-card-body { padding: 14px; flex: 1; display: flex; flex-direction: column; gap: 8px; }
.agt-product-card-name {
  font-size: 14px;
  font-weight: 600;
  color: var(--text);
  line-height: 1.4;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.agt-product-card-rating {
  display: flex;
  align-items: center;
  gap: 4px;
  font-size: 13px;
  color: var(--text-muted);
}
.agt-product-card-rating .stars { color: var(--accent); letter-spacing: -1px; }
.agt-product-card-price { font-size: 20px; font-weight: 900; color: var(--accent); }
.agt-product-card-footer { padding: 0 14px 14px; }
.agt-product-card-footer .agt-btn {
  width: 100%;
  justify-content: center;
  padding: 10px;
  font-size: 14px;
}

/* --- Responsive ------------------------------------------ */
@media (max-width: 1024px) {
  .agt-deals-grid,
  .agt-tiles-grid,
  .agt-products-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 768px) {
  .agt-hero .container { flex-direction: column; text-align: center; }
  .agt-hero-image { width: 200px; }
  .agt-hero-actions { justify-content: center; }
  .agt-deals-grid,
  .agt-tiles-grid,
  .agt-products-grid { grid-template-columns: repeat(2, 1fr); }
  .agt-cat-item { min-width: 96px; }
}
@media (max-width: 480px) {
  .agt-deals-grid,
  .agt-tiles-grid,
  .agt-products-grid { grid-template-columns: 1fr; }
  .agt-hero-text h1 { font-size: 26px; }
}
</style>

<main class="agt-home">

  <?php
  /* ========================================================
     1. HERO BANNER
     Edita el contenido desde aquí o usa ACF si prefieres
     campos dinámicos.
     ======================================================== */
  $hero_title    = get_theme_mod( 'agt_hero_title', 'Las mejores ofertas en tecnología están aquí' );
  $hero_subtitle = get_theme_mod( 'agt_hero_subtitle', 'Laptops, celulares, televisores y mucho más.' );
  $hero_badge    = get_theme_mod( 'agt_hero_badge', 'Temporada de ofertas' );
  $hero_deadline = get_theme_mod( 'agt_hero_deadline', 'Solo hasta el domingo' );
  $hero_url      = get_theme_mod( 'agt_hero_url', wc_get_page_permalink( 'shop' ) );
  $hero_img      = get_theme_mod( 'agt_hero_image', '' );
  ?>
  <section class="agt-hero">
    <div class="container">
      <div class="agt-hero-text">
        <span class="agt-hero-badge"><?php echo esc_html( $hero_badge ); ?></span>
        <h1><?php echo esc_html( $hero_title ); ?></h1>
        <p><?php echo esc_html( $hero_subtitle ); ?></p>
        <p class="agt-hero-deadline"><?php echo esc_html( $hero_deadline ); ?></p>
        <div class="agt-hero-actions">
          <a href="<?php echo esc_url( $hero_url ); ?>" class="agt-btn agt-btn-primary">
            <?php esc_html_e( 'Ver ofertas', 'almacengt' ); ?>
          </a>
          <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="agt-btn agt-btn-outline">
            <?php esc_html_e( 'Explorar tienda', 'almacengt' ); ?>
          </a>
        </div>
      </div>
      <?php if ( $hero_img ) : ?>
      <div class="agt-hero-image">
        <img src="<?php echo esc_url( $hero_img ); ?>" alt="<?php echo esc_attr( $hero_title ); ?>">
      </div>
      <?php endif; ?>
    </div>
  </section>

  <?php
  /* ========================================================
     2. STRIP DE CATEGORÍAS CON IMAGEN DE PRODUCTO
     Muestra las categorías de WooCommerce con imagen.
     ======================================================== */
  $cat_args = array(
    'taxonomy'   => 'product_cat',
    'orderby'    => 'count',
    'order'      => 'DESC',
    'hide_empty' => true,
    'number'     => 10,
    'exclude'    => array( get_option( 'default_product_cat' ) ),
  );
  $product_cats = get_terms( $cat_args );
  if ( ! is_wp_error( $product_cats ) && ! empty( $product_cats ) ) :
  ?>
  <section class="agt-cats-wrap">
    <div class="agt-cats-inner">
      <div class="agt-cats-scroll">
        <?php foreach ( $product_cats as $cat ) :
          $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
          $image_url    = $thumbnail_id
            ? wp_get_attachment_image_url( $thumbnail_id, 'thumbnail' )
            : wc_placeholder_img_src( 'thumbnail' );
          $cat_link     = get_term_link( $cat, 'product_cat' );
        ?>
        <a href="<?php echo esc_url( $cat_link ); ?>" class="agt-cat-item">
          <div class="agt-cat-thumb">
            <img src="<?php echo esc_url( $image_url ); ?>"
                 alt="<?php echo esc_attr( $cat->name ); ?>"
                 loading="lazy">
          </div>
          <span class="agt-cat-label"><?php echo esc_html( $cat->name ); ?></span>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php
  /* ========================================================
     3. OFERTAS DEL DÍA — productos en oferta (on_sale)
     ======================================================== */
  $deals_query = new WP_Query( array(
    'post_type'      => 'product',
    'posts_per_page' => 8,
    'post_status'    => 'publish',
    'meta_query'     => array(
      'relation' => 'OR',
      array( 'key' => '_sale_price', 'value' => '', 'compare' => '!=' ),
      array( 'key' => '_min_variation_sale_price', 'value' => '', 'compare' => '!=' ),
    ),
    'orderby'        => 'meta_value_num',
    'meta_key'       => '_sale_price',
    'order'          => 'DESC',
  ) );

  if ( $deals_query->have_posts() ) :
  ?>
  <section class="agt-deals-wrap">
    <div class="agt-deals-inner">
      <h2 class="agt-section-title"><?php esc_html_e( 'Ofertas del Día', 'almacengt' ); ?></h2>
      <div class="agt-deals-grid">
        <?php
        while ( $deals_query->have_posts() ) :
          $deals_query->the_post();
          global $product;
          $product = wc_get_product( get_the_ID() );
          if ( ! $product || ! $product->is_visible() ) continue;

          $regular = $product->get_regular_price();
          $sale    = $product->get_sale_price();
          $saving  = $regular && $sale ? 'Q' . number_format( $regular - $sale, 2 ) : '';
          $img_url = get_the_post_thumbnail_url( get_the_ID(), 'woocommerce_single' )
                  ?: wc_placeholder_img_src( 'woocommerce_single' );
          $cart_url = $product->is_type( 'simple' )
            ? esc_url( wc_get_cart_url() . '?add-to-cart=' . get_the_ID() )
            : get_permalink();
        ?>
        <div class="agt-deal-card">
          <a href="<?php echo esc_url( get_permalink() ); ?>" class="agt-deal-card-img">
            <img src="<?php echo esc_url( $img_url ); ?>"
                 alt="<?php the_title_attribute(); ?>"
                 loading="lazy">
            <span class="agt-deal-badge"><?php esc_html_e( 'OFERTA', 'almacengt' ); ?></span>
          </a>
          <div class="agt-deal-card-body">
            <a href="<?php echo esc_url( get_permalink() ); ?>" class="agt-deal-card-name">
              <?php the_title(); ?>
            </a>
            <div class="agt-deal-card-price">
              <span class="price-current">Q<?php echo number_format( (float) $sale, 2 ); ?></span>
              <?php if ( $regular ) : ?>
              <span class="price-was">Q<?php echo number_format( (float) $regular, 2 ); ?></span>
              <?php endif; ?>
              <?php if ( $saving ) : ?>
              <span class="price-save"><?php printf( esc_html__( 'Ahorra %s', 'almacengt' ), $saving ); ?></span>
              <?php endif; ?>
            </div>
          </div>
          <div class="agt-deal-card-footer">
            <a href="<?php echo esc_url( $cart_url ); ?>" class="agt-btn agt-btn-primary">
              <?php esc_html_e( 'Agregar al carrito', 'almacengt' ); ?>
            </a>
          </div>
        </div>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php
  /* ========================================================
     4. COMPRAR POR CATEGORÍA — tiles con imagen de fondo
     Muestra las 8 categorías con más productos.
     ======================================================== */
  $tile_cats = get_terms( array(
    'taxonomy'   => 'product_cat',
    'orderby'    => 'count',
    'order'      => 'DESC',
    'hide_empty' => true,
    'number'     => 8,
    'exclude'    => array( get_option( 'default_product_cat' ) ),
  ) );

  if ( ! is_wp_error( $tile_cats ) && ! empty( $tile_cats ) ) :
  ?>
  <section class="agt-tiles-wrap">
    <div class="agt-tiles-inner">
      <h2 class="agt-section-title"><?php esc_html_e( 'Comprar por Categoría', 'almacengt' ); ?></h2>
      <div class="agt-tiles-grid">
        <?php foreach ( $tile_cats as $tc ) :
          $thumb_id = get_term_meta( $tc->term_id, 'thumbnail_id', true );
          $bg_url   = $thumb_id
            ? wp_get_attachment_image_url( $thumb_id, 'large' )
            : 'https://placehold.co/480x320/14213d/fca311?text=' . rawurlencode( $tc->name );
        ?>
        <a href="<?php echo esc_url( get_term_link( $tc, 'product_cat' ) ); ?>" class="agt-tile">
          <img src="<?php echo esc_url( $bg_url ); ?>"
               alt="<?php echo esc_attr( $tc->name ); ?>"
               loading="lazy">
          <div class="agt-tile-overlay">
            <div class="agt-tile-label">
              <span><?php printf( esc_html__( '%d productos', 'almacengt' ), $tc->count ); ?></span>
              <?php echo esc_html( $tc->name ); ?>
            </div>
          </div>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php
  /* ========================================================
     5. PRODUCTOS DESTACADOS
     Usa el atributo "featured" de WooCommerce.
     ======================================================== */
  $featured_query = new WP_Query( array(
    'post_type'      => 'product',
    'posts_per_page' => 8,
    'post_status'    => 'publish',
    'tax_query'      => array( array(
      'taxonomy' => 'product_visibility',
      'field'    => 'name',
      'terms'    => 'featured',
    ) ),
  ) );

  /* Si no hay featured, mostrar los más recientes */
  if ( ! $featured_query->have_posts() ) {
    $featured_query = new WP_Query( array(
      'post_type'      => 'product',
      'posts_per_page' => 8,
      'post_status'    => 'publish',
      'orderby'        => 'date',
      'order'          => 'DESC',
    ) );
  }

  if ( $featured_query->have_posts() ) :
  ?>
  <section class="agt-featured-wrap">
    <div class="agt-featured-inner">
      <h2 class="agt-section-title"><?php esc_html_e( 'Productos Destacados', 'almacengt' ); ?></h2>
      <div class="agt-products-grid">
        <?php
        while ( $featured_query->have_posts() ) :
          $featured_query->the_post();
          global $product;
          $product = wc_get_product( get_the_ID() );
          if ( ! $product || ! $product->is_visible() ) continue;

          $price    = $product->get_price();
          $img_url  = get_the_post_thumbnail_url( get_the_ID(), 'woocommerce_single' )
                   ?: wc_placeholder_img_src( 'woocommerce_single' );
          $avg      = $product->get_average_rating();
          $count    = $product->get_rating_count();
          $stars    = str_repeat( '★', (int) round( $avg ) ) . str_repeat( '☆', 5 - (int) round( $avg ) );
          $cart_url = $product->is_type( 'simple' )
            ? esc_url( wc_get_cart_url() . '?add-to-cart=' . get_the_ID() )
            : get_permalink();
        ?>
        <div class="agt-product-card">
          <a href="<?php echo esc_url( get_permalink() ); ?>" class="agt-product-card-img">
            <img src="<?php echo esc_url( $img_url ); ?>"
                 alt="<?php the_title_attribute(); ?>"
                 loading="lazy">
          </a>
          <div class="agt-product-card-body">
            <a href="<?php echo esc_url( get_permalink() ); ?>" class="agt-product-card-name">
              <?php the_title(); ?>
            </a>
            <?php if ( $count > 0 ) : ?>
            <div class="agt-product-card-rating">
              <span class="stars"><?php echo esc_html( $stars ); ?></span>
              <span>(<?php echo esc_html( $count ); ?>)</span>
            </div>
            <?php endif; ?>
            <div class="agt-product-card-price">
              Q<?php echo number_format( (float) $price, 2 ); ?>
            </div>
          </div>
          <div class="agt-product-card-footer">
            <a href="<?php echo esc_url( $cart_url ); ?>" class="agt-btn agt-btn-primary">
              <?php esc_html_e( 'Agregar al carrito', 'almacengt' ); ?>
            </a>
          </div>
        </div>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

</main>

<?php get_footer(); ?>
