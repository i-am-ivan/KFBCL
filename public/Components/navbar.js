class CustomNavbar extends HTMLElement {
  connectedCallback() {
    this.attachShadow({ mode: 'open' });
    this.shadowRoot.innerHTML = `
      <style>
        :host {
          display: block;
          position: fixed;
          top: 0;
          left: 0;
          right: 0;
          z-index: 1000;
          background-color: transparent;
          transition: all 0.3s ease;
        }
        :host(.scrolled) {
          background-color: white;
          box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}
        .navbar-container {
          max-width: 1200px;
          margin: 0 auto;
          padding: 1rem;
          display: flex;
          justify-content: space-between;
          align-items: center;
        }
        .logo {
          font-size: 1.5rem;
          font-weight: bold;
          color: white;
          text-decoration: none;
        }
        :host(.scrolled) .logo {
          color: #007acc;
}
        .nav-links {
          display: flex;
          gap: 2rem;
        }
        .nav-link {
          color: white;
          text-decoration: none;
          font-weight: 600;
          padding: 0.5rem 0;
          position: relative;
          transition: all 0.3s ease;
          text-transform: uppercase;
          font-size: 0.85rem;
          letter-spacing: 0.05em;
        }
                /* Join Us - Desktop Outline Button */
        .join-btn {
          border: 2px solid rgba(255, 255, 255, 0.3) !important;
          padding: 0.5rem 1.75rem !important;
          border-radius: 9999px !important;
          background: transparent;
          transition: all 0.3s ease;
          margin-left: 1rem;
          color: white !important;
          font-weight: 600;
          text-transform: uppercase;
          font-size: 0.85rem;
          letter-spacing: 0.05em;
        }
        :host(.scrolled) .join-btn {
          border-color: rgba(0, 0, 0, 0.2) !important;
          color: #434343 !important;
        }
        .join-btn:hover {
          background-color: #007acc;
          color: white !important;
          border-color: #007acc !important;
          transform: translateY(-1px);
        }
        /* Remove underline indicator from Join Us button (it's not needed on a button) */
        .join-btn::after,
        .join-btn:hover::after {
          display: none;
        }
        :host(.scrolled) .join-btn:hover {
          background-color: #007acc;
          color: white !important;
          border-color: #007acc !important;
        }
        /* Join Us - Mobile Version */
        .join-btn-mobile {
          display: block;
          width: 80%;
          max-width: 300px;
          margin: 2rem auto 0;
          border: 2px solid #007acc;
          padding: 0.75rem 2rem;
          border-radius: 9999px;
          background: transparent;
          color: #007acc;
          font-weight: 600;
          font-size: 1rem;
          text-transform: uppercase;
          text-align: center;
          transition: all 0.3s ease;
          text-decoration: none !important;
        }
        .join-btn-mobile:hover {
          background-color: #007acc;
          color: white;
        }
        :host(.scrolled) .nav-link {
          color: #333;
        }
        .nav-link:hover {
          color: #007acc;
        }
        .nav-link.active {
          color: #007acc;
          font-weight: 700;
          position: relative;
        }
        .nav-link.active::after {
          content: '';
          position: absolute;
          bottom: 0;
          left: 50%;
          transform: translateX(-50%);
          width: 80%;
          height: 3px;
          background-color: #007acc;
          border-radius: 6px;
          transition: all 0.3s ease;
        }
        .nav-link:not(.active)::after {
          content: '';
          position: absolute;
          bottom: 0;
          left: 50%;
          transform: translateX(-50%);
          width: 0;
          height: 3px;
          background-color: #007acc;
          border-radius: 3px;
          transition: all 0.3s ease;
        }
        .nav-link:hover::after {
          width: 80%;
        }
.mobile-menu-btn {
          display: none;
          background: none;
          border: none;
          cursor: pointer;
          z-index: 1001;
        }
        .mobile-menu {
          display: none;
          background-color: white;
          padding: 1rem;
          position: fixed;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          height: 100vh;
          width: 100vw;
          box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
          z-index: 1000;
          flex-direction: column;
          justify-content: center;
          align-items: center;
        }
        .mobile-menu.open {
          display: flex;
          animation: fadeIn 0.3s ease-out;
        }
        @keyframes fadeIn {
          from { opacity: 0; }
          to { opacity: 1; }
        }
        .mobile-nav-link {
          display: block;
          padding: 1rem 0;
          color: #333; /* Changed from white to #333 */
          text-decoration: none;
          font-size: 1.2rem; /* Slightly smaller */
          font-weight: 500;
          text-align: center;
          transition: color 0.3s;
          text-transform: uppercase;
        }
        .mobile-menu .mobile-nav-link {
          color: #333;
        }
        .mobile-nav-link:hover {
          color: #007acc;
}
        .mobile-menu-btn.active {
          position: fixed;
          right: 1rem;
        }
@media (max-width: 768px) {
          .nav-links {
            display: none;
          }
          .mobile-menu-btn {
            display: block;
          }
        }
      </style>
      <div class="navbar-container">
          <a href="index.html" class="logo">KFBCL</a>
        <div class="nav-links">
          <a href="#" class="nav-link active">HOME</a>
          <a href="#services" class="nav-link">SERVICES</a>
          <a href="#about" class="nav-link">ABOUT</a>
          <a href="#apply" class="nav-link">CONTACT</a>
          <a href="#services" class="nav-link join-btn rounded-full">Join Us</a>
        </div>
        <button class="mobile-menu-btn" aria-label="Toggle menu">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
          </svg>
        </button>
        <div class="mobile-menu">
          <a href="#" class="mobile-nav-link">HOME</a>
          <a href="#services" class="mobile-nav-link">SERVICES</a>
          <a href="#about" class="mobile-nav-link">ABOUT</a>
          <a href="#apply" class="mobile-nav-link">CONTACT</a>
          <a href="#services" class="join-btn-mobile rounded-full">Join Us</a>
        </div>
      </div>
    `;
    
    // Mobile menu toggle
    const mobileMenuBtn = this.shadowRoot.querySelector('.mobile-menu-btn');
    const mobileMenu = this.shadowRoot.querySelector('.mobile-menu');
    
    mobileMenuBtn.addEventListener('click', () => {
      document.body.classList.toggle('overflow-hidden');
      mobileMenu.classList.toggle('open');
      mobileMenuBtn.classList.toggle('active');
      
      const icon = mobileMenuBtn.querySelector('i');
      if (mobileMenu.classList.contains('open')) {
        icon.innerHTML = `
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        `;
      } else {
        icon.innerHTML = `
          <line x1="3" y1="12" x2="21" y2="12"></line>
          <line x1="3" y1="6" x2="21" y2="6"></line>
          <line x1="3" y1="18" x2="21" y2="18"></line>
        `;
      }
});

    // Close menu when clicking on links
    this.shadowRoot.querySelectorAll('.mobile-nav-link').forEach(link => {
      link.addEventListener('click', () => {
        mobileMenu.classList.remove('open');
        mobileMenuBtn.classList.remove('active');
        document.body.classList.remove('overflow-hidden');
        const icon = mobileMenuBtn.querySelector('i');
        icon.innerHTML = `
          <line x1="3" y1="12" x2="21" y2="12"></line>
          <line x1="3" y1="6" x2="21" y2="6"></line>
          <line x1="3" y1="18" x2="21" y2="18"></line>
        `;
});
    });
}
}

customElements.define('custom-navbar', CustomNavbar);