import { Link } from 'react-router-dom'

function Hero() {
  return (
    <div className="hero-section" id="home">
      <div className="hero-content">
        <h1>Welcome to <span className="highlight">Trenz'26</span></h1>
        <p>Discover the latest trends and connect with people around the world</p>
        <div className="hero-cta">
          <a href="#events" className="primary-btn" onClick={(e) => { e.preventDefault(); document.getElementById('events')?.scrollIntoView({ behavior: 'smooth' }) }}>
            Get Started <i className="ri-arrow-right-line"></i>
          </a>
          <Link to="/register" className="secondary-btn">Register Now</Link>
        </div>
      </div>
      <div className="hero-image">
        <div className="pin"></div>
        <div className="notice-content">
          <img src="/images/trenz.jpg" alt="Trenz'26 Hero Image" />
        </div>
      </div>
    </div>
  )
}

export default Hero
