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
            // console.log(`Active section: ${sectionId}`);
        }
    }
    
    // 6. Handle click events on nav links
    navItems.forEach(item => {
        const link = item.querySelector('a');
        if (link) {
            link.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId && targetId.startsWith('#')) {
                    e.preventDefault();
                    
                    const targetSection = document.querySelector(targetId);
                    if (targetSection) {
                        isScrolling = true;
                        navItems.forEach(el => el.classList.remove('active'));
                        item.classList.add('active');
                        window.scrollTo({
                            top: targetSection.offsetTop - 50,
                            behavior: 'smooth'
                        });
                        setTimeout(() => {
                            isScrolling = false;
                            currentSection = targetId.substring(1);
                        }, 1000);
                    }
                }
            });
        }
    });
    const initialSection = window.location.hash || '#home';
    updateActiveTab(initialSection.substring(1));
});
