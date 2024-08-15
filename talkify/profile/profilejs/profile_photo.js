
//send image and username details data to update

document.addEventListener('DOMContentLoaded', function() {


    // function to fetch image when page is first loaded
    function profile_fetch() {
        var username = document.getElementById('profile-username').value;
        var prImageDiv = document.querySelector(".pr-image");
    
        // Send AJAX request
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    
                    if(xhr.responseText.length !== 1) {
                        
                        const img = document.createElement('img');
                        img.setAttribute('id', 'profile-img');
                        img.alt = 'profile';
                        img.src = 'data:image/jpeg;base64,' + xhr.responseText;
                        prImageDiv.innerText = "";
                        prImageDiv.appendChild(img);
                        document.querySelector(".pr-image").style.border = 'none';
                    } else {
                        document.querySelector(".pr-image").style.border = '2px solid #1e3c72';
                        document.querySelector(".pr-image").innerHTML = xhr.responseText;
                    }
                        
                } else {
                    console.error('Error:', xhr.status);
                }
            }
        };
    
        xhr.open('POST', 'profilejs/profile_fetch.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('profile-username=' + encodeURIComponent(username));
    }
    
    profile_fetch();
    
    document.getElementById('profile-message').style.display = "none";
    
    // profile updating loading screen
    var loader = document.getElementById('col');
    loader.style.display = "none";
    
    // profile change
    document.getElementById('profile-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        
        var formData = new FormData(this);
        
        // disable the button show loading
        document.querySelector('.save-btn').disabled = true;
        loader.style.display = "flex";
        document.querySelector('.profile-and-follower-details').style.filter = "blur(2px)";
        
        // Send AJAX request
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    document.getElementById('my-file').value = "";
                    document.getElementById('profile-message').style.display = "flex";
                    document.getElementById('profile-message').innerHTML = xhr.responseText;
                    profile_fetch();
                    document.querySelector('.save-btn').disabled = false;
                    loader.style.display = "none";
                    document.querySelector('.profile-and-follower-details').style.filter = "blur(0px)";
                } else {
                    console.error('Error:', xhr.status);
                }
            }
        };
        xhr.open('POST', 'profilejs/profile_photo.php', true);
        xhr.send(formData);
    });


    
});
