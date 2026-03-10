import { useEffect, useState } from 'react'

const sections = ['home', 'about', 'patrons', 'events', 'sponsors', 'contact']

const navItems = [
  { id: 'home', icon: 'ri-home-5-fill', label: 'Home' },
  { id: 'about', icon: 'ri-information-line', label: 'About' },
  { id: 'patrons', icon: 'ri-shield-star-line', label: 'Leaders' },
  { id: 'events', icon: 'ri-calendar-event-line', label: 'Events' },
  { id: 'sponsors', icon: 'ri-group-line', label: 'Sponsors' },
  { id: 'contact', icon: 'ri-contacts-line', label: 'Contact' },
]

function Sidebar() {
  const [active, setActive] = useState('home')

  useEffect(() => {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            setActive(entry.target.id)
          }
        })
      },
      { rootMargin: '0px 0px -30% 0px', threshold: 0.1 }
    )

    sections.forEach((id) => {
      const el = document.getElementById(id)
      if (el) observer.observe(el)
    })

    return () => observer.disconnect()
  }, [])

  const scrollTo = (id) => {
    const el = document.getElementById(id)
    if (el) el.scrollIntoView({ behavior: 'smooth' })
  }

  return (
    <div className="sidebar">
      <ul className="nav-links">
        {navItems.map((item) => (
          <li key={item.id} className={active === item.id ? 'active' : ''}>
            <a href={`#${item.id}`} onClick={(e) => { e.preventDefault(); scrollTo(item.id) }}>
              <i className={`${item.icon} icon`}></i>
              <span className="link-name">{item.label}</span>
            </a>
          </li>
        ))}
      </ul>
    </div>
  )
}

export default Sidebar
