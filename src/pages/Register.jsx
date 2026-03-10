import { useState, useRef } from 'react'
import { Link } from 'react-router-dom'
import axios from 'axios'
import Swal from 'sweetalert2'

const eventOptions = [
  { value: '', label: 'Select Event' },
  { value: 'WebWeave', label: 'Web Weave' },
  { value: 'NextGenStart', label: 'NextGen Start' },
  { value: 'AppAthon', label: 'App Athon' },
  { value: 'Error404NOTFOUND', label: 'Error : 404 NOT FOUND' },
  { value: 'CodeRewind', label: 'Code Rewind' },
  { value: 'CodeQuest', label: 'Code Quest' },
  { value: 'BuildaResume', label: 'Build a Resume' },
]

function Register() {
  const [activeTab, setActiveTab] = useState('personal-info')
  const [form, setForm] = useState({
    name: '', email: '', regNumber: '', department: '',
    college: '', phone: '', event1: '', transactionId: '',
    transactionDate: new Date().toISOString().split('T')[0],
  })
  const [idCard, setIdCard] = useState(null)
  const [paymentProof, setPaymentProof] = useState(null)
  const idCardRef = useRef(null)
  const paymentRef = useRef(null)

  const handleChange = (e) => {
    setForm({ ...form, [e.target.name]: e.target.value })
  }

  const validatePersonalInfo = () => {
    const required = ['name', 'email', 'regNumber', 'department', 'college', 'phone', 'event1']
    for (const field of required) {
      if (!form[field].trim()) {
        Swal.fire({ title: 'Missing Information', text: 'Please fill all required fields in Personal Information.', icon: 'error' })
        return false
      }
    }
    if (!idCard) {
      Swal.fire({ title: 'Missing Information', text: 'Please upload your ID Card.', icon: 'error' })
      return false
    }
    return true
  }

  const goToPayment = () => {
    if (validatePersonalInfo()) setActiveTab('payment-details')
  }

  const handleSubmit = async (e) => {
    e.preventDefault()
    if (!form.transactionId.trim() || !form.transactionDate.trim()) {
      Swal.fire({ title: 'Missing Information', text: 'Please fill all payment details.', icon: 'error' })
      return
    }
    if (!paymentProof) {
      Swal.fire({ title: 'Missing Information', text: 'Please upload payment screenshot.', icon: 'error' })
      return
    }

    const formData = new FormData()
    Object.entries(form).forEach(([key, val]) => formData.append(key, val))
    formData.append('Idcard', idCard)
    formData.append('paymentProof', paymentProof)

    Swal.fire({ title: 'Please Wait...', text: 'Submitting your form', allowOutsideClick: false, didOpen: () => Swal.showLoading() })

    try {
      const { data } = await axios.post('/api/register', formData, {
        headers: { 'Content-Type': 'multipart/form-data' }
      })

      Swal.close()
      if (data.status === 200) {
        Swal.fire({ title: 'Event Registered Successfully!', text: `Your ID is: ${data.trenzid}`, icon: 'success' })
        setForm({ name: '', email: '', regNumber: '', department: '', college: '', phone: '', event1: '', transactionId: '', transactionDate: new Date().toISOString().split('T')[0] })
        setIdCard(null)
        setPaymentProof(null)
        setActiveTab('personal-info')
      } else if (data.status === 201) {
        Swal.fire({ title: 'Registered Successfully!', html: `Your ID is: <strong>${data.trenzid}</strong><br><br><small>Note: Confirmation email could not be sent.</small>`, icon: 'success' })
        setForm({ name: '', email: '', regNumber: '', department: '', college: '', phone: '', event1: '', transactionId: '', transactionDate: new Date().toISOString().split('T')[0] })
        setIdCard(null)
        setPaymentProof(null)
        setActiveTab('personal-info')
      } else if (data.status === 400) {
        Swal.fire({ title: 'Error!', text: 'Registration limit reached for your Register Number.', icon: 'error' })
      } else {
        Swal.fire({ title: 'Error!', text: data.message || 'Something went wrong!', icon: 'error' })
      }
    } catch {
      Swal.close()
      Swal.fire({ title: 'Server Error', text: 'Could not connect to the server. Please try again later.', icon: 'error' })
    }
  }

  return (
    <div className="login-page">
      <div className="registration-page-container">
        <Link to="/" className="back-btn-floating"><i className="ri-arrow-left-line"></i> Back to Home</Link>

        <div className="content-wrapper">
          <div className="branding-side">
            <h1 className="main-title">Trenz'26</h1>
            <p className="sub-title">Event Registration</p>
          </div>

          <div className="form-side">
            <form className="registration-form-card" onSubmit={handleSubmit}>
              <div className="tabs-navigation">
                <button type="button" className={`tab-btn ${activeTab === 'personal-info' ? 'active' : ''}`} onClick={() => setActiveTab('personal-info')}>
                  <i className="ri-user-line"></i> Personal Info
                </button>
                <button type="button" className={`tab-btn ${activeTab === 'payment-details' ? 'active' : ''}`} onClick={() => { if (validatePersonalInfo()) setActiveTab('payment-details') }}>
                  <i className="ri-bank-card-line"></i> Payment
                </button>
              </div>

              {activeTab === 'personal-info' && (
                <div className="tab-content active" id="personal-info">
                  <h3 className="form-section-title">Personal Information</h3>
                  <div className="form-row">
                    <div className="form-group">
                      <div className="input-with-icon">
                        <input type="text" name="name" placeholder="Full Name" value={form.name} onChange={handleChange} required />
                        <i className="ri-user-line"></i>
                      </div>
                    </div>
                    <div className="form-group">
                      <div className="input-with-icon">
                        <input type="email" name="email" placeholder="Email Address" value={form.email} onChange={handleChange} required />
                        <i className="ri-mail-line"></i>
                      </div>
                    </div>
                  </div>

                  <div className="form-row">
                    <div className="form-group">
                      <div className="input-with-icon">
                        <input type="text" name="regNumber" placeholder="Register Number" value={form.regNumber} onChange={handleChange} required />
                        <i className="ri-id-card-line"></i>
                      </div>
                    </div>
                    <div className="form-group">
                      <div className="input-with-icon">
                        <input type="text" name="department" placeholder="Department" value={form.department} onChange={handleChange} required />
                        <i className="ri-graduation-cap-line"></i>
                      </div>
                    </div>
                  </div>

                  <div className="form-row">
                    <div className="form-group">
                      <div className="input-with-icon">
                        <input type="text" name="college" placeholder="College Name" value={form.college} onChange={handleChange} required />
                        <i className="ri-building-line"></i>
                      </div>
                    </div>
                    <div className="form-group">
                      <div className="input-with-icon">
                        <input type="tel" name="phone" placeholder="Phone Number" value={form.phone} onChange={handleChange} required />
                        <i className="ri-phone-line"></i>
                      </div>
                    </div>
                  </div>

                  <div className="form-row">
                    <div className="form-group">
                      <div className="select-with-icon">
                        <select name="event1" value={form.event1} onChange={handleChange} required>
                          {eventOptions.map((opt) => (
                            <option key={opt.value} value={opt.value}>{opt.label}</option>
                          ))}
                        </select>
                        <i className="ri-calendar-check-line"></i>
                      </div>
                    </div>
                    <div className="form-group">
                      <div className="file-upload">
                        <input type="file" ref={idCardRef} style={{ display: 'none' }} accept="image/*,.pdf"
                          onChange={(e) => setIdCard(e.target.files[0] || null)} />
                        <div className="upload-button" onClick={() => idCardRef.current?.click()}>
                          <i className="ri-upload-2-line"></i>
                          <span>ID Card</span>
                        </div>
                        <p className="file-name1">{idCard ? idCard.name : 'No file chosen'}</p>
                      </div>
                    </div>
                  </div>

                  <div className="tab-buttons">
                    <button type="button" className="next-tab primary-btn" onClick={goToPayment}>
                      Continue <i className="ri-arrow-right-line"></i>
                    </button>
                  </div>
                </div>
              )}

              {activeTab === 'payment-details' && (
                <div className="tab-content active" id="payment-details">
                  <h3 className="form-section-title">Payment Details</h3>
                  <div className="account-details-container" style={{ padding: '14px', background: 'rgba(217, 119, 6, 0.06)', borderRadius: '12px', marginBottom: '16px', fontSize: '0.85rem', border: '1px solid rgba(217, 119, 6, 0.15)' }}>
                    <h4 style={{ marginBottom: '8px', fontSize: '0.95rem', color: '#B45309' }}>Bank Transfer Details</h4>
                    <div className="account-info" style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '4px' }}>
                      <p><strong>Acc No:</strong> 924010014781681</p>
                      <p><strong>IFSC:</strong> UTIB0000123</p>
                      <p style={{ gridColumn: 'span 2' }}><strong>Name:</strong> M.KUMARASAMY COLLEGE OF ENGINEERING - FE HOD AC</p>
                      <p><strong>Bank:</strong> Karur Axis Bank</p>
                      <p><strong>Amount:</strong> ₹250</p>
                    </div>
                  </div>

                  <div className="form-row">
                    <div className="form-group">
                      <div className="input-with-icon">
                        <input type="text" name="transactionId" placeholder="Transaction ID" value={form.transactionId} onChange={handleChange} required />
                        <i className="ri-receipt-line"></i>
                      </div>
                    </div>
                    <div className="form-group">
                      <div className="input-with-icon">
                        <input type="date" name="transactionDate" value={form.transactionDate} onChange={handleChange} required />
                        <i className="ri-calendar-line"></i>
                      </div>
                    </div>
                  </div>

                  <div className="form-group">
                    <div className="file-upload">
                      <input type="file" ref={paymentRef} style={{ display: 'none' }} accept="image/*,.pdf"
                        onChange={(e) => setPaymentProof(e.target.files[0] || null)} />
                      <div className="upload-button" onClick={() => paymentRef.current?.click()}>
                        <i className="ri-upload-2-line"></i>
                        <span>Upload Payment Screenshot</span>
                      </div>
                      <p className="file-name">{paymentProof ? paymentProof.name : 'No file chosen'}</p>
                    </div>
                  </div>

                  <div className="tab-buttons" style={{ display: 'flex', gap: '10px' }}>
                    <button type="button" className="secondary-btn" onClick={() => setActiveTab('personal-info')}>
                      <i className="ri-arrow-left-line"></i> Previous
                    </button>
                    <button type="submit" className="login-btn primary-btn">
                      <i className="ri-check-line"></i> Complete Registration
                    </button>
                  </div>
                </div>
              )}
            </form>
          </div>
        </div>
      </div>
    </div>
  )
}

export default Register
