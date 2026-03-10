import { Link } from 'react-router-dom'

function NotFound() {
  return (
    <div className="not-found-page">
      <h1>404</h1>
      <h2>Page Not Found</h2>
      <p>The page you're looking for doesn't exist or has been moved.</p>
      <Link to="/" className="primary-btn">
        <i className="ri-home-5-line"></i> Back to Home
      </Link>
    </div>
  )
}

export default NotFound
