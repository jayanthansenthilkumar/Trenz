<?php
include "db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
if (isset($_POST['Add_Intra_newuser'])) {
    try {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $regNumber = mysqli_real_escape_string($conn, $_POST['regNumber']);
        $dept = mysqli_real_escape_string($conn, $_POST['department']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $events1 = mysqli_real_escape_string($conn, $_POST['event1']);
        
        $transactiondate = mysqli_real_escape_string($conn, $_POST['transactionDate']);
        $transactionid = mysqli_real_escape_string($conn, $_POST['transactionId']);
       
        $paymentProofName = $_FILES['paymentProof']['name'];
        $paymentProofTmp = $_FILES['paymentProof']['tmp_name'];
        move_uploaded_file($paymentProofTmp, "assets/payment/" . $paymentProofName);

        $checkQuery = "SELECT COUNT(*) AS total FROM events WHERE regno = '$regNumber'";
        $checkResult = mysqli_query($conn, $checkQuery);
        $row = mysqli_fetch_assoc($checkResult);

        if ($row['total'] > 0) {
            $res = [
                'status' => 400,
                'message' => 'Registration limit for Your Register number .'
            ];
            echo json_encode($res);
            exit;
        }
        $query = "INSERT INTO intramkce (name,emailid,regno,depart,phoneno,events1,date,transactionid,transactionreceipt) VALUES ('$name', '$email', '$regNumber', '$dept', '$phone', '$events1' ,'$transactiondate', '$transactionid', '$paymentProofName')";

        if (mysqli_query($conn, $query)) {
            $last_id = mysqli_insert_id($conn); // Auto Increment ID

            $prefix = "TRZFE";   
            $custom_id = $prefix . str_pad($last_id, 4, '0', STR_PAD_LEFT);  // Generate like TZ250001

            // Update trenzid
            $updateQuery = "UPDATE intramkce SET Trenzid='$custom_id' WHERE id='$last_id'";
            mysqli_query($conn, $updateQuery);

            // Mail Send
            $mail = new PHPMailer(true);    

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'trenz2k25@gmail.com'; // Your Gmail
                $mail->Password   = 'ikoximjgvynasved'; // Gmail App Password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                $mail->setFrom('trenz2k25@gmail.com', 'Trenz2k25');
                $mail->addAddress($email); // Send mail to registered user

                $mail->isHTML(true);
                $mail->Subject = "Event Registration Confirmation";
                $mail->Body = "Hello $name,<br><br>
                    Your Trenzid: $custom_id<br>
                    You have successfully registered for the events:<br>
                     $events1 <br><br>
                    Thank you for registering.<br><br>
                    Regards,<br><br>
                    Event Team";
                $mail->send();

                $res = [
                    'status' => 200,
                    'message' => 'User Added Successfully & Mail Sent',
                    'trenzid' => $custom_id,
                ];
            } catch (Exception $e) {
                $res = [
                    'status' => 201,
                    'message' => 'User Added Successfully but Mail Sending Failed'
                ];
            }
        } else {
            throw new Exception('Query Failed: ' . mysqli_error($conn));
        }
        echo json_encode($res);
    } catch (Exception $e) {
        $res = [
            'status' => 500,
            'message' => 'Error: ' . $e->getMessage()
        ];
        echo json_encode($res);
    }
}

