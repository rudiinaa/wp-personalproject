/**
 * Main JavaScript for BookSaw Theme
 */

(function() {
    'use strict';

    /**
     * Initialize theme scripts
     */
    function init() {
        setupMobileMenu();
        setupSearch();
        setupNewsletterForm();
        setupSmoothScroll();
    }

    /**
     * Setup mobile menu toggle
     */
    function setupMobileMenu() {
        const menuToggle = document.querySelector('.menu-toggle');
        const siteNav = document.querySelector('.site-navigation');

        if (menuToggle && siteNav) {
            menuToggle.addEventListener('click', function() {
                siteNav.classList.toggle('toggled');
                menuToggle.setAttribute('aria-expanded', siteNav.classList.contains('toggled'));
            });

            // Close menu when a navigation link is clicked
            const navLinks = siteNav.querySelectorAll('a');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    siteNav.classList.remove('toggled');
                    menuToggle.setAttribute('aria-expanded', false);
                });
            });
        }
    }

    /**
     * Setup search functionality
     */
    function setupSearch() {
        const searchIcons = document.querySelectorAll('.header-search-icon');

        searchIcons.forEach(icon => {
            icon.addEventListener('click', function(e) {
                e.preventDefault();
                const searchTerm = prompt('Search books...');
                if (searchTerm) {
                    window.location.href = '/?s=' + encodeURIComponent(searchTerm) + '&post_type=book';
                }
            });
        });
    }

    /**
     * Setup newsletter form
     */
    function setupNewsletterForm() {
        const newsletterForm = document.querySelector('.newsletter-form');

        if (newsletterForm) {
            newsletterForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const emailInput = this.querySelector('input[type="email"]');
                const email = emailInput.value;

                // Simple email validation
                if (isValidEmail(email)) {
                    // Here you could add AJAX call to subscribe
                    alert('Thank you for subscribing! Check your email for confirmation.');
                    emailInput.value = '';
                } else {
                    alert('Please enter a valid email address.');
                }
            });
        }
    }

    /**
     * Validate email format
     */
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    /**
     * Setup smooth scroll behavior
     */
    function setupSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href !== '#') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
    }

    /**
     * Add to cart functionality (can be extended with WooCommerce)
     */
    window.addToCart = function(bookId) {
        if (typeof wc_add_to_cart_params === 'undefined') {
            alert('Please enable WooCommerce or configure e-commerce functionality.');
            return;
        }

        // WooCommerce integration can be added here
        console.log('Add to cart: ' + bookId);
    };

    /**
     * Initialize when DOM is ready
     */
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
