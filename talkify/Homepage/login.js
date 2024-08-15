document.getElementById('login-form').addEventListener('submit', function(event) {
    
    event.preventDefault(); // Prevent default form submission
    var formData = new FormData(this);
    var logMessage = document.getElementById('log-message');
    
    if (document.getElementById('log-email').value == "" || document.getElementById('log-password').value == "") {
        logMessage.innerHTML = '<p class="text-danger"><i class="fa fa-warning"></i> &nbsp;Fill all the fields.</p>';        
    }
    else {
        
        var xhr = new XMLHttpRequest();
        
        xhr.open('POST', 'login.php', true);
        
         xhr.onreadystatechange = function () {
            if(xhr.status === 200) {
                // console.log("success" + xhr.responseText);
                
                if(xhr.responseText === 'success') {
                    logMessage.innerHTML = '<p class="text-success"><i class="fa fa-check-circle"></i> &nbsp;' + xhr.responseText + '</p>';
                    window.location.href = '../home/home.php';
                }
                else {
                    logMessage.innerHTML = '<p class="text-danger"><i class="fa fa-warning"></i> &nbsp;' + xhr.responseText + '</p>';
                }
                
            }
            else {
                console.error("Error: " + xhr.status);
            }
        };
        
        
        xhr.send(formData);
    
    }
});