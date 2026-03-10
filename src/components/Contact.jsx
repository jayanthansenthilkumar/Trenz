function Contact() {
  return (
    <div className="contact-section" id="contact">
      <div className="section-header">
        <h2>Get In Touch</h2>
        <div className="section-divider"></div>
      </div>
      <div className="contact-cards">
        <div className="contact-card">
          <div className="card-icon"><i className="ri-map-pin-fill"></i></div>
          <h3>Location</h3>
          <p>MKCE KARUR</p>
        </div>
        <div className="contact-card">
          <div className="card-icon"><i className="ri-mail-fill"></i></div>
          <h3>Email</h3>
          <p><a href="mailto:trenz2k26@gmail.com">trenz2k26@gmail.com</a></p>
        </div>
        <div className="contact-card">
          <div className="card-icon"><i className="ri-phone-fill"></i></div>
          <h3>Contact</h3>
          <p><a href="tel:+916385650033">+91 6385650033</a></p>
        </div>
        <div className="contact-card">
          <div className="card-icon"><i className="ri-calendar-event-fill"></i></div>
          <h3>Event Days</h3>
          <p>April 30, 2026<br />9:00 AM - 6:00 PM</p>
        </div>
      </div>
    </div>
  )
}

export default Contact
