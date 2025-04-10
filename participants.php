<?php
session_start();
include('db.php'); // Include the database connection file  
if (!isset($_SESSION['username'])) {
    header("Location: admin.php");
    exit();
}
$userid = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trenz'25</title>
    <link rel="stylesheet" href="admin.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
</head>
<body class="admin-dashboard">
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Trenz</h2>
                <span class="admin-label">Events</span>
                <button id="sidebar-toggle" class="sidebar-toggle">
                    <i class="ri-menu-line"></i>
                </button>
            </div>
            <div class="sidebar-content">
            <nav class="sidebar-menu">
                    <ul>
                    <li>
                        <a href="adminDashboard.php"><i class="ri-dashboard-line"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="events.php"><i class="ri-calendar-event-line"></i> Events</a>
                        </li>
                        <li class="active">
                            <a href="participants.php"><i class="ri-user-star-line"></i> Participants</a>
                        </li>
                        <li>
                            <a href="spotRegistration.php"><i class="ri-user-add-line"></i> Spot Registration</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="search-bar">
                    <i class="ri-search-line"></i>
                    <input type="text" placeholder="Search participants, events...">
                </div>
                <div class="header-actions">
                    <button class="notification-btn">
                        <i class="ri-notification-3-line"></i>
                        <span class="badge">3</span>
                    </button>
                    <button class="message-btn">
                        <i class="ri-mail-line"></i>
                        <span class="badge">5</span>
                    </button>
                    <div class="user-dropdown">
                        <img src="https://ui-avatars.com/api/?name=Event+Admin&background=2563eb&color=fff" alt="Event Admin">
                        <span><?php echo $userid?></span>
                        <i class="ri-arrow-down-s-line"></i>
                        
                        <!-- User dropdown menu -->
                        <div class="dropdown-menu">
                            <ul>
                                
                                <li><a href="logout.php"><i class="ri-logout-box-r-line"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Tabbed Section for Participants -->
                <div class="content-section">
                    <h2>Event Participants</h2>
                    
                    <!-- Tab Navigation -->
                    <div class="tabs-header">
                        <button class="tab-button active" data-tab="registered-tab">Registered Participants</button>
                        <button class="tab-button" data-tab="approved-tab">Approved Participants</button>
                        <button class="tab-button" data-tab="spot-registration-tab">Spot Registration</button>
                    </div>
                    
                    <!-- Tab Content -->
                    <!-- Registered Participants Tab -->
                    <div id="registered-tab" class="tab-content active">
                        <div class="datatable-controls">
                            <div class="datatable-length">
                                <label>
                                    Show 
                                    <select>
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    entries
                                </label>
                            </div>
                            <div class="datatable-filter">
                                <label>
                                    Search: 
                                    <input type="search" placeholder="Enter keywords...">
                                </label>
                            </div>
                        </div>
                        
                        <div class="datatable-wrapper">
                            <table class="datatable" id="registered-table">
                                <thead>
                                    <tr>
                                        <th>Trenz ID</th>
                                        <th>Name</th>
                                        <th>College Name</th>
                                        <th>Event 1</th>
                                        <th>Event 2</th>
                                        <th>Payment Details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>TZ-23001</td>
                                        <td>John Smith</td>
                                        <td>MIT College of Engineering</td>
                                        <td>Web Development Workshop</td>
                                        <td>Machine Learning Basics</td>
                                        <td><button class="payment-btn" data-participant="TZ-23001">View Payment</button></td>
                                        <td class="action-buttons">
                                            <button class="btn-icon accept"><i class="ri-check-line"></i></button>
                                            <button class="btn-icon reject"><i class="ri-close-line"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>TZ-23015</td>
                                        <td>Emma Johnson</td>
                                        <td>Stanford University</td>
                                        <td>Machine Learning Basics</td>
                                        <td>-</td>
                                        <td><button class="payment-btn" data-participant="TZ-23015">View Payment</button></td>
                                        <td class="action-buttons">
                                            <button class="btn-icon accept"><i class="ri-check-line"></i></button>
                                            <button class="btn-icon reject"><i class="ri-close-line"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>TZ-23042</td>
                                        <td>Michael Brown</td>
                                        <td>Harvard University</td>
                                        <td>Cybersecurity Conference</td>
                                        <td>-</td>
                                        <td><button class="payment-btn" data-participant="TZ-23042">View Payment</button></td>
                                        <td class="action-buttons">
                                            <button class="btn-icon accept"><i class="ri-check-line"></i></button>
                                            <button class="btn-icon reject"><i class="ri-close-line"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>TZ-23056</td>
                                        <td>Sarah Davis</td>
                                        <td>Princeton University</td>
                                        <td>Mobile App Development</td>
                                        <td>-</td>
                                        <td><button class="payment-btn" data-participant="TZ-23056">View Payment</button></td>
                                        <td class="action-buttons">
                                            <button class="btn-icon accept"><i class="ri-check-line"></i></button>
                                            <button class="btn-icon reject"><i class="ri-close-line"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Approved Participants Tab -->
                    <div id="approved-tab" class="tab-content">
                        <div class="datatable-controls">
                            <div class="datatable-length">
                                <label>
                                    Show 
                                    <select>
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    entries
                                </label>
                            </div>
                            <div class="datatable-filter">
                                <label>
                                    Search: 
                                    <input type="search" placeholder="Enter keywords...">
                                </label>
                            </div>
                        </div>
                        
                        <div class="datatable-wrapper">
                            <table class="datatable" id="approved-table">
                                <thead>
                                    <tr>
                                        <th>Trenz ID</th>
                                        <th>Name</th>
                                        <th>College Name</th>
                                        <th>Event 1</th>
                                        <th>Event 2</th>
                                        <th>Payment Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>TZ-23078</td>
                                        <td>Alex Wilson</td>
                                        <td>Cornell University</td>
                                        <td>UI/UX Design Masterclass</td>
                                        <td>-</td>
                                        <td><span class="status-badge completed">Paid</span></td>
                                        <td class="action-buttons">
                                            <button class="btn-icon view"><i class="ri-eye-line"></i></button>
                                            <button class="btn-icon delete"><i class="ri-delete-bin-line"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>TZ-23103</td>
                                        <td>Jessica Lee</td>
                                        <td>Yale University</td>
                                        <td>Cultural Dance Competition</td>
                                        <td>-</td>
                                        <td><span class="status-badge completed">Paid</span></td>
                                        <td class="action-buttons">
                                            <button class="btn-icon view"><i class="ri-eye-line"></i></button>
                                            <button class="btn-icon delete"><i class="ri-delete-bin-line"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>TZ-23129</td>
                                        <td>David Miller</td>
                                        <td>Columbia University</td>
                                        <td>Public Speaking Workshop</td>
                                        <td>-</td>
                                        <td><span class="status-badge completed">Paid</span></td>
                                        <td class="action-buttons">
                                            <button class="btn-icon view"><i class="ri-eye-line"></i></button>
                                            <button class="btn-icon delete"><i class="ri-delete-bin-line"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>TZ-23145</td>
                                        <td>Linda Garcia</td>
                                        <td>University of California</td>
                                        <td>Business Workshop</td>
                                        <td>-</td>
                                        <td><span class="status-badge completed">Paid</span></td>
                                        <td class="action-buttons">
                                            <button class="btn-icon view"><i class="ri-eye-line"></i></button>
                                            <button class="btn-icon delete"><i class="ri-delete-bin-line"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>TZ-23178</td>
                                        <td>Ryan Thompson</td>
                                        <td>Duke University</td>
                                        <td>Art Exhibition</td>
                                        <td>-</td>
                                        <td><span class="status-badge completed">Paid</span></td>
                                        <td class="action-buttons">
                                            <button class="btn-icon view"><i class="ri-eye-line"></i></button>
                                            <button class="btn-icon delete"><i class="ri-delete-bin-line"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Spot Registration Tab -->
                    <div id="spot-registration-tab" class="tab-content">
                        <div class="datatable-controls">
                            <div class="datatable-length">
                                <label>
                                    Show 
                                    <select>
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    entries
                                </label>
                            </div>
                            <div class="datatable-filter">
                                <label>
                                    Search: 
                                    <input type="search" placeholder="Enter keywords...">
                                </label>
                            </div>
                        </div>
                        
                        <div class="datatable-wrapper">
                            <table class="datatable" id="spot-registration-table">
                                <thead>
                                    <tr>
                                        <th>Trenz ID</th>
                                        <th>Name</th>
                                        <th>College Name</th>
                                        <th>Event 1</th>
                                        <th>Event 2</th>
                                        <th>Payment Status</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>TZ-23201</td>
                                        <td>Kevin Adams</td>
                                        <td>Boston University</td>
                                        <td>Hackathon</td>
                                        <td>-</td>
                                        <td><span class="status-badge completed">Paid</span></td>
                                        
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Payment Details Modal -->
            <div class="modal" id="payment-modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Payment Details</h3>
                        <button class="modal-close"><i class="ri-close-line"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="payment-info">
                            <div class="info-row">
                                <span class="info-label">Participant ID:</span>
                                <span class="info-value" id="payment-participant-id">TZ-23001</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Participant Name:</span>
                                <span class="info-value" id="payment-participant-name">John Smith</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Payment Status:</span>
                                <span class="info-value status-badge completed" id="payment-status">Paid</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Amount:</span>
                                <span class="info-value" id="payment-amount">$55.00</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Transaction ID:</span>
                                <span class="info-value" id="payment-transaction">TRX-2023051501</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Payment Method:</span>
                                <span class="info-value" id="payment-method">Credit Card</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Payment Date:</span>
                                <span class="info-value" id="payment-date">May 15, 2023</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn-secondary modal-close">Close</button>
                        <button class="btn-primary">Print Receipt</button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="script.js"></script>
</body>
</html>
