# Mobile Responsive

## Navbar — CSS Grid Layout (≤ 768px)

The mobile navbar uses **CSS Grid** instead of flexbox to prevent logo/actions from shifting right.

```css
@media (max-width: 768px) {
  .navbar-inner {
    display: grid;
    grid-template-columns: auto 1fr auto;
    grid-template-rows: auto auto;
    align-items: center;
    gap: 8px 12px;
    padding: 0 16px;
  }
  .site-branding { grid-column: 1; grid-row: 1; }
  .actions      { grid-column: 3; grid-row: 1; }
  .search-bar   { grid-column: 1 / -1; grid-row: 2; width: 100%; }
  .main-nav     { display: none; }
}
```

**Root cause of the old bug:** `flex-wrap: wrap` + `justify-content: space-between` caused elements to reflow unpredictably when the logo or actions wrapped to a new line.

---

## Subnav (Mobile)
The subnav dark background and text color must be **explicitly re-declared** inside the `@media (max-width: 768px)` block — the global styles don't cascade reliably at this breakpoint.

---

## Breakpoints

| Breakpoint | Behavior |
|---|---|
| 1024px+ | 4-column product grid, 4-col footer, flex navbar |
| 768–1023px | 3-column grid, 2-col footer |
| 480–767px | 2-column grid, sidebar collapses below content |
| < 480px | 1-column grid, live search dropdown hidden |

---

## Live Search on Mobile
- Works on all viewports **≥ 481px**
- Hidden below 480px via CSS
- Max **3 results** shown on mobile: `.sdrop-item:nth-child(n+4) { display: none }`
- Titles truncated to **30 chars** on mobile (45 on desktop) via JS client-side truncation
- See [[Live Search]] for full architecture

---

## Asset Cache Busting
After any CSS or JS change, increment `$ver` in `functions.php`:
```php
$ver = '2.4'; // bump this number on every change
```
This forces browsers to fetch fresh files. Without this, users (and you during development) may see stale styles.

---

## Pending
- **Hamburger menu** — `main-nav` is `display: none` on mobile. No replacement navigation exists yet. See [[Pending Work]].