if(isset($_GET['get_user'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM intramkce WHERE Trenzid='$id'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $data = [
            'Trenzid'=> $row['Trenzid'],
            'name'=> $row['name'],
            'transactionid'=> $row['transactionid'],
            'date'=> $row['date'],
            'paymentproof'=> $row['transactionreceipt'],
            'email'=> $row['emailid'],
            'phoneno'=> $row['phoneno'],
            
        ];


        echo json_encode(['status' => 'success', 'data' => $data]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No Record Found']);
    }
}

if (isset($_POST['approve_user'])) {
    $apid = mysqli_real_escape_string($conn, $_POST['ids']);
    $sql = "UPDATE intramkce SET status ='1' WHERE id='$apid'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        mysqli_commit($conn);
        echo json_encode(['status' => 200]);
    }
    else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['Onspot_newuser'])) {
    try {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $regNumber = mysqli_real_escape_string($conn, $_POST['regNumber']);
        $dept = mysqli_real_escape_string($conn, $_POST['department']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $events1 = mysqli_real_escape_string($conn, $_POST['event1']);
        
        $checkQuery = "SELECT COUNT(*) AS total FROM events WHERE regno = '$regNumber'";
        $checkResult = mysqli_query($conn, $checkQuery);
        $row = mysqli_fetch_assoc($checkResult);

        if ($row['total'] > 0) {
            $res = [
                'status' => 400,
                'message' => 'Registration limit for Your Register number .'
            ];
            echo json_encode($res);
            exit;
        }
        $query = "INSERT INTO intramkce (name,emailid,regno,depart,phoneno,events1,status) VALUES ('$name', '$email', '$regNumber', '$dept', '$phone', '$events1','2')";

        if (mysqli_query($conn, $query)) {
            $last_id = mysqli_insert_id($conn); // Auto Increment ID

            $prefix = "TRZFE";   
            $custom_id = $prefix . str_pad($last_id, 4, '0', STR_PAD_LEFT);  // Generate like TZ250001

            // Update trenzid
            $updateQuery = "UPDATE intramkce SET Trenzid='$custom_id' WHERE id='$last_id'";
            mysqli_query($conn, $updateQuery);

            // Mail Send
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'trenz2k25@gmail.com'; // Your Gmail
                $mail->Password   = 'ikoximjgvynasved'; // Gmail App Password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                $mail->setFrom('trenz2k25@gmail.com', 'Trenz2k25');
                $mail->addAddress($email); // Send mail to registered user

                $mail->isHTML(true);
                $mail->Subject = "Event Registration Confirmation";
                $mail->Body = '
                <html>
                <head>
                    <style>
                    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap");

                    body {
                        margin: 0;
                        padding: 0;
                        background-color: #f5f7fa;
                        font-family: "Poppins", sans-serif;
                    }

                    .container {
                        max-width: 650px;
                        background: #ffffff;
                        margin: 40px auto;
                        border-radius: 10px;
                        padding: 40px;
                        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
                    }

                    h2 {
                        color: #333;
                        margin-bottom: 10px;
                    }

                    p {
                        color: #555;
                        font-size: 15px;
                        line-height: 1.6;
                    }

                    .highlight {
                        color: #111;
                        font-weight: 600;
                    }

                    .events-list {
                        background: #f1f5ff;
                        padding: 10px 15px;
                        border-radius: 5px;
                        margin-top: 5px;
                        color: #000;
                    }

                    .info-box {
                        background-color: #fff6e5;
                        border-left: 4px solid #ffc107;
                        padding: 15px;
                        margin: 25px 0;
                        border-radius: 6px;
                        font-size: 14px;
                    }

                    .footer {
                        font-size: 13px;
                        color: #888;
                        margin-top: 40px;
                        text-align: center;
                    }

                    .btn {
                        display: inline-block;
                        background-color: #0056b3;
                        color: #fff !important;
                        padding: 10px 20px;
                        text-decoration: none;
                        border-radius: 6px;
                        margin-top: 20px;
                        font-weight: 600;
                        font-size: 14px;
                    }
                    </style>
                </head>
                <body>
                    <div class="container">
                    <h2>Welcome, <span class="highlight">$name</span>! 🎉</h2>
                    <p>We\'re thrilled to confirm your registration for <strong>Trenzid</strong>.</p>

                    <p><strong>Your Unique Trenzid ID:</strong><br>
                    <span class="highlight">$custom_id</span></p>

                    <p><strong>Events You have Registered For:</strong></p>
                    <div class="events-list">
                        $events1
                    </div><br>

                    <div class="info-box">
                        <strong>Reminder:</strong> Please reach the event venue 20 minutes before your first session starts. Bring a valid ID and your confirmation email.
                    </div>

                    <p>Looking forward to seeing your enthusiasm and energy. Be ready to explore, engage, and excel!</p>

                    <a href="https://trenz.prisoltech.com" class="btn">Visit Site</a>

                    <div class="footer">
                        <p>Need help? Reach us at <a href="mailto:trenz2k25@gmail.com">trenz2k25@gmail.com</a><br>
                        or call +91 97918 52116</p>
                        <p>Trenz2k25 Event Team</p>
                    </div>
                    </div>
                </body>
                </html>';

                $mail->send();

                $res = [
                    'status' => 200,
                    'message' => 'User Added Successfully & Mail Sent',
                    'trenzid' => $custom_id,
                ];
            } catch (Exception $e) {
                $res = [
                    'status' => 201,
                    'message' => 'User Added Successfully but Mail Sending Failed'
                ];
            }
        } else {
            throw new Exception('Query Failed: ' . mysqli_error($conn));
        }
        echo json_encode($res);
    } catch (Exception $e) {
        $res = [
            'status' => 500,
            'message' => 'Error: ' . $e->getMessage()
        ];
        echo json_encode($res);
    }
}
