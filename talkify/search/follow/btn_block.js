document.addEventListener('click', function(event) {
    if (event.target && event.target.nodeName == "BUTTON" && event.target.name == 'block-btn') {
        event.preventDefault();

        var clickedValue = event.target.value;
        // console.log("Clicked value js:", clickedValue, event.target);
        blockHim(clickedValue, event.target);
    }
});

function blockHim(clickedValue, whichBtn) {
    // var myUsername = document.getElementById("my-username").value;

    // Get the element to remove
    var elementToRemove = document.querySelector("#" + clickedValue);
    // console.log(elementToRemove);
    // Send AJAX request
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'follow/btn_block.php?his-username=' + clickedValue, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // console.log(xhr.responseText);
                if (xhr.responseText.trim() === "success") {
                    // The user has been followed
                    // console.log("User blocked successfully.");
                    elementToRemove.remove();
                    followingsfn(1);
                }
            } 
            else {
                console.error('Error:', xhr.status);
                alert("Connection. try again later");
            }
        }
    };
    xhr.send();
}
