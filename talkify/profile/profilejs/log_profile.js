
//send new log details data to update

document.addEventListener('DOMContentLoaded', function() {
    
    document.getElementById('logForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        var formData = new FormData(this);

        // Send AJAX request
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // console.log(xhr.responseText);
                    if (xhr.responseText.includes('Updated')) {
                        
                        var responses = xhr.responseText.split(',');
                        var firstString = responses[0];
                        var secondString = responses[1];
                        var thirdString = responses[2];
                        document.getElementById('login-error').innerHTML = responses[0];
                        document.getElementById('f-email').value = responses[1];
                        document.getElementById('f-password').value = responses[2];
                        document.getElementById('fh-email').value = responses[1];
                        document.getElementById('profile-email').value = responses[1];
                        
                    }
                    else if (xhr.responseText.includes('No Changes Made')) {
                        document.getElementById('login-error').innerHTML = xhr.responseText;
                    }
                    else if (xhr.responseText.includes('Someone')) {
                        document.getElementById('log-email').value = document.getElementById('f-email').value;
                        document.getElementById('login-error').innerHTML = xhr.responseText;
                    }
                    
                    // console.log(document.getElementById('f-email').value);
                    
                    // console.log(document.getElementById('f-password').value);
                } else {
                    console.error('Error:', xhr.status);
                }
            }
        };
        xhr.open('POST', 'profilejs/log_update.php', true);
        xhr.send(formData);
    });

    
});
