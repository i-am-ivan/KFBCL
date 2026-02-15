
// Smooth scrolling polyfill
if (!('scrollBehavior' in document.documentElement.style)) {
  import('smoothscroll-polyfill').then(module => {
    module.polyfill();
  });
}
document.addEventListener('DOMContentLoaded', function() {
  // Create sparkles
function createSparkles(element, count = 15) {
    for (let i = 0; i < count; i++) {
      const sparkle = document.createElement('div');
      sparkle.className = 'sparkle';
      
      // Random size between 3-8px
      const size = Math.random() * 5 + 3;
      sparkle.style.width = `${size}px`;
      sparkle.style.height = `${size}px`;
      
      // Random position around the element
      const rect = element.getBoundingClientRect();
      const x = rect.left + (Math.random() * rect.width);
      const y = rect.top + (Math.random() * rect.height);
      
      sparkle.style.left = `${x}px`;
      sparkle.style.top = `${y}px`;
      
      // Random animation delay
      sparkle.style.animationDelay = `${Math.random() * 0.5}s`;
      
      document.body.appendChild(sparkle);
      
      // Remove after animation completes
      setTimeout(() => {
        sparkle.remove();
      }, 1000);
    }
  }
  // Enhanced animate stats with counting effect
  function animateStats() {
    const statNumbers = document.querySelectorAll('.stat-number');
    statNumbers.forEach((stat, index) => {
      const originalText = stat.textContent;
      const hasPlus = originalText.includes('+');
      const hasPercent = originalText.includes('%');
      const target = parseInt(originalText);
      
      stat.textContent = '0' + (hasPlus ? '+' : '') + (hasPercent ? '%' : '');
      stat.style.opacity = 1;
      
      // Different animation durations based on the value
      const duration = target < 100 ? 2000 : 3000; // Faster for smaller numbers
      const startTime = Date.now();
      
      const animateCount = () => {
        const elapsed = Date.now() - startTime;
        const progress = Math.min(elapsed / duration, 1);
        const easeProgress = progress < 0.5 
          ? 2 * progress * progress 
          : 1 - Math.pow(-2 * progress + 2, 2) / 2; // Ease in-out
        
        let currentValue;
        
        if (hasPercent) {
          // For percentages, animate from 0 to target with decimal precision
          currentValue = Math.floor(easeProgress * target);
          stat.textContent = currentValue + '%';
        } else {
          currentValue = Math.floor(easeProgress * target);
          stat.textContent = currentValue + (hasPlus ? '+' : '');
        }
        
        if (progress < 1) {
          requestAnimationFrame(animateCount);
        } else {
          // Final value and sparkles
          stat.textContent = originalText;
          createSparkles(stat.parentElement);
        }
      };
      
      // Staggered start
      setTimeout(() => {
        requestAnimationFrame(animateCount);
      }, index * 300);
    });
  }
// Start stats animation
  animateStats();
  
  // Improved smooth scrolling with offset and easing
const easeInOutQuad = (t) => t<.5 ? 2*t*t : -1+(4-2*t)*t;
  
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      const targetId = this.getAttribute('href');
      if (targetId === '#') return;
      
      const targetElement = document.querySelector(targetId);
      if (targetElement) {
        const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - 80;
        const startPosition = window.pageYOffset;
        const distance = targetPosition - startPosition;
        const duration = Math.min(Math.abs(distance) * 0.8, 1200);
        let startTime = null;

        const animation = (currentTime) => {
          if (startTime === null) startTime = currentTime;
          const timeElapsed = currentTime - startTime;
          const run = easeInOutQuad(Math.min(timeElapsed / duration, 1));
          window.scrollTo(0, startPosition + distance * run);
          if (timeElapsed < duration) requestAnimationFrame(animation);
        };

        requestAnimationFrame(animation);
      }
    });
  });
  // Navbar scroll effect
  const navbar = document.querySelector('custom-navbar');
  window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
  });
  // Improved active section highlighting using Intersection Observer
  const updateActiveNav = () => {
    const navLinks = document.querySelectorAll('custom-navbar a.nav-link');
    const mobileNavLinks = document.querySelectorAll('custom-navbar a.mobile-nav-link');
    const sections = document.querySelectorAll('section[id]');
    const navHeight = document.querySelector('custom-navbar').offsetHeight || 80;
    const scrollPosition = window.scrollY + navHeight + 1; // Slightly below navbar
    
    let currentSection = null;
    let smallestDistance = Infinity;

    sections.forEach(section => {
      const sectionTop = section.offsetTop - navHeight;
      const sectionBottom = sectionTop + section.offsetHeight;
      
      // Check if current scroll position is within this section
      if (scrollPosition >= sectionTop && scrollPosition <= sectionBottom) {
        // Find the closest section to the top of the viewport
        const distanceToTop = Math.abs(scrollPosition - sectionTop);
        if (distanceToTop < smallestDistance) {
          smallestDistance = distanceToTop;
          currentSection = section;
        }
      }
    });

    navLinks.forEach(link => {
      link.classList.remove('active');
      const linkHref = link.getAttribute('href');
      
      if (currentSection && linkHref === `#${currentSection.id}`) {
        link.classList.add('active');
      } else if (scrollPosition < 100 && (linkHref === '/' || linkHref === '#home')) {
        // Only default to home if near top of page
        link.classList.add('active');
      }
    });

    mobileNavLinks.forEach(link => {
      link.classList.remove('active');
      const linkHref = link.getAttribute('href');
      
      if (currentSection && linkHref === `#${currentSection.id}`) {
        link.classList.add('active');
      } else if (scrollPosition < 100 && (linkHref === '/' || linkHref === '#home')) {
        link.classList.add('active');
      }
    });
  };
