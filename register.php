<?php
include "db.php";
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
</head>

<body class="login-page">
    <div id="particles-js"></div>
    <div class="split-login-container">
        <div class="brand-section">
            <div class="brand-content">
                <h1>Trenz'25</h1>
                <p>Event Registration</p>
            </div>
        </div>
        <div class="login-section">
            <div class="registration-card">
                <form id="registrationForm" enctype="multipart/form-data">
                    <div class="tabs-navigation">
                        <button type="button" class="tab-btn active" data-tab="personal-info">
                            <i class="fas fa-user"></i> Personal Info
                        </button>
                        <button type="button" class="tab-btn" data-tab="payment-details">
                            <i class="fas fa-credit-card"></i> Payment
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
                        <div class="form-group">
                            <label for="Idcard">Upload ID card </label>
                            <div class="file-upload">
                                <input type="file" id="Idcard" name="Idcard" required>
                                <div class="upload-button">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span>Choose File</span>
                                </div>
                                <p class="file-name1">No file chosen</p>
                            </div>
                        </div>



                        <div class="tab-buttons">
                            <button type="button" class="next-tab primary-btn" data-next="payment-details">
                                Continue <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <div class="tab-content" id="payment-details">
                        <h3 class="form-section-title">Payment Details</h3>

                        <div class="qr-code-container">
                            <img src="" alt="Payment QR Code" class="qr-code">
                            <p>Scan to pay ₹200 for registration</p>
                        </div>

                        <div class="form-group">
                            <div class="input-with-icon">
                                <input type="date" id="transactionDate" name="transactionDate" required>
                                <i class="fas fa-calendar"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-with-icon">
                                <input type="text" id="transactionId" name="transactionId" placeholder="Transaction ID/Reference Number" required>
                                <i class="fas fa-receipt"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="paymentProof">Upload Payment Screenshot</label>
                            <div class="file-upload">
                                <input type="file" id="paymentProof" name="paymentProof" required>
                                <div class="upload-button">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span>Choose File</span>
                                </div>
                                <p class="file-name">No file chosen</p>
                            </div>
                        </div>

                        

                        <div class="tab-buttons">
                            <button type="button" class="prev-tab secondary-btn" data-prev="personal-info">
                                <i class="fas fa-arrow-left"></i> Previous
                            </button>
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