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
    <style>
        /* Tab styling */
        .tabs-navigation {
            display: flex;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .tab-button {
            padding: 12px 20px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            color: var(--text-secondary);
            position: relative;
        }
        
        .tab-button.active {
            color: var(--primary-color);
        }
        
        .tab-button.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--primary-color);
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
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="sidebar-content">
                <nav class="sidebar-menu">
                    <ul>
                        <li>
                            <a href="superDashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="manageAdmin.php"><i class="fas fa-user-shield"></i> Manage Admin</a>
                        </li>
                        <li class="active">
                            <a href="#"><i class="fas fa-calendar-alt"></i> Events</a>
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
                                    <i class="fas fa-code"></i>
                                </div>
                                <div class="stat-card-info">
                                    <h4>WebWeave</h4>
                                    <p class="stat-number"><?php echo $Webcount?></p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-icon purple">
                                    <i class="fas fa-rocket"></i>
                                </div>
                                <div class="stat-card-info">
                                    <h4>NextGen Start</h4>
                                    <p class="stat-number"><?php echo $NextGencount?></p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-icon orange">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <div class="stat-card-info">
                                    <h4>App Athon</h4>
                                    <p class="stat-number"><?php echo $Appcount ?></p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-icon red">
                                    <i class="fas fa-bug"></i>
                                </div>
                                <div class="stat-card-info">
                                    <h4>Error : 404</h4>
                                    <p class="stat-number"><?php echo $Errorcount ?></p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-icon teal">
                                    <i class="fas fa-laptop-code"></i>
                                </div>
                                <div class="stat-card-info">
                                    <h4>Code Rewind</h4>
                                    <p class="stat-number"><?php echo $Codecount ?></p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-icon indigo">
                                    <i class="fas fa-question-circle"></i>
                                </div>
                                <div class="stat-card-info">
                                    <h4>Code Quest</h4>
                                    <p class="stat-number"><?php echo $CodeQuestcount ?></p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-icon green">
                                    <i class="fas fa-file-alt"></i>
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
                                    <i class="fas fa-code"></i>
                                </div>
                                <div class="stat-card-info">
                                    <h4>WebWeave</h4>
                                    <p class="stat-number"><?php echo $Webcounts?></p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-icon purple">
                                    <i class="fas fa-rocket"></i>
                                </div>
                                <div class="stat-card-info">
                                    <h4>NextGen Start</h4>
                                    <p class="stat-number"><?php echo $NextGencounts?></p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-icon orange">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                                <div class="stat-card-info">
                                    <h4>App Athon</h4>
                                    <p class="stat-number"><?php echo $Appcounts ?></p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-icon red">
                                    <i class="fas fa-bug"></i>
                                </div>
                                <div class="stat-card-info">
                                    <h4>Error : 404</h4>
                                    <p class="stat-number"><?php echo $Errorcounts ?></p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-icon teal">
                                    <i class="fas fa-laptop-code"></i>
                                </div>
                                <div class="stat-card-info">
                                    <h4>Code Rewind</h4>
                                    <p class="stat-number"><?php echo $Codecounts ?></p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-icon indigo">
                                    <i class="fas fa-question-circle"></i>
                                </div>
                                <div class="stat-card-info">
                                    <h4>Code Quest</h4>
                                    <p class="stat-number"><?php echo $CodeQuestcounts ?></p>
                                </div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-card-icon green">
                                    <i class="fas fa-file-alt"></i>
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
    <div id="tsparticles"></div>
    <script src="animations.js"></script>
</body>
</html>