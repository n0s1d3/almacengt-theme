# Color Palette

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

## Rules
- **Buttons:** `.btn-primary` = amber fill (`#fca311`) with black text
- **Never use blue** — `#0046be` (old BestBuy blue) has been fully replaced

## White Text on Dark Backgrounds
Global `h1–h4` color is black. On dark sections (`.topbar`, `.navbar`, `.subnav`, `.agt-slide-info`, `.page-footer`, `hp-*` sections) you must explicitly set `color: #fff` on headings and text elements — the global rule bleeds in otherwise.

See [[Bugs Fixed]] for the CSS specificity issue.
