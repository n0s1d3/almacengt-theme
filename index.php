<?php get_header(); ?>

<!-- ═══ HERO BANNER ═══ -->
<section class="hero-banner">
  <div class="hero-banner-inner">
    <span class="hero-eyebrow"><?php esc_html_e( 'Nuevas ofertas cada día', 'almacengt' ); ?></span>
    <h1><?php esc_html_e( 'Tu tienda en línea de confianza', 'almacengt' ); ?></h1>
    <p><?php esc_html_e( 'Descubre miles de productos con envío rápido a todo Guatemala', 'almacengt' ); ?></p>
    <div class="hero-actions">
      <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="btn btn-primary btn-lg">
        <?php esc_html_e( 'Ver todos los productos', 'almacengt' ); ?>
      </a>
      <a href="#deals" class="btn-outline-light btn-lg">
        <?php esc_html_e( 'Ofertas del día', 'almacengt' ); ?>
      </a>
    </div>
  </div>
</section>

<!-- ═══ QUICK CATEGORY STRIP ═══ -->
<?php
$quick_cats = get_terms( array(
  'taxonomy'   => 'product_cat',
  'hide_empty' => true,
  'number'     => 10,
  'orderby'    => 'count',
  'order'      => 'DESC',
) );
if ( ! empty( $quick_cats ) && ! is_wp_error( $quick_cats ) ) : ?>
<nav class="quick-cats">
  <div class="container">
    <ul class="quick-cats-list">
      <?php foreach ( $quick_cats as $cat ) : ?>
        <li>
          <a href="<?php echo esc_url( get_term_link( $cat ) ); ?>" class="quick-cat-item">
            <?php echo esc_html( $cat->name ); ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</nav>
<?php endif; ?>

<div class="container">

  <!-- ═══ DEALS OF THE DAY ═══ -->
  <section class="deals-section" id="deals">
    <div class="section-header">
      <h2><?php esc_html_e( 'Ofertas del Día', 'almacengt' ); ?></h2>
      <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="see-all">
        <?php esc_html_e( 'Ver todas las ofertas →', 'almacengt' ); ?>
      </a>
    </div>
    <div class="deals-grid">
      <?php
      $deals_args = array(
        'post_type'      => 'product',
        'posts_per_page' => 4,
        'post_status'    => 'publish',
        'meta_query'     => array(
          array( 'key' => '_sale_price', 'value' => '', 'compare' => '!=' ),
          array( 'key' => '_stock_status', 'value' => 'instock' ),
        ),
        'orderby' => 'date',
        'order'   => 'DESC',
      );
      $deals = new WP_Query( $deals_args );

      if ( $deals->have_posts() ) :
        while ( $deals->have_posts() ) : $deals->the_post();
          global $product;
          $product = wc_get_product( get_the_ID() );
          if ( ! $product ) : continue; endif;
          ?>
          <div class="deal-card">
            <a href="<?php the_permalink(); ?>" class="deal-card-img">
              <?php woocommerce_template_loop_product_thumbnail(); ?>
              <span class="badge-sale"><?php esc_html_e( 'OFERTA', 'almacengt' ); ?></span>
            </a>
            <div class="deal-card-body">
              <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              <p class="price"><?php echo $product->get_price_html(); ?></p>
              <?php woocommerce_template_loop_add_to_cart(); ?>
            </div>
          </div>
          <?php
        endwhile;
        wp_reset_postdata();

      else :
        for ( $i = 1; $i <= 4; $i++ ) : ?>
          <div class="deal-card">
            <a href="#" class="deal-card-img">
              <img src="https://placehold.co/300x220/e5e5e5/555555?text=Oferta+<?php echo $i; ?>" alt="Oferta <?php echo $i; ?>">
              <span class="badge-sale"><?php esc_html_e( 'OFERTA', 'almacengt' ); ?></span>
            </a>
            <div class="deal-card-body">
              <h3><a href="#"><?php esc_html_e( 'Producto en Oferta', 'almacengt' ); ?> <?php echo $i; ?></a></h3>
              <p class="price">Q <?php echo 299 * $i; ?>.00</p>
              <a href="#" class="btn btn-primary"><?php esc_html_e( 'Agregar al carrito', 'almacengt' ); ?></a>
            </div>
          </div>
        <?php endfor;
      endif; ?>
    </div>
  </section>

</div><!-- /.container -->

<!-- ═══ SHOP BY CATEGORY (full-width bg section) ═══ -->
<section class="categories-section">
  <div class="container">
    <div class="section-header">
      <h2><?php esc_html_e( 'Comprar por Categoría', 'almacengt' ); ?></h2>
    </div>
    <div class="categories-grid">
      <?php
      $categories = get_terms( array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => true,
        'number'     => 4,
        'orderby'    => 'count',
        'order'      => 'DESC',
      ) );

      if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) :
        foreach ( $categories as $category ) :
          $thumb_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
          $image    = $thumb_id
            ? wp_get_attachment_url( $thumb_id )
            : 'https://placehold.co/400x220/e5e5e5/555555?text=' . urlencode( $category->name );
          ?>
          <a href="<?php echo esc_url( get_term_link( $category ) ); ?>" class="category-card">
            <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $category->name ); ?>">
            <div class="category-card-overlay">
              <h3><?php echo esc_html( $category->name ); ?></h3>
              <span><?php esc_html_e( 'Ver productos →', 'almacengt' ); ?></span>
            </div>
          </a>
          <?php
        endforeach;

      else :
        $defaults = array( 'Electrónica', 'Hogar', 'Moda', 'Deportes' );
        foreach ( $defaults as $name ) : ?>
          <a href="#" class="category-card">
            <img src="https://placehold.co/400x220/e5e5e5/555555?text=<?php echo urlencode( $name ); ?>" alt="<?php echo esc_attr( $name ); ?>">
            <div class="category-card-overlay">
              <h3><?php echo esc_html( $name ); ?></h3>
              <span><?php esc_html_e( 'Ver productos →', 'almacengt' ); ?></span>
            </div>
          </a>
        <?php endforeach;
      endif; ?>
    </div>
  </div>
</section>

<!-- ═══ FEATURED PRODUCTS ═══ -->
<section class="featured-section">
  <div class="container">
    <div class="section-header">
      <h2><?php esc_html_e( 'Productos Destacados', 'almacengt' ); ?></h2>
      <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="see-all">
        <?php esc_html_e( 'Ver todos →', 'almacengt' ); ?>
      </a>
    </div>
    <div class="products-grid">
      <?php
      $featured_args = array(
        'post_type'      => 'product',
        'posts_per_page' => 8,
        'post_status'    => 'publish',
        'meta_query'     => array(
          array( 'key' => '_stock_status', 'value' => 'instock' ),
        ),
        'orderby' => 'date',
        'order'   => 'DESC',
      );
      $products = new WP_Query( $featured_args );

      if ( $products->have_posts() ) :
        while ( $products->have_posts() ) : $products->the_post();
          global $product;
          $product = wc_get_product( get_the_ID() );
          if ( $product && $product->is_visible() ) :
            wc_get_template_part( 'content', 'product' );
          endif;
        endwhile;
        wp_reset_postdata();
      endif;
      ?>
    </div>
    <div class="view-all">
      <a href="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="btn btn-primary btn-lg">
        <?php esc_html_e( 'Ver todos los productos', 'almacengt' ); ?>
      </a>
    </div>
  </div>
</section>

<?php get_footer(); ?>
