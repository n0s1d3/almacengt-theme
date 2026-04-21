<?php
/**
 * Template Name: AlmacenGT — Home
 *
 * Página principal estilo BestBuy.com para AlmacenGT.
 * Selecciona este template desde el editor de páginas de WordPress.
 *
 * @package almacengt
 * @version 2.0
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<style>
/* ============================================================
   HOME PAGE STYLES — incluidos aquí para portabilidad.
   Si prefieres, mueve estos bloques a style.css.
   ============================================================ */

/* --- Reset / utilidades ----------------------------------- */
.agt-home * { box-sizing: border-box; }
.agt-home a { text-decoration: none; color: inherit; }
.agt-home img { max-width: 100%; height: auto; display: block; }
.agt-home ul { list-style: none; margin: 0; padding: 0; }

/* --- Hero promotional slider ----------------------------- */
.agt-hero-banner { position: relative; overflow: hidden; user-select: none; }
.agt-slide { display: none; width: 100%; }
.agt-slide.is-active { display: block; }

/* Image area */
.agt-slide-img {
  height: 380px;
  background-size: cover;
  background-position: center;
  display: flex;
  align-items: flex-start;
  justify-content: center;
  padding-top: 36px;
  position: relative;
}
.agt-slide-img::after {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, transparent 50%, rgba(0,0,0,0.35) 100%);
  pointer-events: none;
}
.agt-slide-brand {
  font-size: 1rem;
  font-weight: 900;
  letter-spacing: 6px;
  text-transform: uppercase;
  color: #fff;
  text-shadow: 0 2px 12px rgba(0,0,0,.55);
  z-index: 1;
  position: relative;
}

