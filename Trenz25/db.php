<?php
    $conn=new mysqli("localhost","root","","trenz");
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
?>