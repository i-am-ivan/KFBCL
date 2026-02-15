class CustomFooter extends HTMLElement {
  connectedCallback() {
    this.attachShadow({ mode: 'open' });
    this.shadowRoot.innerHTML = `
      <style>
        :host {
          display: block;
          background-color: #1a1a1a;
          color: white;
          padding: 3rem 0;
        }
        .footer-container {
          max-width: 1200px;
          margin: 0 auto;
          padding: 0 1rem;
          display: grid;
          grid-template-columns: repeat(1, 1fr);
          gap: 2rem;
        }
        .footer-logo {
          font-size: 1.5rem;
          font-weight: bold;
          color: white;
          margin-bottom: 1rem;
        }
        .footer-about {
          margin-bottom: 1.5rem;
          color: #aaa;
          line-height: 1.6;
        }
        .footer-links {
          display: grid;
          grid-template-columns: repeat(2, 1fr);
          gap: 2rem;
        }
        .footer-link-section h3 {
          font-size: 1.1rem;
          margin-bottom: 1rem;
          color: white;
        }
        .footer-link {
          display: block;
          color: #aaa;
          margin-bottom: 0.75rem;
          text-decoration: none;
          transition: color 0.3s;
        }
        .footer-link:hover {
          color: #007acc;
        }
        .social-links {
          display: flex;
          gap: 1rem;
          margin-top: 1.5rem;
        }
        .social-link {
          color: white;
          background-color: #333;
          width: 40px;
          height: 40px;
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          transition: background-color 0.3s;
        }
        .social-link:hover {
          background-color: #007acc;
        }
        .footer-bottom {
          margin-top: 3rem;
          text-align: center;
          color: #666;
          font-size: 0.9rem;
          border-top: 1px solid #333;
          padding-top: 1.5rem;
        }
        @media (min-width: 768px) {
          .footer-container {
            grid-template-columns: 2fr 1fr 1fr;
          }
          .footer-links {
            grid-template-columns: repeat(2, 1fr);
          }
        }
      </style>
      <div class="footer-container">
        <div class="footer-about-section">
          <div class="footer-logo">LoanLift</div>
          <p class="footer-about">
            Empowering entrepreneurs and families with financial access and opportunity for over 14 years.
          </p>
          <div class="social-links">
            <a href="#" class="social-link">
              <i data-feather="facebook"></i>
            </a>
            <a href="#" class="social-link">
              <i data-feather="twitter"></i>
            </a>
            <a href="#" class="social-link">
              <i data-feather="instagram"></i>
            </a>
            <a href="#" class="social-link">
              <i data-feather="linkedin"></i>
            </a>
          </div>
        </div>
        <div class="footer-links">
          <div class="footer-link-section">
            <h3>Services</h3>
            <a href="#" class="footer-link">Bodaboda Groups</a>
            <a href="#" class="footer-link">Land Ownership</a>
            <a href="#" class="footer-link">Business Loans</a>
            <a href="#" class="footer-link">Saving Plans</a>
          </div>
          <div class="footer-link-section">
            <h3>Company</h3>
            <a href="#about" class="footer-link">About Us</a>
            <a href="#" class="footer-link">Our Team</a>
            <a href="#" class="footer-link">Careers</a>
            <a href="#apply" class="footer-link">Contact</a>
          </div>
        </div>
        <div class="footer-link-section">
          <h3>Contact Us</h3>
          <div class="footer-contact-info">
            <p><i data-feather="map-pin"></i> 237 BAT, Makongeni Thika, Kiambu County</p>
            <p><i data-feather="phone"></i> +254745 678901</p>
            <p><i data-feather="mail"></i> info@loanlift.org</p>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        &copy; ${new Date().getFullYear()} LoanLift. All rights reserved. Powered By
      </div>
    `;
  }
}

customElements.define('custom-footer', CustomFooter);