document.addEventListener('DOMContentLoaded', function() {   
    
    var otherStory = document.getElementById('others-story');

    // Create a new XMLHttpRequest object
    var xreq = new XMLHttpRequest();
    
    // Define the function to handle the response
    xreq.onreadystatechange = function() {
        if (xreq.readyState == XMLHttpRequest.DONE) {
            if (xreq.status == 200) {
                otherStory.innerHTML = xreq.responseText;
            } 
            else {
                // Handle errors
                console.error('Error fetching story:', xreq.status);
            }
        }
    };
    
    // Open the request
    xreq.open('GET', 'story_fetch.php', true);
    
    // Send the request
    xreq.send();
})