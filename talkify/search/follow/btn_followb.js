function followHim(whichBtn) {
    

        event.preventDefault();
        
        // console.log(whichBtn.value , whichBtn);
        
        // var myUsername = document.getElementById("my-username").value;
        // Send AJAX request
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'follow/btn_follow.php?his-username=' + whichBtn.value, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // console.log(xhr.responseText);
                    if (xhr.responseText.trim() === "success") {
                        whichBtn.disabled = true;
                        whichBtn.innerText = 'Mutual';
                        followingsfn(1);
                        allTopUsersfn(1);
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