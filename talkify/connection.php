<?php 

    $servername = "localhost";
    $username = "id21676769_talkify";
    $password = "Talkify 123&";
    $dbname = "id21676769_talkify";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
?>