(function () {
  'use strict';

  function initSlider(sliderId, prevSel, nextSel, dotSel) {
    var slider = document.getElementById(sliderId);
    if (!slider) return;

    var slides  = slider.querySelectorAll('.agt-slide, .hp-slide');
    var dots    = document.querySelectorAll(dotSel);
    var prev    = document.querySelector(prevSel);
    var next    = document.querySelector(nextSel);
    var total   = slides.length;
    var current = 0;
    var timer   = null;
    var AUTO_MS = 6000;

    if (total < 2) return;

    function activate(n) {
      slides[current].classList.remove('is-active');
      if (dots[current]) {
        dots[current].classList.remove('is-active');
        dots[current].setAttribute('aria-selected', 'false');
      }
      current = (n + total) % total;
      slides[current].classList.add('is-active');
      if (dots[current]) {
        dots[current].classList.add('is-active');
        dots[current].setAttribute('aria-selected', 'true');
      }
    }

    function goTo(n) { activate(n); resetTimer(); }

    function resetTimer() {
      clearInterval(timer);
      timer = setInterval(function () { activate(current + 1); }, AUTO_MS);
    }

    if (prev) prev.addEventListener('click', function () { goTo(current - 1); });
    if (next) next.addEventListener('click', function () { goTo(current + 1); });

    dots.forEach(function (dot, i) {
      dot.addEventListener('click', function () { goTo(i); });
    });

    // Touch swipe
    var touchStartX = 0;
    slider.addEventListener('touchstart', function (e) {
      touchStartX = e.touches[0].clientX;
    }, { passive: true });
    slider.addEventListener('touchend', function (e) {
      var diff = touchStartX - e.changedTouches[0].clientX;
      if (Math.abs(diff) > 48) goTo(current + (diff > 0 ? 1 : -1));
    }, { passive: true });

    // Pause on hover
    slider.addEventListener('mouseenter', function () { clearInterval(timer); });
    slider.addEventListener('mouseleave', resetTimer);

    resetTimer();
  }

  // page-home.php slider (agt-* classes)
  initSlider('agt-hero-slider', '.agt-slider-prev', '.agt-slider-next', '.agt-slider-dot');

  // index.php slider (hp-* classes, fallback)
  initSlider('hp-hero-slider', '.hp-slider-prev', '.hp-slider-next', '.hp-slider-dot');

  // ── Category strip — continuous marquee ──────────────────────────────
  (function () {
    var track = document.getElementById('agt-cats-track');
    if (!track) return;

    var original = Array.from(track.querySelectorAll('.agt-cat-item'));
    if (!original.length) return;

    // Build inner marquee wrapper with original + cloned items
    var marquee = document.createElement('div');
    marquee.className = 'agt-cats-marquee';
    original.forEach(function (el) { marquee.appendChild(el); });
    original.forEach(function (el) { marquee.appendChild(el.cloneNode(true)); });
    track.appendChild(marquee);

    var SPEED    = 0.5;   // px per frame — adjust for faster/slower scroll
    var pos      = 0;
    var halfW    = 1;
    var paused   = false;

    // Calculate width of one full set of original items
    function calcHalf() {
      var gap = parseFloat(window.getComputedStyle(marquee).gap) || 12;
      var w   = 0;
      original.forEach(function (el) { w += el.offsetWidth + gap; });
      halfW = w;
    }

    function tick() {
      if (!paused) {
        pos += SPEED;
        if (pos >= halfW) pos -= halfW;   // seamless reset
        marquee.style.transform = 'translateX(-' + pos + 'px)';
      }
      requestAnimationFrame(tick);
    }

    // Pause on hover
    track.addEventListener('mouseenter', function () { paused = true; });
    track.addEventListener('mouseleave', function () { paused = false; });

    // Touch drag
    var txStart = 0;
    track.addEventListener('touchstart', function (e) {
      txStart  = e.touches[0].clientX;
      paused   = true;
    }, { passive: true });
    track.addEventListener('touchmove', function (e) {
      var diff = txStart - e.touches[0].clientX;
      txStart  = e.touches[0].clientX;
      pos = ((pos + diff) % halfW + halfW) % halfW;
      marquee.style.transform = 'translateX(-' + pos + 'px)';
    }, { passive: true });
    track.addEventListener('touchend', function () { paused = false; }, { passive: true });

    // Arrow buttons — skip one item forward/back instantly
    var prevBtn = document.querySelector('.agt-cats-prev');
    var nextBtn = document.querySelector('.agt-cats-next');

    function itemW() {
      var el  = marquee.querySelector('.agt-cat-item');
      var gap = parseFloat(window.getComputedStyle(marquee).gap) || 12;
      return el ? el.offsetWidth + gap : 120;
    }

    if (nextBtn) nextBtn.addEventListener('click', function () {
      pos = (pos + itemW()) % halfW;
    });
    if (prevBtn) prevBtn.addEventListener('click', function () {
      pos = ((pos - itemW()) % halfW + halfW) % halfW;
    });

    window.addEventListener('resize', calcHalf);

    // Start after layout is ready
    requestAnimationFrame(function () { calcHalf(); tick(); });
  }());

  // ── Subnav dropdowns — tap to open on touch devices ──────────────────
  var isTouch = window.matchMedia('(hover: none)').matches;

  document.querySelectorAll('.subnav-link--parent').forEach(function (link) {
    link.addEventListener('click', function (e) {
      if (!isTouch) return; // desktop: CSS hover handles it
      var item = link.closest('.subnav-item');
      var wasOpen = item.classList.contains('is-open');
      // close all open dropdowns
      document.querySelectorAll('.subnav-item.is-open').forEach(function (el) {
        el.classList.remove('is-open');
      });
      if (!wasOpen) {
        e.preventDefault(); // first tap: open dropdown, don't navigate
        item.classList.add('is-open');
      }
      // second tap (wasOpen): let the link navigate normally
    });
  });

  // close dropdowns when tapping outside
  document.addEventListener('click', function (e) {
    if (!e.target.closest('.subnav-item')) {
      document.querySelectorAll('.subnav-item.is-open').forEach(function (el) {
        el.classList.remove('is-open');
      });
    }
  });

}());
