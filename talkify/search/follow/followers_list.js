function followersfn() {
        
        var loader1 = document.getElementById("col");
        loader1.style.display = "flex";
            
        // var followeeName = document.getElementById("my-username").value;
        var followersForm = document.getElementById("followers-form");
        
        // Send AJAX request
        
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'follow/followers_list.php', true);
        xhr.onreadystatechange = function() {
            if (xhr.status === 200) {
                // console.log(xhr.responseText);
                followersForm.innerHTML = xhr.responseText;
                followingsfn(1);
            }
            else {
                console.error('Error:', xhr.status);
                followersForm.innerHTML = '<p class="wrong-msg"><i style="color: #ff8f00;" class="fa fa-warning"></i> &nbsp;Something went wrong.<br><br><span class="retry-btn" onclick="followersfn();">Retry</span></p>';
            }
            loader1.style.display = "none";
        };
        xhr.send();
}

followersfn();