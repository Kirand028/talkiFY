function chatListfn(chatFlag) {
    
    if(chatFlag === 1) {
        
        var loaders = document.getElementById('col');
        loaders.style.display = "flex";
        // var myuserName = document.getElementById('my-username').value;
        var chatForm = document.getElementById('chat-form');
        
        var xhr = new XMLHttpRequest();
        
        xhr.open('GET', 'follow/chat_list.php', true);
        
        xhr.onreadystatechange = function() {
            if(xhr.status === 200) {
                // console.log(xhr.responseText);
                chatForm.innerHTML = xhr.responseText;
            }
            else {
                console.error('Error', xhr.status);
                chatForm.innerHTML = '<p class="wrong-msg"><i style="color: #ff8f00;" class="fa fa-warning"></i> &nbsp;Something went wrong.<br><br><span class="retry-btn" onclick="chatListfn(1);">Retry</span></p>';
            }
            loaders.style.display = "none";
        };
        xhr.send();
    }
}