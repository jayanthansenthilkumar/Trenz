<?php
session_start();
include('db.php'); 
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
$userid = $_SESSION['username'];
$sql = "SELECT * FROM events";
$sql2= "SELECT * FROM intramkce";
$result = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql2);
$count = mysqli_num_rows($result);
$count2 = mysqli_num_rows($result2);
$total = $count + $count2;
$amount=250*$count+200*$count2;
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trenz'26</title>
    <link href="./assets/images/trenz.png" rel="icon" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Animation Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/tsparticles@2.12.0/tsparticles.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="admin-dashboard">
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Trenz</h2>
                <span class="admin-label">Superadmin</span>
                <button id="sidebar-toggle" class="sidebar-toggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="sidebar-content">
                <nav class="sidebar-menu">
                    <ul>
                        <li class="active">
                            <a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="manageAdmin.php"><i class="fas fa-user-shield"></i> Manage Admin</a>
                        </li>
                        <li>
                            <a href="superEvents.php"><i class="fas fa-calendar-alt"></i> Events</a>
                        </li>
                        <li>
                            <a href="participants.php"><i class="fas fa-users"></i> Participants</a>
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
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search events, participants...">
                </div>
                <div class="header-actions">
                    <div class="user-dropdown">
                        <img src="https://ui-avatars.com/api/?name=Jayanthan+Senthilkumar&background=2563eb&color=fff" alt="Event Admin">
                        <span>Super Admin</span>
                        <i class="fas fa-chevron-down"></i>
                        <!-- User dropdown menu -->
                        <div class="dropdown-menu">
                            <ul>
                                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
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
                            <h1>Welcome back, Jayanthan Senthilkumar!</h1>
                            <p>Super Admin</p>
                        </div>
                    </div>
                </div>
                
                <!-- Stats Cards -->
                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-card-icon blue">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="stat-card-info">
                            <h3>Total Registration</h3>
                            <p class="stat-number"><?php echo $total?></p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-icon purple">
                            <i class="fas fa-indian-rupee-sign"></i>
                        </div>
                        <div class="stat-card-info">
                            <h3>Total Amount</h3>
                            <p class="stat-number"><?php echo $amount?></p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-icon green">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-card-info">
                            <h3>Intercollege</h3>
                            <p class="stat-number"><?php echo $count?></p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-card-icon orange">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="stat-card-info">
                            <h3>Intracollege</h3>
                            <p class="stat-number"><?php echo $count2?></p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="tsparticles"></div>
    <script src="script.js"></script>
    <script src="animations.js"></script>
</body>
</html>