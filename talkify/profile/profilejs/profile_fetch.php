<?php 

    include '../../connection.php';
    $username = $_POST['profile-username'];
    
    if($username!="") {
        
        $query = "SELECT profile FROM users WHERE username = '".$username."'";
        $result = $conn->query($query);
        if($result && $result->num_rows > 0) {
            $image = $result->fetch_assoc();
            $profile_fetch = base64_encode($image['profile']); // Encode image data to base64
            if($profile_fetch != "")
            {
                echo $profile_fetch;
            }
            else {
                echo strtoupper(substr($username, 0, 1));
            }
        }
    }
?>
