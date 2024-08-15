<?php

    include '../connection.php';
    session_start();
    @$user_id = $_SESSION['user-id'];
    @$follower_count = "select follower from friends where LOWER(followee) = '".strtolower($user_id)."'";
    
    $follower_Totalcount = "Wait";
    $followee_Totalcount = "Wait";
    $post_count = "Wait";
    
    @$follower_rslt = $conn->query($follower_count);
    if($follower_rslt) {
        $follower_Totalcount =  $follower_rslt->num_rows;
    }
    
    @$followee_count = "select followee from friends where LOWER(follower) = '".strtolower($user_id)."'";
    
    $followee_Totalcount = "Wait";
    @$followee_rslt = $conn->query($followee_count);
    if($followee_rslt) {
        $followee_Totalcount =  $followee_rslt->num_rows;
    }
    
    @$post_count = "select username from post where LOWER(username) = '".strtolower($user_id)."'";
    
    @$post_Totalcount = "Wait";
    $post_rslt = $conn->query($post_count);
    if($post_rslt) {
        $post_Totalcount =  $post_rslt->num_rows;
    }
    


?>