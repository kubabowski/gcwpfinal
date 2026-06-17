/**
 * PATH : Wordpress-ACF-Starter-Theme-master/js/theme.js
 *
 * GCHemp — theme.js
 * Header scroll effect + scroll-reveal
 */

document.addEventListener('DOMContentLoaded', function () {

    /* ── Header scroll class ─────────────────────────── */
    const header = document.getElementById('masthead');

    function updateHeader() {
        if (window.scrollY > 60) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    }

    window.addEventListener('scroll', updateHeader, { passive: true });
    updateHeader();

    /* ── Scroll reveal ───────────────────────────────── */
    const revealEls = document.querySelectorAll(
        '.about-section .section-header, .slide-content, .product-grid > img, .product-content'
    );

    revealEls.forEach(function (el) {
        el.classList.add('reveal');
    });

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });

    revealEls.forEach(function (el) {
        observer.observe(el);
    });

    // ── Header scroll state ──────────────────────────────────
    (function () {
        var header = document.getElementById('masthead');
        if (!header) return;
        function onScroll() {
            header.classList.toggle('scrolled', window.scrollY > 40);
        }
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    })();

// ── Scroll reveal ────────────────────────────────────────
    (function () {
        var els = document.querySelectorAll('.reveal');
        if (!els.length) return;
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (e.isIntersecting) {
                    e.target.classList.add('revealed');
                    io.unobserve(e.target);
                }
            });
        }, { threshold: 0.12 });
        els.forEach(function (el) { io.observe(el); });
    })();

});