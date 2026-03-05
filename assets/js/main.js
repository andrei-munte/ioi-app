/**
 * IOI Theme - Main JavaScript
 * @package IOI
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // Mobile menu toggle
    const toggle = document.querySelector('.mobile-menu-toggle');
    const menu = document.querySelector('.nav-menu');
    
    if (toggle && menu) {
        toggle.addEventListener('click', function() {
            menu.classList.toggle('active');
            const expanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !expanded);
        });
    }
    
    // Mobile dropdown toggle
    const dropdownToggles = document.querySelectorAll('.nav-menu .dropdown-toggle');
    dropdownToggles.forEach(function(dropdownToggle) {
        dropdownToggle.addEventListener('click', function(e) {
            // Only handle click on mobile
            if (window.innerWidth <= 900) {
                e.preventDefault();
                const parent = this.closest('.has-dropdown');
                parent.classList.toggle('active');
            }
        });
    });
    
    // FAQ accordion
    document.querySelectorAll('.faq-question').forEach(function(question) {
        question.addEventListener('click', function() {
            const item = this.closest('.faq-item');
            const wasActive = item.classList.contains('active');
            
            // Close all FAQ items
            document.querySelectorAll('.faq-item').forEach(function(faq) {
                faq.classList.remove('active');
            });
            
            // Open clicked item if it wasn't active
            if (!wasActive) {
                item.classList.add('active');
            }
        });
    });
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"], a[href*="/#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            // Handle links like "/#section" or "#section"
            let targetId;
            if (href.includes('/#')) {
                // Link to homepage section from another page
                // Let the browser navigate, the hash will be handled on page load
                return;
            } else if (href.startsWith('#')) {
                targetId = href;
            } else {
                return;
            }
            
            if (targetId === '#') return;
            
            const target = document.querySelector(targetId);
            if (target) {
                e.preventDefault();
                
                // Close mobile menu if open
                if (menu) {
                    menu.classList.remove('active');
                    if (toggle) {
                        toggle.setAttribute('aria-expanded', 'false');
                    }
                }
                
                // Close any open dropdowns
                document.querySelectorAll('.has-dropdown.active').forEach(function(dd) {
                    dd.classList.remove('active');
                });
                
                // Smooth scroll to target
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                
                // Update URL hash without jumping
                history.pushState(null, null, targetId);
            }
        });
    });
    
    // Handle hash on page load (for links from other pages)
    if (window.location.hash) {
        setTimeout(function() {
            const target = document.querySelector(window.location.hash);
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }, 100);
    }
    
    // Navbar background on scroll
    const nav = document.querySelector('.site-nav');
    if (nav) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });
    }
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.has-dropdown')) {
            document.querySelectorAll('.has-dropdown.active').forEach(function(dd) {
                dd.classList.remove('active');
            });
        }
    });
    
});