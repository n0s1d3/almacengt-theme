<?php
/**
 * Template Name: AlmacenGT — Carrito
 *
 * Asigna este template a la página "Carrito" desde el editor de WordPress.
 * Páginas → Carrito → Atributos de página → Plantilla → AlmacenGT — Carrito
 *
 * @package almacengt
 * @version 2.0
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<style>
/* ============================================================
   CART PAGE STYLES — AlmacenGT / BestBuy-style
   ============================================================ */
*, *::before, *::after { box-sizing: border-box; }

.agt-cart-page { background: var(--surface); min-height: 60vh; padding: 32px 0 56px; }
.agt-cart-wrap { max-width: 1120px; margin: 0 auto; padding: 0 24px; }
.agt-cart-heading { font-size: 26px; font-weight: 900; color: var(--text); margin: 0 0 24px; }

/* Layout dos columnas */
.agt-cart-layout {
  display: grid;
  grid-template-columns: 1fr 320px;
  gap: 24px;
  align-items: start;
}

/* ---- Columna izquierda ---- */
.agt-cart-main {
  background: #fff;
  border-radius: 8px;
  border: 1px solid var(--border);
  overflow: hidden;
}
.agt-cart-main-header {
  padding: 18px 24px;
  border-bottom: 1px solid var(--border);
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.agt-cart-main-header h2 { font-size: 16px; font-weight: 700; margin: 0; color: var(--text); }
.agt-cart-item-count { font-size: 14px; color: var(--text-muted); }

/* Item row */
.agt-cart-item {
  display: grid;
  grid-template-columns: 100px 1fr auto;
  gap: 16px;
  align-items: center;
  padding: 20px 24px;
  border-bottom: 1px solid var(--border);
  transition: background .15s;
}
.agt-cart-item:last-child { border-bottom: none; }
.agt-cart-item:hover { background: #fafafa; }

.agt-cart-item-img {
  width: 100px; height: 100px;
  display: flex; align-items: center; justify-content: center;
  background: var(--surface);
  border-radius: 6px; overflow: hidden; flex-shrink: 0;
}
.agt-cart-item-img img { width: 100%; height: 100%; object-fit: contain; padding: 8px; }

.agt-cart-item-details { display: flex; flex-direction: column; gap: 6px; }
.agt-cart-item-name { font-size: 15px; font-weight: 600; color: var(--text); line-height: 1.4; }
.agt-cart-item-name a { color: inherit; }
.agt-cart-item-name a:hover { color: var(--accent); }
.agt-cart-item-meta { font-size: 13px; color: var(--text-muted); }
.agt-cart-item-actions { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; margin-top: 4px; }

/* Quantity */
.agt-qty-wrap {
  display: flex; align-items: center;
  border: 1px solid var(--border); border-radius: 4px; overflow: hidden; background: #fff;
}
.agt-qty-wrap input[type="number"] {
  width: 48px; text-align: center;
  border: none; border-left: 1px solid var(--border); border-right: 1px solid var(--border);
  padding: 6px 4px; font-size: 14px; font-weight: 700; color: var(--text);
  -moz-appearance: textfield; background: transparent;
}
.agt-qty-wrap input[type="number"]::-webkit-inner-spin-button,
.agt-qty-wrap input[type="number"]::-webkit-outer-spin-button { -webkit-appearance: none; }
.agt-qty-btn {
  width: 32px; height: 34px;
  display: flex; align-items: center; justify-content: center;
  background: transparent; border: none; cursor: pointer;
  font-size: 18px; font-weight: 700; color: var(--text-muted);
  transition: background .15s, color .15s;
}
.agt-qty-btn:hover { background: var(--surface); color: var(--text); }

.agt-cart-item-remove {
  font-size: 13px; color: var(--text-muted); text-decoration: underline;
  cursor: pointer; background: none; border: none; padding: 0; transition: color .15s;
}
.agt-cart-item-remove:hover { color: #d0021b; }

/* Precio columna derecha */
.agt-cart-item-price-col { text-align: right; min-width: 80px; }
.agt-cart-item-price-col .price-current { font-size: 18px; font-weight: 900; color: var(--accent); }
.agt-cart-item-price-col .price-was {
  font-size: 12px; color: var(--text-muted); text-decoration: line-through;
  display: block; margin-top: 2px;
}

/* Update cart */
.agt-cart-update-wrap {
  padding: 16px 24px; border-top: 1px solid var(--border);
  display: flex; justify-content: flex-end;
}
.agt-btn-update {
  background: transparent; border: 2px solid var(--primary); color: var(--primary);
  font-size: 13px; font-weight: 700; padding: 8px 20px;
  border-radius: 4px; cursor: pointer; transition: background .15s, color .15s;
}
.agt-btn-update:hover { background: var(--primary); color: #fff; }

/* Carrito vacío */
.agt-cart-empty { padding: 48px 24px; text-align: center; }
.agt-cart-empty-icon { font-size: 56px; margin-bottom: 16px; }
.agt-cart-empty h2 { font-size: 22px; font-weight: 800; color: var(--text); margin: 0 0 10px; }
.agt-cart-empty p { font-size: 15px; color: var(--text-muted); margin: 0 0 24px; }
.agt-cart-login-hint { font-size: 14px; color: var(--text-muted); margin-top: 12px; }
.agt-cart-login-hint a { color: var(--primary); font-weight: 600; text-decoration: underline; }

/* ---- Columna derecha: Order Summary ---- */
.agt-cart-summary {
  background: #fff; border-radius: 8px; border: 1px solid var(--border);
  overflow: hidden; position: sticky; top: 80px;
}
.agt-cart-summary-header { padding: 18px 20px; border-bottom: 1px solid var(--border); }
.agt-cart-summary-header h2 { font-size: 18px; font-weight: 800; margin: 0; color: var(--text); }

.agt-summary-rows { padding: 16px 20px; display: flex; flex-direction: column; gap: 10px; }
.agt-summary-row {
  display: flex; justify-content: space-between; align-items: center;
  font-size: 14px; color: var(--text);
}
.agt-summary-row.total {
  font-size: 16px; font-weight: 800;
  padding-top: 12px; border-top: 2px solid var(--border); margin-top: 4px;
}
.agt-summary-row.total .amount { font-size: 20px; color: var(--accent); }
.agt-summary-row .label { color: var(--text-muted); }
.agt-summary-row .value { font-weight: 700; }

.agt-summary-actions { padding: 0 20px 20px; display: flex; flex-direction: column; gap: 10px; }
.agt-btn-checkout {
  width: 100%; padding: 14px;
  background: var(--accent); color: #000;
  font-size: 16px; font-weight: 800;
  border: none; border-radius: 4px; cursor: pointer;
  transition: filter .15s; text-align: center; display: block; text-decoration: none;
}
.agt-btn-checkout:hover { filter: brightness(1.08); color: #000; }
.agt-btn-continue {
  width: 100%; padding: 12px; background: transparent; color: var(--primary);
  font-size: 14px; font-weight: 700; border: 2px solid var(--primary);
  border-radius: 4px; cursor: pointer; text-align: center; display: block;
  transition: background .15s, color .15s; text-decoration: none;
}
.agt-btn-continue:hover { background: var(--primary); color: #fff; }

.agt-summary-note {
  padding: 14px 20px; border-top: 1px solid var(--border);
  font-size: 13px; color: var(--text-muted);
  display: flex; gap: 8px; align-items: flex-start; line-height: 1.4;
}
.agt-summary-note svg { flex-shrink: 0; margin-top: 1px; }
.agt-summary-note.free svg { color: #28a745; }
.agt-summary-note.progress svg { color: var(--accent); }

/* Cupón */
.agt-coupon-wrap { padding: 16px 20px; border-top: 1px solid var(--border); }
.agt-coupon-wrap label { font-size: 13px; font-weight: 700; color: var(--text); display: block; margin-bottom: 8px; }
.agt-coupon-form { display: flex; gap: 8px; }
.agt-coupon-form input {
  flex: 1; padding: 9px 12px;
  border: 1px solid var(--border); border-radius: 4px;
  font-size: 13px; color: var(--text); background: #fff;
}
.agt-coupon-form input:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 2px rgba(252,163,17,.2); }
.agt-btn-coupon {
  padding: 9px 16px; background: var(--primary); color: #fff;
  font-size: 13px; font-weight: 700; border: none; border-radius: 4px;
  cursor: pointer; transition: opacity .15s; white-space: nowrap;
}
.agt-btn-coupon:hover { opacity: .85; }

/* Strip de soporte */
.agt-support-strip {
  background: #fff; padding: 32px 24px; margin-top: 32px;
  border-radius: 8px; border: 1px solid var(--border);
}
.agt-support-grid {
  display: grid; grid-template-columns: repeat(5, 1fr);
  gap: 16px; text-align: center;
}
.agt-support-item a {
  display: flex; flex-direction: column; align-items: center; gap: 10px;
  font-size: 13px; font-weight: 600; color: var(--primary);
  text-decoration: none; transition: color .15s;
}
.agt-support-item a:hover { color: var(--accent); }
.agt-support-icon {
  width: 48px; height: 48px;
  display: flex; align-items: center; justify-content: center;
  border: 1.5px solid var(--border); border-radius: 50%; color: var(--text-muted);
  transition: border-color .15s, color .15s;
}
.agt-support-item a:hover .agt-support-icon { border-color: var(--accent); color: var(--accent); }

/* Notices */
.agt-cart-page .woocommerce-error,
.agt-cart-page .woocommerce-message,
.agt-cart-page .woocommerce-info {
  padding: 12px 16px; border-radius: 6px; margin-bottom: 20px;
  font-size: 14px; font-weight: 600; border-left: 4px solid; list-style: none;
}
.agt-cart-page .woocommerce-error { background: #fff5f5; border-color: #d0021b; color: #d0021b; }
.agt-cart-page .woocommerce-message { background: #f0fff4; border-color: #28a745; color: #1a7a2e; }
.agt-cart-page .woocommerce-info { background: #fffbea; border-color: var(--accent); color: #7a5c00; }
.agt-cart-page .woocommerce-error a,
.agt-cart-page .woocommerce-message a,
.agt-cart-page .woocommerce-info a { color: inherit; font-weight: 700; text-decoration: underline; }

/* Responsive */
@media (max-width: 900px) {
  .agt-cart-layout { grid-template-columns: 1fr; }
  .agt-cart-summary { position: static; }
  .agt-support-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 600px) {
  .agt-cart-item { grid-template-columns: 80px 1fr; }
  .agt-cart-item-price-col { grid-column: 2; }
  .agt-support-grid { grid-template-columns: repeat(2, 1fr); }
  .agt-cart-layout { gap: 16px; }
}
</style>

<div class="agt-cart-page">
  <div class="agt-cart-wrap">

    <?php
    // Necesario para que WooCommerce procese acciones (add to cart, remove, update, coupon)
    if ( function_exists( 'WC' ) ) {
      WC()->cart->calculate_totals();
    }

    // Notices de WooCommerce
    wc_print_notices();

    $cart_count = WC()->cart->get_cart_contents_count();
    ?>

    <h1 class="agt-cart-heading">
      <?php if ( WC()->cart->is_empty() ) :
        esc_html_e( 'Tu carrito está vacío', 'almacengt' );
      else :
        printf(
          esc_html( _n( 'Tu carrito (%d artículo)', 'Tu carrito (%d artículos)', $cart_count, 'almacengt' ) ),
          $cart_count
        );
      endif; ?>
    </h1>

    <div class="agt-cart-layout">

      <?php if ( WC()->cart->is_empty() ) : ?>
      <!-- ===== CARRITO VACÍO ===== -->
      <div class="agt-cart-main">
        <div class="agt-cart-empty">
          <div class="agt-cart-empty-icon">🛒</div>
          <h2><?php esc_html_e( 'No hay artículos en tu carrito', 'almacengt' ); ?></h2>
          <p><?php esc_html_e( '¡Encuentra miles de productos al mejor precio!', 'almacengt' ); ?></p>
          <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"
             style="display:inline-flex;align-items:center;gap:8px;padding:12px 28px;font-size:15px;font-weight:700;border-radius:4px;background:var(--accent);color:#000;text-decoration:none;">
            <?php esc_html_e( 'Explorar tienda', 'almacengt' ); ?>
          </a>
          <?php if ( ! is_user_logged_in() ) : ?>
          <p class="agt-cart-login-hint">
            <?php esc_html_e( '¿Tienes cuenta?', 'almacengt' ); ?>
            <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>">
              <?php esc_html_e( 'Inicia sesión para ver tu carrito', 'almacengt' ); ?>
            </a>
          </p>
          <?php endif; ?>
        </div>
      </div>

      <?php else : ?>
      <!-- ===== CARRITO CON ITEMS ===== -->
      <div class="agt-cart-main">
        <div class="agt-cart-main-header">
          <h2><?php esc_html_e( 'Artículos en tu carrito', 'almacengt' ); ?></h2>
          <span class="agt-cart-item-count">
            <?php printf(
              esc_html( _n( '%d artículo', '%d artículos', $cart_count, 'almacengt' ) ),
              $cart_count
            ); ?>
          </span>
        </div>

        <form class="woocommerce-cart-form"
              action="<?php echo esc_url( wc_get_cart_url() ); ?>"
              method="post">

          <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
            $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

            if ( ! $_product || ! $_product->exists() || $cart_item['quantity'] === 0 ) continue;

            $product_permalink = $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '';
            $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( 'woocommerce_thumbnail' ), $cart_item, $cart_item_key );
            $product_subtotal  = apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
            $regular_price     = (float) $_product->get_regular_price();
            $sale_price        = (float) $_product->get_sale_price();
          ?>
          <div class="agt-cart-item">

            <!-- Imagen -->
            <div class="agt-cart-item-img">
              <?php if ( $product_permalink ) : ?>
                <a href="<?php echo esc_url( $product_permalink ); ?>"><?php echo wp_kses_post( $thumbnail ); ?></a>
              <?php else : ?>
                <?php echo wp_kses_post( $thumbnail ); ?>
              <?php endif; ?>
            </div>

            <!-- Detalles -->
            <div class="agt-cart-item-details">
              <div class="agt-cart-item-name">
                <?php if ( $product_permalink ) : ?>
                  <a href="<?php echo esc_url( $product_permalink ); ?>">
                    <?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ); ?>
                  </a>
                <?php else : ?>
                  <?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ); ?>
                <?php endif; ?>
              </div>

              <?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>

              <div class="agt-cart-item-actions">
                <?php if ( $_product->is_sold_individually() ) : ?>
                  <input type="hidden"
                         name="cart[<?php echo esc_attr( $cart_item_key ); ?>][qty]"
                         value="1">
                <?php else : ?>
                  <div class="agt-qty-wrap">
                    <button type="button" class="agt-qty-btn"
                            onclick="var i=this.nextElementSibling;i.value=Math.max(<?php echo esc_attr( apply_filters( 'woocommerce_quantity_input_min', 1, $_product ) ); ?>,parseInt(i.value)-1);"
                            aria-label="<?php esc_attr_e( 'Reducir', 'almacengt' ); ?>">−</button>
                    <input type="number"
                           name="cart[<?php echo esc_attr( $cart_item_key ); ?>][qty]"
                           value="<?php echo esc_attr( $cart_item['quantity'] ); ?>"
                           min="<?php echo esc_attr( apply_filters( 'woocommerce_quantity_input_min', 1, $_product ) ); ?>"
                           max="<?php echo esc_attr( apply_filters( 'woocommerce_quantity_input_max', $_product->get_max_purchase_quantity() > 0 ? $_product->get_max_purchase_quantity() : 999, $_product ) ); ?>"
                           step="1">
                    <button type="button" class="agt-qty-btn"
                            onclick="var i=this.previousElementSibling;var m=<?php echo esc_attr( $_product->get_max_purchase_quantity() > 0 ? $_product->get_max_purchase_quantity() : 999 ); ?>;i.value=Math.min(m,parseInt(i.value)+1);"
                            aria-label="<?php esc_attr_e( 'Aumentar', 'almacengt' ); ?>">+</button>
                  </div>
                <?php endif; ?>

                <?php echo apply_filters(
                  'woocommerce_cart_item_remove_link',
                  sprintf(
                    '<a href="%s" class="agt-cart-item-remove remove" aria-label="%s" data-product_id="%s" data-cart_item_key="%s">%s</a>',
                    esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                    esc_html__( 'Eliminar artículo', 'almacengt' ),
                    esc_attr( $product_id ),
                    esc_attr( $cart_item_key ),
                    esc_html__( 'Eliminar', 'almacengt' )
                  ),
                  $cart_item_key
                ); ?>
              </div>
            </div>

            <!-- Precio -->
            <div class="agt-cart-item-price-col">
              <span class="price-current"><?php echo wp_kses_post( $product_subtotal ); ?></span>
              <?php if ( $sale_price && $regular_price > $sale_price ) : ?>
              <span class="price-was">Q<?php echo number_format( $regular_price * $cart_item['quantity'], 2 ); ?></span>
              <?php endif; ?>
            </div>

          </div>
          <?php endforeach; ?>

          <div class="agt-cart-update-wrap">
            <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
            <button type="submit" class="agt-btn-update"
                    name="update_cart"
                    value="<?php esc_attr_e( 'Actualizar carrito', 'almacengt' ); ?>">
              <?php esc_html_e( 'Actualizar carrito', 'almacengt' ); ?>
            </button>
          </div>

        </form>
      </div>
      <?php endif; // is_empty ?>

      <!-- ===== ORDER SUMMARY ===== -->
      <div class="agt-cart-summary">
        <div class="agt-cart-summary-header">
          <h2><?php esc_html_e( 'Resumen del pedido', 'almacengt' ); ?></h2>
        </div>

        <div class="agt-summary-rows">
          <div class="agt-summary-row">
            <span class="label"><?php esc_html_e( 'Subtotal', 'almacengt' ); ?></span>
            <span class="value"><?php wc_cart_totals_subtotal_html(); ?></span>
          </div>

          <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
          <div class="agt-summary-row" style="color:#28a745;">
            <span class="label"><?php printf( esc_html__( 'Cupón: %s', 'almacengt' ), esc_html( $code ) ); ?></span>
            <span class="value">− <?php wc_cart_totals_coupon_html( $coupon ); ?></span>
          </div>
          <?php endforeach; ?>

          <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
          <div class="agt-summary-row">
            <span class="label"><?php esc_html_e( 'Envío', 'almacengt' ); ?></span>
            <span class="value"><?php wc_cart_totals_shipping_html(); ?></span>
          </div>
          <?php endif; ?>

          <?php foreach ( WC()->cart->get_tax_totals() as $tax ) : ?>
          <div class="agt-summary-row">
            <span class="label"><?php echo esc_html( $tax->label ); ?></span>
            <span class="value"><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
          </div>
          <?php endforeach; ?>

          <div class="agt-summary-row total">
            <span><?php esc_html_e( 'Total', 'almacengt' ); ?></span>
            <span class="amount"><?php wc_cart_totals_order_total_html(); ?></span>
          </div>
        </div>

        <div class="agt-summary-actions">
          <?php if ( ! WC()->cart->is_empty() ) : ?>
          <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="agt-btn-checkout">
            <?php esc_html_e( 'Proceder al pago', 'almacengt' ); ?>
          </a>
          <?php endif; ?>
          <a href="<?php echo esc_url( wc_get_page_permalink( 'tienda' ) ); ?>" class="agt-btn-continue">
            <?php esc_html_e( 'Seguir comprando', 'almacengt' ); ?>
          </a>
        </div>

        <?php
        $free_min   = 499;
        $cart_total = WC()->cart->get_subtotal();
        if ( $cart_total > 0 && $cart_total < $free_min ) :
          $remaining = $free_min - $cart_total;
        ?>
        <div class="agt-summary-note progress">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          <?php printf( esc_html__( 'Agrega Q%s más para envío gratis.', 'almacengt' ), number_format( $remaining, 2 ) ); ?>
        </div>
        <?php elseif ( $cart_total >= $free_min ) : ?>
        <div class="agt-summary-note free">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
          <?php esc_html_e( '¡Envío gratis aplicado!', 'almacengt' ); ?>
        </div>
        <?php endif; ?>

        <?php if ( wc_coupons_enabled() ) : ?>
        <div class="agt-coupon-wrap">
          <label><?php esc_html_e( '¿Tienes un cupón?', 'almacengt' ); ?></label>
          <form method="post" class="agt-coupon-form">
            <input type="text"
                   name="coupon_code"
                   placeholder="<?php esc_attr_e( 'Código de cupón', 'almacengt' ); ?>">
            <?php wp_nonce_field( 'apply-coupon', '_wpnonce' ); ?>
            <button type="submit" class="agt-btn-coupon" name="apply_coupon">
              <?php esc_html_e( 'Aplicar', 'almacengt' ); ?>
            </button>
          </form>
        </div>
        <?php endif; ?>

      </div><!-- /.agt-cart-summary -->

    </div><!-- /.agt-cart-layout -->

    <!-- ===== STRIP DE SOPORTE ===== -->
    <div class="agt-support-strip">
      <div class="agt-support-grid">
        <div class="agt-support-item">
          <a href="#">
            <div class="agt-support-icon">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            </div>
            <?php esc_html_e( 'Centro de Ayuda', 'almacengt' ); ?>
          </a>
        </div>
        <div class="agt-support-item">
          <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>">
            <div class="agt-support-icon">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            </div>
            <?php esc_html_e( 'Estado de Pedido', 'almacengt' ); ?>
          </a>
        </div>
        <div class="agt-support-item">
          <a href="#">
            <div class="agt-support-icon">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
            </div>
            <?php esc_html_e( 'Envío y Entrega', 'almacengt' ); ?>
          </a>
        </div>
        <div class="agt-support-item">
          <a href="#">
            <div class="agt-support-icon">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-4.9L1 10"/></svg>
            </div>
            <?php esc_html_e( 'Devoluciones', 'almacengt' ); ?>
          </a>
        </div>
        <div class="agt-support-item">
          <a href="tel:+50212345678">
            <div class="agt-support-icon">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.4 2 2 0 0 1 3.59 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.55a16 16 0 0 0 5.54 5.54l.92-.92a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            </div>
            <?php esc_html_e( 'Contacto', 'almacengt' ); ?>
          </a>
        </div>
      </div>
    </div>

  </div><!-- /.agt-cart-wrap -->
</div><!-- /.agt-cart-page -->

<?php get_footer(); ?>