// Optimized scroll handler with requestAnimationFrame
  let isTicking = false;
  const handleScroll = () => {
    if (!isTicking) {
      window.requestAnimationFrame(() => {
        updateActiveNav();
        isTicking = false;
      });
      isTicking = true;
    }
  };

  window.addEventListener('scroll', handleScroll);
  updateActiveNav(); // Initialize on load
// Animate elements when they come into view
  const animateOnScroll = () => {
const elements = document.querySelectorAll('.animate-fade-in');
    elements.forEach(el => {
      const elementPosition = el.getBoundingClientRect().top;
      const screenPosition = window.innerHeight / 1.3;
      
      if (elementPosition < screenPosition) {
        el.style.opacity = '1';
        el.style.transform = 'translateY(0)';
      }
    });
  };

  // Initial check
  animateOnScroll();
  // Check on scroll
  window.addEventListener('scroll', animateOnScroll);
  // Testimonial Slider with Auto-scroll
  const testimonialSlider = () => {
    const slider = document.querySelector('.testimonial-slider');
    if (!slider) return;

    const track = slider.querySelector('.testimonial-track');
    const slides = Array.from(slider.querySelectorAll('.testimonial-slide'));
    const prevBtn = slider.querySelector('.slider-prev');
    const nextBtn = slider.querySelector('.slider-next');
    
    let currentIndex = 0;
    const slideCount = slides.length;
    let autoSlideInterval;
    const slideDuration = 5000; // 5 seconds per slide
    const visibleSlides = () => {
      // Always show 1 slide at a time
      return 1;
    };
const updateSlider = () => {
      const slideWidth = slides[0].offsetWidth + 32; // 32px for gap
      const maxIndex = slideCount - visibleSlides();
      
      if (currentIndex > maxIndex) currentIndex = 0;
      if (currentIndex < 0) currentIndex = maxIndex;

      track.style.transition = 'transform 0.5s ease-in-out';
      track.style.transform = `translateX(-${currentIndex * slideWidth}px)`;
      
      // Disable buttons at ends
      prevBtn.disabled = currentIndex === 0;
      nextBtn.disabled = currentIndex >= maxIndex;
    };

    const startAutoSlide = () => {
      autoSlideInterval = setInterval(() => {
        currentIndex++;
        updateSlider();
      }, slideDuration);
    };

    const resetAutoSlide = () => {
      clearInterval(autoSlideInterval);
      startAutoSlide();
    };

    prevBtn.addEventListener('click', () => {
      currentIndex--;
      updateSlider();
      resetAutoSlide();
    });

    nextBtn.addEventListener('click', () => {
      currentIndex++;
      updateSlider();
      resetAutoSlide();
    });

    // Pause auto-slide on hover
    slider.addEventListener('mouseenter', () => {
      clearInterval(autoSlideInterval);
    });

    slider.addEventListener('mouseleave', startAutoSlide);

    // Handle window resize
    window.addEventListener('resize', () => {
      updateSlider();
      resetAutoSlide();
    });
    
    // Initialize
    updateSlider();
    startAutoSlide();
  };

  testimonialSlider();
