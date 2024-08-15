<?php
    
    include '../connection.php';
    
    date_default_timezone_set('Asia/Kolkata');
    
    // Calculate the date and time 24 hours ago
    $expiryDateTime = new DateTime('-24 hours', new DateTimeZone('Asia/Kolkata'));
    $expiryDate = $expiryDateTime->format('Y-m-d');
    $expiryTime = $expiryDateTime->format('H:i:s');
    
    // Query to delete expired stories
    $deleteQuery = "DELETE FROM status WHERE post_date < '$expiryDate' OR (post_date = '$expiryDate' AND post_time < '$expiryTime')";
    $conn->query($deleteQuery);
    

?>
