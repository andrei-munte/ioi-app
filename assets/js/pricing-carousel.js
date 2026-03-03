/**
 * IOI Pricing 3D Carousel
 * Drag to rotate through pricing tiers
 */
(function() {
    'use strict';
    
    var carousel = document.getElementById('pricingCarousel');
    if (!carousel) return;
    
    var cards = carousel.querySelectorAll('.carousel-card');
    var cardCount = cards.length;
    var anglePerCard = 360 / cardCount;
    var radius = 350;
    
    var currentAngle = 0;
    var targetAngle = 0;
    var isDragging = false;
    var startX = 0;
    var startAngle = 0;
    var velocity = 0;
    var lastX = 0;
    var lastTime = 0;
    var animationId = null;
    
    function positionCards() {
        cards.forEach(function(card, index) {
            var angle = (index * anglePerCard) + currentAngle;
            var radians = (angle * Math.PI) / 180;
            
            var x = Math.sin(radians) * radius;
            var z = Math.cos(radians) * radius - radius;
            
            var scale = Math.max(0.6, (z + radius * 2) / (radius * 2));
            var opacity = Math.max(0.3, scale);
            
            card.style.transform = 'translateX(' + x + 'px) translateZ(' + z + 'px) scale(' + scale + ')';
            card.style.opacity = opacity;
            card.style.zIndex = Math.round(scale * 100);
            
            if (z > -50) {
                card.classList.add('active');
            } else {
                card.classList.remove('active');
            }
        });
    }
    
    function snapToNearestCard() {
        var snappedAngle = Math.round(currentAngle / anglePerCard) * anglePerCard;
        targetAngle = snappedAngle;
        animateToTarget();
    }
    
    function animateToTarget() {
        if (animationId) cancelAnimationFrame(animationId);
        
        function step() {
            var diff = targetAngle - currentAngle;
            
            if (Math.abs(diff) < 0.5) {
                currentAngle = targetAngle;
                positionCards();
                return;
            }
            
            currentAngle += diff * 0.15;
            positionCards();
            animationId = requestAnimationFrame(step);
        }
        
        step();
    }
    
    function applyMomentum() {
        if (animationId) cancelAnimationFrame(animationId);
        
        function step() {
            if (Math.abs(velocity) < 0.5) {
                snapToNearestCard();
                return;
            }
            
            currentAngle += velocity;
            velocity *= 0.95;
            positionCards();
            animationId = requestAnimationFrame(step);
        }
        
        step();
    }
    
    function handleStart(e) {
        if (animationId) cancelAnimationFrame(animationId);
        
        isDragging = true;
        carousel.classList.add('dragging');
        
        startX = e.type.includes('mouse') ? e.clientX : e.touches[0].clientX;
        startAngle = currentAngle;
        lastX = startX;
        lastTime = Date.now();
        velocity = 0;
    }
    
    function handleMove(e) {
        if (!isDragging) return;
        
        var currentX = e.type.includes('mouse') ? e.clientX : e.touches[0].clientX;
        var deltaX = currentX - startX;
        
        currentAngle = startAngle - (deltaX * 0.3);
        positionCards();
        
        var now = Date.now();
        var dt = now - lastTime;
        if (dt > 0) {
            velocity = -(currentX - lastX) * 0.3 / dt * 16;
        }
        lastX = currentX;
        lastTime = now;
    }
    
    function handleEnd() {
        if (!isDragging) return;
        
        isDragging = false;
        carousel.classList.remove('dragging');
        
        if (Math.abs(velocity) > 2) {
            applyMomentum();
        } else {
            snapToNearestCard();
        }
    }
    
    // Mouse events
    carousel.parentElement.addEventListener('mousedown', handleStart);
    document.addEventListener('mousemove', handleMove);
    document.addEventListener('mouseup', handleEnd);
    
    // Touch events
    carousel.parentElement.addEventListener('touchstart', handleStart, { passive: true });
    document.addEventListener('touchmove', handleMove, { passive: true });
    document.addEventListener('touchend', handleEnd);
    
    // Prevent context menu
    carousel.parentElement.addEventListener('contextmenu', function(e) { e.preventDefault(); });
    
    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowLeft') {
            targetAngle = currentAngle + anglePerCard;
            animateToTarget();
        } else if (e.key === 'ArrowRight') {
            targetAngle = currentAngle - anglePerCard;
            animateToTarget();
        }
    });
    
    // Find popular card and center it
    var popularIndex = 1;
    cards.forEach(function(card, index) {
        if (card.querySelector('.popular-badge')) {
            popularIndex = index;
        }
    });
    currentAngle = -popularIndex * anglePerCard;
    positionCards();
    
})();