<?php
defined( 'ABSPATH' ) || exit;
$shop_url = home_url( '/?post_type=product' );
get_header();
?>

<!-- ══════════════════════════════════════════════
     1. HERO BANNER — promotional slides
     ─────────────────────────────────────────────
     To add/edit slides: update $hp_slides below.
     Upload images via WP Admin → Media Library,
     then paste the file URL into 'image'.
══════════════════════════════════════════════ -->
<?php
$hp_slides = [
  [
    'brand'    => 'AlmacenGT',
    'image'    => '', // paste URL from WP Media Library
    'bg'       => 'linear-gradient(135deg,#14213d 0%,#1e3a6e 100%)',
    'headline' => __( 'Tecnología y electrónica al mejor precio en Guatemala', 'almacengt' ),
    'subline'  => __( 'Miles de productos. Envío rápido. Garantía real.', 'almacengt' ),
    'terms'    => '',
    'cta'      => __( 'Ver todas las ofertas', 'almacengt' ),
    'url'      => $shop_url,
  ],
  [
    'brand'    => 'Smartphones',
    'image'    => '', // paste URL from WP Media Library
    'bg'       => 'linear-gradient(135deg,#2d1b4e 0%,#4a2070 100%)',
    'headline' => __( 'Los mejores celulares desde Q1,299', 'almacengt' ),
    'subline'  => __( 'Samsung, iPhone, Xiaomi y más. Envío gratis a toda Guatemala.', 'almacengt' ),
    'terms'    => __( '*Sujeto a disponibilidad de stock.', 'almacengt' ),
    'cta'      => __( 'Ver celulares', 'almacengt' ),
    'url'      => $shop_url,
  ],
  [
    'brand'    => 'Computadoras',
    'image'    => '', // paste URL from WP Media Library
    'bg'       => 'linear-gradient(135deg,#0d2137 0%,#1a3a5c 100%)',
    'headline' => __( 'Laptops y PCs desde Q2,499', 'almacengt' ),
    'subline'  => __( 'Intel, AMD y Apple. Encuentra tu equipo ideal.', 'almacengt' ),
    'terms'    => __( '*Precios sujetos a cambio sin previo aviso.', 'almacengt' ),
    'cta'      => __( 'Ver computadoras', 'almacengt' ),
    'url'      => $shop_url,
  ],
];
?>
<section class="hp-hero-banner" aria-label="<?php esc_attr_e( 'Ofertas destacadas', 'almacengt' ); ?>">
  <div class="hp-hero-slider" id="hp-hero-slider">
    <?php foreach ( $hp_slides as $i => $s ) : ?>
    <div class="hp-slide<?php echo $i === 0 ? ' is-active' : ''; ?>"
         style="background:<?php echo esc_attr( $s['bg'] ); ?>;">
      <div class="hp-slide-img"
           <?php if ( $s['image'] ) : ?>style="background-image:url('<?php echo esc_url( $s['image'] ); ?>')"<?php endif; ?>>
        <span class="hp-slide-brand"><?php echo esc_html( $s['brand'] ); ?></span>
      </div>
      <div class="hp-slide-info">
        <div class="container hp-slide-info-inner">
          <div class="hp-slide-copy">
            <h2 class="hp-slide-headline"><?php echo esc_html( $s['headline'] ); ?></h2>
            <p class="hp-slide-sub"><?php echo esc_html( $s['subline'] ); ?></p>
            <?php if ( $s['terms'] ) : ?>
              <p class="hp-slide-terms"><?php echo esc_html( $s['terms'] ); ?></p>
            <?php endif; ?>
          </div>
          <a href="<?php echo esc_url( $s['url'] ); ?>" class="hp-slide-cta">
            <?php echo esc_html( $s['cta'] ); ?>
          </a>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <?php if ( count( $hp_slides ) > 1 ) : ?>
  <button class="hp-slider-arrow hp-slider-prev" aria-label="<?php esc_attr_e( 'Anterior', 'almacengt' ); ?>">&#8249;</button>
  <button class="hp-slider-arrow hp-slider-next" aria-label="<?php esc_attr_e( 'Siguiente', 'almacengt' ); ?>">&#8250;</button>
  <div class="hp-slider-dots" role="tablist">
    <?php foreach ( $hp_slides as $i => $s ) : ?>
    <button class="hp-slider-dot<?php echo $i === 0 ? ' is-active' : ''; ?>"
            data-slide="<?php echo $i; ?>"
            role="tab"
            aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"
            aria-label="<?php printf( esc_attr__( 'Slide %d', 'almacengt' ), $i + 1 ); ?>"></button>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</section>

<!-- ══════════════════════════════════════════════
     2. SHOP BY CATEGORY — circular icons
