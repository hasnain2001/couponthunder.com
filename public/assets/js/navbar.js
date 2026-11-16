    document.addEventListener('DOMContentLoaded', function() {
        // --- Mobile Drawer Logic ---
        const openBtn = document.getElementById('openMenuBtn');
        const closeBtn = document.getElementById('closeMenuBtn');
        const overlay = document.getElementById('mobileOverlay');
        const drawer = document.getElementById('mobileDrawer');

        function toggleMenu() {
            overlay.classList.toggle('active');
            drawer.classList.toggle('active');
            
            // Prevent body scroll when menu is open
            if (drawer.classList.contains('active')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }

        if(openBtn) openBtn.addEventListener('click', toggleMenu);
        if(closeBtn) closeBtn.addEventListener('click', toggleMenu);
        if(overlay) overlay.addEventListener('click', toggleMenu);

        // --- Custom Dropdown Logic (For Mobile touch/click) ---
        const dropdownTriggers = document.querySelectorAll('.dropdown-trigger');
        
        dropdownTriggers.forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                const content = this.nextElementSibling;
                
                // Close other open dropdowns
                document.querySelectorAll('.dropdown-content').forEach(d => {
                    if (d !== content) {
                        d.style.opacity = '0';
                        d.style.visibility = 'hidden';
                        d.style.transform = 'translateY(10px)';
                    }
                });

                // Toggle current
                if (content.style.opacity === '1') {
                    content.style.opacity = '0';
                    content.style.visibility = 'hidden';
                    content.style.transform = 'translateY(10px)';
                } else {
                    content.style.opacity = '1';
                    content.style.visibility = 'visible';
                    content.style.transform = 'translateY(0)';
                }
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.custom-dropdown')) {
                document.querySelectorAll('.dropdown-content').forEach(d => {
                    d.style.opacity = '0';
                    d.style.visibility = 'hidden';
                    d.style.transform = 'translateY(10px)';
                });
            }
        });
    });