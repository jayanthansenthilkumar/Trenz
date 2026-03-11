import express from 'express'
import cors from 'cors'
import mysql from 'mysql2/promise'
import multer from 'multer'
import path from 'path'
import { fileURLToPath } from 'url'
import fs from 'fs'

const __filename = fileURLToPath(import.meta.url)
const __dirname = path.dirname(__filename)

const app = express()
const PORT = 5000

// Middleware
app.use(cors())
app.use(express.json())
app.use(express.urlencoded({ extended: true }))

// Ensure uploads directory exists
const uploadsDir = path.join(__dirname, 'uploads')
if (!fs.existsSync(uploadsDir)) {
  fs.mkdirSync(uploadsDir, { recursive: true })
}

// Multer configuration for file uploads
const storage = multer.diskStorage({
  destination: (req, file, cb) => cb(null, uploadsDir),
  filename: (req, file, cb) => {
    const uniqueSuffix = Date.now() + '-' + Math.round(Math.random() * 1e9)
    cb(null, uniqueSuffix + path.extname(file.originalname))
  }
})
const upload = multer({ storage })

// MySQL connection pool
const pool = mysql.createPool({
  host: '127.0.0.1',
  user: 'root',
  password: '',
  database: 'trenz',
  waitForConnections: true,
  connectionLimit: 10,
})

// Generate Trenz ID
function generateTrenzId() {
  return 'TRENZ' + Date.now().toString(36).toUpperCase() + Math.random().toString(36).substring(2, 6).toUpperCase()
}

// Register route
app.post('/api/register', upload.fields([
  { name: 'Idcard', maxCount: 1 },
  { name: 'paymentProof', maxCount: 1 }
]), async (req, res) => {
  try {
    const { name, email, regNumber, department, college, phone, event1, transactionId, transactionDate } = req.body
    const idCard = req.files?.Idcard?.[0]?.filename || null
    const paymentProof = req.files?.paymentProof?.[0]?.filename || null

    // Check registration limit per register number
    const [existing] = await pool.query('SELECT COUNT(*) as count FROM events WHERE regno = ?', [regNumber])
    if (existing[0].count >= 3) {
      return res.json({ status: 400, message: 'Registration limit reached for your Register Number.' })
    }

    const trenzid = generateTrenzId()

    await pool.query(
      `INSERT INTO events (Trenzid, name, regno, emailid, depart, collegename, phoneno, events1, idcard, date, transactionid, transactionreceipt)
       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)`,
      [trenzid, name, regNumber, email, department, college, phone, event1, idCard, transactionDate, transactionId, paymentProof]
    )

    res.json({ status: 200, message: 'Registered successfully!', trenzid })
  } catch (error) {
    console.error('Registration error:', error)
    res.status(500).json({ status: 500, message: 'Server error. Please try again later.' })
  }
})

app.listen(PORT, () => {
  console.log(`Server running on http://localhost:${PORT}`)
})
