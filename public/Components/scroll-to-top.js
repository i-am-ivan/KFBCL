class ScrollToTop extends HTMLElement {
  connectedCallback() {
    this.attachShadow({ mode: 'open' });
    this.shadowRoot.innerHTML = `
      <style>
        :host {
          position: fixed;
          bottom: 2rem;
          right: 2rem;
          z-index: 999;
        }
        .scroll-btn {
          width: 40px;
          height: 40px;
          background-color: rgba(0, 122, 204, 0.85);
          color: white;
          border-radius: 8px;
          display: flex;
          align-items: center;
          justify-content: center;
          cursor: pointer;
          border: none;
          outline: none;
          box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
          transition: all 0.3s ease;
          opacity: 0;
          transform: translateY(20px);
          position: relative;
          overflow: hidden;
        }
        .scroll-btn.visible {
          opacity: 1;
          transform: translateY(0);
        }
        .scroll-btn:hover {
          background-color: rgba(0, 122, 204, 1);
          box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        i {
          width: 20px;
          height: 20px;
          stroke-width: 3px;
        }
        .scroll-btn::after {
          content: '';
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          width: 0;
          height: 0;
          border-left: 5px solid transparent;
          border-right: 5px solid transparent;
          border-bottom: 8px solid white;
        }
</style>
      <button class="scroll-btn" aria-label="Scroll to top">
        <i data-feather="chevron-up"></i>
      </button>
`;

    const btn = this.shadowRoot.querySelector('.scroll-btn');
    
    // Show button when scrolling down
    window.addEventListener('scroll', () => {
      if (window.pageYOffset > 300) {
        btn.classList.add('visible');
      } else {
        btn.classList.remove('visible');
      }
    });

    // Scroll to top on click
    btn.addEventListener('click', () => {
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
    });

    // Initialize feather icons
    setTimeout(() => {
      if (window.feather) {
        window.feather.replace();
      }
    }, 100);
  }
}

customElements.define('scroll-to-top', ScrollToTop);