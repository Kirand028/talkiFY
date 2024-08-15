document.getElementById('register-form').addEventListener('submit', function(event) {

    event.preventDefault(); // Prevent default form submission
    var formData = new FormData(this);
        
    var regMessage = document.getElementById('reg-message');
    
    if (document.getElementById('reg-username').value == "" || document.getElementById('reg-email').value == "" || document.getElementById('reg-password').value == "" || document.getElementById('reg-cpassword').value == "") {
        
        regMessage.innerHTML = '<p class="text-danger"><i class="fa fa-warning"></i> &nbsp;Fill all the fields.</p>';        
    }
    else {
        
        var xhr = new XMLHttpRequest();
        
        xhr.open('POST', 'register.php', true);
        
         xhr.onreadystatechange = function () {
            if(xhr.status === 200) {
                if(xhr.responseText === 'success') {
                    regMessage.innerHTML = '<p class="text-green"><i class="fa fa-check-circle"></i> &nbsp;' + xhr.responseText + '</p>';
                    window.location.href = '../profile/profile.php';
                }
                else {
                    regMessage.innerHTML = '<p class="text-danger"><i class="fa fa-warning text-danger"></i> &nbsp;' + xhr.responseText + '</p>';
                }
            }
            else {
                console.error("Error: " + xhr.status);
            }
        };
        
        
        xhr.send(formData);
    
    }
        
});