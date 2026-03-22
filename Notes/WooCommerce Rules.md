# WooCommerce Rules

Critical rules specific to this theme. Breaking these has caused real bugs.

---

## 1. Always Set `$product` Explicitly in Manual Loops
Outside WC's own loop functions, `$product` is NOT automatically set:

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

---

## 2. WooCommerce CSS Filter — Keep Layout CSS
Only remove `woocommerce-general`. Do NOT use `__return_empty_array`:

```php
add_filter( 'woocommerce_enqueue_styles', function( $styles ) {
  unset( $styles['woocommerce-general'] );
  return $styles;
} );
```

`__return_empty_array` strips `woocommerce-layout.css` which cart/checkout/account pages depend on for structure. This was the root cause of the cart page showing homepage content.

---

## 3. Checkout Rendering
Use `echo do_shortcode('[woocommerce_checkout]')` — never `the_content()`.
`the_content()` requires the shortcode to be manually entered in the page editor.

---

## 4. Checkout CSS Conflicts
- `woocommerce.css` turns `.woocommerce-checkout .woocommerce` into a grid container
- Override with `display: block !important` on `.agt-checkout-page .woocommerce`
- `woocommerce-layout.css` sets `width: 48%` on `#customer_details` and `#order_review` — override both with `width: 100%`

---

## 5. WooCommerce "Shop Page" Setting
When WC has a designated shop page, it intercepts that URL and forces `archive-product.php` regardless of the page's assigned custom template.
**Leave the WC shop page blank** when using `page-shop.php`.

---

## 6. `woocommerce.php` Early-Exit Block
WC checks `woocommerce.php` before `archive-product.php` for all WC page types.
`woocommerce.php` has an early-exit that hands off to `archive-product.php` for product archives, taxonomies, and searches.
**Do NOT remove this block** — without it, all search and archive pages revert to the default WC loop (which our CSS hides).

---

## 7. `sidebar-shop.php` Has No `<aside>` Wrapper
The `<aside class="shop-sidebar">` is provided by `archive-product.php`. The sidebar file starts directly with widget divs.

---

## 8. `ul.products` Is Hidden
`woocommerce.css` hides `.woocommerce ul.products { display: none !important }` because we use `.products-grid`.
Related/upsell products override this with higher-specificity `display: grid !important`.

---

## 9. WooCommerce Calls in `header.php`
All `WC()` and `wc_*` calls are wrapped in `function_exists('wc_get_page_permalink')` to prevent fatal errors if WooCommerce is inactive.

---

## 10. `search.php` Is Required
Without it, WordPress falls back to `index.php` for `?s=` queries, rendering the full homepage.
