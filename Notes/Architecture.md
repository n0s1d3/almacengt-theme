# Architecture

## Custom Page Template Strategy

Rather than fighting WooCommerce's archive/template system, every major storefront page uses a **custom WordPress page template** (via `Template Name:` header comment). This gives full layout control and bypasses WC's template intercepting.

| Template | Assignment |
|---|---|
| `page-shop.php` | Assigned to the "Tienda" page in WP Admin |
| `page-checkout.php` | Assigned to the checkout page |
| `page-cart.php` | Assigned to the cart page |

## Key Rules
- `page-shop.php` does its own `WP_Query` with URL-based filtering (`?cat=slug`, `?orderby=X`, `?pg=X`)
- `page-checkout.php` renders with `echo do_shortcode('[woocommerce_checkout]')` — do NOT use `the_content()`
- **Leave the WooCommerce "Shop page" setting blank** — if a page is designated there, WC intercepts its URL and forces `archive-product.php` regardless of the page's assigned custom template

## WooCommerce Template Priority Trap
WC's template loader checks `woocommerce.php` **before** `archive-product.php` for all WC page types.
`woocommerce.php` has an early-exit block that hands off to `archive-product.php` for:
- `is_post_type_archive('product')`
- `is_product_taxonomy()`
- `is_search()` + `post_type=product`

**Do NOT remove that early-exit block** — without it, all search and archive pages silently revert to the default WC loop, which our CSS hides.

## Manual Product Loops
When looping with `while (have_posts())` outside WC's own loop functions, `$product` is NOT automatically set:

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

## Guatemala Context
- Currency: **Q (Quetzales)**
- Phone: **+502**
- Language: **Spanish (es_ES)**
- Strings: `esc_html_e( '...', 'almacengt' )`
