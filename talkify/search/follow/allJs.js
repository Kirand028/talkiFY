function allTopUsersfn(flag) {
        
        loader.style.display = "flex";
        
        if(flag !== 0) {
            
            // var myUsername = document.getElementById("my-username").value;
            var allTopUsers = document.getElementById("allTopUsers");
            // console.log("js", myUsername);
            
            // Send AJAX request
            
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'follow/all_action.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.status === 200) {
                    // console.log(xhr.responseText);
                    allTopUsers.innerHTML = xhr.responseText;
                    loader.style.display = "none";
                }
                else {
                        console.error('Error:', xhr.status);
                        loader.style.display = "none";
                        allTopUsers.innerHTML = '<p class="wrong-msg"><i style="color: #ff8f00;" class="fa fa-warning"></i> &nbsp;Something went wrong.<br><br><span class="retry-btn" onclick="allTopUsersfn(1);">Retry</span></p>';
                }
            };
            xhr.send();
        }
}