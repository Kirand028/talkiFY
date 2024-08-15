function unfollowHim(whichBtn) {
    
    event.preventDefault();
    
    // var myUsername = document.getElementById("my-username").value;

    var elementToRemove = document.getElementById(whichBtn.value);
    // Send AJAX request
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'follow/btn_unfollow.php?his-username=' + whichBtn.value, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // console.log(xhr.responseText);
                elementToRemove.remove();
                if (xhr.responseText.trim() === "success") {
                    // The user has been followed
                    elementToRemove.remove();
                    followersfn();
                    allTopUsersfn(1);
                    // console.log("User unfollowed successfully.");
                }
            } 
            else {
                console.error('Error:', xhr.status);
                alert("Connection problem. try again later");
            }
        }
    };
    xhr.send();
}
