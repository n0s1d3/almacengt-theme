# AlmacenGT — Project Context for Claude

## What this project is
A professional WordPress + WooCommerce theme for **AlmacenGT**, a Guatemalan online marketplace. The design goal is to closely replicate the layout, style, and feel of **BestBuy.com**.

---

## Stack
- **WordPress** + **WooCommerce** (no headless, standard PHP templates)
- **Pure PHP templates** — no Node.js, no build process, no package.json
- **CSS3** with custom properties (`--primary`, `--accent`, etc.), no preprocessor
- **Vanilla JS** (jQuery available via WordPress)
- No React, Vue, or Angular

---

## Theme location
`d:\Custom Websites\AlmacenGT\almacengt-theme\`

- Text domain: `almacengt`
- Version: 2.0
- Container max-width: `1120px`

---

## Color Palette
Source: https://coolors.co/palette/000000-14213d-fca311-e5e5e5-ffffff

| Variable | Value | Role |
|---|---|---|
| `--primary` | `#14213d` | Dark navy — navbar bg, footer bg, table headers |
| `--accent` | `#fca311` | Amber — all CTAs, prices, active states, highlights |
| `--accent-light` | `#fdbb45` | Amber hover state |
| `--text` | `#000000` | Primary body text |
| `--text-muted` | `#555555` | Secondary text |
| `--text-light` | `#888888` | Tertiary/placeholder text |
| `--bg` | `#ffffff` | Page background |
| `--surface` | `#f5f5f5` | Card surfaces, section backgrounds |
| `--surface-dark` | `#e5e5e5` | Borders, dividers |
| `--border` | `#e5e5e5` | All borders |
| Topbar bg | `#000000` | Pure black announcement bar |

**Buttons:** `.btn-primary` = amber fill (`#fca311`) with black text.
**Never use blue** — the old `#0046be` BestBuy blue has been replaced entirely.

---

## File Map

| File | Purpose |
|---|---|
| `style.css` | Full design system — CSS variables, all component styles, responsive breakpoints |
| `woocommerce.css` | WooCommerce visual overrides (loaded after style.css) |
| `functions.php` | Theme setup, WC support, script/style enqueuing |
| `header.php` | Topbar (black, full-width) + sticky dark navy navbar |
| `footer.php` | Minimal footer — just copyright text |
| `index.php` | Homepage: hero → quick-cats strip → deals → categories → featured products |
| `archive-product.php` | Shop / category archive: sidebar + product grid |
| `single-product.php` | Single product page wrapper (delegates to WC template) |
| `woocommerce.php` | WC fallback wrapper — cart, checkout, account, order confirmation |
| `page.php` | Generic WordPress page template (safety fallback) |
| `sidebar-shop.php` | Shop sidebar: category filter + price range filter |
| `woocommerce/content-product.php` | Product card component used in all grids |
| `js/carousel.js` | Hero carousel stub (minimal, ready to expand) |
| `template-parts/breadcrumb.php` | Breadcrumb helper |

---

## Homepage Structure (BestBuy-style)
1. **Hero banner** — dark navy bg, amber eyebrow label, H1, subtitle, 2 CTA buttons
2. **Quick category strip** — horizontal scrollable bar of product category links
3. **Ofertas del Día** — 4-column deal grid with red SALE badge, WooCommerce on-sale products
4. **Comprar por Categoría** — 4-column image tiles with gradient overlay (full-width gray bg section)
5. **Productos Destacados** — 8-product grid using `content-product.php`

---

## Responsive Breakpoints
| Breakpoint | Grid |
|---|---|
| Desktop 1024px+ | 4-column product grid, 4-col footer |
| Tablet 768–1023px | 3-column grid, 2-col footer |
| Mobile 480–767px | 2-column grid, sidebar collapses below content |
| Small < 480px | 1-column grid |

---

## Context: Guatemala
- Currency: **Q (Quetzales)**
- Phone country code: **+502**
- Language: **Spanish (es_ES)**
- All user-facing strings use `esc_html_e( '...', 'almacengt' )`

---

## Critical WooCommerce Rules

### 1. Always set `$product` explicitly in manual loops
When looping with `while (have_posts())` outside of WooCommerce's own loop functions, `$product` is NOT automatically set. Always do:
```php
while ( have_posts() ) :
  the_post();
  global $product;
  $product = wc_get_product( get_the_ID() );
  if ( $product && $product->is_visible() ) :
    wc_get_template_part( 'content', 'product' );
  endif;
endwhile;
```

### 2. WooCommerce CSS filter — keep layout CSS
`functions.php` removes only `woocommerce-general` (visual styles), NOT the full stylesheet array.
```php
add_filter( 'woocommerce_enqueue_styles', function( $styles ) {
  unset( $styles['woocommerce-general'] );
  return $styles;
} );
```
**Do NOT use `__return_empty_array`** — it strips `woocommerce-layout.css` which cart/checkout/account pages depend on for structure. This was a root bug that caused the cart page to show the homepage content.

### 3. WooCommerce calls need existence checks in header.php
All `WC()` and `wc_*` calls in `header.php` are wrapped in `function_exists('wc_get_page_permalink')`.

### 4. `sidebar-shop.php` has no `<aside>` wrapper
The `<aside class="shop-sidebar">` wrapper is provided by `archive-product.php`. The sidebar file starts directly with widget divs.

### 5. `ul.products` is hidden
`woocommerce.css` hides `.woocommerce ul.products { display: none !important }` because we use a custom `.products-grid` div. Related/upsell products override this with higher-specificity `display: grid !important`.

### 6. `woocommerce.php` is the fallback for all WC pages
Cart, checkout, my account, order confirmation all route through `woocommerce.php`, which wraps `woocommerce_content()` in `.container`.

### 7. `page.php` exists as a safety net
Prevents WordPress static pages from falling back to `index.php` (which would show the homepage hero/deals layout on every page).

---

## Placeholder Images
Use `https://placehold.co/WxH/bgcolor/textcolor?text=Label` (NOT `via.placeholder.com` — that service is unreliable/deprecated).

---

## Known Bugs Fixed (do not re-introduce)
| Bug | Root Cause | Fix |
|---|---|---|
| Shop page shows no products | `$product` global not set in manual loop | Explicit `wc_get_product()` call per iteration |
| Cart page shows homepage content | `__return_empty_array` stripped WC layout CSS | Changed to only unset `woocommerce-general` |
| Topbar not full-width | Had both `topbar` + `container` on same element | Separated into `<div class="topbar"><div class="container topbar-inner">` |
| Broken product card images | `via.placeholder.com` is down | Switched to `placehold.co` |
| Sidebar nested `<aside>` | `sidebar-shop.php` added its own `<aside>` wrapper | Removed from sidebar file |
| CSS parse error in style.css | Orphaned rules after `.price_slider_amount` block | Cleaned up in full rewrite |
| `.footer-content` had no grid | Never defined in CSS | Added 4-col grid with responsive collapse |
| Fatal error if WC inactive | `WC()->cart` called unconditionally in header | Wrapped in `function_exists()` check |
| `single-product.php` unstyled | Used `.main-content`/`.content-section` (undefined) | Replaced with `.container` |
| Duplicate WC support registration | `almacengt_woocommerce_support()` ran twice | Removed duplicate function |
