<?php
session_start();
include('db.php'); // Include the database connection file  
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
$userid = $_SESSION['username'];



$Webcount = $NextGencount = $Appcount = $Errorcount = $Codecount = $CodeQuestcount = $Buildcount = 0;

$sql = "SELECT * FROM events";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)){
    $event = $row['events1'];

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

$Webcounts = $NextGencounts = $Appcounts = $Errorcounts = $Codecounts = $CodeQuestcounts = $Buildcounts = 0;

$sql2 = "SELECT * FROM intramkce";
$result1 = mysqli_query($conn, $sql2);

while($row1 = mysqli_fetch_assoc($result1)){
  

    $event = $row1['events1'];

    switch($event){
        case 'WebWeave':
            $Webcounts++;
            break;
        case 'NextGenStart':
            $NextGencounts++;
            break;
        case 'AppAthon':
            $Appcounts++;
            break;
        case 'Error404NOTFOUND':
            $Errorcounts++;
            break;
        case 'CodeRewind':
            $Codecounts++;
            break;
        case 'CodeQuest':
            $CodeQuestcounts++;
            break;
        case 'BuildaResume':
            $Buildcounts++;
            break;    
    }
}

// Now you have all counts ready

?>

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
    <style>
        /* Tab styling */
        .tabs-navigation {
            display: flex;
            margin-bottom: 20px;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .tab-button {
            padding: 12px 20px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            color: #666;
            position: relative;
        }
        
        .tab-button.active {
            color: #2563eb;
        }
        
        .tab-button.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 3px;
            background: #2563eb;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
    </style>
</head>
<body class="admin-dashboard">
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Trenz</h2>
                <span class="admin-label">Superadmin</span>
                <button id="sidebar-toggle" class="sidebar-toggle">
                    <i class="ri-menu-line"></i>
                </button>
            </div>
            <div class="sidebar-content">
                <nav class="sidebar-menu">
                    <ul>
                        <li>
                            <a href="superDashboard.php"><i class="ri-dashboard-line"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="manageAdmin.php"><i class="ri-admin-line"></i> Manage Admin</a>
                        </li>
                        <li class="active">
                            <a href="#"><i class="ri-calendar-event-line"></i> Events</a>
                        </li>
                        <li>
                            <a href="participants.php"><i class="ri-group-line"></i> Participants</a>
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
                    <div class="user-dropdown">
                        <img src="https://ui-avatars.com/api/?name=Jayanthan+Senthilkumar&background=2563eb&color=fff" alt="Event Admin">
                        <span>Super Admin</span>
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
                <div class="tabs-navigation">
                    <button class="tab-button active" data-tab="intercollege">Intercollege Events</button>
                    <button class="tab-button" data-tab="intracollege">Intracollege Events</button>
                </div>
                
                <!-- Intercollege Tab Content -->
                <div class="tab-content active" id="intercollege">
                    <div class="content-section">
                        <div class="stats-container">
                            <div class="stat-card">
                                <div class="stat-card-icon blue">
                                    <i class="ri-code-box-line"></i>
                                </div>
                                <div class="stat-card-info">
                                    <h4>WebWeave</h4>
                                    <p class="stat-number"><?php echo $Webcount?></p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-icon purple">
                                    <i class="ri-rocket-2-line"></i>
                                </div>
                                <div class="stat-card-info">
                                    <h4>NextGen Start</h4>
                                    <p class="stat-number"><?php echo $NextGencount?></p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-icon orange">
                                    <i class="ri-apps-2-line"></i>
                                </div>
                                <div class="stat-card-info">
                                    <h4>App Athon</h4>
                                    <p class="stat-number"><?php echo $Appcount ?></p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-icon red">
                                    <i class="ri-error-warning-line"></i>
                                </div>
                                <div class="stat-card-info">
                                    <h4>Error : 404</h4>
                                    <p class="stat-number"><?php echo $Errorcount ?></p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-icon teal">
                                    <i class="ri-code-s-slash-line"></i>
                                </div>
                                <div class="stat-card-info">
                                    <h4>Code Rewind</h4>
                                    <p class="stat-number"><?php echo $Codecount ?></p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-icon indigo">
                                    <i class="ri-questionnaire-line"></i>
                                </div>
                                <div class="stat-card-info">
                                    <h4>Code Quest</h4>
                                    <p class="stat-number"><?php echo $CodeQuestcount ?></p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-icon green">
                                    <i class="ri-file-paper-2-line"></i>
                                </div>
                                <div class="stat-card-info">
                                    <h4>Build a Resume</h4>
                                    <p class="stat-number"><?php echo $Buildcount ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Intracollege Tab Content -->
                <div class="tab-content" id="intracollege">
                    <div class="content-section">
                        <div class="stats-container">
                            <div class="stat-card">
                                <div class="stat-card-icon blue">
                                    <i class="ri-code-box-line"></i>
                                </div>
                                <div class="stat-card-info">
                                    <h4>WebWeave</h4>
                                    <p class="stat-number"><?php echo $Webcounts?></p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-icon purple">
                                    <i class="ri-rocket-2-line"></i>
                                </div>
                                <div class="stat-card-info">
                                    <h4>NextGen Start</h4>
                                    <p class="stat-number"><?php echo $NextGencounts?></p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-icon orange">
                                    <i class="ri-apps-2-line"></i>
                                </div>
                                <div class="stat-card-info">
                                    <h4>App Athon</h4>
                                    <p class="stat-number"><?php echo $Appcounts ?></p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-icon red">
                                    <i class="ri-error-warning-line"></i>
                                </div>
                                <div class="stat-card-info">
                                    <h4>Error : 404</h4>
                                    <p class="stat-number"><?php echo $Errorcounts ?></p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-icon teal">
                                    <i class="ri-code-s-slash-line"></i>
                                </div>
                                <div class="stat-card-info">
                                    <h4>Code Rewind</h4>
                                    <p class="stat-number"><?php echo $Codecounts ?></p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-icon indigo">
                                    <i class="ri-questionnaire-line"></i>
                                </div>
                                <div class="stat-card-info">
                                    <h4>Code Quest</h4>
                                    <p class="stat-number"><?php echo $CodeQuestcounts ?></p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-icon green">
                                    <i class="ri-file-paper-2-line"></i>
                                </div>
                                <div class="stat-card-info">
                                    <h4>Build a Resume</h4>
                                    <p class="stat-number"><?php echo $Buildcounts ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="script.js"></script>
    <script>
        // Tab switching functionality
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');
        
        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const tabId = button.getAttribute('data-tab');
                
                // Remove active class from all buttons and contents
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));
                
                // Add active class to clicked button and corresponding content
                button.classList.add('active');
                document.getElementById(tabId).classList.add('active');
            });
        });
    </script>
</body>
</html>
