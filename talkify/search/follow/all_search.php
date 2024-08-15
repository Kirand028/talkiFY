<?php 
    
    include '../../connection.php';
        
    session_start();    
    $myUsername = $_SESSION['user-id'];//$_GET['my-username'];
    $search_username = $_POST['search-username'];
    // echo $search_username.'ksksksksk';
    $query = "SELECT * FROM users where username like '%".$search_username."%'";
    $result = $conn->query($query);
        
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $o_username = $row['username'];
            // $o_email = $row['email'];
            // $my_password = $row['password'];
            // $my_fullname = $row['fullname'];
            // $my_birthdate = $row['birthdate'];
            $o_bio = $row['bio'];
            // $my_gender = $row['gender'];
            $o_profile = $row['profile'];
            if($o_profile == "") {
                $o_profile = strtoupper(substr($o_username, 0, 1));
            }
            else {
                $o_profile = base64_encode($o_profile);
            }
            
            echo '<div class="friend-list-container">';
                echo '<div class="friend-photo">';
                    if(strlen($o_profile) > 1) {
                        echo'<img src="data:image/jpeg;base64,'.$o_profile.'" alt="'.$o_username.'">';
                    }
                    else {
                        echo '<h4>'.$o_profile.'</h4>';
                    }
                echo '</div>';
                echo '<div class="friend-username followers">';
                    echo '<p>'.$o_username.'</p>';
                    $o_bio = ($o_bio != "")?$o_bio:"Hey there!, I'm using talkify.";
                    echo '<span>'.$o_bio.'</span>';
                echo '</div>';
                echo '<div class="followers-btn">';
                    $mutual_friend = "select friends_id from friends where (follower = '$o_username' and followee = '$myUsername') or (followee = '$o_username' and follower = '$myUsername')";
                    $mutual_result = $conn->query($mutual_friend);
                    if($mutual_result->num_rows === 2) {
                        echo '<button name="follow-btn" value="'.$o_username.'" disabled>Mutual</button>';
                        echo '<button name="unfollow-btn" value="'.$o_username.'" onclick="unfollowHim(this)">Unfollow</button>';
                    }
                    else {
                        echo '<button name="follow-btn" value="'.$o_username.'" onclick="followHim(this);">Follow <i class="fa-solid fa-arrow-rotate-left"></i></button>';
                    }
                    // echo '<button name='.$o_username.'>Follow</button>';
                    // echo '<button name="'.$o_username.'">Block</button>';
                echo '</div>';
            echo '</div>';
            
        }
    }
    else {
        echo '<p class="wrong-msg"><i class="fa fa-warning" style="color: #ff8f00;"></i>Username not found<span class="retry-btn" onclick="searchUserfn();">Retry</span></p>';
    }
?>