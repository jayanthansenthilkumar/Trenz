/**
 * Trenz'26 - Animation & Theme System
 * Uses tsParticles, GSAP, and Lottie for modern animations
 */

// ============================================
// THEME MANAGEMENT
// ============================================
const ThemeManager = {
    init() {
        const savedTheme = localStorage.getItem('trenz-theme') || 'light';
        this.setTheme(savedTheme);
        this.bindEvents();
    },

    setTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('trenz-theme', theme);
        
        // Update particles colors based on theme
        if (window.tsParticles) {
            this.updateParticlesTheme(theme);
        }
    },

    toggle() {
        const currentTheme = document.documentElement.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        this.setTheme(newTheme);
    },

    bindEvents() {
        document.querySelectorAll('.theme-toggle, #theme-toggle').forEach(btn => {
            btn.addEventListener('click', () => this.toggle());
        });
    },

    updateParticlesTheme(theme) {
        const particleColor = theme === 'dark' ? '#e74c3c' : '#e74c3c';
        const lineColor = theme === 'dark' ? 'rgba(231, 76, 60, 0.2)' : 'rgba(231, 76, 60, 0.1)';
        
        // Reload particles with new colors if needed
        if (window.tsParticlesInstance) {
            window.tsParticlesInstance.options.particles.color.value = particleColor;
            window.tsParticlesInstance.options.particles.links.color = lineColor;
            window.tsParticlesInstance.refresh();
        }
    }
};

// ============================================
// tsParticles CONFIGURATION
// ============================================
const ParticlesConfig = {
    // Main floating particles config
    floating: {
        fullScreen: { enable: false },
        background: { color: { value: "transparent" } },
        fpsLimit: 60,
        interactivity: {
            // events: {
            //     onHover: {
            //         enable: true,
            //         mode: "grab"
            //     },
            //     onClick: {
            //         enable: true,
            //         mode: "push"
            //     },
            //     resize: true
            // },
            modes: {
                grab: {
                    distance: 1,
                    links: { opacity: 0.5 }
                },
                push: { quantity: 2 }
            }
        },
        particles: {
            color: { value: "#e74c3c" },
            links: {
                color: "rgba(231, 76, 60, 0.1)",
                distance: 150,
                enable: true,
                opacity: 0.3,
                width: 1
            },
            move: {
                direction: "none",
                enable: true,
                outModes: { default: "bounce" },
                random: true,
                speed: 1,
                straight: false,
                attract: {
                    enable: true,
                    rotateX: 600,
                    rotateY: 1200
                }
            },
            number: {
                density: {
                    enable: true,
                    area: 1000
                },
                value: 60
            },
            opacity: {
                value: { min: 0.3, max: 0.6 },
                animation: {
                    enable: true,
                    speed: 1,
                    minimumValue: 0.1
                }
            },
            shape: {
                type: ["circle"]
            },
            size: {
                value: { min: 2, max: 5 },
                animation: {
                    enable: true,
                    speed: 2,
                    minimumValue: 1
                }
            }
        },
        detectRetina: true
    },

    // Confetti burst for events
    confetti: {
        fullScreen: { enable: false },
        particles: {
            number: { value: 0 },
            color: {
                value: ["#e74c3c", "#3498db", "#27ae60", "#f39c12", "#9b59b6"]
            },
            shape: {
                type: ["circle", "square", "triangle"]
            },
            opacity: {
                value: 1,
                animation: {
                    enable: true,
                    minimumValue: 0,
                    speed: 0.5,
                    startValue: "max",
                    destroy: "min"
                }
            },
            size: {
                value: { min: 3, max: 7 }
            },
            life: {
                duration: { sync: true, value: 3 },
                count: 1
            },
            move: {
                enable: true,
                gravity: {
                    enable: true,
                    acceleration: 15
                },
                speed: { min: 10, max: 30 },
                decay: 0.05,
                direction: "none",
                outModes: { default: "destroy", top: "none" }
            },
            rotate: {
                value: { min: 0, max: 360 },
                direction: "random",
                animation: { enable: true, speed: 30 }
            },
            tilt: {
                direction: "random",
                enable: true,
                value: { min: 0, max: 360 },
                animation: { enable: true, speed: 30 }
            },
            roll: {
                darken: { enable: true, value: 25 },
                enable: true,
                speed: { min: 5, max: 15 }
            },
            wobble: {
                distance: 30,
                enable: true,
                speed: { min: -7, max: 7 }
            }
        },
        emitters: {
            position: { x: 50, y: 0 },
            rate: { delay: 0, quantity: 0 },
            size: { width: 0, height: 0 }
        }
    },

    // Bubble effect
    bubbles: {
        fullScreen: { enable: false },
        background: { color: { value: "transparent" } },
        particles: {
            number: {
                value: 30,
                density: { enable: true, area: 800 }
            },
            color: {
                value: ["rgba(231, 76, 60, 0.3)", "rgba(52, 152, 219, 0.3)", "rgba(39, 174, 96, 0.3)"]
            },
            shape: { type: "circle" },
            opacity: {
                value: { min: 0.1, max: 0.4 }
            },
            size: {
                value: { min: 10, max: 50 },
                animation: {
                    enable: true,
                    speed: 3,
                    minimumValue: 5,
                    sync: false
                }
            },
            move: {
                enable: true,
                speed: 2,
                direction: "top",
                outModes: { default: "out", bottom: "out", top: "out" }
            }
        },
        detectRetina: true
    }
};

