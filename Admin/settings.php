<?php
session_start();
include('db.php');

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: admin.php");
    exit();
}

$userid = $_SESSION['username'];
$role = $_SESSION['role'] ?? '1'; // Default to admin role

// Get current settings
function getSetting($conn, $key) {
    $query = "SELECT setting_value FROM settings WHERE setting_key = '" . mysqli_real_escape_string($conn, $key) . "'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['setting_value'];
    }
    return null;
}

// Update setting
if (isset($_POST['update_settings'])) {
    $max_registrations = mysqli_real_escape_string($conn, $_POST['max_registrations']);
    $registration_enabled = isset($_POST['registration_enabled']) ? '1' : '0';
    $registration_message = mysqli_real_escape_string($conn, $_POST['registration_message']);
    
    // Update or insert settings
    $settings = [
        'max_registrations_per_regno' => $max_registrations,
        'registration_enabled' => $registration_enabled,
        'registration_message' => $registration_message
    ];
    
    $success = true;
    foreach ($settings as $key => $value) {
        $query = "INSERT INTO settings (setting_key, setting_value, updated_by) 
                  VALUES ('$key', '$value', '$userid') 
                  ON DUPLICATE KEY UPDATE 
                  setting_value = '$value', 
                  updated_by = '$userid',
                  updated_at = CURRENT_TIMESTAMP";
        
        if (!mysqli_query($conn, $query)) {
            $success = false;
            break;
        }
    }
    
    if ($success) {
        $_SESSION['success_message'] = "Settings updated successfully!";
    } else {
        $_SESSION['error_message'] = "Failed to update settings!";
    }
    
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Get current values
$max_registrations = getSetting($conn, 'max_registrations_per_regno') ?? '1';
$registration_enabled = getSetting($conn, 'registration_enabled') ?? '1';
$registration_message = getSetting($conn, 'registration_message') ?? 'Registration is currently open!';
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Settings - Trenz'26</title>
    <link href="./assets/images/trenz.png" rel="icon" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="admin.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .settings-container {
            max-width: 800px;
            margin: 30px auto;
            background: var(--bg-secondary);
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        .settings-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid var(--border-color);
        }
        
        .settings-header i {
            font-size: 2rem;
            color: var(--primary-color);
        }
        
        .settings-header h2 {
            font-size: 1.8rem;
            color: var(--text-primary);
            margin: 0;
        }
        
        .settings-form {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .form-group label {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 1rem;
        }
        
        .form-group .description {
            font-size: 0.9rem;
            color: var(--text-secondary);
            margin-top: -5px;
        }
        
        .form-group input[type="number"],
        .form-group textarea {
            padding: 12px 15px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            background: var(--bg-primary);
            color: var(--text-primary);
        }
        
        .form-group input[type="number"]:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1);
        }
        
        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }
        
        .toggle-switch {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 30px;
        }
        
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 30px;
        }
        
        .slider:before {
            position: absolute;
            content: "";
            height: 22px;
            width: 22px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }
        
        input:checked + .slider {
            background-color: var(--primary-color);
        }
        
        input:checked + .slider:before {
            transform: translateX(30px);
        }
        
        .toggle-label {
            font-weight: 500;
            color: var(--text-primary);
        }
        
        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-primary {
            background: var(--primary-color);
            color: white;
        }
        
        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(231, 76, 60, 0.3);
        }
        
        .btn-secondary {
            background: var(--bg-primary);
            color: var(--text-primary);
            border: 2px solid var(--border-color);
        }
        
        .btn-secondary:hover {
            background: var(--border-color);
        }
        
        .info-box {
            background: rgba(231, 76, 60, 0.1);
            border-left: 4px solid var(--primary-color);
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }
        
        .info-box p {
            margin: 5px 0;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }
        
        .info-box strong {
            color: var(--text-primary);
        }
    </style>
