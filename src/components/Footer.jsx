import { Link } from 'react-router-dom'

function Footer() {
  return (
    <div className="footer-section">
      <div className="footer-content">
        <div className="footer-column">
          <h3>About Trenz'26</h3>
          <p>A national level technical symposium bringing together innovative minds from across the country.</p>
          <div className="footer-social">
            <a href="#"><i className="ri-facebook-fill"></i></a>
            <a href="#"><i className="ri-twitter-fill"></i></a>
            <a href="#"><i className="ri-instagram-line"></i></a>
            <a href="#"><i className="ri-linkedin-fill"></i></a>
          </div>
        </div>
        <div className="footer-column">
          <h3>Quick Links</h3>
          <ul className="footer-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#events">Events</a></li>
            <li><a href="#sponsors">Sponsors</a></li>
            <li><Link to="/register">Register</Link></li>
          </ul>
        </div>
        <div className="footer-column">
          <h3>Contact Us</h3>
          <ul className="footer-contact">
            <li><i className="ri-map-pin-line"></i> MKCE KARUR</li>
            <li><i className="ri-mail-line"></i> trenz2k26@gmail.com</li>
            <li><i className="ri-phone-line"></i> +91 63856 50033</li>
          </ul>
        </div>
        <div className="footer-column">
          <h3>Subscribe</h3>
          <p>Stay updated with our newsletter</p>
          <form className="footer-subscribe" onSubmit={(e) => e.preventDefault()}>
            <input type="email" placeholder="Enter your email" />
            <button type="submit"><i className="ri-send-plane-fill"></i></button>
          </form>
        </div>
      </div>
      <div className="footer-bottom">
        <div className="copyright">
          <p>&copy; 2026 Trenz'26. All Rights Reserved.</p>
        </div>
        <div className="footer-bottom-links">
          <a href="#">Privacy Policy</a>
          <a href="#">Terms of Service</a>
        </div>
      </div>
    </div>
  )
}

export default Footer
