<?php 
    
    include '../connection.php';
    session_start();
    
    @$user_id = $_SESSION['user-id'];
    @$query = "SELECT * FROM users WHERE username='$user_id'";
    @$result = $conn->query($query);
        
    if (@$result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        $my_username = $row['username'];
        $my_email = $row['email'];
        $my_password = $row['password'];
        $my_fullname = $row['fullname'];
        $my_birthdate = $row['birthdate'];
        $my_bio = $row['bio'];
        $my_gender = $row['gender'];
        $my_profile = 'data:image/jpeg;base64,' . base64_encode($row['profile']);
    }
    else {
        echo '<script>window.location.href="../Homepage"</script>';
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recent Posts</title>
    <link rel="stylesheet" href="view_post.css">
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
            <div class="footer">
                <a href="../home/home.php"><i class="fas fa-home"></i><span>Home</span></a>
                <a href="../search/friends.php"><i class="fas fa-search"></i><span>Search</span></a>
                <a href="../post/post.php"><i class="fas fa-circle-plus"></i><span>Post</span></a>
                <!-- <a href="#"><i class="fas fa-comment"></i><span>Chat</span></a> -->
                <a href="../profile/profile.php" class="active"><i class="fas fa-user"></i><span>Profile</span></a>
            </div>
            <div class="post-header">
                <span><a href="profile.php"><i class="fa fa-times"></i></a></span>
                <p><?= $my_username; ?></p>
                <a href=""></a>
            </div>
            <div class="post-estatus" onclick="clearPostStatus()"></div>
            <div class="post-container">
                <?php
                    
                    $pquery = "SELECT * FROM post WHERE username='$my_username' order by post_id DESC";
                    $presult = $conn->query($pquery);
        
                    if ($presult->num_rows > 0) {
                        
                        while($prow = $presult->fetch_assoc()) {
                            echo '<div class="post-div" id="id'.$prow["post_id"].'">
                                <div class="user-info">
                                    <div class="user-image">';
                                    if($row["profile"] === null || $row["profile"] === "") {
                                        echo strtoupper(substr($my_username, 0, 1));
                                        echo '<style>.user-image{ border: 1px solid #1e3c72; }</style>';
                                    }
                                    else {
                                        echo'<img src="'.$my_profile.'" alt="Posted by'.$my_username.'">';
                                    }
                               echo'</div>
                                    <div class="user-name-date">
                                        <h5>'.$my_username.'</h5>
                                        <p>'.$prow["post_date"].' <span>&nbsp; |&nbsp; '.$prow["post_time"].'</span> </p>
                                    </div>
                                    <button class="ellipsis-button" onclick="showActionOptions(this);"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                                    <div class="ellipsis-options">
                                            <button onclick="deletePost('.$prow["post_id"].')" name="'.$prow["post_id"].'">Delete</button>
                                            <button name="'.$prow["post_id"].'">Share</button>
                                            <button name="'.$prow["post_id"].'">Save</button>
                                    </div>
                                </div>
                                
                                <div class="post-details">';
                                if($prow["description"] != "") {
                                    echo'<div class="post-description">
                                           <p>'.$prow["description"].'</p>
                                         </div>';
                                }
                                if($prow["post_image"] !=null || $prow["post_image"] != "") {
                                    echo '<div class="post-image">
                                            <img src="'.'data:image/jpeg;base64,' . base64_encode($prow["post_image"]).'" alt="Posted By '.$my_username.'">
                                         </div>';
                                }
                                echo '</div>
                                <div class="post-likes">
                                    <div class="l-c-s">
                                        <p class="gradient-icon heart"><i class="far fa-heart" onclick="toggleIconClass(this)"></i></p>
                                        <p class="gradient-icon"><i class="far fa-comment"></i></p>
                                        <p class="gradient-icon"><i class="fas fa-share"></i></p>
                                    </div>
                                    <div class="water-mark">
                                        <p class="posted-on">posted on <span class="wm-talk">talk</span><span class="wm-ify">iFy</span>
                                        </p>
                                    </div>
                                </div>
                            </div>';
                        }
                    }
                    else {
                        echo '<img src="result_not_found.jpg" alt="No Posts" style="width:275px; height: 275px;"/>';
                        echo '<h5 style="margin-top:5%;">No Posts &nbsp;<a href="../post/post.php" style="color: #1e3c72; font-weight: 300;">Create One</a></h5>';
                    }
                    
                ?>
            </div>
        </div>
    </div>
    <script>

        // function to change color
        function toggleIconClass(icon) {
            icon.classList.toggle("fas");
        }

        function showActionOptions(button) {
            const ellipsisOptions = button.nextElementSibling;
            ellipsisOptions.classList.toggle("open");
        }
        
        var postStatus = document.querySelector(".post-estatus");
        function deletePost(postID) {
            
            var parentElement = document.querySelector(".post-container");
            var divToRemove = document.querySelector("#id" + postID);
            
            
            var xhr = new XMLHttpRequest();
            
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Request successful, handle response
                        // console.log(xhr.responseText);
                        postStatus.style.display = "flex";
                        postStatus.innerHTML = xhr.responseText;
                        if (parentElement && divToRemove) {
                            parentElement.removeChild(divToRemove);
                        } else {
                            console.error("Parent element or div to remove not found.");
                        }
                    } else {
                        // Error handling
                        console.error('Error:', xhr.status);
                    }
                }
            };
        
            xhr.open('POST', 'profilejs/delete_post.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Set content type to application/x-www-form-urlencoded
            xhr.send('postID=' + encodeURIComponent(postID));
        }
        
        function clearPostStatus() {
            postStatus.innerHTML = '';
            postStatus.style.display = "none";
        }

    </script>  
</body>

</html>