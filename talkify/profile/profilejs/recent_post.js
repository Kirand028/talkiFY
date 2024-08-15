
//send image and username details data to update

document.addEventListener('DOMContentLoaded', function() {


    // function to fetch image when page is first loaded
    function recentPost_fetch() {
    var rpost_username = document.getElementById('profile-username').value;
    var url = 'profilejs/recent_post.php?rpost_username=' + encodeURIComponent(rpost_username);
    // console.log(rpost_username);
    
    // Send AJAX request
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var rposts = JSON.parse(xhr.responseText);
                rpostJson(rposts);
                // console.log(rposts);
                // console.log(xhr.responseText);
            } else {
                console.error('Error:', xhr.status);
            }
        }
    };

    xhr.open('GET', url, true);
    xhr.send();
    }

    
    
    function rpostJson(rposts) {
    rposts.forEach(function(rpost) {
        var rPostSection = document.querySelector(".rpost-section");
        
        let liContainer = document.createElement('li');
        let rimg = document.createElement('img');
        
        // Set alt attribute dynamically based on post content
        rimg.alt = 'Post by ' + rpost.username; // Example of dynamic alt text
        
        // Set ID attribute if needed
        // rimg.setAttribute('id', 'profile-img-' + rpost.username); // Example of setting ID
        
        rimg.src = rpost.post_image;
        rPostSection.appendChild(liContainer);
        liContainer.appendChild(rimg);
        
        // console.log(rpost.username);
    });
    }

    
    recentPost_fetch();
});