══════════════════════════════════════════════ -->
<?php
$hp_cats = get_terms( [
  'taxonomy'   => 'product_cat',
  'hide_empty' => true,
  'number'     => 10,
  'orderby'    => 'count',
  'order'      => 'DESC',
] );
if ( ! empty( $hp_cats ) && ! is_wp_error( $hp_cats ) ) :
?>
<section class="hp-cats" id="hp-cats">
  <div class="container">
    <h2 class="hp-cats-heading"><?php esc_html_e( 'Comprar por categoría', 'almacengt' ); ?></h2>
    <div class="hp-cats-track">
      <?php foreach ( $hp_cats as $cat ) :
        $thumb_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
        $img      = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'thumbnail' ) : '';
      ?>
      <a href="<?php echo esc_url( get_term_link( $cat ) ); ?>" class="hp-cat-item">
        <div class="hp-cat-circle">
          <?php if ( $img ) : ?>
            <img src="<?php echo esc_url( $img ); ?>" alt="" loading="lazy">
          <?php else : ?>
            <span class="hp-cat-initial"><?php echo esc_html( mb_substr( $cat->name, 0, 1 ) ); ?></span>
          <?php endif; ?>
        </div>
        <span class="hp-cat-name"><?php echo esc_html( $cat->name ); ?></span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════════════════════
     3. PROMO TILES — 4 colored cards
══════════════════════════════════════════════ -->
<?php
$promo_cats = get_terms( [
  'taxonomy'   => 'product_cat',
  'hide_empty' => true,
  'number'     => 4,
  'orderby'    => 'count',
  'order'      => 'DESC',
] );
$tile_bgs       = [ '#14213d', '#0d1f38', '#1a2f50', '#0f2035' ];
$tile_headlines = [
  __( 'Hasta 50% OFF en', 'almacengt' ),
  __( 'Desde Q199 en', 'almacengt' ),
  __( 'Envío gratis en', 'almacengt' ),
  __( 'Nuevos productos en', 'almacengt' ),
];
if ( ! empty( $promo_cats ) && ! is_wp_error( $promo_cats ) ) :
?>
<section class="hp-promos">
  <div class="container">
    <div class="hp-promos-grid">
      <?php foreach ( $promo_cats as $i => $cat ) :
        $bg       = $tile_bgs[ $i % count( $tile_bgs ) ];
        $headline = $tile_headlines[ $i % count( $tile_headlines ) ];
        $thumb_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
        $img      = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'medium' ) : '';
        if ( ! $img ) {
          $cat_post = get_posts( [
            'post_type'      => 'product',
            'posts_per_page' => 1,
            'post_status'    => 'publish',
            'has_thumbnail'  => true,
            'tax_query'      => [ [ 'taxonomy' => 'product_cat', 'field' => 'term_id', 'terms' => $cat->term_id ] ],
          ] );
          if ( $cat_post ) $img = get_the_post_thumbnail_url( $cat_post[0]->ID, 'medium' );
        }
      ?>
      <a href="<?php echo esc_url( get_term_link( $cat ) ); ?>"
         class="hp-promo-tile"
         style="background:<?php echo esc_attr( $bg ); ?>;">
        <p class="hp-promo-headline"><?php echo esc_html( $headline ); ?></p>
        <h3 class="hp-promo-name"><?php echo esc_html( $cat->name ); ?></h3>
        <?php if ( $img ) : ?>
          <img class="hp-promo-img" src="<?php echo esc_url( $img ); ?>" alt="" loading="lazy">
        <?php endif; ?>
        <span class="hp-promo-btn"><?php esc_html_e( 'Ver ahora', 'almacengt' ); ?></span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════════════════════
     4. ACCOUNT BANNER
══════════════════════════════════════════════ -->
<?php if ( ! is_user_logged_in() ) : ?>
<div class="hp-account-banner">
  <div class="container hp-account-inner">
    <div class="hp-account-text">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
      <span>
        <?php esc_html_e( 'Crea tu cuenta para rastrear pedidos, acceder a ofertas exclusivas y más.', 'almacengt' ); ?>
        &nbsp;<small>*<?php esc_html_e( 'Aplican condiciones.', 'almacengt' ); ?></small>
      </span>
    </div>
    <div class="hp-account-actions">
      <?php if ( function_exists( 'wc_get_page_permalink' ) ) : ?>
      <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="hp-account-btn-outline">
        <?php esc_html_e( 'Iniciar sesión', 'almacengt' ); ?>
      </a>
      <a href="<?php echo esc_url( add_query_arg( 'action', 'register', wc_get_page_permalink( 'myaccount' ) ) ); ?>" class="hp-account-btn-primary">
        <?php esc_html_e( 'Crear cuenta', 'almacengt' ); ?>
      </a>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php endif; ?>

