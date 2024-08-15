var myUserName = document.getElementById('my-UserName').value;
var hisUserName = document.getElementById('his-UserName').value;
var numberOfMessages = 20;


function loadImages() {
            
    var chatDivs = document.querySelectorAll('.chatdiv-img');
    var imageTag = document.querySelector('.profile-image').innerHTML;
    
    chatDivs.forEach(function(cdiv) {
        cdiv.innerHTML = imageTag;
    });
}


fetch_messages(myUserName, hisUserName, numberOfMessages);

function fetch_messages(myUserName, hisUserName, numberOfMessages) {
    
    var chatBox = document.querySelector('.chat-box');
    
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'chat/message_load.php?my-username=' + myUserName + '&his-username=' + hisUserName + '&number-of-messages=' + numberOfMessages, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // console.log(xhr.responseText);
                chatBox.innerHTML = xhr.responseText;
                loadImages();
            }
            else {
                console.error('Error:', xhr.status);
            }
        }
    };
    xhr.send();  
}


function scrollToBottomChat() {
    var chatContainer = document.querySelector('.chat-box');
    chatContainer.scrollTop = chatContainer.scrollHeight;
}

setInterval(() => { fetch_messages(myUserName, hisUserName, numberOfMessages)}, 2000);
