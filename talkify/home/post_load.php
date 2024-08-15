<?php

    include '../connection.php';
    
    session_start();
    
    $user_id = $_SESSION['user-id'];
    
    function fetchPostsFromDatabase($conn, $offset, $limit, $user_id) {
        // Prepare and execute SQL query
        $sql = "SELECT post_id, username, description, post_image, post_date, post_time FROM post WHERE username <> ? ORDER BY post_id DESC LIMIT ?, ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sii", $user_id, $offset, $limit);

        $stmt->execute();
        $result = $stmt->get_result();
        
        if (!$stmt) {
            die("Error: " . $conn->error); // Or use $stmt->error if available
        }
        echo $conn->error;
        
        // Check if the query was successful
        if (!$result) {
            // Handle error
            return false;
        }
        
        $sql_profile = "SELECT profile FROM users WHERE username = ?";
        $stmt_profile = $conn->prepare($sql_profile);
    
        // Fetch posts from the result set
        $posts = array();
        while ($row = $result->fetch_assoc()) {
            
            // Handle cases where post_image or description may be NULL
            if ($row['post_image'] === null || $row['post_image'] === "") {
                $row['post_image'] = ''; // Set an empty string if post_image is NULL
            } 
            else {
                // Encode the image data as base64
                $row['post_image'] = 'data:image/jpeg;base64,' . base64_encode($row['post_image']);
            }
            
            if ($row['description'] === null || $row['description'] === "") {
                $row['description'] = ''; // Set an empty string if description is NULL
            }
        
            // Fetch profile image for the user
            $stmt_profile->bind_param("s", $row['username']);
            $stmt_profile->execute();
            $result_profile = $stmt_profile->get_result();
        
            if ($result_profile->num_rows > 0) {
                
                // User profile exists
                $profile_row = $result_profile->fetch_assoc();
                if ($profile_row['profile'] === "" || $profile_row['profile'] === null) {
                
                    // If profile image is empty, assign a default profile image
                    $row['profile_image'] = strtoupper(substr($row['username'], 0, 1));
                } 
                else {
                
                    // Encode the profile image data as base64
                    $row['profile_image'] = 'data:image/jpeg;base64,' . base64_encode($profile_row['profile']);
                }
            } 
            else {
            
                // User profile doesn't exist, assign a default profile image
                $row['profile_image'] = strtoupper(substr($row['username'], 0, 1));
            }
        
            $posts[] = $row;
        }
    
    // Close statement
    $stmt_profile->close();

    return $posts;
    }
    
    // Usage example:
    $offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 5;
    $posts = fetchPostsFromDatabase($conn, $offset, $limit, $user_id);
    if ($posts !== false) {
        // Convert the fetched posts to JSON and echo it
        header('Content-Type: application/json');
        echo json_encode($posts);
        // $offset += 0;
        // $limit += 5;
    } 
    else {
        // Handle error
        echo "Failed to fetch posts.";
    }

?>
