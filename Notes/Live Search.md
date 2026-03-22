# Live Search Dropdown

Works on **all viewports ≥ 481px** (not desktop-only).

---

## Architecture (3 Layers of Truncation)

### 1. PHP — `functions.php` (server-side)
- AJAX handler queries 6 products max
- Truncates title to 40 chars: `mb_substr($title, 0, 38) . '…'`
- Returns only the first category: `explode(',', $cat)[0]`

### 2. JS — `js/live-search.js` (client-side fallback)
- `truncate(str, max)` helper function
- On render: `isMobile = window.innerWidth < 768`
- `maxChars = isMobile ? 30 : 45`
- Renders as `escHtml(truncate(p.title, maxChars))`
- This is the **guaranteed fallback** — works even if PHP output is cached

### 3. CSS — `style.css` (visual safety net)
- `text-overflow: ellipsis` on `.sdrop-item-title`

---

## CSS Rules
All `.sdrop-*` styles are **global** (no media query wrapper).
- Base: `.search-dropdown { display: none }`
- Open: `.search-dropdown.is-open { display: block }`
- Mobile cap: `.sdrop-item:nth-child(n+4) { display: none }` — max 3 results on mobile
- Dropdown hidden below 480px: `@media (max-width: 480px) { .search-dropdown { display: none !important } }`

> **Why global?** Previously all `.sdrop-*` CSS was inside `@media (min-width: 1025px)`. Tablet viewports (768–1024px) got zero styles — the dropdown rendered as unstyled concatenated text. Moving everything global fixed all viewport sizes at once.

---

## Search Inputs
Both inputs (in `header.php` and `search.php`) have:
- `maxlength="100"`
- `autocomplete="off"`
- `text-overflow: ellipsis` via CSS

---

## Important
`.search-bar` must NOT have `overflow: hidden` — it clips the absolutely-positioned dropdown.
The fix: removed `overflow: hidden`, added `position: relative`, moved `border-radius` to the button only.
