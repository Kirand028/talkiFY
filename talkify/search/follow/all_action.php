<?php 
    
    include '../../connection.php';
        
    session_start();
    $my_username = $_SESSION['user-id']; //$_GET['my-username'];
    $query = "SELECT * FROM users where username <>'".$my_username."' Limit 20";
    $result = $conn->query($query);
        
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $o_username = $row['username'];
            // $o_email = $row['email'];
            // $my_password = $row['password'];
            // $my_fullname = $row['fullname'];
            // $my_birthdate = $row['birthdate'];
            // $my_bio = $row['bio'];
            // $my_gender = $row['gender'];
            $o_profile = $row['profile'];
            if($o_profile == "") {
                $o_profile = strtoupper(substr($o_username, 0, 1));
            }
            else {
                $o_profile = base64_encode($o_profile);
            }
            
            echo '<div class="user-container">';
                    
                    $mutual_friend = "select friends_id from friends where (follower = '$o_username' and followee = '$my_username') or (followee = '$o_username' and follower = '$my_username')";
                    $mutual_result = $conn->query($mutual_friend);
                    $areTheyMutualFriends = ($mutual_result->num_rows === 2)? true: false;
                    if($areTheyMutualFriends) {
                        echo '<p class="follows-you">Follows you</p>';
                    }
                    echo '<div class="user-photo">';
                        if(strlen($o_profile) > 1) {
                            echo '<img src="data:image/jpeg;base64,'.$o_profile.'" alt="">';
                        }
                        else {
                            echo '<h4>'.$o_profile.'<h4>';
                        }
                        echo '</div>';
                        echo '<div class="user-name">';
                            echo'<input type="text" readonly value="'.$o_username.'">';
                        echo '</div>';
                        echo '<div class="action-btn">';

                        if($areTheyMutualFriends) {
                            echo '<button name="unfollow-btn" value="'.$o_username.'" onclick="unfollowHim(this)">Unfollow</button>';
                        }
                        else {
                            echo '<button name="follow-btn" value="'.$o_username.'" onclick="followHim(this);">Follow <i class="fa-solid fa-arrow-rotate-left"></i></button>';
                        }
                        echo '</div>';
            echo '</div>';
            
        }
    }
    else {
        echo '<p class="wrong-msg"><i class="fa fa-info-circle" style="color: #ff8f00;"></i>No users at the top<span class="retry-btn" onclick="allTopUsersfn(1);">Retry</span></p>';
    }
?>