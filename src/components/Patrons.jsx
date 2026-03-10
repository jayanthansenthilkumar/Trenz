import { useRef } from 'react'

const organizers = [
  { name: 'Abbishek krishna T K', title: 'Organizer', image: '/images/abbi.jpg', phone: '+916385650033', whatsapp: '916385650033' },
  { name: 'Deepak Rajan K', title: 'Organizer', image: '/images/deepak.jpg', phone: '+919791852116', whatsapp: '919487274363' },
  { name: 'Manikandan Prabhu C', title: 'Organizer', image: '/images/mani.jpg', phone: '+917540006268', whatsapp: '917540006268' },
  { name: 'Srivarth G P', title: 'Organizer', image: '/images/srivath.jpg', phone: '+918438796113', whatsapp: '918438796113' },
  { name: 'Surya S M', title: 'Organizer', image: '/images/surya.jpg', phone: '+917708794789', whatsapp: '917708794789' },
  { name: 'Ajay B N', title: 'Organizer', image: '/images/ajay.jpg', phone: '+917810024407', whatsapp: '917810024407' },
  { name: 'Nishanth Amuthan V', title: 'Organizer', image: '/images/nishanth.jpg', phone: '+919342623353', whatsapp: '919342623353' },
  { name: 'Bharathi Dharshan S', title: 'Organizer', image: '/images/bharathi.jpg', phone: '+919363873188', whatsapp: '919363873188' },
]

function Patrons() {
  const containerRef = useRef(null)

  const scroll = (dir) => {
    if (containerRef.current) {
      containerRef.current.scrollBy({ left: dir * 380, behavior: 'smooth' })
    }
  }

  return (
    <div className="patrons-section" id="patrons">
      <div className="section-header">
        <h2>Meet our Organizers</h2>
        <div className="section-divider"></div>
      </div>
      <div className="patrons-scroll-container">
        <button className="scroll-btn prev-btn" onClick={() => scroll(-1)}>
          <i className="ri-arrow-left-s-line"></i>
        </button>
        <div className="patrons-container" ref={containerRef}>
          {organizers.map((org, i) => (
            <div className="patron-card" key={i}>
              <div className="patron-image">
                <img src={org.image} alt={org.name} />
              </div>
              <div className="patron-details">
                <h3>{org.name}</h3>
                <p className="patron-title">{org.title}</p>
                <div className="patron-contact">
                  <a href={`tel:${org.phone}`} className="contact-link phone">
                    <i className="ri-phone-line"></i> Call
                  </a>
                  <a href={`https://wa.me/${org.whatsapp}`} className="contact-link whatsapp" target="_blank" rel="noopener noreferrer">
                    <i className="ri-whatsapp-line"></i> WhatsApp
                  </a>
                </div>
              </div>
            </div>
          ))}
        </div>
        <button className="scroll-btn next-btn" onClick={() => scroll(1)}>
          <i className="ri-arrow-right-s-line"></i>
        </button>
      </div>
    </div>
  )
}

export default Patrons
