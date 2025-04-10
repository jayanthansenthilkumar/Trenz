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
        move_uploaded_file($idcardTmp, "uploads/" . $idcardName);

        $paymentProofName = $_FILES['paymentProof']['name'];
        $paymentProofTmp = $_FILES['paymentProof']['tmp_name'];
        move_uploaded_file($paymentProofTmp, "paymentupload/" . $paymentProofName);

        $query = "INSERT INTO events (name,emailid,regno,depart,collegename,phoneno,events1,events2,idcard,date,transactionid,transactionreceipt) VALUES ('$name', '$email', '$regNumber', '$dept', '$college', '$phone', '$events1', '$events2','$idcardName' ,'$transactiondate', '$transactionid', '$paymentProofName')";

        if (mysqli_query($conn, $query)) {

            // Mail Send
            $mail = new PHPMailer(true);
        
            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = ''; // Your Gmail
                $mail->Password   = ''; // Gmail App Password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;
        
                $mail->setFrom('yourmail@gmail.com', 'Event Team');
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
                    'message' => 'User Added Successfully & Mail Sent'
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
?>
