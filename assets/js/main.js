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
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');
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
    
    // Animate elements on scroll (intersection observer)
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);
    
    // Observe cards and sections
    document.querySelectorAll('.card, .stat-item, .section-header').forEach(function(el) {
        observer.observe(el);
    });
    
});

// Language switcher enhancement
function setLanguage(langCode) {
    document.cookie = 'ioi_lang=' + langCode + ';path=/;max-age=31536000';
    window.location.href = window.location.pathname + '?lang=' + langCode;
}
