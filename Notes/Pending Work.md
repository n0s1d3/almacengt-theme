# Pending Work

Tasks identified but not yet implemented.

---

## Hamburger Menu (Mobile Navigation)

**Status:** Not started
**Priority:** High — mobile users currently have no navigation

On mobile (≤ 768px), `.main-nav` is set to `display: none` with no replacement.
The full desktop navigation is simply hidden.

**What's needed:**
- Hamburger button in the mobile navbar (top-right area or next to logo)
- Slide-out drawer or dropdown menu showing the main nav links
- Should also include the top-level category links from the subnav
- Close on tap-outside or via an X button

**Where to implement:**
- HTML: `header.php` — add button to `.navbar-inner`
- CSS: `style.css` — drawer/overlay styles under the `@media (max-width: 768px)` block
- JS: `carousel.js` or a new `js/mobile-menu.js`

---

## Product Image Import

The site has ~2,700 products with image files available but product names are encoded/hashed (e.g. `061CKS7HQ4H8WVPGYHVZT88BH`). A bulk import/rename process may be needed.

---

## Placeholder Images
All placeholder images currently use `https://placehold.co/WxH/bgcolor/textcolor?text=Label`.
These should be replaced with real product/category images before launch.
