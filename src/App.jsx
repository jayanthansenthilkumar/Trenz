import { Routes, Route } from 'react-router-dom'
import Home from './pages/Home'
import Register from './pages/Register'
import EventPage from './pages/EventPage'
import NotFound from './pages/NotFound'

function App() {
  return (
    <Routes>
      <Route path="/" element={<Home />} />
      <Route path="/register" element={<Register />} />
      <Route path="/event" element={<EventPage />} />
      <Route path="*" element={<NotFound />} />
    </Routes>
  )
}

export default App
