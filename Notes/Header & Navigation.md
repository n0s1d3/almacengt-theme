# Header & Navigation

## Sticky Header
Both the navbar and subnav are wrapped in `<div class="site-header">` in `header.php`.
Sticky is applied to `.site-header`, not `.navbar` — this keeps them together as one unit.

```css
.site-header {
  position: sticky;
  top: 0;
  z-index: 100;
}
```

`body.admin-bar` offset is added for logged-in WordPress users (WP admin bar is 32px).

---

## Navbar Layout (Desktop)
Flex row order: **logo → search-bar → actions → main-nav**

`.search-bar` has `flex: 1` so it fills all available center space.

## Navbar Layout (Mobile ≤ 768px)
Switches from flex to **CSS Grid** (3 columns × 2 rows):
- Row 1: logo (col 1) | — | actions (col 3)
- Row 2: search bar (spans all 3 columns)
- `main-nav` is `display: none` on mobile (**hamburger menu is pending**)

---

## Subnav
- Shows only **top-level categories that have child categories**
- Categories without children are silently skipped — accessible via the shop page
- Each `.subnav-item` has a chevron SVG and a `.subnav-dropdown` with child links

### Dropdown Behavior
- **Desktop (hover):** CSS `:hover` reveals `.subnav-dropdown`
- **Touch devices:** `window.matchMedia('(hover: none)')` detected in `carousel.js` — tap the parent link to open; tap again (or tap elsewhere) to close. First tap is `preventDefault()` so it doesn't navigate.

---

## Search Bar
- `flex: 1` on desktop, full-width on row 2 of mobile grid
- `maxlength="100"` on all search inputs
- `text-overflow: ellipsis` so long typed text doesn't overflow visually
- Hidden input: `<input type="hidden" name="post_type" value="product">` filters results to WooCommerce products
- `.search-bar` must NOT have `overflow: hidden` — it clips the absolutely-positioned live search dropdown

---

## Account & Cart Links
- `.action-link` — icon + label stacked vertically (BestBuy style)
- Cart shows a `.cart-count` badge when items > 0
- All `WC()` and `wc_*` calls in `header.php` are wrapped in `function_exists('wc_get_page_permalink')` to prevent fatal errors if WooCommerce is inactive

---

## Pending
- Hamburger/mobile menu: `main-nav` is hidden on mobile with no replacement navigation yet. See [[Pending Work]].
