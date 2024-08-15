<?php
    
    include '../../connection.php';
    
    $outgoing_userName = $_POST['outgoing_id'];
    $incoming_userName = $_POST['incoming_id'];
    $message = $_POST['message'];
    
    date_default_timezone_set('Asia/Kolkata');

    // Get the current date and time in 12-hour format with AM/PM
    $current_time = date('h:i:s A');
    
    // Get the current date
    $current_date = date('Y-m-d');
    
    // Display the current time and date
    // echo "Current Indian Time: $current_time<br>";
    // echo "Current Indian Date: $current_date";
    
    
    // echo $outgoing_userName."  ".$incoming_userName."  ".$message;
    
    $message_insert = "insert into chats(outgoing_username, incoming_username, message, mdate, mtime) values('$outgoing_userName','$incoming_userName', '$message','$current_date', '$current_time')";
    
    if($conn->query($message_insert)) {
        echo 'Success';
    }
    else {
        echo 'what ?';
    }
    
?>