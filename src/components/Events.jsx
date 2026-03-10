import { Link } from 'react-router-dom'

const eventsList = [
  { id: 'webdesign', name: 'Web Weave', desc: 'Showcase your web development skills by creating responsive and innovative website designs.', image: '/images/webdesign.jpg', type: 'technical' },
  { id: 'startup', name: 'NextGen Start', desc: 'Present your innovative startup ideas and business models to a panel of industry experts.', image: '/images/startup.jpg', type: 'non-technical' },
  { id: 'appdev', name: 'App A thon', desc: 'Design and develop mobile applications that solve real-world problems using cutting-edge technologies.', image: '/images/appdev.avif', type: 'technical' },
  { id: 'debugging', name: 'Error : 404 NOT FOUND', desc: 'Test your debugging skills by finding and fixing errors in complex code snippets under time pressure.', image: '/images/coding.png', type: 'non-technical' },
  { id: 'coderewind', name: 'Code Rewind', desc: 'Compete in our flagship coding competition featuring challenging algorithmic problems and real-world scenarios.', image: '/images/reverse.webp', type: 'technical' },
  { id: 'codequest', name: 'Code Quest', desc: 'A multi-round coding treasure hunt that tests problem-solving and technical skills.', image: '/images/codehunt.png', type: 'non-technical' },
  { id: 'resumebuilding', name: 'Build a Resume', desc: 'Create a professional resume showcasing your skills effectively.', image: '/images/resume.png', type: 'non-technical' },
]

function Events() {
  return (
    <div className="events-section" id="events">
      <div className="section-header">
        <h2>Trenz'26 Events</h2>
        <div className="section-divider"></div>
      </div>
      <div className="events-container">
        {eventsList.map((evt) => (
          <div className={`event-card ${evt.type}`} key={evt.id}>
            <img src={evt.image} alt={evt.name} className="event-card-image" />
            <div className="event-content">
              <div className="event-details">
                <h3>{evt.name}</h3>
                <p className="event-description">{evt.desc}</p>
                <Link to={`/event?id=${evt.id}`} className="event-btn">
                  View Event <i className="ri-arrow-right-line"></i>
                </Link>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  )
}

export default Events
