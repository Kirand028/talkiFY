<?php
include '../../connection.php';

function rfetchPosts($ruser_name, $conn) {
    // Prepare and execute SQL query
    // $sql = "SELECT post_image, username FROM post WHERE username = ? AND post_image IS NOT NULL ORDER BY post_id DESC";
    $sql = "SELECT post_image, username FROM post WHERE username = ? AND post_image IS NOT NULL AND post_image != '' ORDER BY post_id DESC LIMIT 15";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $ruser_name);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the query was successful
    if (!$result) {
        // Handle error
        return false;
    }

    // Fetch posts from the result set
    $rposts = array();
    while ($rrow = $result->fetch_assoc()) {
        // Add post object to $rposts array
        $rposts[] = array(
            'post_image' => 'data:image/jpeg;base64,' . base64_encode($rrow['post_image']),
            'username' => $rrow['username']
        );
    }

    return $rposts;
}

// Call the function
$ruser_name = $_GET['rpost_username'];

$rposts = rfetchPosts($ruser_name, $conn);
if ($rposts !== false) {
    // Convert the fetched posts to JSON and echo it
    header('Content-Type: application/json');
    echo json_encode($rposts);
} else {
    // Handle error
    echo "Failed to fetch posts.";
}
?>
