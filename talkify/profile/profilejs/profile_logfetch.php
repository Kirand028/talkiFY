<?php

    include '../../connection.php';
    
    $user_email = $_POST['profile-email'];
    $query = "select email, password from users where email = '".$user_email."'";
    
    $res_q = $conn->query($query);
    if($res_q->num_rows > 0) {
        $row = $res_q->fetch_assoc();
        $userEmail = $row['email'];
        $userPassword  = $row['password'];
        echo  $userEmail. ',' .$userPassword;
    }
    
?>