<?php
    include '../../connection.php';
    
    session_start();
    
    if($_SESSION['user-id'] != ""&& $_GET['his-username'] != "") {
        $hisUsername = $_GET['his-username'];
        $myUsername = $_SESSION['user-id'];
        
        $follow_query = 'insert into friends(followee, follower) values("'.$hisUsername.'", "'.$myUsername.'")';
        $follow_result = $conn->query($follow_query);
        if($follow_result) {
            echo 'success';
        }
        
    } 
    else {
        echo "Something wemt Wrong";
    }
?>
