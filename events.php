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
                        <li  class="active">
                            <a href="events.php"><i class="ri-calendar-event-line"></i> Events</a>
                        </li>
                        <li>
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
                    <input type="text" placeholder="Search events, participants...">
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
                <!-- Tabs Section -->
                <div class="tabs-container">
                    <div class="tabs-header">
                        <button class="tab-button active" data-tab="tech-events">Technical Events</button>
                        <button class="tab-button" data-tab="nontech-events">Non-Technical Events</button>
                    </div>
                    
                    <div class="tab-content active" id="tech-events">
                        <div class="content-section">
                            <div class="stats-container">
                                <div class="stat-card">
                                    <div class="stat-card-icon blue">
                                        <i class="ri-code-line"></i>
                                    </div>
                                    <div class="stat-card-info">
                                        <h3>Web Development</h3>
                                        <p class="stat-number">120 Registered</p>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-card-icon purple">
                                        <i class="ri-ai-generate"></i>
                                    </div>
                                    <div class="stat-card-info">
                                        <h3>Machine Learning</h3>
                                        <p class="stat-number">75 Registered</p>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-card-icon orange">
                                        <i class="ri-database-2-line"></i>
                                    </div>
                                    <div class="stat-card-info">
                                        <h3>Data Science</h3>
                                        <p class="stat-number">92 Registered</p>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-card-icon green">
                                        <i class="ri-smartphone-line"></i>
                                    </div>
                                    <div class="stat-card-info">
                                        <h3>Mobile App Dev</h3>
                                        <p class="stat-number">68 Registered</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="tab-content" id="nontech-events">
                        <div class="content-section">
                            <div class="stats-container">
                                <div class="stat-card">
                                    <div class="stat-card-icon blue">
                                        <i class="ri-palette-line"></i>
                                    </div>
                                    <div class="stat-card-info">
                                        <h3>UI/UX Design</h3>
                                        <p class="stat-number">45 Registered</p>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-card-icon purple">
                                        <i class="ri-presentation-line"></i>
                                    </div>
                                    <div class="stat-card-info">
                                        <h3>Business Workshop</h3>
                                        <p class="stat-number">58 Registered</p>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-card-icon orange">
                                        <i class="ri-music-2-line"></i>
                                    </div>
                                    <div class="stat-card-info">
                                        <h3>Music Competition</h3>
                                        <p class="stat-number">72 Registered</p>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-card-icon green">
                                        <i class="ri-gallery-line"></i>
                                    </div>
                                    <div class="stat-card-info">
                                        <h3>Art Exhibition</h3>
                                        <p class="stat-number">39 Registered</p>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-card-icon blue">
                                        <i class="ri-dance-line"></i>
                                    </div>
                                    <div class="stat-card-info">
                                        <h3>Dance Competition</h3>
                                        <p class="stat-number">32 Registered</p>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-card-icon purple">
                                        <i class="ri-projector-line"></i>
                                    </div>
                                    <div class="stat-card-info">
                                        <h3>Film Festival</h3>
                                        <p class="stat-number">48 Registered</p>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-card-icon orange">
                                        <i class="ri-book-open-line"></i>
                                    </div>
                                    <div class="stat-card-info">
                                        <h3>Literary Workshop</h3>
                                        <p class="stat-number">27 Registered</p>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-card-icon green">
                                        <i class="ri-mic-line"></i>
                                    </div>
                                    <div class="stat-card-info">
                                        <h3>Public Speaking</h3>
                                        <p class="stat-number">63 Registered</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="script.js"></script>
</body>
</html>
