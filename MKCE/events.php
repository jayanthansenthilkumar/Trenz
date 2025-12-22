<?php
session_start();
include('db.php'); // Include the database connection file  
if (!isset($_SESSION['username'])) {
    header("Location: admin.php");
    exit();
}
$userid = $_SESSION['username'];

$Webcount= 0;
$NextGencount = 0;
$Appcount = 0;
$Errorcount = 0;
$Codecount= 0;
$CodeQuestcount = 0;
$Buildcount = 0;


$sql = "SELECT * FROM intramkce";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)){
    
    $events = [$row['events1']];  // Add more if you have
    
    foreach($events as $event){
        switch($event){
            case 'WebWeave':
                $Webcount++;
                break;
            case 'NextGenStart':
                $NextGencount++;
                break;
            case 'AppAthon':
                $Appcount++;
                break;
            case 'Error404NOTFOUND':
                $Errorcount++;
                break;
            case 'CodeRewind':
                $Codecount++;
                break;
            case 'CodeQuest':
                $CodeQuestcount++;
                break;
            case 'BuildaResume':
                $Buildcount++;
                break;
            
            
        }
    }
}


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
                
                    
                    
                    <div class="tab-content active" id="tech-events">
                        <div class="content-section">
                            <div class="stats-container">
                                <div class="stat-card">
                                    <div class="stat-card-icon blue">
                                        <i class="ri-code-line"></i>
                                    </div>
                                    <div class="stat-card-info">
                                        <h4>WebWeave</h4>
                                        <p class="stat-number"><?php echo $Webcount?></p>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-card-icon purple">
                                        <i class="ri-ai-generate"></i>
                                    </div>
                                    <div class="stat-card-info">
                                        <h4>NextGen Start</h4>
                                        <p class="stat-number"><?php echo $NextGencount?></p>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-card-icon orange">
                                        <i class="ri-database-2-line"></i>
                                    </div>
                                    <div class="stat-card-info">
                                        <h4>App Athon</h4>
                                        <p class="stat-number"><?php echo $Appcount ?></p>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-card-icon green">
                                        <i class="ri-smartphone-line"></i>
                                    </div>
                                    <div class="stat-card-info">
                                        <h4>Error : 404 NOT FOUND</h4>
                                        <p class="stat-number"><?php echo $Errorcount ?></p>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-card-icon green">
                                        <i class="ri-smartphone-line"></i>
                                    </div>
                                    <div class="stat-card-info">
                                        <h4>Code Rewind</h4>
                                        <p class="stat-number"><?php echo $Codecount ?></p>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-card-icon green">
                                        <i class="ri-smartphone-line"></i>
                                    </div>
                                    <div class="stat-card-info">
                                        <h4>Code Quest</h4>
                                        <p class="stat-number"><?php echo $CodeQuestcount ?></p>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-card-icon green">
                                        <i class="ri-smartphone-line"></i>
                                    </div>
                                    <div class="stat-card-info">
                                        <h4>Build a Resume</h4>
                                        <p class="stat-number"><?php echo $Buildcount ?></p>
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