</head>
<body class="admin-dashboard">
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Trenz</h2>
                <span class="admin-label"><?php echo ($role == '0') ? 'Superadmin' : 'Events'; ?></span>
                <button id="sidebar-toggle" class="sidebar-toggle">
                    <i class="ri-menu-line"></i>
                </button>
            </div>
            <div class="sidebar-content">
                <nav class="sidebar-menu">
                    <ul>
                        <li>
                            <a href="<?php echo ($role == '0') ? 'superDashboard.php' : 'adminDashboard.php'; ?>">
                                <i class="<?php echo ($role == '0') ? 'fas fa-tachometer-alt' : 'ri-dashboard-line'; ?>"></i> Dashboard
                            </a>
                        </li>
                        <?php if ($role == '0'): ?>
                        <li>
                            <a href="manageAdmin.php"><i class="fas fa-user-shield"></i> Manage Admin</a>
                        </li>
                        <?php endif; ?>
                        <li>
                            <a href="<?php echo ($role == '0') ? 'superEvents.php' : 'events.php'; ?>">
                                <i class="<?php echo ($role == '0') ? 'fas fa-calendar-alt' : 'ri-calendar-event-line'; ?>"></i> Events
                            </a>
                        </li>
                        <li>
                            <a href="participants.php"><i class="<?php echo ($role == '0') ? 'fas fa-users' : 'ri-user-star-line'; ?>"></i> Participants</a>
                        </li>
                        <?php if ($role != '0'): ?>
                        <li>
                            <a href="spotRegistration.php"><i class="ri-user-add-line"></i> Spot Registration</a>
                        </li>
                        <?php endif; ?>
                        <li class="active">
                            <a href="settings.php"><i class="fas fa-cog"></i> Registration Settings</a>
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
                    <i class="<?php echo ($role == '0') ? 'fas fa-search' : 'ri-search-line'; ?>"></i>
                    <input type="text" placeholder="Search settings...">
                </div>
                <div class="header-actions">
                    <div class="user-dropdown">
                        <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($userid); ?>&background=e74c3c&color=fff" alt="Admin">
                        <span><?php echo ($role == '0') ? 'Super Admin' : 'Admin'; ?></span>
                        <i class="<?php echo ($role == '0') ? 'fas fa-chevron-down' : 'ri-arrow-down-s-line'; ?>"></i>
                        <div class="dropdown-menu">
                            <ul>
                                <li><a href="logout.php"><i class="<?php echo ($role == '0') ? 'fas fa-sign-out-alt' : 'ri-logout-box-r-line'; ?>"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Settings Content -->
            <div class="dashboard-content">
                <div class="settings-container">
                    <div class="settings-header">
                        <i class="fas fa-sliders-h"></i>
                        <h2>Registration Settings</h2>
                    </div>

                    <form method="POST" class="settings-form">
                        <div class="form-group">
                            <label for="max_registrations">
                                <i class="fas fa-hashtag"></i> Maximum Registrations Per Register Number
                            </label>
                            <input type="number" 
                                   id="max_registrations" 
                                   name="max_registrations" 
                                   value="<?php echo htmlspecialchars($max_registrations); ?>" 
                                   min="1" 
                                   max="10" 
                                   required>
                            <span class="description">
                                Set how many events a single register number can register for. (Recommended: 1-3)
                            </span>
                        </div>

                        <div class="form-group">
                            <label>
                                <i class="fas fa-toggle-on"></i> Registration Status
                            </label>
                            <div class="toggle-switch">
                                <label class="switch">
                                    <input type="checkbox" 
                                           name="registration_enabled" 
                                           id="registration_enabled"
                                           <?php echo ($registration_enabled == '1') ? 'checked' : ''; ?>>
                                    <span class="slider"></span>
                                </label>
                                <span class="toggle-label">
                                    <span id="status-text"><?php echo ($registration_enabled == '1') ? 'Enabled' : 'Disabled'; ?></span>
                                </span>
                            </div>
                            <span class="description">
                                Enable or disable the registration system for all events.
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="registration_message">
                                <i class="fas fa-comment-alt"></i> Registration Message
                            </label>
                            <textarea id="registration_message" 
                                      name="registration_message" 
                                      required><?php echo htmlspecialchars($registration_message); ?></textarea>
                            <span class="description">
                                This message will be displayed on the registration page.
                            </span>
                        </div>

                        <div class="info-box">
                            <p><i class="fas fa-info-circle"></i> <strong>Note:</strong></p>
                            <p>• Changes will take effect immediately after saving</p>
                            <p>• Maximum limit prevents abuse of registration system</p>
                            <p>• Disabling registration will show maintenance message to users</p>
                            <p>• Current registration count is based on unique register numbers</p>
                        </div>

                        <div class="button-group">
                            <button type="submit" name="update_settings" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Settings
                            </button>
                            <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <div id="tsparticles"></div>
    <script src="script.js"></script>
    <script src="animations.js"></script>
    
    <script>
        // Show success/error messages
        <?php if (isset($_SESSION['success_message'])): ?>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '<?php echo $_SESSION['success_message']; ?>',
                confirmButtonColor: '#e74c3c'
            });
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error_message'])): ?>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '<?php echo $_SESSION['error_message']; ?>',
                confirmButtonColor: '#e74c3c'
            });
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>
        
        // Update toggle label text
        document.getElementById('registration_enabled').addEventListener('change', function() {
            document.getElementById('status-text').textContent = this.checked ? 'Enabled' : 'Disabled';
        });
    </script>
</body>
</html>
