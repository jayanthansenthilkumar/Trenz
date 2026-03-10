import { useSearchParams, Link } from 'react-router-dom'
import eventsData from '../data/eventsData'

function EventPage() {
  const [searchParams] = useSearchParams()
  const eventId = searchParams.get('id')
  const event = eventsData[eventId]

  if (!event) {
    return (
      <div className="events-section" style={{ minHeight: '100vh', display: 'flex', flexDirection: 'column', justifyContent: 'center', alignItems: 'center' }}>
        <h2>Event Not Found</h2>
        <Link to="/" className="primary-btn" style={{ marginTop: '20px' }}>Back to Home</Link>
      </div>
    )
  }

  return (
    <div className="event-page-wrapper">
      <div className="events-section">
        <div className="section-header">
          <Link to="/" className="back-btn"><i className="ri-arrow-left-line"></i> Back to Home</Link>
          <h2>{event.headerTitle || 'Event Details'}</h2>
          <div className="section-divider"></div>
        </div>

        <div className="single-event-container">
          <img src={event.image} alt={event.title} className="event-banner" />

          <div className="event-info">
            <h1 className="event-title">{event.title}</h1>

            <div className="event-meta">
              {event.meta.map((m, i) => (
                <div className="meta-item" key={i}>
                  <i className={m.icon}></i>
                  <span>{m.text}</span>
                </div>
              ))}
            </div>

            <div className="event-rules" dangerouslySetInnerHTML={{ __html: event.rulesHTML }} />

            <div className="event-actions">
              <Link to="/register" className="register-btn">Register Now</Link>
            </div>
          </div>
        </div>
      </div>

      <footer className="event-footer">
        <p>&copy; 2026 Trenz'26. All rights reserved.</p>
        <div className="social-links">
          <a href="#"><i className="ri-instagram-line"></i></a>
          <a href="#"><i className="ri-facebook-circle-line"></i></a>
          <a href="#"><i className="ri-twitter-line"></i></a>
          <a href="#"><i className="ri-linkedin-box-line"></i></a>
        </div>
      </footer>
    </div>
  )
}

export default EventPage
