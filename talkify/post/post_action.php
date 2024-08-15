<?php 
    include '../connection.php';

    $post_username = $_POST['post-username'];
    $post_visibility = $_POST['post-visibility'];
    $post_description = $_POST['text-area'];
    
    $tableName = '';
    
    if($_GET['status'] == 'No') {
        $tableName = 'post';
    }
    else {
        $tableName = 'status';
    }
    
    // Check if either description or image is not null
    if (!empty($post_description) || !empty($_FILES['post-image']['tmp_name'])) {
        // Set the timezone to India (IST)
        date_default_timezone_set('Asia/Kolkata');
    
        // Get the current date and time
        $post_date = date('Y-m-d');
        $post_time = date('h:i A');
    
        // Check if image is not null and is of valid type
        if (!empty($_FILES['post-image']['tmp_name'])) {
            $image = $_FILES['post-image']['tmp_name'];
            $image_name = $_FILES['post-image']['name'];
            $image_type = $_FILES['post-image']['type'];
            $size = $_FILES['post-image']['size'] / 1024 / 1024; // Size in MB

            if (!in_array($image_type, ['image/png', 'image/jpg', 'image/jpeg']) || $size > 1) {
                $message = '<i class="fa fa-warning" style="color:red;"></i> &nbsp;&nbsp; Oops! Invalid file or file size exceeds limit &nbsp;&nbsp;<i class="fa fa-times" style="color:red;"></i>';
                echo $message;
                exit; // Stop execution
            }
            $image = addslashes(file_get_contents($image));
        } 
        else {
            $image = '';
            $image_name = '';
        }
    
        // Insert post into the database
        $insert_query = "INSERT INTO $tableName (username, privacy, description, post_image, post_date, post_time) 
                     VALUES ('$post_username', '$post_visibility', '$post_description', '$image', '$post_date', '$post_time')";
    
        if ($conn->query($insert_query)) {
            $image = "";
            $post_description = "";
            if($_GET['status'] == 'No') {
                $message = '<i class="fa fa-check-circle" style="color:green;"></i>&nbsp;&nbsp; Content Posted &nbsp;&nbsp;<i class="fa fa-times" style="color:red;"></i>';
                echo $message;
            }
            elseif($_GET['status'] == 'Yes'){
                $message = '<i class="fa fa-check-circle" style="color:green;"></i>&nbsp;&nbsp; Story Posted. Visible for 24 Hours.&nbsp;&nbsp;<i class="fa fa-times" style="color:red;"></i>';
                echo $message;
            }
        }
        else {
            $message = '<i class="fa fa-warning" style="color:red;"></i> &nbsp;&nbsp; Oops! Update error &nbsp;&nbsp;<i class="fa fa-times" style="color:red;"></i>';
            echo $message;
        }
    } 
    else {
        $message = '<i class="fa fa-warning" style="color:red;"></i> &nbsp;&nbsp; Select an image file or write something &nbsp;&nbsp;<i class="fa fa-times" style="color:red;"></i>';
        echo $message;
    }
?>
