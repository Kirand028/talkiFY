document.addEventListener('click', function(event) {
    if (event.target && event.target.nodeName == "BUTTON" && event.target.name == 'follow-btn') {
        
        event.preventDefault();
        var clickedValue = event.target.value;
        // console.log("Clicked value js:", clickedValue);
        followHimBack(clickedValue, event.target);
    }
});

function followHimBack(clickedValue, whichBtn) {
    
    // var myUsername = document.getElementById("my-username").value;
    // Send AJAX request
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'follow/btn_follow.php?his-username=' + clickedValue, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // console.log(xhr.responseText);
                if (xhr.responseText.trim() === "success") {
                    // The user has been followed
                    // console.log(whichBtn + "kk");
                    whichBtn.disabled = true;
                    whichBtn.innerText = 'Mutual';
                }
            } 
            else {
                console.error('Error:', xhr.status);
            }
        }
    };
    xhr.send();
}
