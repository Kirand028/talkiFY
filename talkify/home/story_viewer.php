<?php
                        
    include '../connection.php';
                        
    $story_ID = $_GET['storyId'];
                        
    $story_qry = 'select * from status where post_id = '.$story_ID;
    $st_rslt = $conn->query($story_qry);
    if($st_rslt->num_rows > 0) {
        
        $st_row = $st_rslt->fetch_assoc();
                            
        $st_img = $st_row['post_image'];
        $st_username = $st_row['username'];
        $st_desc = $st_row['description'];
        $st_time = $st_row['post_time'];
                            
        $profile_qry = 'select profile from users where username = "'.$st_username.'"';
        $pf_rslt = $conn->query($profile_qry);
        if($pf_rslt->num_rows > 0) {
            
            $pf_row = $pf_rslt->fetch_assoc();
            $profile = $pf_row['profile'];
            
            if($profile == "" || $profile == null) {
                $profile = '<h4 class="user-name-first">'.strtoupper(substr($st_username, 0, 1)).'</h4>';
            }
            else {
                $profile = '<img src="data:image/jpeg;base64,'.base64_encode($profile).'alt="Profile" />';
            }
        }
        
    }
                        
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Story</title>
    <link rel="stylesheet" href="story_viewer.css">
    <link rel="stylesheet" href="../common.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/solid.min.css">
    <link rel="icon" href="logo2.png">
</head>

<body>

    <div class="main-container">
        <div class="box"> 
            <div class="progress-1"></div>
            <div class="footer">
                <a href="../home/home.php"><i class="fas fa-home"></i><span>Home</span></a>
                <a href="../search/search.php"><i class="fas fa-search"></i><span>Search</span></a>
                <a href="../post/post.php"><i class="fas fa-circle-plus"></i><span>Post</span></a>
                <!-- <a href="#"><i class="fas fa-comment"></i><span>Chat</span></a> -->
                <a href="../profile/profile.php"><i class="fas fa-user"></i><span>Profile</span></a>
            </div>
            <div class="post-header">
                <span><a href="home.php"><i class="fas fa-angle-left"></i></a></span>
                <div class="profile-image">
                    <?= $profile?>
                </div>
                <div class="upload-details">
                    <p id="username"><?= $st_username ?></p>
                    <span id="uploadTime"><?= $st_time ?></span>
                </div>

            </div>
            <div class="story-container">
                <?php 
                    
                    if($st_img != '' || $st_img != null) {
                        echo'<div class="story-section">';
                            echo '<img src="data:image/jpeg;base64,'.base64_encode($st_img).'" alt="story"/>';
                        echo'</div>';
                        
                        if($st_desc != '' || $st_desc != null) {
                            echo'<div class="story-description" id="caption">';
                                echo'<p>'.$st_desc.'</p>';
                            echo'</div>';
                        }
                    }
                    elseif($st_desc != '' || $st_desc != null) {
                        echo'<div class="story-description" id="caption" style="min-height: -webkit-fill-available;">';
                            echo'<p>'.$st_desc.'</p>';
                        echo'</div>';
                    }
                ?>
            </div>
        </div>
    </div>


<script>

    // Redirect to home page after 15 seconds
    setTimeout(() => {
        window.location.href = "home.php";
    }, 10000);
    
</script>

</body>

</html>