// Form validation
const contactForm = document.getElementById('contactForm');
  if (contactForm) {
    const validateField = (field, errorId, errorMessage) => {
            const errorElement = document.getElementById(errorId);
            if (!field.validity.valid) {
              // Customize messages based on field type
              let customMessage = '';
              if (field.id === 'name') {
                customMessage = 'Please enter your full name (minimum 3 characters)';
              } else if (field.id === 'email') {
                customMessage = 'Please enter a valid email address (e.g., user@example.com)';
              } else if (field.id === 'subject') {
                customMessage = 'Please enter a subject (minimum 5 characters)';
              } else if (field.id === 'message') {
                customMessage = 'Please enter your message (minimum 10 characters)';
              } else {
                customMessage = errorMessage;
              }
              errorElement.textContent = customMessage;
errorElement.classList.remove('hidden');
        field.classList.add('border-red-300');
        return false;
      } else {
        errorElement.classList.add('hidden');
        field.classList.remove('border-red-300');
        return true;
      }
    };

    const fields = [
      { id: 'name', errorId: 'name-error', errorMessage: 'Please enter a valid name' },
      { id: 'email', errorId: 'email-error', errorMessage: 'Please enter a valid email' },
      { id: 'subject', errorId: 'subject-error', errorMessage: 'Please enter a valid subject' },
      { id: 'message', errorId: 'message-error', errorMessage: 'Please enter a valid message' }
    ];

    fields.forEach(({id, errorId}) => {
      const field = document.getElementById(id);
      if (field) {
        field.addEventListener('input', () => {
          validateField(field, errorId, '');
        });
        field.addEventListener('blur', () => {
          validateField(field, errorId, '');
        });
      }
    });

    contactForm.addEventListener('submit', (e) => {
      e.preventDefault();
      
      let isValid = true;
      fields.forEach(({id, errorId, errorMessage}) => {
        const field = document.getElementById(id);
        if (field) {
          if (!validateField(field, errorId, errorMessage)) {
            isValid = false;
          }
        }
      });

      if (isValid) {
        // Form is valid, submit it
        // Show success message in a more elegant way
        const successMessage = document.createElement('div');
        successMessage.className = 'bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4';
        successMessage.setAttribute('role', 'alert');
        successMessage.innerHTML = `
          <strong class="font-bold">Success!</strong>
          <span class="block sm:inline">Your message has been sent. We'll get back to you soon.</span>
        `;
        contactForm.prepend(successMessage);
        
        // Remove message after 5 seconds
        setTimeout(() => {
          successMessage.remove();
        }, 5000);
contactForm.reset();
      }
    });
  }
});

// Intersection Observer for smooth section transitions
const observerOptions = {
  root: null,
  rootMargin: '0px',
  threshold: 0.1
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('animate-fade-in');
    }
  });
}, observerOptions);

document.querySelectorAll('section').forEach(section => {
  observer.observe(section);
});

// Enhanced pricing cards interaction
function initPricingCards() {
  const cardsContainer = document.querySelector('.pricing-cards-container');
  const cards = document.querySelectorAll('.pricing-card');

  if (!cardsContainer || cards.length === 0) return;

  // Only enable on desktop
  if (window.innerWidth >= 1024) {
    cards.forEach(card => {
      card.addEventListener('mouseenter', () => {
        // Add active class to hovered card
        card.classList.add('card-active');

        // Add subtle glow effect
        const rect = card.getBoundingClientRect();
        const glow = document.createElement('div');
        glow.className = 'card-glow-effect';
        glow.style.cssText = `
          position: absolute;
          top: ${rect.top}px;
          left: ${rect.left}px;
          width: ${rect.width}px;
          height: ${rect.height}px;
          background: radial-gradient(circle at center, rgba(0,122,204,0.1) 0%, transparent 70%);
          pointer-events: none;
          z-index: 5;
          border-radius: 1rem;
        `;
        document.body.appendChild(glow);

        // Remove glow after animation
        setTimeout(() => {
          if (glow.parentNode) {
            glow.remove();
          }
        }, 500);
      });

      card.addEventListener('mouseleave', () => {
        card.classList.remove('card-active');
      });
    });

    // Add keyboard navigation
    cards.forEach((card, index) => {
      card.setAttribute('tabindex', '0');
      card.addEventListener('focus', () => {
        card.classList.add('card-active');
      });

      card.addEventListener('blur', () => {
        card.classList.remove('card-active');
      });

      card.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          const button = card.querySelector('button');
          if (button) button.click();
        }
      });
    });
  }
}

// Call this in your DOMContentLoaded event
document.addEventListener('DOMContentLoaded', function() {
  // ... existing code ...

  initPricingCards();

  // Handle window resize
  window.addEventListener('resize', initPricingCards);
});