<?php
    
    include '../connection.php';
    
    session_start();
    
    if($_SESSION['user-id'] == "") {
        echo '<script>window.location.href="../Homepage"</script>';
    }
    
    @$myUsername = base64_decode(htmlspecialchars_decode($_GET['my-username']));
    
    @$hisUsername = base64_decode(htmlspecialchars_decode($_GET['his-username']));
    
    @$profile_img_qry = "select profile,bio from users where username = '$hisUsername'";
    @$profile_img_rslt = $conn->query($profile_img_qry);
    @$profile_img_row =  $profile_img_rslt->fetch_assoc();
    
    @$profile_bio = $profile_img_row['bio'];
    @$profile_img = $profile_img_row['profile'];
    
?>