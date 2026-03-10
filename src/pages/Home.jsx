import Sidebar from '../components/Sidebar'
import Hero from '../components/Hero'
import About from '../components/About'
import Patrons from '../components/Patrons'
import Events from '../components/Events'
import Sponsors from '../components/Sponsors'
import Contact from '../components/Contact'
import Footer from '../components/Footer'

function Home() {
  return (
    <div className="container">
      <Sidebar />
      <div className="content-area">
        <Hero />
        <About />
        <Patrons />
        <Events />
        <Sponsors />
        <Contact />
        <Footer />
      </div>
    </div>
  )
}

export default Home
