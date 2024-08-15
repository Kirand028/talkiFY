<?php


    include '../../connection.php';
    
    session_start();
    
    // Check if the request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $reference_email = $_POST['fh-email'];
        
        $n_username = $_POST['r-username'];
        $n_fullname = $_POST['r-fullname'];
        $n_dob = $_POST['r-dob'];
        $n_bio = $_POST['r-bio'];
        $n_gender = $_POST['r-gender'];
        
        $fetch_username = "select username from users where email = '".$reference_email."' ";
        $fetch_result = $conn->query($fetch_username);
        $fetch_row = $fetch_result->fetch_assoc();
        $fetched_un = $fetch_row['username'];
        
        // if reference is exists
        $query = "SELECT email FROM users WHERE email = '".$reference_email."'";
        $res_qry = $conn->query($query);
        if ($res_qry->num_rows > 0) {
            
            //check if the new username is taken or not 
            $query1 = "SELECT username FROM users WHERE username = '".$n_username."' and username <> '".$fetched_un."'";
            $res_qry1 = $conn->query($query1);
            if ($res_qry1->num_rows > 0) {
                echo '<i class="fas fa-exclamation-triangle" style="color:red;"></i>&nbsp; &nbsp; Username is Taken by other user <i class="fa fa-times" style="margin-left: 15px"></i>';
            }
            else {
                $u_query = "UPDATE users SET username = '".$n_username."', fullname = '".$n_fullname."',birthdate = '".$n_dob."',bio = '".$n_bio."', gender = '".$n_gender."' WHERE email = '".$reference_email."'";
                
                if ($conn->query($u_query)) { // Update successful
                    
                    $_SESSION['user-id'] = $n_username;
                    
                    $other_table1 = "update chats set outgoing_username = '$n_username' where outgoing_username = '$fetched_un'";
                    $other_table2 = "update friends set followee = '$n_username'where followee = '$fetched_un'";
                    $other_table3 = "update post set username = '$n_username' where username = '$fetched_un'";
                    $other_table4 = "update status set username = '$n_username' where username = '$fetched_un'";
                    $other_table5 = "update chats set incoming_username = '$n_username' where incoming_username = '$fetched_un'";
                    $other_table6 = "update friends set follower = '$n_username' where follower = '$fetched_un'";
                    
                    $conn->query($other_table1);
                    $conn->query($other_table2);
                    $conn->query($other_table3);
                    $conn->query($other_table4);
                    $conn->query($other_table5);
                    $conn->query($other_table6);
                    
                    echo '<i class="fas fa-check-circle" style="color:green;"></i>&nbsp; &nbsp; Details Updated <i class="fa fa-times" style="margin-left: 15px"></i>'.','.$n_username.','.$n_fullname.','.$n_dob.','.$n_bio.','.$n_gender;
                }
                else {
                    echo '<i class="fas fa-exclamation-triangle" style="color:red;"></i>&nbsp; &nbsp; Something went wrong, try again <i class="fa fa-times" style="margin-left: 15px"></i>';
                }
            }
        }
    }
?>