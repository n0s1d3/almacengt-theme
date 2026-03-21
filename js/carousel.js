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

  // ── Category strip carousel ───────────────────────────────────────────
  (function () {
    var track = document.getElementById('agt-cats-track');
    if (!track) return;

    var prev  = document.querySelector('.agt-cats-prev');
    var next  = document.querySelector('.agt-cats-next');
    var AUTO_MS = 3500;
    var timer;

    function itemWidth() {
      var first = track.querySelector('.agt-cat-item');
      if (!first) return 120;
      var style = window.getComputedStyle(track);
      var gap = parseFloat(style.gap) || 12;
      return first.offsetWidth + gap;
    }

    function advance() {
      var iw = itemWidth();
      var atEnd = track.scrollLeft + track.clientWidth >= track.scrollWidth - iw;
      if (atEnd) {
        track.scrollTo({ left: 0, behavior: 'smooth' });
      } else {
        track.scrollBy({ left: iw, behavior: 'smooth' });
      }
    }

    function retreat() {
      var iw = itemWidth();
      if (track.scrollLeft <= 0) {
        track.scrollTo({ left: track.scrollWidth, behavior: 'smooth' });
      } else {
        track.scrollBy({ left: -iw, behavior: 'smooth' });
      }
    }

    function resetTimer() {
      clearInterval(timer);
      timer = setInterval(advance, AUTO_MS);
    }

    if (next) next.addEventListener('click', function () { advance(); resetTimer(); });
    if (prev) prev.addEventListener('click', function () { retreat(); resetTimer(); });

    track.addEventListener('mouseenter', function () { clearInterval(timer); });
    track.addEventListener('mouseleave', resetTimer);

    var touchStartX = 0;
    track.addEventListener('touchstart', function (e) {
      touchStartX = e.touches[0].clientX;
      clearInterval(timer);
    }, { passive: true });
    track.addEventListener('touchend', function (e) {
      var diff = touchStartX - e.changedTouches[0].clientX;
      if (Math.abs(diff) > 32) { diff > 0 ? advance() : retreat(); }
      resetTimer();
    }, { passive: true });

    resetTimer();
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