/* Info bar */
.agt-slide-info {
  background: #0d1a33;
  width: 100%;
  height: 110px;
  box-sizing: border-box;
  display: flex;
  align-items: center;
  overflow: hidden;
}
.agt-slide-info-inner {
  max-width: 1120px;
  margin: 0 auto;
  padding: 0 24px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 32px;
  flex-wrap: nowrap;
}
.agt-slide-copy { flex: 1; min-width: 0; }
.agt-slide-headline {
  color: #fff;
  font-size: clamp(1.25rem, 2.5vw, 1.75rem);
  font-weight: 800;
  margin: 0 0 8px;
  line-height: 1.2;
}
.agt-slide-sub {
  color: rgba(255,255,255,.72);
  font-size: 0.92rem;
  margin: 0 0 4px;
  line-height: 1.5;
}
.agt-slide-terms {
  color: rgba(255,255,255,.35);
  font-size: 0.75rem;
  margin: 0;
}
.agt-slide-cta {
  display: inline-block;
  background: var(--accent);
  color: #000;
  font-size: 0.95rem;
  font-weight: 700;
  padding: 13px 32px;
  border-radius: 4px;
  text-decoration: none;
  white-space: nowrap;
  flex-shrink: 0;
  transition: background .2s, transform .1s;
  border: none;
  cursor: pointer;
}
.agt-slide-cta:hover { background: var(--accent-light); transform: translateY(-1px); color: #000; }

/* Arrows */
.agt-slider-arrow {
  position: absolute;
  top: 190px;
  transform: translateY(-50%);
  width: 48px; height: 48px;
  border-radius: 50%;
  background: rgba(0,0,0,.45);
  color: #fff;
  border: 2px solid rgba(255,255,255,.35);
  font-size: 1.6rem;
  cursor: pointer;
  z-index: 20;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background .2s, border-color .2s;
  line-height: 1;
}
.agt-slider-arrow:hover { background: rgba(0,0,0,.75); border-color: #fff; }
.agt-slider-prev { left: 16px; }
.agt-slider-next { right: 16px; }

/* Dots */
.agt-slider-dots {
  position: absolute;
  bottom: 148px;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  gap: 8px;
  z-index: 20;
}
.agt-slider-dot {
  width: 9px; height: 9px;
  border-radius: 50%;
  background: rgba(255,255,255,.4);
  border: none;
  cursor: pointer;
  padding: 0;
  transition: background .2s, transform .2s;
}
.agt-slider-dot.is-active { background: #fff; transform: scale(1.4); }

/* Buttons (keep for rest of page) */
.agt-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 12px 28px;
  font-size: 15px;
  font-weight: 700;
  border-radius: 4px;
  cursor: pointer;
  transition: filter .15s, transform .1s;
  border: none;
  text-decoration: none;
}
.agt-btn:hover { filter: brightness(1.08); transform: translateY(-1px); }
.agt-btn-primary { background: var(--accent); color: #000; }
.agt-btn-outline {
  background: rgba(255,255,255,.12);
  color: #fff;
  border: 2px solid #fff;
}
.agt-btn-outline:hover { background: #fff; color: var(--primary); }

/* --- Section titles --------------------------------------- */
.agt-section-title {
  font-size: 22px;
  font-weight: 800;
  color: var(--text);
  margin: 0 0 20px;
}

/* --- Category Strip -------------------------------------- */
.agt-cats-wrap {
  background: #fff;
  border-bottom: 1px solid var(--border);
  padding: 24px 0;
}
.agt-cats-inner {
  max-width: 1120px;
  margin: 0 auto;
  padding: 0 48px;
  position: relative;
}
/* Fade edges */
.agt-cats-inner::before,
.agt-cats-inner::after {
  content: '';
  position: absolute;
  top: 0; bottom: 0;
  width: 48px;
  z-index: 5;
  pointer-events: none;
}
.agt-cats-inner::before { left: 48px; background: linear-gradient(to right, #fff, transparent); }
.agt-cats-inner::after  { right: 48px; background: linear-gradient(to left, #fff, transparent); }
/* Arrow buttons */
.agt-cats-arrow {
  position: absolute;
  top: 50%; transform: translateY(-50%);
  z-index: 10;
  width: 36px; height: 36px;
  border-radius: 50%;
  background: #fff;
  border: 1px solid var(--border);
  box-shadow: 0 2px 8px rgba(0,0,0,0.12);
  color: var(--primary);
  font-size: 1.5rem;
  cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  line-height: 1;
  transition: background 0.2s, color 0.2s, box-shadow 0.2s;
  padding: 0;
}
.agt-cats-arrow:hover { background: var(--primary); color: #fff; box-shadow: 0 4px 16px rgba(0,0,0,0.18); }
.agt-cats-prev { left: 4px; }
.agt-cats-next { right: 4px; }
.agt-cats-scroll {
  overflow: hidden;
  cursor: default;
}
.agt-cats-marquee {
  display: flex;
  gap: 12px;
  will-change: transform;
}
.agt-cat-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
  min-width: 120px;
  padding: 12px 8px;
  border-radius: 8px;
  cursor: pointer;
  transition: background .15s;
  text-align: center;
  flex-shrink: 0;
}
.agt-cat-item:hover { background: var(--surface); }
.agt-cat-thumb {
  width: 88px;
  height: 88px;
  border-radius: 50%;
  background: var(--surface);
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 2px solid var(--border);
  transition: border-color .15s, box-shadow .15s;
}
.agt-cat-item:hover .agt-cat-thumb {
  border-color: var(--accent);
  box-shadow: 0 0 0 3px rgba(252,163,17,.2);
}
.agt-cat-thumb img { width: 100%; height: 100%; object-fit: cover; }
.agt-cat-thumb .agt-cat-icon {
  font-size: 32px;
  color: var(--text-muted);
}
.agt-cat-label {
  font-size: 13px;
  font-weight: 600;
  color: var(--text);
  line-height: 1.3;
}

/* --- Deals grid ------------------------------------------ */
.agt-deals-wrap {
  background: var(--surface);
  padding: 40px 0;
}
.agt-deals-inner {
  max-width: 1120px;
  margin: 0 auto;
  padding: 0 24px;
}
.agt-deals-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
}
.agt-deal-card {
  background: #fff;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 2px 8px rgba(0,0,0,.06);
  transition: box-shadow .2s, transform .2s;
  display: flex;
  flex-direction: column;
}
.agt-deal-card:hover {
  box-shadow: 0 8px 32px rgba(0,0,0,.12);
  transform: translateY(-3px);
}
.agt-deal-card-img {
  position: relative;
  aspect-ratio: 4/3;
  overflow: hidden;
  background: var(--surface);
}
.agt-deal-card-img img {
  width: 100%; height: 100%;
  object-fit: cover;
  transition: transform .3s;
}
.agt-deal-card:hover .agt-deal-card-img img { transform: scale(1.04); }
.agt-deal-badge {
  position: absolute;
  top: 10px; left: 10px;
  background: #d0021b;
  color: #fff;
  font-size: 11px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: .5px;
  padding: 3px 8px;
  border-radius: 2px;
}
.agt-deal-card-body { padding: 14px; flex: 1; display: flex; flex-direction: column; gap: 6px; }
.agt-deal-card-name {
  font-size: 14px;
  font-weight: 600;
  color: var(--text);
  line-height: 1.4;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.agt-deal-card-price {
  display: flex;
  align-items: baseline;
  gap: 8px;
  flex-wrap: wrap;
}
.agt-deal-card-price .price-current {
  font-size: 20px;
  font-weight: 900;
  color: var(--accent);
}
.agt-deal-card-price .price-was {
  font-size: 13px;
  color: var(--text-muted);
  text-decoration: line-through;
}
.agt-deal-card-price .price-save {
  font-size: 12px;
  font-weight: 700;
  color: #d0021b;
}
.agt-deal-card-footer { padding: 0 14px 14px; }
.agt-deal-card-footer .agt-btn {
  width: 100%;
  justify-content: center;
  padding: 10px;
  font-size: 14px;
}

/* --- Category tiles -------------------------------------- */
.agt-tiles-wrap {
  background: #fff;
  padding: 40px 0;
}
.agt-tiles-inner {
  max-width: 1120px;
  margin: 0 auto;
  padding: 0 24px;
}
.agt-tiles-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
}
.agt-tile {
  position: relative;
  border-radius: 8px;
  overflow: hidden;
  aspect-ratio: 3/2;
  cursor: pointer;
  background: var(--primary);
}
.agt-tile img {
  width: 100%; height: 100%;
  object-fit: cover;
  transition: transform .35s;
}
.agt-tile:hover img { transform: scale(1.06); }
.agt-tile-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to top, rgba(0,0,0,.75) 0%, rgba(0,0,0,.1) 55%, transparent 100%);
  display: flex;
  align-items: flex-end;
  padding: 16px;
  transition: background .2s;
}
.agt-tile:hover .agt-tile-overlay {
  background: linear-gradient(to top, rgba(20,33,61,.85) 0%, rgba(20,33,61,.2) 55%, transparent 100%);
}
.agt-tile-label {
  color: #fff;
  font-size: 16px;
  font-weight: 800;
  line-height: 1.3;
  text-shadow: 0 1px 4px rgba(0,0,0,.5);
}
.agt-tile-label span {
  display: block;
  font-size: 12px;
  font-weight: 500;
  color: var(--accent);
  margin-bottom: 4px;
  text-transform: uppercase;
  letter-spacing: 1px;
}

/* --- Featured products ----------------------------------- */
.agt-featured-wrap {
  background: var(--surface);
  padding: 40px 0 56px;
}
.agt-featured-inner {
  max-width: 1120px;
  margin: 0 auto;
  padding: 0 24px;
}
.agt-products-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
}
.agt-product-card {
  background: #fff;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 1px 4px rgba(0,0,0,.06);
  transition: box-shadow .2s, transform .2s;
  display: flex;
  flex-direction: column;
}
.agt-product-card:hover {
  box-shadow: 0 6px 24px rgba(0,0,0,.1);
  transform: translateY(-2px);
}
.agt-product-card-img {
  aspect-ratio: 1;
  background: var(--surface);
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 16px;
}
.agt-product-card-img img {
  width: 100%; height: 100%;
  object-fit: contain;
  transition: transform .3s;
}
.agt-product-card:hover .agt-product-card-img img { transform: scale(1.05); }
.agt-product-card-body { padding: 14px; flex: 1; display: flex; flex-direction: column; gap: 8px; }
.agt-product-card-name {
  font-size: 14px;
  font-weight: 600;
  color: var(--text);
  line-height: 1.4;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.agt-product-card-rating {
  display: flex;
  align-items: center;
  gap: 4px;
  font-size: 13px;
  color: var(--text-muted);
}
.agt-product-card-rating .stars { color: var(--accent); letter-spacing: -1px; }
.agt-product-card-price { font-size: 20px; font-weight: 900; color: var(--accent); }
.agt-product-card-footer { padding: 0 14px 14px; }
.agt-product-card-footer .agt-btn {
  width: 100%;
  justify-content: center;
  padding: 10px;
  font-size: 14px;
}

/* --- Mid-page promo banner ------------------------------- */
.agt-promo-block {
  background: #fff;
  border-top: 1px solid var(--border);
  text-align: center;
  overflow: hidden;
  padding: 64px 24px 0;
}
.agt-promo-block-inner {
  max-width: 580px;
  margin: 0 auto;
}
.agt-promo-block-label {
  display: inline-block;
  font-size: 0.72rem;
  font-weight: 800;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: var(--text-muted);
  margin-bottom: 12px;
}
.agt-promo-block-title {
  font-size: clamp(2rem, 4vw, 3rem);
  font-weight: 900;
  color: var(--text);
  margin: 0 0 16px;
  line-height: 1.1;
  letter-spacing: -0.5px;
}
.agt-promo-block-sub {
  font-size: 1rem;
  color: var(--text-muted);
  line-height: 1.65;
  margin: 0 0 8px;
}
.agt-promo-block-terms {
  font-size: 0.78rem;
  color: var(--text-light);
  margin: 0 0 28px;
}
.agt-promo-block-cta {
  display: inline-block;
  background: var(--primary);
  color: #fff;
  font-weight: 700;
  font-size: 1rem;
  padding: 14px 40px;
  border-radius: 4px;
  text-decoration: none;
  margin-bottom: 48px;
  transition: background 0.2s, transform 0.1s;
}
.agt-promo-block-cta:hover {
  background: #1e3a6e;
  color: #fff;
  transform: translateY(-1px);
}
.agt-promo-block-img {
  max-width: 520px;
  margin: 0 auto;
  display: flex;
  align-items: flex-end;
  justify-content: center;
}
.agt-promo-block-img img {
  width: 100%;
  height: auto;
  display: block;
  border-radius: 8px 8px 0 0;
  box-shadow: 0 -8px 40px rgba(0,0,0,0.1);
}
/* Brand attribution below image */
.agt-promo-block-brand {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  padding: 16px 0 0;
  font-size: 0.9rem;
  font-weight: 700;
  color: var(--text-muted);
  letter-spacing: 0.5px;
}

/* --- Brand banners marquee -------------------------------- */
.agt-brands-wrap {
  background: #fff;
  padding: 40px 0;
  border-bottom: 1px solid var(--border);
  overflow: hidden;
}
.agt-brands-inner {
  max-width: 1120px;
  margin: 0 auto;
  padding: 0 24px;
}
.agt-brands-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 20px;
  flex-wrap: wrap;
  gap: 12px;
}
.agt-brands-header .agt-section-title { margin: 0; }
.agt-brands-viewall {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  color: var(--primary);
  font-size: 14px;
  font-weight: 700;
  text-decoration: none;
  border: 2px solid var(--primary);
  padding: 7px 18px;
  border-radius: 4px;
  transition: background .15s, color .15s;
}
.agt-brands-viewall:hover { background: var(--primary); color: #fff; }
.agt-brands-overflow {
  overflow: hidden;
  position: relative;
}
.agt-brands-overflow::before,
.agt-brands-overflow::after {
  content: '';
  position: absolute;
  top: 0; bottom: 0;
  width: 60px;
  z-index: 5;
  pointer-events: none;
}
.agt-brands-overflow::before { left: 0; background: linear-gradient(to right, #fff, transparent); }
.agt-brands-overflow::after  { right: 0; background: linear-gradient(to left, #fff, transparent); }
.agt-brands-track {
  display: flex;
  gap: 16px;
  width: max-content;
  animation: agt-brands-scroll 40s linear infinite;
}
.agt-brands-track:hover { animation-play-state: paused; }
@keyframes agt-brands-scroll {
  from { transform: translateX(0); }
  to   { transform: translateX(-50%); }
}
.agt-brand-card {
  display: flex;
  align-items: center;
  justify-content: center;
  min-width: 140px;
  height: 76px;
  background: var(--surface);
  border: 2px solid var(--border);
  border-radius: 8px;
  padding: 0 24px;
  cursor: pointer;
  flex-shrink: 0;
  text-decoration: none;
  transition: border-color .2s, box-shadow .2s, transform .15s, background .15s;
}
.agt-brand-card:hover {
  border-color: var(--accent);
  background: #fff;
  box-shadow: 0 4px 18px rgba(252,163,17,.22);
  transform: translateY(-3px);
}
.agt-brand-name {
  font-size: 19px;
  font-weight: 900;
  letter-spacing: -0.5px;
  white-space: nowrap;
  line-height: 1;
}
.agt-brand-logo {
  max-width: 110px;
  max-height: 48px;
  width: auto;
  height: auto;
  object-fit: contain;
  filter: grayscale(100%);
  opacity: 0.65;
  transition: filter .2s, opacity .2s;
}
.agt-brand-card:hover .agt-brand-logo {
  filter: grayscale(0%);
  opacity: 1;
}

/* --- Category showcase (dark panel + horizontal scroll) -- */
.agt-showcase-wrap {
  background: var(--surface);
  padding: 40px 0;
}
.agt-showcase-inner {
  max-width: 1120px;
  margin: 0 auto;
  padding: 0 24px;
  display: flex;
  flex-direction: column;
  gap: 24px;
}
.agt-showcase-block {
  background: #1c1c1c;
  border-radius: 12px;
  overflow: hidden;
  display: flex;
  align-items: stretch;
  min-height: 280px;
}
.agt-showcase-panel {
  width: 220px;
  flex-shrink: 0;
  padding: 32px 24px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.agt-showcase-panel-top { display: flex; flex-direction: column; gap: 10px; }
.agt-showcase-panel-headline {
  font-size: clamp(1.1rem, 1.8vw, 1.4rem);
  font-weight: 800;
  color: #fff;
  line-height: 1.25;
  margin: 0;
}
.agt-showcase-panel-sub {
  font-size: 0.85rem;
  color: rgba(255,255,255,.58);
  line-height: 1.55;
  margin: 0;
}
.agt-showcase-panel-link {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  color: #fff;
  font-size: 0.9rem;
  font-weight: 700;
  text-decoration: underline;
  text-underline-offset: 3px;
  text-decoration-color: rgba(255,255,255,.4);
  transition: color .15s, text-decoration-color .15s;
}
.agt-showcase-panel-link:hover { color: var(--accent); text-decoration-color: var(--accent); }
.agt-showcase-cards {
  flex: 1;
  overflow-x: auto;
  display: flex;
  gap: 10px;
  padding: 16px 20px 16px 12px;
  scrollbar-width: none;
  -ms-overflow-style: none;
  align-items: stretch;
}
.agt-showcase-cards::-webkit-scrollbar { display: none; }
.agt-showcase-card {
  background: #fff;
  border-radius: 8px;
  min-width: 168px;
  max-width: 168px;
  display: flex;
  flex-direction: column;
  flex-shrink: 0;
  overflow: hidden;
  text-decoration: none;
  transition: transform .2s, box-shadow .2s;
}
.agt-showcase-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 24px rgba(0,0,0,.25);
}
.agt-showcase-card-img {
  position: relative;
  height: 140px;
  background: var(--surface);
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 12px;
  overflow: hidden;
}
.agt-showcase-card-img img {
  width: 100%; height: 100%;
  object-fit: contain;
  transition: transform .3s;
}
.agt-showcase-card:hover .agt-showcase-card-img img { transform: scale(1.05); }
.agt-showcase-save-badge {
  position: absolute;
  top: 8px; left: 8px;
  background: #d0021b;
  color: #fff;
  font-size: 10px;
  font-weight: 800;
  padding: 3px 7px;
  border-radius: 2px;
  line-height: 1.4;
  white-space: nowrap;
}
.agt-showcase-card-body {
  padding: 10px 12px 14px;
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 5px;
}
.agt-showcase-card-name {
  font-size: 12px;
  font-weight: 500;
  color: var(--text);
  line-height: 1.4;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.agt-showcase-card-prices { margin-top: auto; display: flex; flex-direction: column; gap: 1px; }
.agt-showcase-price-current {
  font-size: 15px;
  font-weight: 900;
  color: var(--text);
}
.agt-showcase-price-was {
  font-size: 11px;
  color: var(--text-muted);
  text-decoration: line-through;
}
@media (max-width: 768px) {
  .agt-showcase-block { flex-direction: column; }
  .agt-showcase-panel { width: 100%; padding: 20px; flex-direction: row; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px; }
  .agt-showcase-panel-sub { display: none; }
}

/* --- All products section --------------------------------- */
.agt-allproducts-wrap {
  background: var(--surface);
  padding: 40px 0 56px;
  border-top: 1px solid var(--border);
}
.agt-allproducts-inner {
  max-width: 1120px;
  margin: 0 auto;
  padding: 0 24px;
}
.agt-allproducts-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 20px;
  flex-wrap: wrap;
  gap: 12px;
}
.agt-allproducts-header .agt-section-title { margin: 0; }
.agt-allproducts-cta-row {
  text-align: center;
  margin-top: 32px;
}
.agt-allproducts-cta-row .agt-btn {
  font-size: 15px;
  padding: 14px 48px;
}

/* --- Responsive ------------------------------------------ */
@media (max-width: 1024px) {
  .agt-deals-grid,
  .agt-tiles-grid,
  .agt-products-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 768px) {
  .agt-slide-img { height: 260px; }
  .agt-slider-arrow { top: 130px; width: 40px; height: 40px; font-size: 1.3rem; }
  .agt-slider-dots { bottom: 108px; }
  .agt-slide-info { height: auto; padding: 20px 0; }
  .agt-slide-info-inner { flex-direction: column; align-items: flex-start; gap: 16px; }
  .agt-slide-headline { font-size: 1.15rem; }
  .agt-deals-grid,
  .agt-tiles-grid,
  .agt-products-grid { grid-template-columns: repeat(2, 1fr); }
  .agt-cat-item { min-width: 96px; }
}
@media (max-width: 480px) {
  .agt-slide-img { height: 200px; }
  .agt-slider-arrow { display: none; }
  .agt-slider-dots { bottom: 92px; }
  .agt-deals-grid,
  .agt-tiles-grid,
  .agt-products-grid { grid-template-columns: 1fr; }
}
</style>

<main class="agt-home">

  <?php
  /* ========================================================
     1. HERO — promotional banner carousel
     ─────────────────────────────────────────────────────────
     Edit $agt_slides to change banners.
     'image' → URL from WP Admin → Media Library.
     Leave 'image' empty to show the gradient background only.
     ======================================================== */
  $shop_url   = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
  $agt_slides = [
    [
      'brand'    => '',
      'image'    => 'https://almacengt.com/wp-content/uploads/2026/03/Gemini_Generated_Image_bal623bal623bal6-1.png', // paste full URL from Media Library
      'bg'       => 'linear-gradient(135deg,#14213d 0%,#1e3a6e 100%)',
      'headline' => __( 'Tecnología y electrónica al mejor precio en Guatemala', 'almacengt' ),
      'subline'  => __( 'Miles de productos. Envío rápido a toda Guatemala. Garantía real.', 'almacengt' ),
      'terms'    => '',
      'cta'      => __( 'Ver todas las ofertas', 'almacengt' ),
      'url'      => $shop_url,
    ],
    [
      'brand'    => '',
      'image'    => 'https://almacengt.com/wp-content/uploads/2026/04/Gemini_Generated_Image_6oma8l6oma8l6oma.png', // paste full URL from Media Library
      'bg'       => 'linear-gradient(135deg,#2d1b4e 0%,#4a2070 100%)',
      'headline' => __( 'Los mejores celulares desde Q1,299', 'almacengt' ),
      'subline'  => __( 'Samsung, iPhone, Xiaomi y más. Envío gratis en compras mayores a Q499.', 'almacengt' ),
      'terms'    => __( '*Sujeto a disponibilidad de stock.', 'almacengt' ),
      'cta'      => __( 'Ver celulares', 'almacengt' ),
      'url'      => $shop_url,
    ],
    [
      'brand'    => '',
      'image'    => 'https://almacengt.com/wp-content/uploads/2026/04/Gemini_Generated_Image_6coxsk6coxsk6cox.png', // paste full URL from Media Library
      'bg'       => 'linear-gradient(135deg,#0d2137 0%,#1a3a5c 100%)',
      'headline' => __( 'Laptops y PCs desde Q2,499', 'almacengt' ),
      'subline'  => __( 'Intel, AMD y Apple. El equipo que necesitas al precio que mereces.', 'almacengt' ),
      'terms'    => __( '*Precios sujetos a cambio sin previo aviso.', 'almacengt' ),
      'cta'      => __( 'Ver computadoras', 'almacengt' ),
      'url'      => $shop_url,
    ],
  ];
  ?>
  <section class="agt-hero-banner" aria-label="<?php esc_attr_e( 'Ofertas destacadas', 'almacengt' ); ?>">
    <div id="agt-hero-slider">
      <?php foreach ( $agt_slides as $i => $s ) : ?>
      <div class="agt-slide<?php echo $i === 0 ? ' is-active' : ''; ?>"
           style="background:<?php echo esc_attr( $s['bg'] ); ?>;">
        <div class="agt-slide-img"
             <?php if ( $s['image'] ) : ?>style="background-image:url('<?php echo esc_url( $s['image'] ); ?>')"<?php endif; ?>>
          <span class="agt-slide-brand"><?php echo esc_html( $s['brand'] ); ?></span>
        </div>
        <div class="agt-slide-info">
          <div class="agt-slide-info-inner">
            <div class="agt-slide-copy">
              <h2 class="agt-slide-headline"><?php echo esc_html( $s['headline'] ); ?></h2>
              <p class="agt-slide-sub"><?php echo esc_html( $s['subline'] ); ?></p>
              <?php if ( $s['terms'] ) : ?>
                <p class="agt-slide-terms"><?php echo esc_html( $s['terms'] ); ?></p>
              <?php endif; ?>
            </div>
            <a href="<?php echo esc_url( $s['url'] ); ?>" class="agt-slide-cta">
              <?php echo esc_html( $s['cta'] ); ?>
            </a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <?php if ( count( $agt_slides ) > 1 ) : ?>
    <button class="agt-slider-arrow agt-slider-prev" aria-label="<?php esc_attr_e( 'Anterior', 'almacengt' ); ?>">&#8249;</button>
    <button class="agt-slider-arrow agt-slider-next" aria-label="<?php esc_attr_e( 'Siguiente', 'almacengt' ); ?>">&#8250;</button>
    <div class="agt-slider-dots" role="tablist">
      <?php foreach ( $agt_slides as $i => $s ) : ?>
      <button class="agt-slider-dot<?php echo $i === 0 ? ' is-active' : ''; ?>"
              data-slide="<?php echo $i; ?>"
              role="tab"
              aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"
              aria-label="<?php printf( esc_attr__( 'Slide %d', 'almacengt' ), $i + 1 ); ?>"></button>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>
  </section>

  <?php
  /* ========================================================
     2. STRIP DE CATEGORÍAS CON IMAGEN DE PRODUCTO
     Muestra las categorías de WooCommerce con imagen.
     ======================================================== */
  $cat_args = array(
    'taxonomy'   => 'product_cat',
    'orderby'    => 'count',
    'order'      => 'DESC',
    'hide_empty' => true,
    'number'     => 10,
    'exclude'    => array( get_option( 'default_product_cat' ) ),
  );
  $product_cats = get_terms( $cat_args );
  if ( ! is_wp_error( $product_cats ) && ! empty( $product_cats ) ) :
  ?>
  <section class="agt-cats-wrap">
    <div class="agt-cats-inner">
      <button class="agt-cats-arrow agt-cats-prev" aria-label="<?php esc_attr_e( 'Anterior', 'almacengt' ); ?>">&#8249;</button>
      <div class="agt-cats-scroll" id="agt-cats-track">
        <?php foreach ( $product_cats as $cat ) :
          $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
          $image_url    = $thumbnail_id
            ? wp_get_attachment_image_url( $thumbnail_id, 'thumbnail' )
            : wc_placeholder_img_src( 'thumbnail' );
          $cat_link     = get_term_link( $cat, 'product_cat' );
        ?>
        <a href="<?php echo esc_url( $cat_link ); ?>" class="agt-cat-item">
          <div class="agt-cat-thumb">
            <img src="<?php echo esc_url( $image_url ); ?>"
                 alt="<?php echo esc_attr( $cat->name ); ?>"
                 loading="lazy">
          </div>
          <span class="agt-cat-label"><?php echo esc_html( $cat->name ); ?></span>
        </a>
        <?php endforeach; ?>
      </div>
      <button class="agt-cats-arrow agt-cats-next" aria-label="<?php esc_attr_e( 'Siguiente', 'almacengt' ); ?>">&#8250;</button>
    </div>
  </section>
  <?php endif; ?>

  <?php
  /* ========================================================
     2b. BRAND BANNERS — scrolling marquee of partner brands
     ─────────────────────────────────────────────────────────
     Add / remove entries from $agt_brands to customize.
     'color' → brand's primary hex color for the name text.
     ======================================================== */
  /*
   * 'logo' → filename inside almacengt-theme/images/brands/  (leave empty to show brand name as text fallback)
   * 'name' → used as alt text and for the product search link
   */
  $agt_brands = [
    [ 'name' => 'HP',         'logo' => 'HP.png'       ],
    [ 'name' => 'Epson',      'logo' => 'Epson.svg'    ],
    [ 'name' => 'Samsung',    'logo' => 'Samsung.png'  ],
    [ 'name' => 'Sony',       'logo' => 'Sony.png'     ],
    [ 'name' => 'Kingston',   'logo' => 'Kingston.svg' ],
    [ 'name' => 'LG',         'logo' => 'LG.svg'       ],
    [ 'name' => 'Asus',       'logo' => 'ASUS.svg'     ],
    [ 'name' => 'Lenovo',     'logo' => 'Lenovo.png'   ],
    [ 'name' => 'Acer',       'logo' => 'Acer.svg'     ],
    [ 'name' => 'Canon',      'logo' => 'Canon.svg'    ],
    [ 'name' => 'Logitech',   'logo' => 'Logitech.svg' ],
    [ 'name' => 'Intel',      'logo' => 'Intel.png'    ],
    [ 'name' => 'AMD',        'logo' => 'AMD.svg'      ],
    [ 'name' => 'Apple',      'logo' => 'Apple.png'    ],
    [ 'name' => 'WD',         'logo' => 'WD.svg'       ],
    [ 'name' => 'Toshiba',    'logo' => 'Toshiba.svg'  ],
    [ 'name' => 'Xiaomi',     'logo' => 'Xiaomi.svg'   ],
    [ 'name' => 'Corsair',    'logo' => 'Corsair.svg'  ],
  ];
  $brands_img_url = get_template_directory_uri() . '/images/brands/';
  ?>
  <section class="agt-brands-wrap" aria-label="<?php esc_attr_e( 'Marcas destacadas', 'almacengt' ); ?>">
    <div class="agt-brands-inner">
      <div class="agt-brands-header">
        <h2 class="agt-section-title"><?php esc_html_e( 'Marcas Destacadas', 'almacengt' ); ?></h2>
        <a href="<?php echo esc_url( $shop_url ); ?>" class="agt-brands-viewall">
          <?php esc_html_e( 'Ver toda la tienda →', 'almacengt' ); ?>
        </a>
      </div>
      <div class="agt-brands-overflow">
        <div class="agt-brands-track" id="agt-brands-track">
          <?php
          /* Output items twice for seamless infinite loop */
          $brand_sets = [ $agt_brands, $agt_brands ];
          foreach ( $brand_sets as $idx => $set ) :
            foreach ( $set as $b ) :
              $search_url = home_url( '/?s=' . rawurlencode( $b['name'] ) . '&post_type=product' );
              $has_logo   = ! empty( $b['logo'] );
          ?>
          <a href="<?php echo esc_url( $search_url ); ?>"
             class="agt-brand-card"
             <?php echo $idx === 1 ? 'aria-hidden="true" tabindex="-1"' : ''; ?>>
            <?php if ( $has_logo ) : ?>
              <img src="<?php echo esc_url( $brands_img_url . $b['logo'] ); ?>"
                   alt="<?php echo esc_attr( $b['name'] ); ?>"
                   class="agt-brand-logo"
                   loading="lazy">
            <?php else : ?>
              <span class="agt-brand-name"><?php echo esc_html( $b['name'] ); ?></span>
            <?php endif; ?>
          </a>
          <?php
            endforeach;
          endforeach;
          ?>
        </div>
      </div>
    </div>
  </section>

  <?php
  /* ========================================================
     3. OFERTAS DEL DÍA — productos en oferta (on_sale)
     ======================================================== */
  $deals_query = new WP_Query( array(
    'post_type'      => 'product',
    'posts_per_page' => 8,
    'post_status'    => 'publish',
    'meta_query'     => array(
      'relation' => 'OR',
      array( 'key' => '_sale_price', 'value' => '', 'compare' => '!=' ),
      array( 'key' => '_min_variation_sale_price', 'value' => '', 'compare' => '!=' ),
    ),
    'orderby'        => 'meta_value_num',
    'meta_key'       => '_sale_price',
    'order'          => 'DESC',
  ) );

  if ( $deals_query->have_posts() ) :
  ?>
  <section class="agt-deals-wrap">
    <div class="agt-deals-inner">
      <h2 class="agt-section-title"><?php esc_html_e( 'Ofertas del Día', 'almacengt' ); ?></h2>
      <div class="agt-deals-grid">
        <?php
        while ( $deals_query->have_posts() ) :
          $deals_query->the_post();
          global $product;
          $product = wc_get_product( get_the_ID() );
          if ( ! $product || ! $product->is_visible() ) continue;

          $regular = $product->get_regular_price();
          $sale    = $product->get_sale_price();
          $saving  = $regular && $sale ? 'Q' . number_format( $regular - $sale, 2 ) : '';
          $img_url = get_the_post_thumbnail_url( get_the_ID(), 'woocommerce_single' )
                  ?: wc_placeholder_img_src( 'woocommerce_single' );
          $cart_url = $product->is_type( 'simple' )
            ? esc_url( wc_get_cart_url() . '?add-to-cart=' . get_the_ID() )
            : get_permalink();
        ?>
        <div class="agt-deal-card">
          <a href="<?php echo esc_url( get_permalink() ); ?>" class="agt-deal-card-img">
            <img src="<?php echo esc_url( $img_url ); ?>"
                 alt="<?php the_title_attribute(); ?>"
                 loading="lazy">
            <span class="agt-deal-badge"><?php esc_html_e( 'OFERTA', 'almacengt' ); ?></span>
          </a>
          <div class="agt-deal-card-body">
            <a href="<?php echo esc_url( get_permalink() ); ?>" class="agt-deal-card-name">
              <?php the_title(); ?>
            </a>
            <div class="agt-deal-card-price">
              <span class="price-current">Q<?php echo number_format( (float) $sale, 2 ); ?></span>
              <?php if ( $regular ) : ?>
              <span class="price-was">Q<?php echo number_format( (float) $regular, 2 ); ?></span>
              <?php endif; ?>
              <?php if ( $saving ) : ?>
              <span class="price-save"><?php printf( esc_html__( 'Ahorra %s', 'almacengt' ), $saving ); ?></span>
              <?php endif; ?>
            </div>
          </div>
          <div class="agt-deal-card-footer">
            <a href="<?php echo esc_url( $cart_url ); ?>" class="agt-btn agt-btn-primary">
              <?php esc_html_e( 'Agregar al carrito', 'almacengt' ); ?>
            </a>
          </div>
        </div>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php
  /* ========================================================
     4. COMPRAR POR CATEGORÍA — tiles con imagen de fondo
     Muestra las 8 categorías con más productos.
     ======================================================== */
  $tile_cats = get_terms( array(
    'taxonomy'   => 'product_cat',
    'orderby'    => 'count',
    'order'      => 'DESC',
    'hide_empty' => true,
    'number'     => 8,
    'exclude'    => array( get_option( 'default_product_cat' ) ),
  ) );

  if ( ! is_wp_error( $tile_cats ) && ! empty( $tile_cats ) ) :
  ?>
  <section class="agt-tiles-wrap">
    <div class="agt-tiles-inner">
      <h2 class="agt-section-title"><?php esc_html_e( 'Comprar por Categoría', 'almacengt' ); ?></h2>
      <div class="agt-tiles-grid">
        <?php foreach ( $tile_cats as $tc ) :
          $thumb_id = get_term_meta( $tc->term_id, 'thumbnail_id', true );
          $bg_url   = $thumb_id
            ? wp_get_attachment_image_url( $thumb_id, 'large' )
            : 'https://placehold.co/480x320/14213d/fca311?text=' . rawurlencode( $tc->name );
        ?>
        <a href="<?php echo esc_url( get_term_link( $tc, 'product_cat' ) ); ?>" class="agt-tile">
          <img src="<?php echo esc_url( $bg_url ); ?>"
               alt="<?php echo esc_attr( $tc->name ); ?>"
               loading="lazy">
          <div class="agt-tile-overlay">
            <div class="agt-tile-label">
              <span><?php printf( esc_html__( '%d productos', 'almacengt' ), $tc->count ); ?></span>
              <?php echo esc_html( $tc->name ); ?>
            </div>
          </div>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php
  /* ========================================================
     4b. CATEGORY SHOWCASE — dark panel + horizontal product scroll
     ─────────────────────────────────────────────────────────
     Pulls the top 3 categories by product count and renders
     a BestBuy-style showcase block for each one.
     ======================================================== */
  $showcase_cats = get_terms( array(
    'taxonomy'   => 'product_cat',
    'orderby'    => 'count',
    'order'      => 'DESC',
    'hide_empty' => true,
    'number'     => 3,
    'exclude'    => array( get_option( 'default_product_cat' ) ),
  ) );

  if ( ! is_wp_error( $showcase_cats ) && ! empty( $showcase_cats ) ) :
  ?>
  <section class="agt-showcase-wrap">
    <div class="agt-showcase-inner">
      <?php foreach ( $showcase_cats as $sc_cat ) :
        $sc_query = new WP_Query( array(
          'post_type'      => 'product',
          'posts_per_page' => 10,
          'post_status'    => 'publish',
          'tax_query'      => array( array(
            'taxonomy' => 'product_cat',
            'field'    => 'term_id',
            'terms'    => $sc_cat->term_id,
          ) ),
        ) );
        if ( ! $sc_query->have_posts() ) continue;
        $sc_desc     = $sc_cat->description ?: __( 'Los mejores productos al mejor precio en Guatemala.', 'almacengt' );
        $sc_cat_link = get_term_link( $sc_cat, 'product_cat' );
      ?>
      <div class="agt-showcase-block">
        <div class="agt-showcase-panel">
          <div class="agt-showcase-panel-top">
            <h2 class="agt-showcase-panel-headline"><?php echo esc_html( $sc_cat->name ); ?></h2>
            <p class="agt-showcase-panel-sub"><?php echo esc_html( wp_strip_all_tags( $sc_desc ) ); ?></p>
          </div>
          <a href="<?php echo esc_url( $sc_cat_link ); ?>" class="agt-showcase-panel-link">
            <?php esc_html_e( 'Ver todo', 'almacengt' ); ?> &rarr;
          </a>
        </div>
        <div class="agt-showcase-cards">
          <?php
          while ( $sc_query->have_posts() ) :
            $sc_query->the_post();
            global $product;
            $product = wc_get_product( get_the_ID() );
            if ( ! $product || ! $product->is_visible() ) continue;

            $sc_price   = $product->get_price();
            $sc_regular = $product->get_regular_price();
            $sc_sale    = $product->get_sale_price();
            $sc_saving  = ( $sc_regular && $sc_sale && $sc_regular > $sc_sale )
                          ? number_format( $sc_regular - $sc_sale, 2 )
                          : '';
            $sc_img     = get_the_post_thumbnail_url( get_the_ID(), 'woocommerce_single' )
                       ?: wc_placeholder_img_src( 'woocommerce_single' );
          ?>
          <a href="<?php echo esc_url( get_permalink() ); ?>" class="agt-showcase-card">
            <div class="agt-showcase-card-img">
              <img src="<?php echo esc_url( $sc_img ); ?>"
                   alt="<?php the_title_attribute(); ?>"
                   loading="lazy">
              <?php if ( $sc_saving ) : ?>
              <span class="agt-showcase-save-badge">
                <?php printf( esc_html__( 'Ahorra Q%s', 'almacengt' ), $sc_saving ); ?>
              </span>
              <?php endif; ?>
            </div>
            <div class="agt-showcase-card-body">
              <span class="agt-showcase-card-name"><?php the_title(); ?></span>
              <div class="agt-showcase-card-prices">
                <span class="agt-showcase-price-current">Q<?php echo number_format( (float) $sc_price, 2 ); ?></span>
                <?php if ( $sc_saving ) : ?>
                <span class="agt-showcase-price-was">Q<?php echo number_format( (float) $sc_regular, 2 ); ?></span>
                <?php endif; ?>
              </div>
            </div>
          </a>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>
  <?php endif; ?>

  <?php
  /* ========================================================
     5. PRODUCTOS DESTACADOS
     Usa el atributo "featured" de WooCommerce.
     ======================================================== */
  $featured_query = new WP_Query( array(
    'post_type'      => 'product',
    'posts_per_page' => 20,
    'post_status'    => 'publish',
    'tax_query'      => array( array(
      'taxonomy' => 'product_visibility',
      'field'    => 'name',
      'terms'    => 'featured',
    ) ),
  ) );

  /* Si hay menos de 8 destacados, usar los más recientes */
  if ( $featured_query->post_count < 8 ) {
    wp_reset_postdata();
    $featured_query = new WP_Query( array(
      'post_type'      => 'product',
      'posts_per_page' => 20,
      'post_status'    => 'publish',
      'orderby'        => 'date',
      'order'          => 'DESC',
    ) );
  }

  if ( $featured_query->have_posts() ) :
  ?>
  <section class="agt-featured-wrap">
    <div class="agt-featured-inner">
      <h2 class="agt-section-title"><?php esc_html_e( 'Productos Destacados', 'almacengt' ); ?></h2>
      <div class="agt-products-grid">
        <?php
        $agt_featured_shown = 0;
        while ( $featured_query->have_posts() && $agt_featured_shown < 8 ) :
          $featured_query->the_post();
          global $product;
          $product = wc_get_product( get_the_ID() );
          if ( ! $product ) continue;
          $agt_featured_shown++;

          $price    = $product->get_price();
          $img_url  = get_the_post_thumbnail_url( get_the_ID(), 'woocommerce_single' )
                   ?: wc_placeholder_img_src( 'woocommerce_single' );
          $avg      = $product->get_average_rating();
          $count    = $product->get_rating_count();
          $stars    = str_repeat( '★', (int) round( $avg ) ) . str_repeat( '☆', 5 - (int) round( $avg ) );
          $cart_url = $product->is_type( 'simple' )
            ? esc_url( wc_get_cart_url() . '?add-to-cart=' . get_the_ID() )
            : get_permalink();
        ?>
        <div class="agt-product-card">
          <a href="<?php echo esc_url( get_permalink() ); ?>" class="agt-product-card-img">
            <img src="<?php echo esc_url( $img_url ); ?>"
                 alt="<?php the_title_attribute(); ?>"
                 loading="lazy">
          </a>
          <div class="agt-product-card-body">
            <a href="<?php echo esc_url( get_permalink() ); ?>" class="agt-product-card-name">
              <?php the_title(); ?>
            </a>
            <?php if ( $count > 0 ) : ?>
            <div class="agt-product-card-rating">
              <span class="stars"><?php echo esc_html( $stars ); ?></span>
              <span>(<?php echo esc_html( $count ); ?>)</span>
            </div>
            <?php endif; ?>
            <div class="agt-product-card-price">
              Q<?php echo number_format( (float) $price, 2 ); ?>
            </div>
          </div>
          <div class="agt-product-card-footer">
            <a href="<?php echo esc_url( $cart_url ); ?>" class="agt-btn agt-btn-primary">
              <?php esc_html_e( 'Agregar al carrito', 'almacengt' ); ?>
            </a>
          </div>
        </div>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php
  /* ========================================================
     5b. TODOS LOS PRODUCTOS — full browsable product grid
     Shows the 12 most recent products. Links to full shop.
     ======================================================== */
  $allproducts_query = new WP_Query( array(
    'post_type'      => 'product',
    'posts_per_page' => 12,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
  ) );

  if ( $allproducts_query->have_posts() ) :
  ?>
  <section class="agt-allproducts-wrap">
    <div class="agt-allproducts-inner">
      <div class="agt-allproducts-header">
        <h2 class="agt-section-title"><?php esc_html_e( 'Todos los Productos', 'almacengt' ); ?></h2>
        <a href="<?php echo esc_url( $shop_url ); ?>" class="agt-brands-viewall">
          <?php esc_html_e( 'Ver toda la tienda →', 'almacengt' ); ?>
        </a>
      </div>
      <div class="agt-products-grid">
        <?php
        while ( $allproducts_query->have_posts() ) :
          $allproducts_query->the_post();
          global $product;
          $product = wc_get_product( get_the_ID() );
          if ( ! $product || ! $product->is_visible() ) continue;

          $price    = $product->get_price();
          $img_url  = get_the_post_thumbnail_url( get_the_ID(), 'woocommerce_single' )
                   ?: wc_placeholder_img_src( 'woocommerce_single' );
          $avg      = $product->get_average_rating();
          $count    = $product->get_rating_count();
          $stars    = str_repeat( '★', (int) round( $avg ) ) . str_repeat( '☆', 5 - (int) round( $avg ) );
          $cart_url = $product->is_type( 'simple' )
            ? esc_url( wc_get_cart_url() . '?add-to-cart=' . get_the_ID() )
            : get_permalink();
        ?>
        <div class="agt-product-card">
          <a href="<?php echo esc_url( get_permalink() ); ?>" class="agt-product-card-img">
            <img src="<?php echo esc_url( $img_url ); ?>"
                 alt="<?php the_title_attribute(); ?>"
                 loading="lazy">
          </a>
          <div class="agt-product-card-body">
            <a href="<?php echo esc_url( get_permalink() ); ?>" class="agt-product-card-name">
              <?php the_title(); ?>
            </a>
            <?php if ( $count > 0 ) : ?>
            <div class="agt-product-card-rating">
              <span class="stars"><?php echo esc_html( $stars ); ?></span>
              <span>(<?php echo esc_html( $count ); ?>)</span>
            </div>
            <?php endif; ?>
            <div class="agt-product-card-price">
              Q<?php echo number_format( (float) $price, 2 ); ?>
            </div>
          </div>
          <div class="agt-product-card-footer">
            <a href="<?php echo esc_url( $cart_url ); ?>" class="agt-btn agt-btn-primary">
              <?php esc_html_e( 'Agregar al carrito', 'almacengt' ); ?>
            </a>
          </div>
        </div>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
      <div class="agt-allproducts-cta-row">
        <a href="<?php echo esc_url( $shop_url ); ?>" class="agt-btn agt-btn-primary">
          <?php esc_html_e( 'Ver todos los productos en la tienda →', 'almacengt' ); ?>
        </a>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <?php
  /* ========================================================
     6. MID-PAGE PROMO BANNER
     ─────────────────────────────────────────────────────────
     Edit $agt_promo below to change the content.
     'image' → upload to Media Library, paste URL here.
     Leave 'image' empty to hide the image area.
     ======================================================== */
  $agt_promo = [
    'label'  => __( 'Nuevo en AlmacenGT', 'almacengt' ),
    'title'  => __( 'Bienvenido, Guatemala.', 'almacengt' ),
    'sub'    => __( 'Desde Q2,499. Encuentra la tecnología que necesitas al precio que mereces. Envío rápido a todo el país.', 'almacengt' ),
    'terms'  => __( 'Aplican condiciones. Sujeto a disponibilidad de stock.', 'almacengt' ),
    'cta'    => __( 'Ver ahora', 'almacengt' ),
    'url'    => $shop_url,
    'image'  => '', // paste URL from WP Admin → Media Library
    'brand'  => '', // optional brand line, e.g. "MacBook Neo" (leave blank to hide)
  ];
  ?>
  <section class="agt-promo-block">
    <div class="agt-promo-block-inner">
      <?php if ( $agt_promo['label'] ) : ?>
        <span class="agt-promo-block-label"><?php echo esc_html( $agt_promo['label'] ); ?></span>
      <?php endif; ?>
      <h2 class="agt-promo-block-title"><?php echo esc_html( $agt_promo['title'] ); ?></h2>
      <p class="agt-promo-block-sub"><?php echo esc_html( $agt_promo['sub'] ); ?></p>
      <?php if ( $agt_promo['terms'] ) : ?>
        <p class="agt-promo-block-terms"><?php echo esc_html( $agt_promo['terms'] ); ?></p>
      <?php endif; ?>
      <a href="<?php echo esc_url( $agt_promo['url'] ); ?>" class="agt-promo-block-cta">
        <?php echo esc_html( $agt_promo['cta'] ); ?>
      </a>
    </div>
    <?php if ( $agt_promo['image'] ) : ?>
    <div class="agt-promo-block-img">
      <img src="<?php echo esc_url( $agt_promo['image'] ); ?>"
           alt="<?php echo esc_attr( $agt_promo['title'] ); ?>"
           loading="lazy">
    </div>
    <?php if ( $agt_promo['brand'] ) : ?>
    <div class="agt-promo-block-brand">
      <?php echo esc_html( $agt_promo['brand'] ); ?>
    </div>
    <?php endif; ?>
    <?php endif; ?>
  </section>

</main>

<?php get_footer(); ?>
