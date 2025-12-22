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
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spot Registration - Trenz'26</title>
    <link href="./assets/images/trenz.png" rel="icon" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="login.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/tsparticles@2.12.0/tsparticles.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>
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
    <div id="tsparticles"></div>
    <div class="split-login-container">
        <div class="brand-section">
            <div class="brand-content">
                <h1>Trenz'26</h1>
                <p>Spot Registration</p>
            </div>
        </div>
        <div class="login-section">
            <div class="registration-card">
                <a href="adminDashboard.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                <form id="registrationForm" enctype="multipart/form-data">
                    <div class="tabs-navigation">
                        <button type="button" class="tab-btn active" data-tab="personal-info">
                            <i class="fas fa-user"></i> Spot Registration
                        </button>
                    </div>
                    <div class="tab-content active" id="personal-info">
                        <h3 class="form-section-title">Trenz'26 Spot Registration</h3>
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
                                <option value="">Select Event</option>
                                    <option value="WebWeave">Web Weave</option>
                                    <option value="NextGenStart">NextGen Start</option>
                                    <option value="AppAthon">App Athon</option>
                                    <option value="Error404NOTFOUND">Error : 404 NOT FOUND</option>
                                    <option value="CodeRewind">Code Rewind</option>
                                    <option value="CodeQuest">Code Quest</option>
                                    <option value="BuildaResume">Build a Resume</option>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="script.js"></script>
    <script>
        $(document).on('submit', '#registrationForm', function(e) {
            e.preventDefault();
            var Formdata = new FormData(this);
            Formdata.append("Onspot_newuser", true);
            Swal.fire({
            title: 'Please Wait...',
            text: 'Submitting your form',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading()
            }
        });
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
                        Swal.close();
                        swal.fire({
                            title: "Event Registered Successfully!",
                            text: "Your ID is: " + res.trenzid,
                            icon: "success",
                            button: "Okay",
                        });

                        $('#registrationForm')[0].reset();
                    } else if (res.status == 201) {
                        Swal.close();
                        swal.fire({
                            title: "Error!",
                            text: "Registered Successfully but Mail not Sent!",
                            icon: "error",
                            button: "Okay",
                        });

                        $('#registrationForm')[0].reset();
                    }
                    else if (res.status == 400) {
                        Swal.close();
                        Swal.fire({
                            title: "Registration Limit Reached!",
                            text: res.message,
                            icon: "error",
                            confirmButtonColor: '#e74c3c',
                            confirmButtonText: "Okay",
                        });
                    }
                    else if (res.status == 403) {
                        Swal.close();
                        Swal.fire({
                            title: "Registration Disabled!",
                            text: res.message,
                            icon: "warning",
                            confirmButtonColor: '#e74c3c',
                            confirmButtonText: "Okay",
                        });
                    }
                    else if (res.status == 500) {
                        Swal.close();
                        Swal.fire({
                            title: "Error!",
                            text: res.message || "Something went wrong!",
                            icon: "error",
                            confirmButtonColor: '#e74c3c',
                            confirmButtonText: "Okay",
                        });
                    }
                }
            })
        });
    </script>
    <script src="script.js"></script>
    <script src="animations.js"></script>
</body>
</html>