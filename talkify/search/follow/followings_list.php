<?php 
include '../../connection.php';

session_start();

$followee_username = $_SESSION['user-id'];//$_GET['my-username'];

$query = "SELECT DISTINCT followee FROM friends WHERE follower = '$followee_username'";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        
        $o_username = $row['followee'];
        
        $sub_query = "select bio, profile from users where username = '$o_username'";
        $sub_result = $conn->query($sub_query);
        
        $sub_row = $sub_result->fetch_assoc();
        $o_bio = $sub_row['bio'];
        $o_profile = $sub_row['profile'];

        if(empty($o_profile)) {
            $o_profile = strtoupper(substr($o_username, 0, 1));
        } else {
            $o_profile = base64_encode($o_profile);
        }
            
        echo '<div class="friend-list-container" id="'.$o_username.'">';
            echo '<div class="friend-photo">';
                if(strlen($o_profile) < 2) {
                    echo '<h4>'.$o_profile.'</h4>';
                } else {
                    echo '<img src="data:image/jpeg;base64,'.$o_profile.'" alt="'.$o_username.'"/>';
                }
            echo '</div>';
            echo '<div class="friend-username followers">';
                echo '<p>'.$o_username.'</p>';
                $o_bio = ($o_bio != "") ? $o_bio : "Hey there!, I'm using talkify.";
                echo '<span>'.$o_bio.'</span>';
            echo '</div>';
            echo '<div class="followers-btn">';
                echo '<button name="unfollow-btn" value="'.$o_username.'" onclick="unfollowHim(this)">Unfollow</button>';
                // echo '<button name="block-btn" value="'.$o_username.'">Block</button>';
            echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p class="wrong-msg"><i class="fa fa-info-circle" style="color: #ff8f00;"></i>No followings</p>';
}
?>
