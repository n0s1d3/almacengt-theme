# Bugs Fixed

Complete log of bugs found and fixed. Do not re-introduce these.

---

## WooCommerce & Templates

| Bug | Root Cause | Fix |
|---|---|---|
| Shop page shows no products | `$product` global not set in manual loop | Explicit `wc_get_product()` call per iteration |
| Cart page shows homepage content | `__return_empty_array` stripped WC layout CSS | Changed to only unset `woocommerce-general` |
| Checkout shows nothing | `the_content()` needs shortcode in page editor | Replaced with `echo do_shortcode('[woocommerce_checkout]')` |
| Checkout cramped on right | `woocommerce.css` grid turned shortcode wrapper into grid container | Added `display: block !important` on `.agt-checkout-page .woocommerce` |
| Checkout columns gap | `woocommerce-layout.css` sets `width: 48%` on both columns | Added `width: 100%` to `#customer_details` and `#order_review` |
| Search results show homepage | No `search.php` — WP fell back to `index.php` | Created `search.php` |
| Search returns all post types | Form had no `post_type` parameter | Added `<input type="hidden" name="post_type" value="product">` |
| WC shop page setting overrides custom template | WC intercepts designated shop page URL | Leave WC shop page blank when using `page-shop.php` |
| Fatal error if WC inactive | `WC()->cart` called unconditionally in header | Wrapped in `function_exists()` check |
| Duplicate WC support registration | `almacengt_woocommerce_support()` ran twice | Removed duplicate function |

---

## Layout & CSS

| Bug | Root Cause | Fix |
|---|---|---|
| Topbar not full-width | Had both `topbar` + `container` on same element | Separated into `<div class="topbar"><div class="container topbar-inner">` |
| `.footer-content` had no grid | Never defined in CSS | Added 4-col grid with responsive collapse |
| CSS parse error in style.css | Orphaned rules after `.price_slider_amount` block | Cleaned up in full rewrite |
| `single-product.php` unstyled | Used `.main-content`/`.content-section` (undefined) | Replaced with `.container` |
| Sidebar nested `<aside>` | `sidebar-shop.php` added its own `<aside>` wrapper | Removed from sidebar file |

---

## Header & Navigation

| Bug | Root Cause | Fix |
|---|---|---|
| Mobile navbar logo/actions pushed right | `flex-wrap: wrap` + `justify-content: space-between` caused reflow | Replaced with CSS Grid (3-col × 2-row) at ≤ 768px |
| Subnav scrolled away with page | `position: sticky` on `.navbar` only, not the wrapper | Wrapped navbar + subnav in `.site-header`, moved sticky to wrapper |
| Subnav showed all categories (including childless) | No children check before rendering dropdown | `get_terms(['parent' => $sncat->term_id])` — only render when children exist |

---

## Live Search

| Bug | Root Cause | Fix |
|---|---|---|
| Live search dropdown clipped | `.search-bar` had `overflow: hidden` | Removed `overflow: hidden`, added `position: relative`, moved border-radius to button |
| Live search dropdown unstyled on tablet (768–1024px) | All `.sdrop-*` CSS was inside `@media (min-width: 1025px)` | Moved all dropdown CSS global (no media query wrapper) |
| Mobile search showing full-length product names | PHP truncation cached in browser; no JS fallback | Added client-side `truncate()` in `live-search.js` (30 chars mobile / 45 desktop) |

---

## Homepage

| Bug | Root Cause | Fix |
|---|---|---|
| Hero slider info bar height shifting between slides | Used `min-height` — allowed expansion when content differed | Changed to fixed `height: 110px` + `overflow: hidden` on `.agt-slide-info` |
| Broken product card images | `via.placeholder.com` is down | Switched to `placehold.co` |
