function About() {
  return (
    <div className="about-section" id="about">
      <div className="section-header">
        <h2>About Trenz'26</h2>
        <div className="section-divider"></div>
      </div>
      <div className="about-content">
        <div className="about-text">
          <h3>Connecting Minds, Creating Future</h3>
          <p>
            The Trenz'26 - An Intercollegiate Skill Fest is an annual gathering of thought leaders,
            researchers, and industry professionals dedicated to exploring cutting-edge innovations
            and emerging trends across disciplines.
          </p>
          <div className="about-info-container">
            <div className="about-objectives">
              <h4>Our Objectives</h4>
              <ul className="objective-list">
                <li><i className="ri-check-line"></i> Strengthen coding, debugging, and app development skills through hands-on challenges</li>
                <li><i className="ri-check-line"></i> Encourage innovative thinking in web design, application development, and startup ideation</li>
                <li><i className="ri-check-line"></i> Foster teamwork through interactive problem-solving and coding competitions</li>
                <li><i className="ri-check-line"></i> Inspire participants to develop original solutions and think entrepreneurially</li>
                <li><i className="ri-check-line"></i> Provide practical exposure, aligning academic knowledge with real-world applications</li>
              </ul>
            </div>
          </div>
        </div>
        <div className="about-image">
          <img src="/images/trenz.png" alt="Symposium Participants" />
          <div className="about-why-attend">
            <h4>Why You Should Attend</h4>
            <ul className="why-attend-list">
              <li><i className="ri-award-line"></i> Showcase your talent and make an impact</li>
              <li><i className="ri-gift-line"></i> Your skills could earn you real rewards</li>
              <li><i className="ri-team-line"></i> Meet innovators, creators, and future leaders</li>
              <li><i className="ri-file-list-3-line"></i> Build your professional portfolio</li>
              <li><i className="ri-briefcase-line"></i> Add real-world experience that recruiters value</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  )
}

export default About
