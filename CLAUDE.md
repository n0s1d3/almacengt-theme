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
| `functions.php` | Theme setup, WC support, script/style enqueuing, live search AJAX handler |
| `header.php` | Topbar (black, full-width) + sticky dark navy navbar with search + account/cart icons |
| `footer.php` | Minimal footer — just copyright text |
| `index.php` | Homepage: hero → quick-cats strip → deals → categories → featured products |
| `page-shop.php` | **Custom shop page template** (`Template Name: AlmacenGT — Tienda`) — bypasses WC archive system |
| `page-checkout.php` | Custom checkout template — renders `[woocommerce_checkout]` shortcode |
| `page-cart.php` | Custom cart template — renders WooCommerce cart content |
| `search.php` | WordPress search results template — filters to products only |
| `archive-product.php` | WC category/tag archive fallback (sidebar + product grid) |
| `single-product.php` | Single product page wrapper (delegates to WC template) |
| `woocommerce.php` | WC fallback wrapper — account, order confirmation |
| `page.php` | Generic WordPress page template (safety fallback) |
| `sidebar-shop.php` | Shop sidebar: category filter + price range filter |
| `woocommerce/content-product.php` | Product card component used in all grids |
| `js/carousel.js` | Hero carousel stub (minimal, ready to expand) |
| `js/live-search.js` | Desktop-only live search dropdown (debounced AJAX, product preview) |
| `template-parts/breadcrumb.php` | Breadcrumb helper |

---

## Architecture: Custom Page Template Strategy

**Core approach:** Rather than fighting WooCommerce's archive/template system, every major storefront page (shop, cart, checkout) uses a **custom WordPress page template** (via `Template Name:` header comment). This gives full control over layout and bypasses WC's template intercepting.

- `page-shop.php` — assigned to the "Tienda" page in WP Admin. Does its own `WP_Query` for products with URL-based filtering (`?cat=slug`, `?orderby=X`, `?pg=X`).
- `page-checkout.php` — renders checkout with `echo do_shortcode('[woocommerce_checkout]')`. Do NOT use `the_content()` — it depends on the page editor having the shortcode entered manually.
- `page-cart.php` — same pattern for cart.
- **WooCommerce "Shop page" setting can be left blank** — `page-shop.php` works independently. If breadcrumb "Continue Shopping" links are needed, add: `add_filter('woocommerce_get_shop_page_id', fn() => get_page_by_path('tienda')->ID ?? 0)`.

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

### 6. `woocommerce.php` is the fallback for non-custom WC pages
Account, order confirmation route through `woocommerce.php`, which wraps `woocommerce_content()` in `.container`. Cart and checkout have their own custom templates now.

### 7. `page.php` exists as a safety net
Prevents WordPress static pages from falling back to `index.php` (which would show the homepage hero/deals layout on every page).

### 8. Checkout layout — two CSS conflicts to know about
`woocommerce.css` has `.woocommerce-checkout .woocommerce { display: grid; grid-template-columns: 1fr 400px }` which turns the shortcode's `.woocommerce` div into a grid container. `page-checkout.php` overrides this with `display: block !important` on `.agt-checkout-page .woocommerce`.

Additionally, `woocommerce-layout.css` sets `width: 48%` on `#customer_details` and `#order_review`. In CSS Grid, floats are ignored but `width` still applies, so each column only fills 48% of its track — leaving a visible gap. Override both with `width: 100%`.

### 9. WooCommerce "Shop page" setting conflicts with custom templates
When WooCommerce has a page designated as its "Shop page," it intercepts requests to that URL and runs its own product archive query — routing through `archive-product.php` regardless of the page's assigned custom template. Leave the WooCommerce shop page blank when using `page-shop.php`.

### 10. `search.php` is required
Without `search.php`, WordPress falls back to `index.php` for `?s=` queries, rendering the full homepage. `search.php` handles `?s=query&post_type=product` and uses the main WordPress query (already filtered to products by the hidden `post_type` input in the search form).

---

## Live Search Dropdown

Desktop-only (`@media (min-width: 1025px)`). Architecture:

- **`functions.php`**: registers `wp_ajax_agt_live_search` + `wp_ajax_nopriv_agt_live_search` actions. Handler uses `check_ajax_referer`, sanitizes `$_GET['q']`, queries up to 6 products, returns `wp_send_json_success()` with array of `{title, url, price, image, cat}`.
- **`wp_localize_script`** passes `agtSearch.ajaxUrl`, `agtSearch.nonce`, `agtSearch.searchUrl` to JS.
- **`js/live-search.js`**: appends `.search-dropdown` into `.search-bar` form, debounces input (280ms, min 2 chars), fires GET to `admin-ajax.php`, renders product list with loading dots animation. Closes on outside click, Escape, or form submit.
- **`style.css`**: `.search-bar` has `position: relative` (NOT `overflow: hidden`) so the dropdown can escape. All `.sdrop-*` styles and the `@keyframes sdrop-bounce` loading animation are inside `@media (min-width: 1025px)`.

**Important:** `.search-bar` must NOT have `overflow: hidden` — it clips the absolutely-positioned dropdown. The button gets `border-radius: 0 4px 4px 0` directly instead.

---

## Header Layout
Order of flex children in `.navbar-inner`: **logo → search-bar → actions → main-nav**

The `.search-bar` has `flex: 1` so it fills all available center space. This order was intentional — putting nav after actions means the search bar owns the center.

Search form has `<input type="hidden" name="post_type" value="product">` to filter results to WooCommerce products only.

Account and cart links use icon + label stacked vertically (`.action-link`), matching BestBuy style. Cart shows a `.cart-count` badge when items > 0.

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
| Checkout shows nothing | `the_content()` needs shortcode in page editor | Replaced with `echo do_shortcode('[woocommerce_checkout]')` |
| Checkout cramped on right | `woocommerce.css` grid turned shortcode wrapper into grid container | Added `display: block !important` on `.agt-checkout-page .woocommerce` |
| Checkout columns gap | `woocommerce-layout.css` sets `width: 48%` on both columns; width applies in grid | Added `width: 100%` to `#customer_details` and `#order_review` |
| Search results show homepage | No `search.php` — WordPress fell back to `index.php` | Created `search.php` |
| Search returns all post types | Form had no `post_type` parameter | Added `<input type="hidden" name="post_type" value="product">` |
| Live search dropdown clipped | `.search-bar` had `overflow: hidden` | Removed `overflow: hidden`, added `position: relative`, moved border-radius to button |
| WC shop page setting overrides custom template | WC intercepts the designated shop page URL and forces archive-product.php | Leave WC shop page blank when using page-shop.php |
