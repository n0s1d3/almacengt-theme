<?php
/**
 * The template for displaying single product pages.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="container" style="padding-top: 40px; padding-bottom: 60px;">
  <?php
  while ( have_posts() ) :
    the_post();
    wc_get_template_part( 'content', 'single-product' );
  endwhile;
  ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  // WooCommerce uses .woocommerce-product-details__short-description; fall back to .short-description
  var desc = document.querySelector('.woocommerce-product-details__short-description, .short-description');
  if (!desc) return;

  // Wrap first so CSS can control max-height
  var wrap = document.createElement('div');
  wrap.className = 'agt-desc-wrap is-collapsed'; // collapse immediately — BEFORE measuring
  desc.parentNode.insertBefore(wrap, desc);
  wrap.appendChild(desc);

  // Measure AFTER collapse is applied so scrollHeight reflects real content height
  var fullHeight = desc.scrollHeight;
  var clampHeight = parseFloat(getComputedStyle(wrap).maxHeight) || 0;

  var btn = document.createElement('button');
  btn.className = 'agt-desc-toggle';
  btn.textContent = 'Ver más';
  wrap.parentNode.insertBefore(btn, wrap.nextSibling);

  // If content fits inside the clamp, remove collapse and hide button
  if (fullHeight <= clampHeight + 4) {
    wrap.classList.remove('is-collapsed');
    btn.style.display = 'none';
    return;
  }

  btn.addEventListener('click', function () {
    var isNowCollapsed = wrap.classList.toggle('is-collapsed');
    btn.textContent = isNowCollapsed ? 'Ver más' : 'Ver menos';
  });
});
</script>

<?php
get_footer();