// Initialize tsParticles
async function initParticles(containerId = 'tsparticles', config = 'floating') {
    if (typeof tsParticles === 'undefined') {
        console.warn('tsParticles not loaded');
        return;
    }

    const container = document.getElementById(containerId);
    if (!container) {
        console.warn(`Container #${containerId} not found`);
        return;
    }

    try {
        window.tsParticlesInstance = await tsParticles.load(containerId, ParticlesConfig[config]);
        console.log('tsParticles initialized successfully');
    } catch (error) {
        console.error('Error initializing tsParticles:', error);
    }
}

// Trigger confetti burst
async function triggerConfetti(containerId = 'confetti-container') {
    if (typeof tsParticles === 'undefined') return;

    const container = document.getElementById(containerId);
    if (!container) return;

    const instance = await tsParticles.load(containerId, ParticlesConfig.confetti);
    
    // Emit confetti burst
    instance.addEmitter({
        position: { x: 50, y: 30 },
        rate: { delay: 0, quantity: 50 },
        life: { count: 1, duration: 0.1 }
    });

    // Clean up after animation
    setTimeout(() => {
        instance.destroy();
    }, 5000);
}

// ============================================
// GSAP ANIMATIONS
// ============================================
const GSAPAnimations = {
    init() {
        if (typeof gsap === 'undefined') {
            console.warn('GSAP not loaded');
            return;
        }

        // Register ScrollTrigger if available
        if (typeof ScrollTrigger !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger);
        }

        this.initScrollAnimations();
        this.initFloatingElements();
        this.initHoverAnimations();
    },

    initScrollAnimations() {
        if (typeof ScrollTrigger === 'undefined') return;

        // Fade in elements on scroll
        gsap.utils.toArray('.gsap-fade-in, .section-header, .event-card, .patron-card, .contact-card').forEach(elem => {
            gsap.fromTo(elem, 
                { opacity: 0, y: 50 },
                {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    ease: "power2.out",
                    scrollTrigger: {
                        trigger: elem,
                        start: "top 85%",
                        toggleActions: "play none none reverse"
                    }
                }
            );
        });

        // Scale in elements
        gsap.utils.toArray('.gsap-scale-in').forEach(elem => {
            gsap.fromTo(elem,
                { opacity: 0, scale: 0.8 },
                {
                    opacity: 1,
                    scale: 1,
                    duration: 0.6,
                    ease: "back.out(1.7)",
                    scrollTrigger: {
                        trigger: elem,
                        start: "top 85%"
                    }
                }
            );
        });

        // Slide in from left
        gsap.utils.toArray('.gsap-slide-left').forEach(elem => {
            gsap.fromTo(elem,
                { opacity: 0, x: -50 },
                {
                    opacity: 1,
                    x: 0,
                    duration: 0.8,
                    ease: "power2.out",
                    scrollTrigger: {
                        trigger: elem,
                        start: "top 85%"
                    }
                }
            );
        });

        // Slide in from right
        gsap.utils.toArray('.gsap-slide-right').forEach(elem => {
            gsap.fromTo(elem,
                { opacity: 0, x: 50 },
                {
                    opacity: 1,
                    x: 0,
                    duration: 0.8,
                    ease: "power2.out",
                    scrollTrigger: {
                        trigger: elem,
                        start: "top 85%"
                    }
                }
            );
        });

        // Stagger animation for lists
        gsap.utils.toArray('.events-container, .contact-cards, .footer-content').forEach(container => {
            const items = container.children;
            gsap.fromTo(items,
                { opacity: 0, y: 30 },
                {
                    opacity: 1,
                    y: 0,
                    duration: 0.5,
                    stagger: 0.1,
                    ease: "power2.out",
                    scrollTrigger: {
                        trigger: container,
                        start: "top 85%"
                    }
                }
            );
        });
    },

    initFloatingElements() {
        // Continuous floating animation for hero image
        gsap.to('.hero-image .notice-content', {
            y: -15,
            duration: 3,
            ease: "power1.inOut",
            yoyo: true,
            repeat: -1
        });

        // Floating animation for stat items
        gsap.utils.toArray('.stat-item').forEach((item, i) => {
            gsap.to(item, {
                y: -10,
                duration: 2 + (i * 0.3),
                ease: "power1.inOut",
                yoyo: true,
                repeat: -1,
                delay: i * 0.2
            });
        });

        // Pulse animation for buttons
        gsap.to('.primary-btn', {
            scale: 1.02,
            duration: 1.5,
            ease: "power1.inOut",
            yoyo: true,
            repeat: -1
        });
    },

    initHoverAnimations() {
        // Enhanced card hover
        document.querySelectorAll('.event-card, .patron-card, .contact-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                gsap.to(card, {
                    scale: 1.02,
                    boxShadow: '0 20px 40px rgba(0, 0, 0, 0.15)',
                    duration: 0.3,
                    ease: "power2.out"
                });
            });

            card.addEventListener('mouseleave', () => {
                gsap.to(card, {
                    scale: 1,
                    boxShadow: '0 2px 8px rgba(0, 0, 0, 0.06)',
                    duration: 0.3,
                    ease: "power2.out"
                });
            });
        });

        // Button ripple effect
        document.querySelectorAll('.primary-btn, .secondary-btn, .event-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const ripple = document.createElement('span');
                ripple.classList.add('ripple-effect');
                ripple.style.left = `${e.offsetX}px`;
                ripple.style.top = `${e.offsetY}px`;
                btn.appendChild(ripple);
                
                gsap.to(ripple, {
                    scale: 4,
                    opacity: 0,
                    duration: 0.6,
                    ease: "power2.out",
                    onComplete: () => ripple.remove()
                });
            });
        });
    },

    // Animate page entrance
    pageEntrance() {
        const tl = gsap.timeline();

        tl.fromTo('.sidebar', 
            { x: -100, opacity: 0 },
            { x: 0, opacity: 1, duration: 0.5, ease: "power2.out" }
        )
        .fromTo('.hero-content > *',
            { y: 50, opacity: 0 },
            { y: 0, opacity: 1, duration: 0.6, stagger: 0.1, ease: "power2.out" },
            "-=0.3"
        )
        .fromTo('.hero-image',
            { scale: 0.8, opacity: 0 },
            { scale: 1, opacity: 1, duration: 0.8, ease: "back.out(1.2)" },
            "-=0.4"
        );

        return tl;
    }
};

