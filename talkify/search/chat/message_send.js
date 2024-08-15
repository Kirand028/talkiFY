document.getElementById('message-send-form').addEventListener('submit', function(event) {
    
    event.preventDefault();
    
    var messageInput = document.getElementById('message-field').value;
    
    if(messageInput !== "") {
    
        var formData = new FormData(this);
        // Send AJAX request
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    if(xhr.responseText == "Success") {
                        console.log(xhr.responseText);
                    }
                    console.log(xhr.responseText);
                } 
                else {
                    console.error('Error:', xhr.status);
                }
                document.getElementById('message-field').value = '';
            }
        };
        xhr.open('POST', 'chat/message_send.php', true);
        xhr.send(formData);
    }
    
});