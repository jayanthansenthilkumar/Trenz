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
    <title>Registration - Trenz'25</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="login.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .back-btn {
            display: inline-block;
            padding: 8px 15px;
            background-color: #2c3e50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-bottom: 15px;
            transition: background-color 0.3s;
        }

        .back-btn:hover {
            background-color: #1a2530;
        }

        .back-btn i {
            margin-right: 5px;
        }
    </style>
</head>

<body class="login-page">
    <div id="particles-js"></div>
    <div class="split-login-container">
        <div class="brand-section">
            <div class="brand-content">
                <h1>Trenz'25</h1>
                <p>Spot Registration</p>
            </div>
        </div>
        <div class="login-section">
            <div class="registration-card">
                <a href="adminDashboard.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                <form id="registrationForm" enctype="multipart/form-data">
                    <div class="tabs-navigation">
                        <button type="button" class="tab-btn active" data-tab="personal-info">
                            <i class="fas fa-user"></i> Personal Info
                        </button>

                    </div>
                    <div class="tab-content active" id="personal-info">
                        <h3 class="form-section-title">Personal Information</h3>
                        <div class="form-group">
                            <div class="input-with-icon">
                                <input type="text" id="name" name="name" placeholder="Full Name" required>
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-with-icon">
                                <input type="email" id="email" name="email" placeholder="Email Address" required>
                                <i class="fas fa-envelope"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-with-icon">
                                <input type="text" id="regNumber" name="regNumber" placeholder="Register Number" required>
                                <i class="fas fa-id-card"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-with-icon">
                                <input type="text" id="department" name="department" placeholder="Department" required>
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-with-icon">
                                <input type="text" id="college" name="college" placeholder="College Name" required>
                                <i class="fas fa-university"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-with-icon">
                                <input type="tel" id="phone" name="phone" placeholder="Phone Number" required>
                                <i class="fas fa-phone"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="select-with-icon">
                                <select id="event1" name="event1" required>
                                    <option value="">Select Event 1</option>
                                    <option value="event1">Coding Challenge</option>
                                    <option value="event2">Web Design</option>
                                    <option value="event3">Tech Quiz</option>
                                    <option value="event4">Robotics</option>
                                </select>
                                <i class="fas fa-calendar-check"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="select-with-icon">
                                <select id="event2" name="event2" required>
                                    <option value="">Select Event 2</option>
                                    <option value="event1">Coding Challenge</option>
                                    <option value="event2">Web Design</option>
                                    <option value="event3">Tech Quiz</option>
                                    <option value="event4">Robotics</option>
                                </select>
                                <i class="fas fa-calendar-check"></i>
                            </div>
                        </div>


                        <div class="tab-buttons">

                            <button type="submit" class="login-btn primary-btn">
                                <i class="fas fa-check-circle"></i> Complete Registration
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
    <script>
        $(document).on('submit', '#registrationForm', function(e) {
            e.preventDefault();
            var Formdata = new FormData(this);
            Formdata.append("Add_newuser", true);

            $.ajax({
                url: "backend.php",
                method: "POST",
                data: Formdata,
                processData: false,
                contentType: false,
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    console.log(res);

                    if (res.status == 200) {
                        alert("Registered Successfully & Mail Sent!");
                        $('#registrationForm')[0].reset();
                    } else if (res.status == 201) {
                        alert("Registered Successfully but Mail not Sent!");
                        $('#registrationForm')[0].reset();
                    } else if (res.status == 500) {
                        alert("Something Went Wrong! Try Again.");
                    }
                }
            })
        });
    </script>

</body>

</html>