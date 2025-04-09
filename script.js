document.addEventListener('DOMContentLoaded', function() {
    if (typeof particlesJS !== 'undefined' && document.getElementById('particles-js')) {
        // Check if this is the login page
        if (document.body.classList.contains('login-page')) {
            particlesJS('particles-js', {
                particles: {
                    number: { value: 80 },
                    color: { value: '#2563eb' },
                    opacity: { value: 0.2 }, // Increased opacity for better visibility
                    size: { value: 3 },
                    line_linked: {
                        enable: true,
                        distance: 150,
                        color: '#2563eb',
                        opacity: 0.1, // Increased opacity for better visibility
                        width: 1
                    },
                    move: {
                        enable: true,
                        speed: 2
                    }
                }
            });
        } else {
            // Default particles for other pages
            particlesJS('particles-js', {
                particles: {
                    number: { value: 80 },
                    color: { value: '#2563eb' },
                    opacity: { value: 0.2 },
                    size: { value: 3 },
                    line_linked: {
                        enable: true,
                        distance: 150,
                        color: '#2563eb',
                        opacity: 0.1,
                        width: 1
                    },
                    move: {
                        enable: true,
                        speed: 2
                    }
                }
            });
        }
    } else {
        console.error('Particles.js not found');
    }

    // Enhanced smooth navigation for all anchor links in the page
    const allLinks = document.querySelectorAll('a[href^="#"]');
    
    allLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            
            if (targetId && targetId !== '#') {
                const targetSection = document.getElementById(targetId.substring(1));
                
                if (targetSection) {
                    targetSection.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    });

    // File upload name display
    const fileInput = document.getElementById('paymentProof');
    if (fileInput) {
        const fileName = document.querySelector('.file-name');
        
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileName.textContent = this.files[0].name;
            } else {
                fileName.textContent = 'No file chosen';
            }
        });
    }
    
    // Set default date to today for transaction date
    const transactionDate = document.getElementById('transactionDate');
    if (transactionDate) {
        const today = new Date();
        const formattedDate = today.toISOString().split('T')[0];
        transactionDate.value = formattedDate;
    }

    // Tab functionality for registration form
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    const nextTabBtns = document.querySelectorAll('.next-tab');
    const prevTabBtns = document.querySelectorAll('.prev-tab');
    
    if (tabBtns.length > 0) {
        // Handle tab button clicks
        tabBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active class from all buttons and contents
                tabBtns.forEach(b => b.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));
                
                // Add active class to current button and corresponding content
                this.classList.add('active');
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });
        
        // Handle next button clicks
        nextTabBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const nextTabId = this.getAttribute('data-next');
                
                // Validate current tab fields before proceeding
                const currentTab = this.closest('.tab-content');
                const requiredFields = currentTab.querySelectorAll('input[required], select[required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.value) {
                        isValid = false;
                        field.classList.add('invalid');
                        
                        // Add shake animation to highlight error
                        field.animate(
                            [
                                { transform: 'translateX(0px)' },
                                { transform: 'translateX(-5px)' },
                                { transform: 'translateX(5px)' },
                                { transform: 'translateX(-5px)' },
                                { transform: 'translateX(0px)' }
                            ],
                            { duration: 300 }
                        );
                    } else {
                        field.classList.remove('invalid');
                    }
                });
                
                if (isValid) {
                    // Switch to next tab
                    tabBtns.forEach(b => b.classList.remove('active'));
                    tabContents.forEach(c => c.classList.remove('active'));
                    
                    document.querySelector(`[data-tab="${nextTabId}"]`).classList.add('active');
                    document.getElementById(nextTabId).classList.add('active');
                }
            });
        });
        
        // Handle previous button clicks
        prevTabBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const prevTabId = this.getAttribute('data-prev');
                
                // Switch to previous tab
                tabBtns.forEach(b => b.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));
                
                document.querySelector(`[data-tab="${prevTabId}"]`).classList.add('active');
                document.getElementById(prevTabId).classList.add('active');
            });
        });
        
        // Add input validation styling
        document.querySelectorAll('.registration-form input, .registration-form select').forEach(field => {
            field.addEventListener('input', function() {
                if (this.hasAttribute('required') && this.value) {
                    this.classList.remove('invalid');
                }
            });
        });
    }
});
