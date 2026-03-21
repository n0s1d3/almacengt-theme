<?php
/**
 * Template Name: AlmacenGT — Checkout
 *
 * Asigna este template a la página "Pago / Checkout" desde el editor de WordPress.
 * Páginas → Pago → Atributos de página → Plantilla → AlmacenGT — Checkout
 *
 * Usa el formulario nativo de WooCommerce para preservar pagos, validaciones y AJAX.
 * El diseño replica el layout de dos columnas estilo BestBuy.com
 *
 * @package almacengt
 * @version 2.0
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<style>
/* ============================================================
   CHECKOUT PAGE — AlmacenGT / BestBuy-style
   Estiliza el formulario nativo de WooCommerce sin romperlo.
   ============================================================ */

/* Página wrapper */
.agt-checkout-page {
  background: var(--surface);
  min-height: 70vh;
  padding: 32px 0 64px;
}
.agt-checkout-wrap {
  max-width: 1120px;
  margin: 0 auto;
  padding: 0 24px;
}

/* Encabezado de página */
.agt-checkout-heading {
  font-size: 26px;
  font-weight: 900;
  color: var(--text);
  margin: 0 0 24px;
}

/* ---- Layout dos columnas ---- */
/* WooCommerce genera: #customer_details (izq) + #order_review (der)
   dentro de .woocommerce > form.checkout */
.agt-checkout-page .woocommerce {
  width: 100%;
}
.agt-checkout-page form.woocommerce-checkout {
  display: grid !important;
  grid-template-columns: 1fr 360px !important;
  grid-template-rows: auto;
  gap: 24px !important;
  align-items: start;
  width: 100%;
}

/* Columna izquierda */
.agt-checkout-page #customer_details {
  grid-column: 1;
  grid-row: 1;
  display: flex;
  flex-direction: column;
  gap: 20px;
}

/* Columna derecha (order review) */
.agt-checkout-page #order_review_heading,
.agt-checkout-page #order_review {
  grid-column: 2;
}
.agt-checkout-page #order_review_heading {
  grid-row: 1;
  display: none; /* Ocultamos el h3 suelto; usamos nuestro propio header */
}
.agt-checkout-page #order_review {
  grid-row: 1;
  position: sticky;
  top: 80px;
}

/* ---- Cupón (notice encima del form) ---- */
.agt-checkout-page .woocommerce-info {
  background: #fffbea;
  border: 1px solid #f0d060;
  border-left: 4px solid var(--accent);
  border-radius: 6px;
  padding: 12px 16px;
  font-size: 14px;
  color: #7a5c00;
  margin-bottom: 20px;
  list-style: none;
}
.agt-checkout-page .woocommerce-info a {
  color: var(--accent);
  font-weight: 700;
  text-decoration: underline;
}
.agt-checkout-page .woocommerce-error {
  background: #fff5f5;
  border: 1px solid #fcc;
  border-left: 4px solid #d0021b;
  border-radius: 6px;
  padding: 12px 16px;
  font-size: 14px;
  color: #d0021b;
  margin-bottom: 20px;
  list-style: none;
}

/* ---- Tarjetas / secciones del formulario ---- */
.agt-checkout-page .woocommerce-billing-fields,
.agt-checkout-page .woocommerce-shipping-fields,
.agt-checkout-page .woocommerce-additional-fields {
  background: #fff;
  border: 1px solid var(--border);
  border-radius: 8px;
  padding: 24px;
}
.agt-checkout-page .woocommerce-billing-fields h3,
.agt-checkout-page .woocommerce-shipping-fields h3,
.agt-checkout-page .woocommerce-additional-fields h3 {
  font-size: 17px;
  font-weight: 800;
  color: var(--text);
  margin: 0 0 20px;
  padding-bottom: 14px;
  border-bottom: 1px solid var(--border);
}

