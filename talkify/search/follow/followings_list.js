function followingsfn(flagFollowing) {
    
    if(flagFollowing === 1) {    
        var loader1 = document.getElementById("col");
        loader1.style.display = "flex";
            
        // var followeeName = document.getElementById("my-username").value;
        var followingsForm = document.getElementById("followings-form");
            
        // Send AJAX request
        
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'follow/followings_list.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.status === 200) {
                // console.log(xhr.responseText);
                followingsForm.innerHTML = xhr.responseText;
            }
            else {
                console.error('Error:', xhr.status);
                followingsForm.innerHTML = '<p class="wrong-msg"><i style="color: #ff8f00;" class="fa fa-warning"></i> &nbsp;Something went wrong.<br><br><span class="retry-btn" onclick="followingsfn();">Retry</span></p>';
            }
            loader1.style.display = "none";
        };
        xhr.send();
    }
}