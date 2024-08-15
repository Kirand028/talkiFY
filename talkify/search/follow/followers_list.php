<?php 
    
    // include '../../connection.php';
        
    // $followee_username = $_GET['my-username'];
    // $query = "SELECT * FROM friends where followee = '".$followee_username."' or follower = '".$followee_username."'";
    // $result = $conn->query($query);
        
    // if ($result->num_rows > 0) {
    //     while($row = $result->fetch_assoc()) {
    //         $o_username = $row['follower'];
            
    //         $subquery = "SELECT profile,bio FROM users where username = '".$o_username."'";
    //         $subresult = $conn->query($subquery);
    //         $subrow = $subresult->fetch_assoc();
    //         $o_bio = $subrow['bio'];
    //         $o_profile = $subrow['profile'];
    //         if($o_profile == "") {
    //             $o_profile = strtoupper(substr($o_username, 0, 1));
    //         }
    //         else {
    //             $o_profile = base64_encode($o_profile);
    //         }
                
    //         echo '<div class="friend-list-container" id="friend-list-container">';
    //             echo '<div class="friend-photo">';
    //                 if(strlen($o_profile) < 2) {
    //                     echo '<h4>'.$o_profile.'</h4>';
    //                 }
    //                 else {
    //                     echo '<img src="data:image/jpeg;base64,'.$o_profile.'" alt="'.$o_username.'"/>';
    //                 }
                    
    //             echo '</div>';
    //             echo '<div class="friend-username followers">';
    //                 echo '<p>'.$o_username.'</p>';
    //                 $o_bio = ($o_bio != "")?$o_bio:"TalkiFY";
    //                 echo '<span>'.$o_bio.'</span>';
    //             echo '</div>';
    //             echo '<div class="followers-btn">';
    //                 echo '<button name="follow-btn" value="'.$o_username.'">Follow</button>';
    //                 echo '<button name="block-btn"  value="'.$o_username.'">Block</button>';
    //             echo '</div>';
    //         echo '</div>';
    //     }
    // }
    // else {
    //     echo '<p class="wrong-msg"><i class="fa fa-info-circle" style="color: #ff8f00;"></i>No followers</p>';;
    // }
?>
<?php 
include '../../connection.php';

// $followee_username = //$_GET['my-username'];

session_start();
$user_id = $_SESSION['user-id'];
$followee_username = $user_id;

$query = "SELECT DISTINCT f.follower, u.profile, u.bio
          FROM friends f
          JOIN users u ON (f.follower = u.username)
          WHERE (f.followee = '$followee_username' OR f.follower = '$followee_username')
                AND f.follower != '$followee_username'";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $o_username = $row['follower'];
        $o_bio = $row['bio'];
        $o_profile = $row['profile'];

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
                $mutual_friend = "select friends_id from friends where (follower = '$o_username' and followee = '$followee_username') or (followee = '$o_username' and follower = '$followee_username')";
                $mutual_result = $conn->query($mutual_friend);
                if($mutual_result->num_rows === 2) {
                    echo '<button name="follow-btn" value="'.$o_username.'" disabled>Mutual</button>';
                }
                else {
                    echo '<button name="follow-btn" value="'.$o_username.'" onclick="followHim(this);">Follow <i class="fa-solid fa-arrow-rotate-left"></i></button>';
                }
                echo '<button name="block-btn" value="'.$o_username.'">Block</button>';
            echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p class="wrong-msg"><i class="fa fa-info-circle" style="color: #ff8f00;"></i>No followers</p>';
}
?>