// ============================================
// LOTTIE ANIMATIONS
// ============================================
const LottieAnimations = {
    instances: [],

    init() {
        if (typeof lottie === 'undefined') {
            console.warn('Lottie not loaded');
            return;
        }

        this.loadAnimations();
    },

    loadAnimations() {
        // Find all lottie containers
        document.querySelectorAll('[data-lottie]').forEach(container => {
            const animationPath = container.dataset.lottie;
            const loop = container.dataset.loop !== 'false';
            const autoplay = container.dataset.autoplay !== 'false';

            const anim = lottie.loadAnimation({
                container: container,
                renderer: 'svg',
                loop: loop,
                autoplay: autoplay,
                path: animationPath
            });

            this.instances.push({ container, anim });
        });
    },

    // Play animation on scroll
    playOnScroll(containerId) {
        const instance = this.instances.find(i => i.container.id === containerId);
        if (!instance) return;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    instance.anim.play();
                } else {
                    instance.anim.pause();
                }
            });
        }, { threshold: 0.5 });

        observer.observe(instance.container);
    },

    // Get animation instance by container ID
    getInstance(containerId) {
        return this.instances.find(i => i.container.id === containerId)?.anim;
    }
};

// ============================================
// COLOR PALETTE DISPLAY
// ============================================
const ColorPalette = {
    colors: {
        primary: { name: 'Primary', value: '#e74c3c' },
        secondary: { name: 'Secondary', value: '#3498db' },
        accent: { name: 'Accent', value: '#27ae60' },
        warning: { name: 'Warning', value: '#f39c12' }
    },

    render(containerId) {
        const container = document.getElementById(containerId);
        if (!container) return;

        container.innerHTML = Object.entries(this.colors).map(([key, color]) => `
            <div class="palette-item">
                <div class="palette-color ${key}" style="background: ${color.value}" title="${color.name}: ${color.value}"></div>
                <span class="palette-label">${color.name}</span>
            </div>
        `).join('');
    }
};

// ============================================
// INITIALIZATION
// ============================================
document.addEventListener('DOMContentLoaded', () => {
    // Initialize Theme
    ThemeManager.init();

    // Initialize Particles
    initParticles('tsparticles', 'floating');

    // Initialize GSAP Animations
    GSAPAnimations.init();
    GSAPAnimations.pageEntrance();

    // Initialize Lottie
    LottieAnimations.init();

    // Render Color Palette in footer
    ColorPalette.render('color-palette');

    console.log('Trenz\'26 Animations Initialized');
});

// Export for external use
window.TrenzAnimations = {
    ThemeManager,
    ParticlesConfig,
    initParticles,
    triggerConfetti,
    GSAPAnimations,
    LottieAnimations,
    ColorPalette
};
