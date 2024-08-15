<?php
    
    
    include '../connection.php';
    
    session_start();
    
    $username = strtolower($_POST['log-email']);
    $password = $_POST['log-password'];
    
    $log_query = "select username, email, password from users where LOWER(email) = '$username' or LOWER(username) = '$username'";
    $log_rslt = $conn->query($log_query);
    
    if($log_rslt->num_rows > 0) {
        $log_row = $log_rslt->fetch_assoc();
        
        $user_name = $log_row['username'];
        $user_email = $log_row['email'];
        $user_password = $log_row['password'];
        
        if(($username === strtolower($user_name) || $username === strtolower($user_email)) && ($user_password === $password)) {
            
            $_SESSION['user-id'] = $user_name;
            echo 'success';
        }
        else {
            echo 'Username / Email and password does not correspond to each other.';
        }
        
    }
    else {
        echo 'Not registered with this Username / Email';
    }

?>