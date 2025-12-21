<?php
session_start();
include "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trenz'25</title>
    <link href="./assets/images/trenz.png" rel="icon" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="login.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="login-page">    
    <div id="particles-js"></div>
    
    <div class="split-login-container">
        <!-- Brand Section (Now on the left) -->
        <div class="brand-section">
            <div class="brand-content">
                <h1>Trenz'25</h1>
                <p>Administrative Portal</p>
            </div>
        </div>
        
        <!-- Login Card Section (Now on the right) -->
        <div class="login-section">
            <div class="login-card">
                <div class="login-header">
                    <h2>Admin Login</h2>
                    <div class="section-divider"></div>
                </div>
                
                <form id="adminLoginForm" method="POST" action="admin.php">
                    <div class="form-group">
                        <!-- <label for="username">Username</label> -->
                        <div class="input-with-icon">
                            <input type="text" id="username" name="username" placeholder="Enter your username" required>
                            <i class="fas fa-user"></i>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <!-- <label for="password">Password</label> -->
                        <div class="input-with-icon">
                            <input type="password" id="password" name="password" placeholder="Enter your password" required>
                            <i class="fas fa-lock"></i>
                        </div>
                    </div>
                    
                    <!-- <div class="form-options">
                        <div class="remember-me">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Remember me</label>
                        </div>
                        <a href="#" class="forgot-password">Forgot Password?</a>
                    </div> -->
                    
                    <button type="submit" class="login-btn primary-btn">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db.php'; 
    session_start();

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM login WHERE userid = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['role'];

        // Show success SweetAlert
        $redirectPage = ($_SESSION['role'] == 1) ? 'adminDashboard.php' : 'admin.php';

        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Login Successful!',
                text: 'Welcome $username',
                
            }).then(() => {
                window.location.href = '$redirectPage';
            });
        </script>";
    } else {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Failed',
                text: 'Invalid Username or Password. Please try again.',
                confirmButtonText: 'Retry'
            }).then(() => {
                window.location.href = 'admin.php';
            });
        </script>";
    }
} else {
    exit();
}
?>


    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
