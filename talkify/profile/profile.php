<?php 
    
    // session_start();
    include '../connection.php';
    include 'follower_count.php';
    
    @$user_id = $_SESSION['user-id'];
    
    $query = "SELECT * FROM users WHERE username='$user_id'";
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
    }
    else {
        echo '<script>window.location.href="../Homepage/";</script>';
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="../common.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/solid.min.css">
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <title>Profile</title>

</head>
<body>
    <div class="main-container">
        <div class="box">
            <div class="footer">
                <a href="../home/home.php"><i class="fas fa-home"></i><span>Home</span></a>
                <a href="../search/friends.php"><i class="fas fa-search"></i><span>Search</span></a>
                <a href="../post/post.php" ><i class="fas fa-circle-plus"></i><span>Post</span></a>
                <!-- <a href="#"><i class="fas fa-comment"></i><span>Chat</span></a> -->
                <a href="profile.php" class="active"><i class="fas fa-user"></i><span>Profile</span></a>
            </div>
            <div class="profile-body">
                <div id="profile-message"></div>
                <div class="profile-and-follower-details">
                    <div class="profile-photo-section">
                        <div class="profile-photo">
                            <form method="post" id="profile-form" enctype="multipart/form-data">
                                <input type="hidden" value="<?php echo $my_username; ?>" name="profile-username" id="profile-username">
                                <input type="hidden" value="<?php echo $my_email; ?>" name="profile-email" id="profile-email">                            
                                <input style="display:none" type="file" id="my-file" name="profile-img">
                                <div class="pr-image" onclick="document.getElementById('my-file').click()">

                                </div>
                                <div class="change-pen" onclick="document.getElementById('my-file').click()"><i class="fa fa-pen"></i></div>
                                <button class="save-btn" name="profile-set"><i class="fa fa-check"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="follower-details-section">
                        <div class="username-bio">
                            <h3 id="head-username"><?php echo $my_username;?></h3>
                            <p><?php echo $my_bio; ?></p>
                        </div>
                        <div class="follower-details">
                            <div class="total-followers">
                                <span><?= $follower_Totalcount ?></span>
                                <p>Followers</p>
                            </div>
                            <div class="total-following">
                                <span><?= $followee_Totalcount ?></span>
                                <p>Followings</p>
                            </div>
                            <div class="total-posts">
                                <span><?= $post_Totalcount ?></span>
                                <p>Posts</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="login-details-section">
                    <div class="edit-button">
                        <button class="update-basic-head" id="showRecentPost"  onclick="showRecentPostDiv();"><i class="fas fa-file-alt"></i> &nbsp;&nbsp;Your Recent Post &nbsp;<i class="fa fa-angle-down"></i></button>
                    </div>        
                    <form method="GET" id="postForm">
                        <a href="view_post.php" class="view-all-post-link">view all</a>
                        <div class="post-image-container">

                            <ul class="rpost-section">
                                
                            </ul>

                        
                        </div>
                        
                    </form>
                </div>
                 
                <div class="input-fields-section">
                    <div class="edit-button">
                        <button class="update-basic-head" id="drop-down" onclick="showUpdateDiv();"><i class="fa fa-user"></i> &nbsp;&nbsp;Update profile &nbsp;<i class="fa fa-angle-down"></i></button>
                        <button class="edit" id="edit" onclick="makeEditable();"><i class="fa fa-pen"></i></button>
                    </div>
                    <form method="post" id="updateForm" autocomplete="off">
                        <p id="error-message" class="error-message"></p>
                        <div class="input-fields">
                            <div class="input-container">
                                <input type="hidden" id="fh-email" value="<?php echo $my_email; ?>" name="fh-email" readonly>
                                <label for="r-username">Username</label>
                                <input type="text" class="editable" id="r-username" name="r-username" value="<?php echo $my_username;?>" readonly required>
                            </div>
                            <div class="input-container">
                                <label for="r-fullname">Full Name</label>
                                <input type="text" class="editable" id="r-fullname" name="r-fullname" value="<?php echo $my_fullname; ?>" readonly>
                            </div>
                            <div class="input-container">
                                <label for="r-dob">Birth Date</label>
                                <input type="date" class="editable" id="r-dob" name="r-dob" value="<?php echo $my_birthdate; ?>" readonly>
                            </div>
                            <div class="input-container">
                                <label for="r-bio">Short Bio</label>
                                <input type="text" class="editable" id="r-bio" name="r-bio" value="<?php echo $my_bio; ?>" readonly>
                            </div>
                            <!-- <div class="input-container">
                                <label for="bio">Short Bio</label>
                                <input type="text" class="editable" name="bio" value="" readonly>
                            </div> -->
                            <div class="input-container">
                                <label for="r-gender">gender</label>
                                <select class="editable" id="sel" name="r-gender" disabled>
                                    <option><?php echo $my_gender; ?></option>
                                    <?php 
                                        if($my_gender == 'Male') {
                                            echo '<option>Female</option>
                                                  <option>Unspecify</option>';
                                        }
                                        elseif($my_gender == 'Female') {
                                            echo '<option>Male</option>
                                            <option>Unspecify</option>';
                                        }
                                        else {
                                            echo '<option>Male</option>
                                            <option>Female</option>';
                                        }
                                    ?>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="update-btn"><button id="update" name="r-save" disabled>Save</button></div>
                    </form>
                </div>
                <div class="login-details-section">
                    <div class="edit-button">
                        <button class="update-basic-head" id="drop-down" onclick="showLoginUpdateDiv();"><i class="fa fa-lock"></i> &nbsp;&nbsp;Password and security &nbsp;<i class="fa fa-angle-down"></i></button>
                        <button class="edit" id="log-edit" onclick="makeEditableLogin();"><i class="fa fa-pen"></i></button>
                    </div>        
                    <form method="POST" id="logForm">
                        <p id="login-error" class="error-message"></p>
                        <div class="log-details">
                            <div class="input-container">
                                <label for="username">Email</label>
                                <input type="hidden" id="f-email" value="<?php echo $my_email; ?>" name="f-email" readonly>
                                <input type="hidden" id="f-password" value="<?php echo $my_password; ?>" name="f-password" readonly>
                                <input type="email" id="log-email" value="<?php echo $my_email; ?>" name="email" readonly required >
                            </div>
                            <div class="input-container">
                                <label for="username">Password &nbsp; <i class="fa-solid fa-eye" id="togglePassword"></i></label>
                                <input type="password" id="log-password" value="<?php echo $my_password; ?>" name="password" readonly required>
                            </div>
                        </div>
                        <div class="update-btn"><button id="log-update" name="log-update" disabled>Save</button></div>
                    </form>
                </div>
                <div class="out-feed-help-section">
                    <div class="edit-button">
                        <button class="update-basic-head" id="delete-acc" onclick="deleteConfirm();"><i class="fa fa-trash-alt"></i> &nbsp;&nbsp;Delete Account &nbsp;</button>                        
                    </div>
                    <form action="#" method="post" id="deleteForm">
                        <div class="delete-confirm">
                            <button name="delete" class="delete-button" id="dtbt" disabled><i class="fa fa-trash"></i> <span>Delete Anyway</span></button>
                            <p><i class="fa fa-warning" style="color: #c35300"></i> &nbsp;All the data will be deleted with your account</p>
                        </div>
                    </form>
                </div>
                <div class="out-feed-help-section">
                    <div class="edit-button">
                        <button class="update-basic-head" onclick=""><i class="fa fa-phone"></i> &nbsp;&nbsp;Help & Support &nbsp;</button>
                    </div>
                </div>
                <div class="out-feed-help-section">
                    <div class="edit-button">
                        <button class="update-basic-head" onclick=""><i class="fa fa-message"></i> &nbsp;&nbsp;Feedback &nbsp;</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="col">
        <div id="img-wrap">
            <span class="loader"></span>
        </div>
    </div>
    
    <script src="profilejs/profile.js"></script>
    <script src="profilejs/log_profile.js"></script>
    <script src="profilejs/profile_photo.js"></script>
    <script src="profilejs/profile_details.js"></script>
    <script src="profilejs/recent_post.js"></script>
</body>
</html>