/* ---- Campos del formulario ---- */
.agt-checkout-page .woocommerce-checkout .form-row {
  margin-bottom: 16px;
}
.agt-checkout-page .woocommerce-checkout .form-row label {
  font-size: 13px;
  font-weight: 600;
  color: var(--text);
  margin-bottom: 6px;
  display: block;
}
.agt-checkout-page .woocommerce-checkout .form-row label .required {
  color: #d0021b;
  font-weight: 900;
}
.agt-checkout-page .woocommerce-checkout input[type="text"],
.agt-checkout-page .woocommerce-checkout input[type="email"],
.agt-checkout-page .woocommerce-checkout input[type="tel"],
.agt-checkout-page .woocommerce-checkout input[type="number"],
.agt-checkout-page .woocommerce-checkout input[type="password"],
.agt-checkout-page .woocommerce-checkout textarea,
.agt-checkout-page .woocommerce-checkout select,
.agt-checkout-page .woocommerce-checkout .select2-selection {
  width: 100% !important;
  padding: 10px 14px !important;
  border: 1px solid var(--border) !important;
  border-radius: 4px !important;
  font-size: 14px !important;
  color: var(--text) !important;
  background: #fff !important;
  transition: border-color .15s, box-shadow .15s !important;
  height: auto !important;
  line-height: 1.5 !important;
  box-shadow: none !important;
}
.agt-checkout-page .woocommerce-checkout input:focus,
.agt-checkout-page .woocommerce-checkout textarea:focus,
.agt-checkout-page .woocommerce-checkout select:focus,
.agt-checkout-page .woocommerce-checkout .select2-selection--single:focus {
  outline: none !important;
  border-color: var(--accent) !important;
  box-shadow: 0 0 0 3px rgba(252,163,17,.2) !important;
}
.agt-checkout-page .woocommerce-checkout textarea {
  min-height: 100px;
  resize: vertical;
}

/* Select2 custom */
.agt-checkout-page .select2-container--default .select2-selection--single {
  height: auto !important;
  border: 1px solid var(--border) !important;
  border-radius: 4px !important;
}
.agt-checkout-page .select2-container--default .select2-selection--single .select2-selection__rendered {
  padding: 10px 14px !important;
  font-size: 14px !important;
  line-height: 1.5 !important;
  color: var(--text) !important;
}
.agt-checkout-page .select2-container--default .select2-selection--single .select2-selection__arrow {
  top: 10px !important;
  right: 10px !important;
}

/* Form row half-width (nombre / apellido) */
.agt-checkout-page .form-row-first,
.agt-checkout-page .form-row-last {
  width: 48% !important;
  float: left !important;
}
.agt-checkout-page .form-row-first { margin-right: 4% !important; }
.agt-checkout-page .form-row-last  { margin-right: 0 !important; }
.agt-checkout-page .col2-set::after { content: ''; display: table; clear: both; }

/* Checkbox "enviar a dirección diferente" */
.agt-checkout-page #ship-to-different-address {
  margin-bottom: 0;
}
.agt-checkout-page #ship-to-different-address label {
  font-size: 15px;
  font-weight: 700;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 10px;
}
.agt-checkout-page #ship-to-different-address input[type="checkbox"] {
  width: 18px !important;
  height: 18px !important;
  accent-color: var(--accent);
  padding: 0 !important;
  cursor: pointer;
}

/* Validación inline */
.agt-checkout-page .form-row.woocommerce-invalid input,
.agt-checkout-page .form-row.woocommerce-invalid select {
  border-color: #d0021b !important;
}
.agt-checkout-page .form-row.woocommerce-invalid-required-field::after {
  font-size: 12px;
  color: #d0021b;
}

/* ---- Order Review (columna derecha) ---- */
.agt-checkout-page #order_review {
  background: #fff;
  border: 1px solid var(--border);
  border-radius: 8px;
  overflow: hidden;
}

/* Header del resumen */
.agt-checkout-page #order_review::before {
  content: 'Resumen del pedido';
  display: block;
  font-size: 18px;
  font-weight: 800;
  color: var(--text);
  padding: 18px 20px;
  border-bottom: 1px solid var(--border);
}

/* Tabla de productos */
.agt-checkout-page table.woocommerce-checkout-review-order-table {
  width: 100%;
  border-collapse: collapse;
  font-size: 14px;
}
.agt-checkout-page table.woocommerce-checkout-review-order-table thead th {
  padding: 10px 20px;
  font-size: 12px;
  font-weight: 700;
  color: var(--text-muted);
  text-transform: uppercase;
  letter-spacing: .5px;
  border-bottom: 1px solid var(--border);
  background: var(--surface);
  text-align: left;
}
.agt-checkout-page table.woocommerce-checkout-review-order-table thead th:last-child {
  text-align: right;
}
.agt-checkout-page table.woocommerce-checkout-review-order-table tbody tr {
  border-bottom: 1px solid var(--border);
}
.agt-checkout-page table.woocommerce-checkout-review-order-table tbody td {
  padding: 12px 20px;
  vertical-align: middle;
  color: var(--text);
}
.agt-checkout-page table.woocommerce-checkout-review-order-table tbody td:last-child {
  text-align: right;
  font-weight: 700;
  color: var(--accent);
}
.agt-checkout-page .woocommerce-checkout-review-order-table .product-name {
  font-weight: 600;
  line-height: 1.4;
}
.agt-checkout-page .woocommerce-checkout-review-order-table .product-name .product-quantity {
  color: var(--text-muted);
  font-weight: 400;
  font-size: 13px;
}

