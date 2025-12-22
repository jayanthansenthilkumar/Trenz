
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration - Trenz'25</title>
    <link href="./assets/images/trenz.png" rel="icon" type="image/png" sizes="16x16">
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
            <a href="index.html" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Home</a>
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
                        <!-- <div class="qr-code-container">
                            <img src="" alt="Payment QR Code" class="qr-code">
                            <p>Scan to pay ₹250 for registration</p>
                        </div> -->
                        <div class="account-details-container">
                            <h4>Bank Transfer Details</h4>
                            <div class="account-info">
                                <p><strong>Account Number:</strong> 924010014781681</p>
                                <p><strong>IFSC Code:</strong> UTIB0000123</p>
                                <p><strong>Account Name:</strong> M.KUMARASAMY COLLEGE OF ENGINEERING - FE HOD AC</p>
                                <p><strong>Bank Name:</strong> Karur Axis Bank</p>
                                <p><strong>Amount:</strong> ₹250</p>
                                <p><small>Please transfer the exact amount and save the transaction details</small></p>
                            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="script.js"></script>
    <script>
        $(document).on('submit', '#registrationForm', function(e) {
            e.preventDefault();
            var Formdata = new FormData(this);
            Formdata.append("Add_newuser", true);
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
                    // Safely try to parse JSON response
                    try {
                        var res = JSON.parse(response);
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
                            swal.fire({
                                title: "Error!",
                                text: "Registration limit for Your Register number",
                                icon: "error",
                                button: "Okay",
                            });

                            $('#registrationForm')[0].reset();
                        }
                        else if (res.status == 500) {
                            Swal.close();
                            swal.fire({
                                title: "Error!",
                                text: "Something went wrong!",
                                icon: "error",
                                button: "Okay",
                            });
                        }
                    } catch (e) {
                        // Handle JSON parse error
                        console.error("JSON Parse Error:", e);
                        console.log("Raw Response:", response);
                        Swal.close();
                        Swal.fire({
                            title: "Server Error",
                            text: "The server returned an invalid response. Please try again later or contact support.",
                            icon: "error",
                            button: "Okay",
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                    Swal.close();
                    Swal.fire({
                        title: "Connection Error",
                        text: "Could not connect to the server. Please check your internet connection and try again.",
                        icon: "error",
                        button: "Okay",
                    });
                }
            });
        });
    </script>

</body>

</html>