<?php

    include '../../connection.php';
    
    // Check if the request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $u_email = $_POST['email'];
        $u_password = $_POST['password'];
        
        $o_email = $_POST['f-email'];
        $o_password = $_POST['f-password'];
        
        // No changes made
        if ($o_email == $u_email && $o_password == $u_password) {
            
            echo '<i class="fas fa-exclamation-triangle" style="color:red;"></i>&nbsp; &nbsp; No Changes Made &nbsp; &nbsp;<i class="fa fa-times" style="margin-left: 15px"></i>';
        } 
        else {
            // Check if the updated email is already registered
            if ($o_email != $u_email) {
                $query = "SELECT email FROM users WHERE email = '".$u_email."'";
                $res_qry = $conn->query($query);
                
                if ($res_qry->num_rows > 0) { // Email already registered
                
                    echo '<i class="fas fa-exclamation-triangle" style="color:red;"></i>&nbsp; &nbsp; Someone Registered with this email &nbsp; &nbsp;<i class="fa fa-times" style="margin-left: 15px"></i>';
                } 
                else { // Email not registered
                
                    $u_query = "UPDATE users SET email = '".$u_email."', password = '".$u_password."' WHERE email = '".$o_email."'";
                    if ($conn->query($u_query)) { // Update successful
                
                        echo '<i class="fas fa-check-circle" style="color:green;"></i>&nbsp; &nbsp; Credentials Updated &nbsp; &nbsp;<i class="fa fa-times" style="margin-left: 15px"></i>'.','.$u_email.','.$u_password;
                    }
                }
            } 
            else { // Email not changed
                if ($o_password != $u_password) {
                    $u_query = "UPDATE users SET password = '".$u_password."' WHERE email = '".$o_email."'";
                    if ($conn->query($u_query)) { // Update successful
                        echo '<i class="fas fa-check-circle" style="color:green;"></i>&nbsp; &nbsp; Password Updated &nbsp; &nbsp;<i class="fa fa-times" style="margin-left: 15px"></i>'.','.$u_email.','.$u_password;
                    }
                } 
                else { // Only password changed
                    echo '<i class="fas fa-check-circle" style="color:green;"></i>&nbsp; &nbsp; Password Updated &nbsp; &nbsp;<i class="fa fa-times" style="margin-left: 15px"></i>'.','.$u_email.','.$u_password;
                }
            }
        }
    }
?>