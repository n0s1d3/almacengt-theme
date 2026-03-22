# Homepage Structure

File: `page-home.php` — `Template Name: AlmacenGT — Home`

This is the **actual homepage** in production. `index.php` is a fallback only and is NOT used.

---

## 1. Hero Promotional Slider — `agt-hero-banner`
- 3 slides, dark gradient background
- Black info bar below the image (`agt-slide-info`)
- Edit the `$agt_slides` PHP array at the top of the section
- `'image'` key = Media Library URL — leave empty for gradient fallback
- Info bar has **fixed `height: 110px`** — intentional, prevents height dancing between slides
- `overflow: hidden` on `.agt-slide-info` as safety net

## 2. Category Strip — `agt-cats-wrap`
- Continuous RAF-based marquee (0.5px per frame)
- Items are cloned in JS for a seamless infinite loop
- Only shows categories that **have subcategories** (parent=0 + children check)
- Categories without children are accessible via the shop page
- Speed: change `SPEED = 0.5` in `carousel.js`
- Arrow buttons (prev/next) and hover-pause are implemented

## 3. Ofertas del Día — `agt-deals-wrap`
- 4-column deal grid
- Pulls WooCommerce on-sale products

## 4. Comprar por Categoría — `agt-tiles-wrap`
- 4-column image tiles
- Dark gradient overlay on each tile

## 5. Productos Destacados — `agt-featured-wrap`
- 4-column product grid

## 6. Mid-page Promo Banner — `agt-promo-block`
- BestBuy MacBook-style full-width block
- Edit the `$agt_promo` PHP array
- `'image'` key = Media Library URL

---

## Responsive Breakpoints

| Breakpoint | Grid |
|---|---|
| Desktop 1024px+ | 4-column product grid, 4-col footer |
| Tablet 768–1023px | 3-column grid, 2-col footer |
| Mobile 480–767px | 2-column grid, sidebar collapses below content |
| Small < 480px | 1-column grid |
