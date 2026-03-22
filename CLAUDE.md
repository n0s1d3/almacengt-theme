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
- Version: 2.4
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
| `functions.php` | Theme setup, WC support, script/style enqueuing, live search AJAX handler. Asset version: `$ver = '2.4'` — increment on every CSS/JS change to bust browser cache |
| `header.php` | `<div class="site-header">` wraps navbar + subnav (both sticky together). Subnav shows only categories WITH children (dropdown). Categories without children are hidden — accessible via shop page |
| `footer.php` | BestBuy-style footer: service links row + 4-column grid (about, categories, help, account) |
| `index.php` | Fallback template — NOT the homepage in production (page-home.php is used instead) |
| `page-home.php` | **THE actual homepage** (`Template Name: AlmacenGT — Home`). Edit `$agt_slides` array for hero slider images/content. Edit `$agt_promo` for mid-page promo banner |
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
| `js/carousel.js` | Hero slider (agt-* and hp-*) + category strip continuous marquee + subnav dropdown tap logic |
| `js/live-search.js` | AJAX search dropdown — all viewports ≥ 481px, max 3 results on mobile, titles truncated to 30 chars mobile / 45 desktop |
| `template-parts/breadcrumb.php` | Breadcrumb helper |

---

## Architecture: Custom Page Template Strategy

**Core approach:** Rather than fighting WooCommerce's archive/template system, every major storefront page (shop, cart, checkout) uses a **custom WordPress page template** (via `Template Name:` header comment). This gives full control over layout and bypasses WC's template intercepting.

- `page-shop.php` — assigned to the "Tienda" page in WP Admin. Does its own `WP_Query` for products with URL-based filtering (`?cat=slug`, `?orderby=X`, `?pg=X`).
- `page-checkout.php` — renders checkout with `echo do_shortcode('[woocommerce_checkout]')`. Do NOT use `the_content()` — it depends on the page editor having the shortcode entered manually.
- `page-cart.php` — same pattern for cart.
- **WooCommerce "Shop page" setting can be left blank** — `page-shop.php` works independently. If breadcrumb "Continue Shopping" links are needed, add: `add_filter('woocommerce_get_shop_page_id', fn() => get_page_by_path('tienda')->ID ?? 0)`.

---

## Homepage Structure (BestBuy-style) — page-home.php
1. **Hero promotional slider** (`agt-hero-banner`) — 3 slides, dark gradient bg, black info bar below image. Edit `$agt_slides` PHP array at top of section. `'image'` key = Media Library URL, leave empty for gradient fallback. Info bar has fixed `height: 110px` — intentional, prevents height dancing between slides
2. **Category strip** (`agt-cats-wrap`) — continuous marquee (RAF-based, 0.5px/frame). Items cloned in JS for seamless infinite loop. Only shows categories that have subcategories (parent=0 + children check). Speed: change `SPEED = 0.5` in carousel.js
3. **Ofertas del Día** (`agt-deals-wrap`) — 4-column deal grid, WooCommerce on-sale products
4. **Comprar por Categoría** (`agt-tiles-wrap`) — 4-column image tiles with dark gradient overlay
5. **Productos Destacados** (`agt-featured-wrap`) — 4-column product grid
6. **Mid-page promo banner** (`agt-promo-block`) — BestBuy MacBook-style block. Edit `$agt_promo` array. `'image'` key = Media Library URL

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

### 6. `woocommerce.php` — priority trap with product archives
WooCommerce's template loader checks `woocommerce.php` **before** `archive-product.php` for every WooCommerce page type (product archives, searches, cart, account, etc.). Because our theme has `woocommerce.php`, it would always win and call `woocommerce_content()` — outputting the default `ul.products` loop which our CSS then hides.

**Fix in place:** `woocommerce.php` has an early-exit at the top that hands off to `archive-product.php` for `is_post_type_archive('product')`, `is_product_taxonomy()`, and `is_search()` + `post_type=product`. Account and order confirmation still go through `woocommerce.php` normally.

**Do NOT remove that early-exit block** — without it, all search and archive pages silently revert to the default WooCommerce loop, hidden by our own CSS.

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

Works on all viewports ≥ 481px (NOT desktop-only anymore). Architecture:

- **`functions.php`**: AJAX handler truncates title to 40 chars and returns only the first category. Queries 6 products max.
- **`js/live-search.js`**: truncates title client-side to 30 chars on mobile / 45 on desktop (`window.innerWidth < 768`). Dropdown hides on mobile via `@media (max-width: 480px)`.
- **`style.css`**: ALL `.sdrop-*` styles are global (no media query wrapper). `.search-dropdown { display: none }` is the base; `.search-dropdown.is-open { display: block }` reveals it. Mobile shows max 3 results via `.sdrop-item:nth-child(n+4) { display: none }`.
- Both search inputs (`header.php` and `search.php`) have `maxlength="100"` and `text-overflow: ellipsis`.

**Important:** `.search-bar` must NOT have `overflow: hidden` — it clips the absolutely-positioned dropdown.

---

## Header Layout
Order of flex children in `.navbar-inner`: **logo → search-bar → actions → main-nav**

The `.search-bar` has `flex: 1` so it fills all available center space. This order was intentional — putting nav after actions means the search bar owns the center.

On mobile (`≤ 768px`) `.navbar-inner` switches from flex to **CSS Grid** (3-col × 2-row): logo top-left, actions top-right, search bar spans full width on row 2. Main nav is `display: none` on mobile (hamburger menu pending).

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
| Mobile navbar logo/actions pushed right | `flex-wrap: wrap` + `justify-content: space-between` caused element reflow | Replaced with CSS Grid (3-col × 2-row) at ≤ 768px breakpoint |
| Live search dropdown unstyled on tablet (768–1024px) | All `.sdrop-*` CSS was inside `@media (min-width: 1025px)` — tablet viewports got no styles | Moved all dropdown CSS global (no media query), `.nth-child(n+4)` hides extra results on mobile |
| Mobile search showing full-length product names | PHP truncation cached in browser; no JS fallback | Added client-side `truncate()` in live-search.js (30 chars mobile / 45 desktop) as guaranteed fallback |
| Hero slider info bar height shifting between slides | Used `min-height` which allowed expansion when content differed between slides | Changed to fixed `height: 110px` + `overflow: hidden` on `.agt-slide-info` |
| Subnav scrolled away with page | `position: sticky` was on `.navbar` only, not the wrapper | Wrapped navbar + subnav in `.site-header`, moved sticky to wrapper. `body.admin-bar` offset added |
| Subnav showed all categories (including childless) | No children check before rendering dropdown | `get_terms(['parent' => $sncat->term_id])` — only render `.subnav-item` when children exist |
