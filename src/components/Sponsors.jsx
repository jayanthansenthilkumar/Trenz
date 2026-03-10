function Sponsors() {
  return (
    <div className="sponsors-section" id="sponsors">
      <div className="section-header">
        <h2>Our Sponsors</h2>
        <div className="section-divider"></div>
      </div>
      <div className="sponsors-container">
        <div className="sponsor-tier silver">
          <h3 className="tier-title">Principal Sponsor</h3>
          <div className="sponsor-logos">
            <div className="sponsor-item">
              <img src="/images/trivasiya.png" alt="Principal Sponsor" />
            </div>
          </div>
        </div>
        <div className="sponsor-tier gold">
          <h3 className="tier-title">Gold Sponsors</h3>
          <div className="sponsor-logos">
            <div className="sponsor-item">
              <img src="/images/6sport.png" alt="Gold Sponsor 1" />
            </div>
            <div className="sponsor-item">
              <img src="/images/trimp.png" alt="Gold Sponsor 2" />
            </div>
          </div>
        </div>
      </div>
    </div>
  )
}

export default Sponsors
