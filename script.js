document.addEventListener('DOMContentLoaded', function() {
    if (typeof particlesJS !== 'undefined' && document.getElementById('particles-js')) {
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
    } else {
        console.error('Particles.js not found');
    }
    const heroSection = document.querySelector('.hero-section');
    if (!heroSection.id) heroSection.id = 'home';
    const navItems = document.querySelectorAll('.sidebar .nav-links li');
    const sections = Array.from(document.querySelectorAll('#home, #about'));
    let currentSection = '';
    let isScrolling = false;
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (!isScrolling && entry.isIntersecting && entry.intersectionRatio > 0.5) {
                currentSection = entry.target.id;
                updateActiveTab(currentSection);
            }
        });
    }, { threshold: [0.5] });
    sections.forEach(section => observer.observe(section));
    function updateActiveTab(sectionId) {
        navItems.forEach(item => item.classList.remove('active'));
        const activeNavItem = document.querySelector(`.sidebar .nav-links li a[href="#${sectionId}"]`);
        if (activeNavItem) {
            activeNavItem.parentElement.classList.add('active');
        }
    }
    
    // Simplified and fixed navigation functionality
    const navLinks = document.querySelectorAll('.sidebar .nav-links li a');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get the target section id from href attribute
            const targetId = this.getAttribute('href');
            
            if (targetId && targetId.startsWith('#')) {
                // Find the target section
                const targetSection = document.getElementById(targetId.substring(1));
                
                if (targetSection) {
                    console.log("Navigating to section:", targetId);
                    
                    // Update active state
                    document.querySelectorAll('.sidebar .nav-links li').forEach(item => {
                        item.classList.remove('active');
                    });
                    this.parentElement.classList.add('active');
                    
                    // Scroll to the section
                    targetSection.scrollIntoView({ behavior: 'smooth' });
                    
                    // Alternative scroll method if scrollIntoView doesn't work well
                    /*
                    window.scrollTo({
                        top: targetSection.offsetTop - 50,
                        behavior: 'smooth'
                    });
                    */
                } else {
                    console.error("Target section not found:", targetId);
                }
            }
        });
    });
    
    const initialSection = window.location.hash || '#home';
    updateActiveTab(initialSection.substring(1));
});
