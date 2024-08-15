var loading = document.getElementById('col');
var offset = 0;
var limit = 5;
var prevScrollHeight = 0; // Track previous scroll height

fetchMorePosts(offset, limit);

var postMainDiv = document.querySelector('.post-main-div');



// Function to check if the scroll has reached the bottom
function isScrollAtBottom() {
    // Check if the scroll position is at the bottom
    return postMainDiv.scrollHeight - postMainDiv.scrollTop <= postMainDiv.clientHeight;
}


// Function to handle scroll event
function handleScroll() {
    // Check if the scroll has reached the bottom
    if (isScrollAtBottom() && postMainDiv.scrollHeight !== prevScrollHeight) {
        
        // For example, load more posts
        offset = offset + 5;
        limit = limit + 5;
        // console.log(offset + "   " + limit);
        fetchMorePosts(offset, limit);
        
        // Update previous scroll height
        prevScrollHeight = postMainDiv.scrollHeight;
        // alert(prevScrollHeight,postMainDiv.scrollHeight);
    }
}


// Attach scroll event listener to the post container
postMainDiv.addEventListener('scroll', handleScroll);

// Add touch event handling for better mobile compatibility
postMainDiv.addEventListener('touchmove', function() {
    if (isScrollAtBottom() && postMainDiv.scrollHeight !== prevScrollHeight) {
        handleScroll();
    }
});


var c=0;

// Function to fetch more posts from the server
function fetchMorePosts(offset,limit) {

    loading.style.display = 'flex';
    
    // Send an AJAX request to fetch more posts
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'post_load.php?offset=' + offset + 'limit=' + limit, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // console.log("called");
            // alert("fun called",c++);
            // console.log(xhr.responseText);
            var posts = JSON.parse(xhr.responseText);
            renderPosts(posts);
            loading.style.display = 'none';
        }
    };
    xhr.send();
}


// Function to render fetched posts
function renderPosts(posts) {
    var postContainer = document.querySelector('.post-submit');
    posts.forEach(function(post) {
        var postDiv = document.createElement('div');
        postDiv.className = 'post-div';
        
        if (posts.length === 0) {
            // Display a message indicating that there are no more posts to load
            var messageDiv = document.createElement('div');
            messageDiv.textContent = 'No more posts to load';
            postContainer.appendChild(messageDiv);
            return;
        }
        
    
        // Generate HTML content for each post
        postDiv.innerHTML = `
            <div class="user-info">
                <div class="user-image" style="border: ${post.profile_image.length <= 2 ? '1px solid #1e3c72' : 'none'};">
                    ${post.profile_image.length > 2 ? '<img src="' + post.profile_image + '" alt="P">' : post.profile_image}
                </div>
                <div class="user-name-date">
                    <h5>${post.username}</h5>
                    <p>${post.post_date} <span>${post.post_time}</span></p>
                </div>
            </div>
            <div class="post-details">
                <div class="post-description">
                    <p>${post.description}</p>
                </div>
                ${post.post_image ? '<div class="post-image"><img src="' + post.post_image + '" alt="Post"></div>' : ''}
            </div>
            <div class="post-likes">
                <div class="l-c-s">
                    <p class="gradient-icon heart"><i class="far fa-heart" onclick="toggleIconClass(this)"></i></p>
                    <p class="gradient-icon"><i class="far fa-comment"></i></p>
                    <p class="gradient-icon"><i class="fas fa-share"></i></p>
                </div>
                <div class="water-mark">
                    <p class="posted-on">posted on <span class="wm-talk">talk</span><span class="wm-ify">iFy</span></p>
                </div>
            </div>
        `;
        // console.log(post.post_image + "jdjdjdj");
        postContainer.appendChild(postDiv);
    });

    
}
