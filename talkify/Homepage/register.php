<?php
    
    include '../connection.php';
    session_start();
    
    $reg_email = $_POST['reg-email'];
    $reg_password = $_POST['reg-password'];
    $reg_cpassword = $_POST['reg-cpassword'];
    $reg_username = $_POST['reg-username'];
    
    $reg_query = "SELECT username, email, password FROM users WHERE LOWER(username) = '" . strtolower($reg_username) . "' OR LOWER(email) = '" . strtolower($reg_email) . "'";
    $reg_result = $conn->query($reg_query);
    if($reg_result->num_rows > 0) {
        
        $reg_row = $reg_result->fetch_assoc();
        
        $his_username = $reg_row['username'];
        $his_email =  $reg_row['email'];
        
        if(strtolower($his_username) === strtolower($reg_username)) {
            echo 'Username is taken';
        }
        else if(strtolower($his_email) === strtolower($reg_email)) {
            echo 'Already registered with this email';
        }
    }
    else {
        
        if($reg_password !== $reg_cpassword) {
            echo 'Both password should match';
        }
        else if(strlen($reg_password) < 6) {
            echo 'password length should be atleast 6 characters long';
        }
        else {
            $bio_insert = "Hey there!, I am using talkify.";
            $ins_query = "insert into users(username, email, password, bio) values('$reg_username', '$reg_email', '$reg_password', '$bio_insert')";
            $ins_rslt = $conn->query($ins_query);
            if($ins_rslt) {
                echo 'success';
                $_SESSION['user-id'] = $reg_username;
            }
            else {
                echo 'Some error occured';
            }
        }
    }

?>