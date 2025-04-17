<?php
session_start();
include('db.php'); // Include the database connection file  
if (!isset($_SESSION['username'])) {
    header("Location: admin.php");
    exit();
}
$userid = $_SESSION['username'];
$sql = "SELECT * FROM intramkce  ";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);
$amount=250*$count;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trenz'25</title>
    <link href="./assets/images/trenz.png" rel="icon" type="image/png" sizes="16x16">
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
                        <li class="active">
                            <a href="#"><i class="ri-dashboard-line"></i> Dashboard</a>
                        </li>
                        <li>
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
                    <button class="message-btn">
                        <i class="ri-mail-line"></i>
                        <span class="badge">5</span>
                    </button>
                    <div class="user-dropdown">
                        <img src="https://ui-avatars.com/api/?name=Event+Admin&background=2563eb&color=fff" alt="Event Admin">
                        <span>Admin</span>
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
                <!-- Welcome Card -->
                <div class="welcome-card">
                    <div class="welcome-info">
                        <div class="welcome-text">
                            <h1>Welcome back, Admin!</h1>
                            <p><span id="current-date">Today</span> | <span class="welcome-stat">Next event: Tech Conference (in 3 days)</span></p>
                        </div>
                    </div>
                </div>
                
                <!-- Stats Cards -->
                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-card-icon blue">
                            <i class="ri-user-add-line"></i>
                        </div>
                        <div class="stat-card-info">
                            <h3>Total Registration</h3>
                            <p class="stat-number"><?php echo $count?></p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-icon purple">
                            <i class="ri-money-dollar-circle-line"></i>
                        </div>
                        <div class="stat-card-info">
                            <h3>Total Amount</h3>
                            <p class="stat-number"><?php echo $amount?></p>
                        </div>
                    </div>
                    
                    
                </div>

                <!-- End of Dashboard Content -->
            </div>
        </main>
    </div>

    <script src="script.js"></script>
</body>
</html>