<!-- ══════════════════════════════════════════════
     5. BRAND SPOTLIGHT — dark panel + product carousel
══════════════════════════════════════════════ -->
<?php
$spotlight = new WP_Query( [
  'post_type'      => 'product',
  'posts_per_page' => 8,
  'post_status'    => 'publish',
  'meta_query'     => [ [ 'key' => '_sale_price', 'value' => '', 'compare' => '!=' ] ],
  'orderby'        => 'date',
  'order'          => 'DESC',
] );
if ( $spotlight->have_posts() ) :
?>
<section class="hp-spotlight">
  <div class="hp-spotlight-wrap">
    <div class="hp-spotlight-panel">
      <h2><?php esc_html_e( 'Ahorra en electrónica', 'almacengt' ); ?></h2>
      <p><?php esc_html_e( 'Los mejores precios en tecnología para todo Guatemala.', 'almacengt' ); ?></p>
      <a href="<?php echo esc_url( $shop_url ); ?>" class="hp-spotlight-link"><?php esc_html_e( 'Ver todos →', 'almacengt' ); ?></a>
    </div>
    <div class="hp-spotlight-scroll">
      <?php while ( $spotlight->have_posts() ) : $spotlight->the_post();
        $product = wc_get_product( get_the_ID() );
        if ( ! $product ) : continue; endif;
        $img     = get_the_post_thumbnail_url( get_the_ID(), 'woocommerce_thumbnail' )
                   ?: 'https://placehold.co/200x160/e5e5e5/555555?text=' . rawurlencode( get_the_title() );
        $regular = (float) $product->get_regular_price();
        $sale    = (float) $product->get_sale_price();
        $saved   = ( $regular && $sale && $regular > $sale ) ? round( $regular - $sale ) : 0;
      ?>
      <a href="<?php the_permalink(); ?>" class="hp-spotlight-card">
        <?php if ( $saved > 0 ) : ?>
          <span class="hp-save-badge"><?php printf( esc_html__( 'Ahorra Q%s', 'almacengt' ), number_format_i18n( $saved ) ); ?></span>
        <?php endif; ?>
        <div class="hp-spotlight-img"><img src="<?php echo esc_url( $img ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy"></div>
        <h4 class="hp-spotlight-title"><?php the_title(); ?></h4>
        <div class="hp-spotlight-prices">
          <?php if ( $sale ) : ?>
            <span class="hp-price-sale"><?php echo wc_price( $sale ); ?></span>
            <s class="hp-price-reg"><?php echo wc_price( $regular ); ?></s>
          <?php else : ?>
            <span class="hp-price-sale"><?php echo $product->get_price_html(); ?></span>
          <?php endif; ?>
        </div>
      </a>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════════════════════
     6. CATEGORY CIRCLES ON NAVY
══════════════════════════════════════════════ -->
<?php
$nav_cats = get_terms( [
  'taxonomy'   => 'product_cat',
  'hide_empty' => true,
  'number'     => 6,
  'orderby'    => 'count',
  'order'      => 'DESC',
] );
if ( ! empty( $nav_cats ) && ! is_wp_error( $nav_cats ) ) :
?>
<section class="hp-navcats">
  <div class="container hp-navcats-inner">
    <div class="hp-navcats-promo">
      <h2><?php esc_html_e( 'Encuentra lo que necesitas', 'almacengt' ); ?></h2>
      <p><?php esc_html_e( 'Explora nuestra amplia selección de productos.', 'almacengt' ); ?></p>
      <a href="<?php echo esc_url( $shop_url ); ?>" class="hp-navcats-link"><?php esc_html_e( 'Ver todo →', 'almacengt' ); ?></a>
    </div>
    <div class="hp-navcats-circles">
      <?php foreach ( $nav_cats as $cat ) :
        $thumb_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
        $img      = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'thumbnail' ) : '';
      ?>
      <a href="<?php echo esc_url( get_term_link( $cat ) ); ?>" class="hp-navcat-item">
        <div class="hp-navcat-circle">
          <?php if ( $img ) : ?>
            <img src="<?php echo esc_url( $img ); ?>" alt="" loading="lazy">
          <?php else : ?>
            <span><?php echo esc_html( mb_substr( $cat->name, 0, 1 ) ); ?></span>
          <?php endif; ?>
        </div>
        <span class="hp-navcat-label"><?php echo esc_html( $cat->name ); ?></span>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════════════════════
     7. DEAL OF THE DAY — panel + horizontal scroll
