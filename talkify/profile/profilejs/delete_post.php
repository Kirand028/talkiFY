<?php
    include '../../connection.php';
    // Check if the number is sent in the POST request
    if(isset($_POST['postID'])) {
        // Retrieve the number from the $_POST superglobal
        $post_id = $_POST['postID'];
        
        $dquery = "delete from post where post_id = $post_id";
        if($conn->query($dquery)) 
            echo '<p><span><i class="fa-solid fa-trash" style="color:green;"></i> Post deleted </span><i class="fa fa-times"></i></p>';
        else 
            echo '<p><span><i class="fa fa-warning" style="color:red;"></i> Oops! Some error occured</span><i class="fa fa-times"></i></p>';
           
    }
    else {
        echo '<p><span><i class="fa fa-warning" style="color:red;"></i> Oops! Refresh the page and Try</span><i class="fa fa-times"></i></p>';
    }
?>
