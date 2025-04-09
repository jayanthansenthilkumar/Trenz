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

    // Simplified navigation functionality without active states
    const navLinks = document.querySelectorAll('.sidebar .nav-links li a');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            
            if (targetId && targetId.startsWith('#')) {
                const targetSection = document.getElementById(targetId.substring(1));
                
                if (targetSection) {
                    targetSection.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    });
});
