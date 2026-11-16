document.addEventListener('DOMContentLoaded', function() {
    const newsletterForm = document.getElementById('newsletterForm');
    
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const btn = this.querySelector('.ct-subscribe-btn');
            const btnText = btn.querySelector('.btn-text');
            const btnIcon = btn.querySelector('.btn-icon');
            const input = this.querySelector('input');
            
            // Prevent double clicks
            if (btn.classList.contains('loading') || btn.classList.contains('success')) return;

            // 1. Set Loading State
            btn.classList.add('loading');
            
            // 2. Simulate API Call (Replace with your actual AJAX request)
            setTimeout(() => {
                // Remove loading, set success
                btn.classList.remove('loading');
                btn.classList.add('success');
                btnText.textContent = 'Subscribed';
                
                // Change icon to checkmark
                btnIcon.className = 'fa-solid fa-check btn-icon';
                
                // Clear the input field
                input.value = '';

                // 3. Reset back to normal after 3 seconds
                setTimeout(() => {
                    btn.classList.remove('success');
                    btnText.textContent = 'Subscribe';
                    btnIcon.className = 'fa-solid fa-paper-plane btn-icon';
                }, 3000);

            }, 1200); // 1.2 second simulated delay
        });
    }
});