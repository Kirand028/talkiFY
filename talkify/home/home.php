<?php 
    
    include '../connection.php';
    session_start();
    
    @$user_id = $_SESSION['user-id'];
    
    @$query = "SELECT * FROM users WHERE username='$user_id'";
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
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="../common.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/solid.min.css">
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <title>Home</title>

</head>
<body>
    <div class="main-container">
        <div class="box">
            <div class="footer">
                <a href="home.php" class="active"><i class="fas fa-home"></i><span>Home</span></a>
                <a href="../search/friends.php"><i class="fas fa-search"></i><span>Search</span></a>
                <a href="../post/post.php" ><i class="fas fa-circle-plus"></i><span>Post</span></a>
                <!-- <a href="#"><i class="fas fa-comment"></i><span>Chat</span></a> -->
                <a href="../profile/profile.php"><i class="fas fa-user"></i><span>Profile</span></a>
            </div>
            <div class="main-head">
                <div class="img-container"></div>
                <div class="first-row">
                    <i class="fa-solid fa-rocket"></i>
                    <h3>
                        <span class="t">t</span>
                        <span class="a">a</span>
                        <span class="l">l</span>
                        <span class="k">k</span>
                        <span class="I-F-Y">iFY</span>
                    </h3>
                </div>
                <!-- <i class="fas fa-plane"></i> -->
            </div>
            <div class="post-main-div">
                <div class="greetings-div">
                    <div class="first-col">
                        <h1>Hello,</h1>
                        <p><?= $my_username?></p>
                    </div>
                    <div class="second-col">
                        <a href="../profile/profile.php"><h3 class="fas fa-cogs"></h3></a>
                    </div>
                </div>
                <form method="GET" class="post-submit" enctype="multipart/form-data">
                    <div class="status-section">
                        <div class="status-container">
                            <a href="../post/post.php?<?php echo 'status=Yes'; ?>"><i class="fas fa-plus"></i></a>  
                            <p>Add Story</p>
                        </div>
                        <div class="others-story" id="others-story">
                            
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
    <div id="col">
        <div id="img-wrap">
            <span class="loader"></span>
        </div>
    </div>
</body>
<script src="post_load.js"></script>
<script src="story_fetch.js"></script>
<script>

// function to change color
    function toggleIconClass(icon) {
      if (icon.classList.contains('far')) {
        icon.classList.remove('far');
        icon.classList.add('fas');
        icon.style.background = '#1e3c72';
        icon.style['-webkit-background-clip'] = 'text';
        icon.style['-webkit-text-fill-color'] = 'transparent';
      } else if (icon.classList.contains('fas')) {
        icon.classList.remove('fas');
        icon.classList.add('far');
      }
    }
    
    document.addEventListener('DOMContentLoaded', function() {    
    
        var loader = document.getElementById("col");
        loader.style.display = 'none';
        
        var imageData = "<?= $my_profile ?>";
    
        if (imageData.length === 1) {
            
            var h2Element = document.createElement('h2');
            h2Element.textContent = "<?php echo $my_profile; ?>"; 
            document.querySelector('.img-container').appendChild(h2Element);
            document.querySelector('.img-container').style.border = '2px solid #1e3c72'
        } 
        else {
            
            var profilePhoto = document.createElement('img');
            profilePhoto.alt = "Profile";
            profilePhoto.id = "profile-photo";
            profilePhoto.src = 'data:image/jpeg;base64,' + imageData ;
            document.querySelector('.img-container').appendChild(profilePhoto);
        }
        
    
    });
    
    

</script>

</html>