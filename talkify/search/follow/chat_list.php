<?php
    
    include '../../connection.php';
    
    session_start();
    $my_userName = $_SESSION['user-id'];
    
    // Selecting mutual friends using a subquery
    // $mutual_friends_query = "SELECT DISTINCT f1.follower 
    //                          FROM friends f1
    //                          INNER JOIN friends f2 ON f1.follower = f2.followee
    //                          WHERE f1.followee = '$my_userName'";
    
    
    $mutual_friends_query = "SELECT f1.follower AS follower
        FROM friends AS f1
        WHERE f1.followee = '$my_userName'
        AND f1.follower IN (
            SELECT followee
            FROM friends
            WHERE follower = '$my_userName'
        )";
    
    
    $mutual_friends_result = $conn->query($mutual_friends_query);
    
    if($mutual_friends_result->num_rows > 0) {
        while($row = $mutual_friends_result->fetch_assoc()) {
            $user_Name =  $row['follower'];
            
            $profile_query = "SELECT profile FROM users WHERE username = '$user_Name'";
            $profile_result = $conn->query($profile_query);
            $profile_row = $profile_result->fetch_assoc(); 
            $profile_img = $profile_row['profile'];
            if(empty($profile_row['profile'])) {
                $profile_img = strtoupper(substr($user_Name, 0, 1));
            }
            else {
                $profile_img = "data:image/jpeg;base64," . base64_encode($profile_img);
            }
            
            echo '<a class="chat-now" value="'.$user_Name.'" href="message.php?my-username='.base64_encode(htmlspecialchars($my_userName)).'&his-username='.base64_encode(htmlspecialchars($user_Name)).'">';
                echo '<div class="friend-list-container">';
                    echo '<div class="friend-photo">';
                    
                        if(strlen($profile_img) === 1) {
                            echo '<h4>'.$profile_img.'</h4>';   
                        } 
                        else {
                            echo '<img src="'.$profile_img.'" alt="'.$user_Name.'"/>';
                        }
                        
                    echo '</div>';
                    echo '<div class="friend-username">';
                            echo '<p>'.$user_Name.'</p>';
                            
                            $message_query = "select * from chats where (outgoing_username = '$my_userName' and incoming_username = '$user_Name') or (outgoing_username = '$user_Name' and incoming_username = '$my_userName') order by chat_id desc limit 1";
                            $message_rslt = $conn->query($message_query);
                            
                            if($message_rslt->num_rows > 0) {
                                $message_row = $message_rslt->fetch_assoc();
                                $chat_message = $message_row['message'];
                                echo "<span>$chat_message</span>";
                            }
                            else {
                                echo "<span>No message here yet, say Hi.</span>";
                            }
                    echo '</div>';
                echo '</div>';
            echo '</a>';
        }
    }
    
?>