/* Subtotales / totales */
.agt-checkout-page table.woocommerce-checkout-review-order-table tfoot tr {
  border-bottom: 1px solid var(--border);
}
.agt-checkout-page table.woocommerce-checkout-review-order-table tfoot td,
.agt-checkout-page table.woocommerce-checkout-review-order-table tfoot th {
  padding: 10px 20px;
  font-size: 14px;
  color: var(--text);
}
.agt-checkout-page table.woocommerce-checkout-review-order-table tfoot th {
  font-weight: 600;
  color: var(--text-muted);
}
.agt-checkout-page table.woocommerce-checkout-review-order-table tfoot td {
  text-align: right;
  font-weight: 700;
}
.agt-checkout-page table.woocommerce-checkout-review-order-table tfoot tr.order-total th,
.agt-checkout-page table.woocommerce-checkout-review-order-table tfoot tr.order-total td {
  font-size: 16px;
  font-weight: 900;
  padding-top: 14px;
  padding-bottom: 14px;
  border-top: 2px solid var(--border);
}
.agt-checkout-page table.woocommerce-checkout-review-order-table tfoot tr.order-total td {
  color: var(--accent);
  font-size: 20px;
}

/* ---- Sección de pago ---- */
.agt-checkout-page #payment {
  background: transparent;
  border: none;
  padding: 0;
}
.agt-checkout-page #payment .wc_payment_methods {
  list-style: none;
  margin: 0;
  padding: 16px 20px;
  display: flex;
  flex-direction: column;
  gap: 10px;
  border-bottom: 1px solid var(--border);
}
.agt-checkout-page #payment .wc_payment_methods li {
  background: var(--surface);
  border: 1.5px solid var(--border);
  border-radius: 6px;
  padding: 12px 16px;
  cursor: pointer;
  transition: border-color .15s;
}
.agt-checkout-page #payment .wc_payment_methods li.payment_method_selected,
.agt-checkout-page #payment .wc_payment_methods li:has(input:checked) {
  border-color: var(--accent);
  background: #fffbea;
}
.agt-checkout-page #payment .wc_payment_methods li label {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  color: var(--text);
}
.agt-checkout-page #payment .wc_payment_methods li input[type="radio"] {
  accent-color: var(--accent);
  width: 16px;
  height: 16px;
  flex-shrink: 0;
}
.agt-checkout-page #payment .wc_payment_methods li img {
  max-height: 24px;
  width: auto;
}
.agt-checkout-page #payment .payment_box {
  padding: 10px 0 4px 26px;
  font-size: 13px;
  color: var(--text-muted);
  line-height: 1.5;
}
.agt-checkout-page #payment .payment_box input {
  margin-top: 6px;
}

/* Botón de pagar */
.agt-checkout-page #payment #place_order,
.agt-checkout-page #payment .button[name="woocommerce_checkout_place_order"] {
  display: block !important;
  width: calc(100% - 40px) !important;
  margin: 16px 20px 20px !important;
  padding: 16px !important;
  background: var(--accent) !important;
  color: #000 !important;
  font-size: 17px !important;
  font-weight: 900 !important;
  text-align: center !important;
  border: none !important;
  border-radius: 4px !important;
  cursor: pointer !important;
  transition: filter .15s !important;
  letter-spacing: .3px;
}
.agt-checkout-page #payment #place_order:hover,
.agt-checkout-page #payment .button[name="woocommerce_checkout_place_order"]:hover {
  filter: brightness(1.08) !important;
}

/* Nota de privacidad */
.agt-checkout-page .woocommerce-privacy-policy-text {
  padding: 0 20px 16px;
  font-size: 12px;
  color: var(--text-muted);
  line-height: 1.5;
  text-align: center;
}
.agt-checkout-page .woocommerce-privacy-policy-text a {
  color: var(--primary);
  text-decoration: underline;
}

