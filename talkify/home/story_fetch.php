<?php 
    
    include '../connection.php';
    include 'story_expire.php';
    session_start();
    $user_id = $_SESSION['user-id'];
    $query = "SELECT username, post_image, post_id FROM status where username != '$user_id'";
    $result = $conn->query($query);
        
    if ($result->num_rows > 0) {
        
        while($row=$result->fetch_assoc()) {
            
            $user_name = $row['username'];
            $story_id = $row['post_id'];
            $story_img = $row['post_image'];
            
            echo '<div class="status-container">';
            echo '<a href="story_viewer.php?storyId=' . $story_id . '">';
            
            if ($story_img != '') { 
                
                $img_data = base64_encode($story_img);
                $img_data = 'data:image/jpeg;base64,' . $img_data;
                echo '<img src="' . $img_data . '" alt="story">';
                
            } 
            else {
                echo strtoupper(substr($user_name, 0, 1));
            }
            
            echo '</a>';
            echo '<p>' . $user_name . '</p>';
            echo '</div>';

        }
    }

?>