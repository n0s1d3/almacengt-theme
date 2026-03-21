</main>

<!-- Service links row -->
<div class="footer-services">
  <div class="container footer-services-inner">
    <a href="#" class="footer-service-item">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.9 12.72a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.81 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
      <span><?php esc_html_e( 'Atención al Cliente', 'almacengt' ); ?></span>
    </a>
    <a href="#" class="footer-service-item">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
      <span><?php esc_html_e( 'Estado del Pedido', 'almacengt' ); ?></span>
    </a>
    <a href="#" class="footer-service-item">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12H19M12 5l7 7-7 7"/></svg>
      <span><?php esc_html_e( 'Envíos', 'almacengt' ); ?></span>
    </a>
    <a href="#" class="footer-service-item">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.56"/></svg>
      <span><?php esc_html_e( 'Devoluciones', 'almacengt' ); ?></span>
    </a>
    <a href="#" class="footer-service-item">
      <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
      <span><?php esc_html_e( 'Garantía de Precio', 'almacengt' ); ?></span>
    </a>
  </div>
</div>

<footer class="page-footer">
  <div class="container">
    <div class="footer-content">
      <!-- Column 1: About -->
      <div class="footer-col">
        <h4 class="footer-col-heading"><?php bloginfo( 'name' ); ?></h4>
        <p class="footer-col-desc"><?php esc_html_e( 'Tu tienda de tecnología y electrónica en Guatemala. Precios bajos, envío rápido.', 'almacengt' ); ?></p>
      </div>
      <!-- Column 2: Categories -->
      <div class="footer-col">
        <h4 class="footer-col-heading"><?php esc_html_e( 'Categorías', 'almacengt' ); ?></h4>
        <ul class="footer-col-list">
          <?php
          $footer_cats = get_terms( [
            'taxonomy'   => 'product_cat',
            'hide_empty' => true,
            'number'     => 5,
            'orderby'    => 'count',
            'order'      => 'DESC',
          ] );
          if ( ! empty( $footer_cats ) && ! is_wp_error( $footer_cats ) ) :
            foreach ( $footer_cats as $fcat ) :
          ?>
          <li><a href="<?php echo esc_url( get_term_link( $fcat ) ); ?>"><?php echo esc_html( $fcat->name ); ?></a></li>
          <?php endforeach; endif; ?>
        </ul>
      </div>
      <!-- Column 3: Help -->
      <div class="footer-col">
        <h4 class="footer-col-heading"><?php esc_html_e( 'Ayuda', 'almacengt' ); ?></h4>
        <ul class="footer-col-list">
          <li><a href="#"><?php esc_html_e( 'Estado del Pedido', 'almacengt' ); ?></a></li>
          <li><a href="#"><?php esc_html_e( 'Envíos y Entregas', 'almacengt' ); ?></a></li>
          <li><a href="#"><?php esc_html_e( 'Devoluciones', 'almacengt' ); ?></a></li>
          <li><a href="#"><?php esc_html_e( 'Garantía de Precio', 'almacengt' ); ?></a></li>
          <li><a href="#"><?php esc_html_e( 'Preguntas Frecuentes', 'almacengt' ); ?></a></li>
        </ul>
      </div>
      <!-- Column 4: Account -->
      <div class="footer-col">
        <h4 class="footer-col-heading"><?php esc_html_e( 'Mi Cuenta', 'almacengt' ); ?></h4>
        <ul class="footer-col-list">
          <?php if ( function_exists( 'wc_get_page_permalink' ) ) : ?>
          <li><a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"><?php esc_html_e( 'Iniciar Sesión', 'almacengt' ); ?></a></li>
          <li><a href="<?php echo esc_url( add_query_arg( 'action', 'register', wc_get_page_permalink( 'myaccount' ) ) ); ?>"><?php esc_html_e( 'Crear Cuenta', 'almacengt' ); ?></a></li>
          <li><a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) . 'orders/' ); ?>"><?php esc_html_e( 'Mis Pedidos', 'almacengt' ); ?></a></li>
          <li><a href="<?php echo esc_url( wc_get_cart_url() ); ?>"><?php esc_html_e( 'Carrito', 'almacengt' ); ?></a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      <p>&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'Todos los derechos reservados.', 'almacengt' ); ?></p>
      <p><?php esc_html_e( 'Powered by Demente.digital', 'almacengt' ); ?></p>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
