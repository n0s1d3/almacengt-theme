# File Map

| File | Purpose |
|---|---|
| `style.css` | Full design system — CSS variables, all component styles, responsive breakpoints |
| `woocommerce.css` | WooCommerce visual overrides (loaded after style.css) |
| `functions.php` | Theme setup, WC support, script/style enqueuing, live search AJAX handler. `$ver = '2.4'` — increment on every CSS/JS change |
| `header.php` | `<div class="site-header">` wraps navbar + subnav (sticky together). Subnav shows only categories WITH children. Categories without children are hidden — accessible via shop page |
| `footer.php` | BestBuy-style footer: service links row + 4-column grid |
| `index.php` | Fallback template — NOT the homepage in production |
| `page-home.php` | **THE actual homepage** (`Template Name: AlmacenGT — Home`) |
| `page-shop.php` | Custom shop template (`Template Name: AlmacenGT — Tienda`) — bypasses WC archive |
| `page-checkout.php` | Custom checkout — renders `[woocommerce_checkout]` shortcode |
| `page-cart.php` | Custom cart template |
| `search.php` | WordPress search results — filters to products only |
| `archive-product.php` | WC category/tag archive fallback (sidebar + product grid) |
| `single-product.php` | Single product page wrapper |
| `woocommerce.php` | WC fallback wrapper — account, order confirmation |
| `page.php` | Generic WordPress page template (safety fallback) |
| `sidebar-shop.php` | Shop sidebar: category filter + price range filter |
| `woocommerce/content-product.php` | Product card component used in all grids |
| `js/carousel.js` | Hero slider + category strip continuous marquee + subnav dropdown tap logic |
| `js/live-search.js` | AJAX search dropdown — all viewports ≥ 481px |
| `template-parts/breadcrumb.php` | Breadcrumb helper |

## Asset Versioning
`functions.php` uses a hardcoded `$ver = '2.4'` for all `wp_enqueue_style` and `wp_enqueue_script` calls.
Increment this number on every CSS or JS change to bust the browser cache.
