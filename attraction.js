document.addEventListener('DOMContentLoaded', function() {
    const attractionContainer = document.getElementById('attraction-cards-container');
    const prevBtn = document.getElementById('attraction-prev');
    const nextBtn = document.getElementById('attraction-next');
    
    let scrollPosition = 0;
    const cardWidth = 300; // Adjust based on your card width + margin
    const scrollAmount = cardWidth * 4; // Scroll 4 cards at once
    
    // Update navigation buttons based on scroll position
    function updateNavButtons() {
        prevBtn.classList.toggle('disabled', scrollPosition <= 0);
        nextBtn.classList.toggle('disabled', scrollPosition >= attractionContainer.scrollWidth - attractionContainer.clientWidth);
    }
    
    // Scroll left
    prevBtn.addEventListener('click', function() {
        scrollPosition = Math.max(0, scrollPosition - scrollAmount);
        attractionContainer.scrollTo({
            left: scrollPosition,
            behavior: 'smooth'
        });
        setTimeout(updateNavButtons, 400);
    });
    
    // Scroll right
    nextBtn.addEventListener('click', function() {
        scrollPosition = Math.min(
            attractionContainer.scrollWidth - attractionContainer.clientWidth,
            scrollPosition + scrollAmount
        );
        attractionContainer.scrollTo({
            left: scrollPosition,
            behavior: 'smooth'
        });
        setTimeout(updateNavButtons, 400);
    });
    
    // Initialize button states
    updateNavButtons();
    
    // Update button states on window resize
    window.addEventListener('resize', updateNavButtons);
});
