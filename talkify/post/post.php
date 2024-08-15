<?php 
    
    include '../connection.php';

    session_start();
    $user_id = $_SESSION['user-id'];
    
    $query = "SELECT * FROM users WHERE username='$user_id'";
    $result = $conn->query($query);
        
    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        $my_username = $row['username'];
        $my_email = $row['email'];
        // $my_password = $row['password'];
        // $my_fullname = $row['fullname'];
        // $my_birthdate = $row['birthdate'];
        // $my_bio = $row['bio'];
        // $my_gender = $row['gender'];
        $my_profile = $row['profile'];
        if($my_profile == "") {
            $my_profile = strtoupper(substr($my_username, 0, 1));
        }
        else {
            $my_profile = base64_encode($my_profile);
        }
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
    <link rel="stylesheet" href="post.css">
    <link rel="stylesheet" href="../common.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/solid.min.css">
    <title>Post</title>

</head>
<body>
    <div class="main-container">
        <div class="box">
            <div class="footer">
                <a href="../home/home.php"><i class="fas fa-home"></i><span>Home</span></a>
                <a href="../search/friends.php"><i class="fas fa-search"></i><span>Search</span></a>
                <a href="post.php" class="active"><i class="fas fa-circle-plus"></i><span>Post</span></a>
                <!-- <a href="#"><i class="fa-solid fa-message"></i><span>Chat</span></a> -->
                <a href="../profile/profile.php"><i class="fas fa-user"></i> <span>Profile</span></a>
            </div>
            <form method="post" id="postForm" autocomplete="off">
                <div class="post-header">
                    <span><a href="../home/home.php"><i class="fa fa-times" id="cross-mark"></i></a></span>
                    <p>Create a post</p>
                    <button id="post-btn">Post</button>
                </div>
                <p id="post-status" class="message"></p>
                <div class="post-body">
                    <div class="write-post">
                        <div class="profile-div">
                            <div class="profile-img">

                            </div>
                            <div class="username">
                                <input type="hidden" name="post-username" value="<?php echo $my_username; ?>">
                                <p><?php echo $my_username; ?></p>
                                <input type="hidden" name="post-visibility" id="post-privacy">
                                <span id="visibility" class="visibility">Public</span>
                            </div>
                        </div>
                        <div class="post-title">
                            <div class="wrapper">
                                <input type="file" id="file-input" accept="image/*" name="post-image" title="Select an image file">
                                <label for="file-input" class="label-ele">
                                  <i class="fas fa-image" title="Select an image file"></i>
                                </label>
                            </div>
                            <div class="post-img">

                            </div>
                            <p class="image-title">Select an Image file less than 1MB</p>
                            <i class="fa fa-times remove" title="Remove image file"></i>
                        </div>
                        <div class="write-post-head">
                            <div class="icon-container">
                                <span onclick="makeBold();"><i class="fa-solid fa-bold"></i></span>
                                <span onclick="makeItalic();"><i class="fa-solid fa-italic"></i></span>
                                <span onclick="clearText();"><i class="fa-solid fa-eraser"></i></span>
                                <span style="background: transparent;" onclick="window.location.href='../profile/view_post.php';"><i class="fa-solid fa-bars"></i></span>
                                <span style="background: transparent;"><i class="fa fa-image"></i></span>
                                <span style="background: transparent;"><i class="fa fa-video"></i></span>
                            </div>
                            <div class="textarea-container">
                                <textarea name="text-area" id="text-area" cols="30" rows="10" placeholder="What do you want to talk about?"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="col">
        <div id="img-wrap">
            <span class="loader"></span>
        </div>
    </div>

    <script src="post.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {    
    
    
        var imageData = "<?= $my_profile ?>";
    
        if (imageData.length === 1) {
            
            var h2Element = document.createElement('h2');
            h2Element.textContent = "<?php echo $my_profile; ?>"; 
            document.querySelector('.profile-img').appendChild(h2Element);
        } 
        else {
            
            var profilePhoto = document.createElement('img');
            profilePhoto.alt = "Profile";
            profilePhoto.id = "profile-photo";
            profilePhoto.src = 'data:image/jpeg;base64,' + imageData ;
            document.querySelector('.profile-img').appendChild(profilePhoto);
        }
        
  
    });
    
    var textArea = document.getElementById('text-area');
    function makeBold() {
        textArea.style.fontWeight = (textArea.style.fontWeight == 'bold') ? 'normal' : 'bold'; 
    }
    
    function makeItalic() {
        textArea.style.fontStyle = (textArea.style.fontStyle == 'italic') ? 'normal' : 'italic'; 
    }
    
    function clearText() {
        textArea.value = '';
    }

    </script>
</body>
</html>