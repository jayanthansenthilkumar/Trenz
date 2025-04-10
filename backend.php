<?php
include "db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
if (isset($_POST['Add_newuser'])) {
    try {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $regNumber = mysqli_real_escape_string($conn, $_POST['regNumber']);
        $dept = mysqli_real_escape_string($conn, $_POST['department']);
        $college = mysqli_real_escape_string($conn, $_POST['college']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $events1 = mysqli_real_escape_string($conn, $_POST['event1']);
        $events2 = mysqli_real_escape_string($conn, $_POST['event2']);
        $transactiondate = mysqli_real_escape_string($conn, $_POST['transactionDate']);
        $transactionid = mysqli_real_escape_string($conn, $_POST['transactionId']);
        // File Upload
        $idcardName = $_FILES['Idcard']['name'];
        $idcardTmp = $_FILES['Idcard']['tmp_name'];
        move_uploaded_file($idcardTmp, "idcard/" . $idcardName);
        $paymentProofName = $_FILES['paymentProof']['name'];
        $paymentProofTmp = $_FILES['paymentProof']['tmp_name'];
        move_uploaded_file($paymentProofTmp, "paymentupload/" . $paymentProofName);

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
        $query = "INSERT INTO events (name,emailid,regno,depart,collegename,phoneno,events1,events2,idcard,date,transactionid,transactionreceipt) VALUES ('$name', '$email', '$regNumber', '$dept', '$college', '$phone', '$events1', '$events2','$idcardName' ,'$transactiondate', '$transactionid', '$paymentProofName')";

        if (mysqli_query($conn, $query)) {
            $last_id = mysqli_insert_id($conn); // Auto Increment ID

            $prefix = "TRENZ25";   
            $custom_id = $prefix . str_pad($last_id, 4, '0', STR_PAD_LEFT);  // Generate like TZ250001

            // Update trenzid
            $updateQuery = "UPDATE events SET Trenzid='$custom_id' WHERE id='$last_id'";
            mysqli_query($conn, $updateQuery);

            // Mail Send
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'tssakthi02@gmail.com'; // Your Gmail
                $mail->Password   = 'zkajpocfnuznirci'; // Gmail App Password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                $mail->setFrom('tssakthi02@gmail.com', 'Event Team');
                $mail->addAddress($email); // Send mail to registered user

                $mail->isHTML(true);
                $mail->Subject = "Event Registration Confirmation";
                $mail->Body    = "
                    Hello $name,<br><br>
                    You have successfully registered for the events:<br>
                    1. $events1 <br>
                    2. $events2 <br><br>
                    Thank you for registering.<br><br>
                    Regards,<br>
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

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM events WHERE Trenzid='$id'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $data = [
            'Trenzid'    => $row['Trenzid'],
            'name'  => $row['name'],
            'transactionid'    => $row['transactionid'],
            'date'      => $row['date'],
            'idcard'           => $row['idcard'],
            'paymentproof'  => $row['transactionreceipt']
        ];


        echo json_encode(['status' => 'success', 'data' => $data]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No Record Found']);
    }
}
