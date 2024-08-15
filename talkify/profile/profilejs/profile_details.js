
//send new log details data to update

document.addEventListener('DOMContentLoaded', function() {
    
    document.getElementById('updateForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        var uformData = new FormData(this);

        // Send AJAX request
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // console.log(xhr.responseText);
                    if (xhr.responseText.includes('Details Updated')) {
                        // console.log(xhr.responseText);  
                        var responses = xhr.responseText.split(',');
                        document.getElementById('error-message').innerHTML = responses[0];
                        document.getElementById('r-username').value = responses[1];
                        document.getElementById('r-fullname').value = responses[2];
                        document.getElementById('r-dob').value = responses[3];
                        document.getElementById('r-bio').value = responses[4];
                        document.getElementById('profile-username').value = responses[1];
                        document.getElementById('sel').value = responses[5];
                        document.getElementById('head-username').innerText = responses[1];
                    }
                    else {
                        document.getElementById('error-message').innerHTML = xhr.responseText;
                        document.getElementById('r-username').value = document.getElementById('profile-username').value;
                    }
                    
                } else {
                    console.error('Error:', xhr.status);
                }
            }
        };
        xhr.open('POST', 'profilejs/profile_details.php', true);
        xhr.send(uformData);
    });

});