/* Trust badges bajo el botón de pago */
.agt-trust-badges {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 16px;
  padding: 12px 20px 20px;
  border-top: 1px solid var(--border);
  flex-wrap: wrap;
}
.agt-trust-badge {
  display: flex;
  align-items: center;
  gap: 5px;
  font-size: 11px;
  font-weight: 600;
  color: var(--text-muted);
}
.agt-trust-badge svg { color: #28a745; flex-shrink: 0; }

/* ---- Login / cuenta ---- */
.agt-checkout-page .woocommerce-form-login-toggle,
.agt-checkout-page .checkout_coupon,
.agt-checkout-page .woocommerce-form-login {
  background: #fff;
  border: 1px solid var(--border);
  border-radius: 8px;
  padding: 16px 20px;
  margin-bottom: 20px;
  font-size: 14px;
}
.agt-checkout-page .woocommerce-form-login-toggle p,
.agt-checkout-page .checkout_coupon p { margin: 0; }

/* Envío gratis badge */
.agt-checkout-shipping-note {
  background: #f0fff4;
  border: 1px solid #b7ebc5;
  border-radius: 6px;
  padding: 10px 16px;
  font-size: 13px;
  font-weight: 600;
  color: #1a7a2e;
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 4px;
}

/* ---- Responsive ---- */
@media (max-width: 900px) {
  .agt-checkout-page form.woocommerce-checkout {
    grid-template-columns: 1fr !important;
  }
  .agt-checkout-page #order_review_heading,
  .agt-checkout-page #order_review {
    grid-column: 1;
    position: static;
  }
  .agt-checkout-page #order_review_heading { display: none; }
}
@media (max-width: 600px) {
  .agt-checkout-page .form-row-first,
  .agt-checkout-page .form-row-last {
    width: 100% !important;
    float: none !important;
    margin-right: 0 !important;
  }
}
</style>

<div class="agt-checkout-page">
  <div class="agt-checkout-wrap">

    <h1 class="agt-checkout-heading">
      <?php esc_html_e( 'Finalizar compra', 'almacengt' ); ?>
    </h1>

    <?php
    // Notices de WooCommerce (errores de validación, etc.)
    wc_print_notices();

    // Verificar si el carrito tiene productos
    if ( WC()->cart->is_empty() ) : ?>
      <div style="background:#fff;border:1px solid var(--border);border-radius:8px;padding:48px;text-align:center;">
        <p style="font-size:18px;font-weight:700;color:var(--text);margin:0 0 16px;">
          <?php esc_html_e( 'Tu carrito está vacío.', 'almacengt' ); ?>
        </p>
        <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"
           style="display:inline-flex;padding:12px 28px;background:var(--accent);color:#000;font-weight:700;border-radius:4px;text-decoration:none;font-size:15px;">
          <?php esc_html_e( 'Ir a la tienda', 'almacengt' ); ?>
        </a>
      </div>
    <?php else :

      // Nota de envío gratis si aplica
      if ( WC()->cart->get_subtotal() >= 499 ) : ?>
        <div class="agt-checkout-shipping-note">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
          <?php esc_html_e( '¡Envío gratis aplicado a tu pedido!', 'almacengt' ); ?>
        </div>
      <?php endif;

      // Renderiza el checkout directamente — no depende del contenido guardado en la página.
      // Preserva AJAX, validaciones, nonces y gateways de pago intactos.
      echo do_shortcode( '[woocommerce_checkout]' );

    endif; ?>

    <?php
    // Trust badges y métodos de pago aceptados
    // Se muestran fuera del form para no interferir con WC
    ?>
    <div style="display:flex;justify-content:center;gap:24px;margin-top:20px;flex-wrap:wrap;font-size:13px;color:var(--text-muted);align-items:center;">
      <span style="display:flex;align-items:center;gap:6px;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#28a745" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
        <?php esc_html_e( 'Compra 100% segura', 'almacengt' ); ?>
      </span>
      <span style="display:flex;align-items:center;gap:6px;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#28a745" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
        <?php esc_html_e( 'Datos protegidos', 'almacengt' ); ?>
      </span>
      <span style="display:flex;align-items:center;gap:6px;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#28a745" stroke-width="2"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-4.9L1 10"/></svg>
        <?php esc_html_e( 'Devoluciones gratuitas', 'almacengt' ); ?>
      </span>
    </div>

  </div><!-- /.agt-checkout-wrap -->
</div><!-- /.agt-checkout-page -->

<?php get_footer(); ?>