══════════════════════════════════════════════ -->
<?php
$deals = new WP_Query( [
  'post_type'      => 'product',
  'posts_per_page' => 8,
  'post_status'    => 'publish',
  'meta_query'     => [
    [ 'key' => '_sale_price', 'value' => '', 'compare' => '!=' ],
    [ 'key' => '_stock_status', 'value' => 'instock' ],
  ],
  'orderby' => 'date',
  'order'   => 'DESC',
] );
if ( $deals->have_posts() ) :
?>
<section class="hp-deals" id="deals">
  <div class="container">
    <div class="hp-deals-wrap">
      <div class="hp-deals-panel">
        <div class="hp-deals-badge">
          <span><?php esc_html_e( 'OFERTA', 'almacengt' ); ?></span>
          <strong><?php esc_html_e( 'DEL DÍA', 'almacengt' ); ?></strong>
        </div>
        <a href="<?php echo esc_url( $shop_url ); ?>" class="hp-deals-cta">
          <?php esc_html_e( 'Ver todas las ofertas', 'almacengt' ); ?>
        </a>
      </div>
      <div class="hp-deals-scroll">
        <?php while ( $deals->have_posts() ) : $deals->the_post();
          $product = wc_get_product( get_the_ID() );
          if ( ! $product ) : continue; endif;
          $img     = get_the_post_thumbnail_url( get_the_ID(), 'woocommerce_thumbnail' )
                     ?: 'https://placehold.co/180x140/e5e5e5/555555?text=' . rawurlencode( get_the_title() );
          $regular = (float) $product->get_regular_price();
          $sale    = (float) $product->get_sale_price();
          $saved   = ( $regular && $sale && $regular > $sale ) ? round( $regular - $sale ) : 0;
        ?>
        <a href="<?php the_permalink(); ?>" class="hp-deal-card">
          <?php if ( $saved > 0 ) : ?>
            <span class="hp-save-badge"><?php printf( esc_html__( 'Ahorra Q%s', 'almacengt' ), number_format_i18n( $saved ) ); ?></span>
          <?php endif; ?>
          <div class="hp-deal-img"><img src="<?php echo esc_url( $img ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy"></div>
          <h4 class="hp-deal-title"><?php the_title(); ?></h4>
          <div class="hp-deal-prices">
            <?php if ( $sale ) : ?>
              <span class="hp-price-sale"><?php echo wc_price( $sale ); ?></span>
              <s class="hp-price-reg"><?php echo wc_price( $regular ); ?></s>
            <?php else : ?>
              <span class="hp-price-sale"><?php echo $product->get_price_html(); ?></span>
            <?php endif; ?>
          </div>
        </a>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ══════════════════════════════════════════════
     8. FEATURED PRODUCTS GRID
══════════════════════════════════════════════ -->
<?php
$featured = new WP_Query( [
  'post_type'      => 'product',
  'posts_per_page' => 8,
  'post_status'    => 'publish',
  'orderby'        => 'date',
  'order'          => 'DESC',
] );
if ( $featured->have_posts() ) :
?>
<section class="hp-featured">
  <div class="container">
    <div class="section-header">
      <h2><?php esc_html_e( 'Productos Destacados', 'almacengt' ); ?></h2>
      <a href="<?php echo esc_url( $shop_url ); ?>" class="see-all"><?php esc_html_e( 'Ver todos →', 'almacengt' ); ?></a>
    </div>
    <div class="products-grid">
      <?php while ( $featured->have_posts() ) : $featured->the_post();
        $product = wc_get_product( get_the_ID() );
        if ( ! $product ) : continue; endif;
        $img_url = get_the_post_thumbnail_url( get_the_ID(), 'woocommerce_thumbnail' )
                   ?: 'https://placehold.co/250x200/e5e5e5/555555?text=' . rawurlencode( get_the_title() );
        $can_add = $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock();
        $btn_url = $can_add ? esc_url( add_query_arg( 'add-to-cart', get_the_ID(), wc_get_cart_url() ) ) : esc_url( get_permalink() );
        $btn_cls = $can_add ? 'btn btn-primary add_to_cart_button ajax_add_to_cart' : 'btn btn-primary';
      ?>
      <div class="card">
        <a href="<?php the_permalink(); ?>" class="card-image">
          <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
        </a>
        <div class="card-body">
          <div class="card-category"><?php echo wc_get_product_category_list( get_the_ID(), ', ' ); ?></div>
          <h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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
    <div style="text-align:center; margin-top:32px;">
      <a href="<?php echo esc_url( $shop_url ); ?>" class="btn btn-primary btn-lg">
        <?php esc_html_e( 'Ver todos los productos', 'almacengt' ); ?>
      </a>
    </div>
  </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>
