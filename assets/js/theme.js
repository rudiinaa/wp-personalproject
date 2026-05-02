(function () {
    'use strict';

    function addStickyHeader() {
        var header = document.querySelector('.site-header');

        if (!header) {
            return;
        }

        window.addEventListener('scroll', function () {
            if (window.scrollY > 20) {
                header.classList.add('is-scrolled');
            } else {
                header.classList.remove('is-scrolled');
            }
        });
    }

    function init() {
        addStickyHeader();
        console.log('Learning Journal theme JS loaded.');
    }

    document.addEventListener('DOMContentLoaded', init);
})();
