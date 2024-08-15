        // function validateInput(event) {
        //     const input = event.target;
        //     const value = input.value;
        //     const sanitizedValue = value.replace(/[^!#$%^,_&*+=@.a-zA-Z0-9]/g, '');
        //     input.value = sanitizedValue;
        // }
        
        // function validatespaceInput(event) {
        //     const input = event.target;
        //     const value = input.value;
        //     const sanitizedValue = value.replace(/[^!#$%^,_&*+=@.a-zA-Z0-9 ]/g, '');
        //     input.value = sanitizedValue;
        // }
    
    
        //to make user details inputs editable
        
        function makeEditable() {
            
        document.getElementById("edit").disabled = true;
        document.getElementById("update").disabled = false;
        document.getElementById("sel").disabled = false;
        
        var inputBoxes = document.querySelectorAll('.editable'); // Select textboxes with class 'editable'
            for (var i = 0; i < inputBoxes.length; i++) {
                inputBoxes[i].readOnly = false;
                inputBoxes[i].style.borderBottom="2px solid blue";
            }
        }

        // to make editable login inputs
        document.getElementById("log-update").disabled = true;
        function makeEditableLogin() {
            document.getElementById("log-update").disabled = false;
            let logEmail = document.getElementById('log-email');
            let logPassword = document.getElementById('log-password');
            logEmail.readOnly = (logEmail.readOnly === true) ? false : true;
            logPassword.readOnly = (logPassword.readOnly === true) ? false : true;
            logEmail.style.borderBottom="2px solid blue";
            logPassword.style.borderBottom="2px solid blue";
        }


        // toggle recent post div
        let postForm = document.getElementById("postForm");
        postForm.style.display = "none";
        function showRecentPostDiv() {
            postForm.style.display = (postForm.style.display === 'none') ? 'block' : 'none';
        }

    
        // toggle user details div
        let updateForm = document.getElementById("updateForm");
        let editBtn = document.getElementById("edit");
        editBtn.style.display = "none";
        updateForm.style.display = "none";
        function showUpdateDiv() {
            updateForm.style.display = (updateForm.style.display === 'none') ? 'block' : 'none';
            editBtn.style.display = (editBtn.style.display === 'none') ? 'flex' : 'none';
        }

        //toggle login details div
        let logForm = document.getElementById("logForm");
        let logBtn = document.getElementById("log-edit");
        logForm.style.display = "none";
        logBtn.style.display = "none";
        function showLoginUpdateDiv() {
            logForm.style.display = (logForm.style.display === 'none') ? 'block' : 'none';
            logBtn.style.display = (logBtn.style.display === 'none') ? 'flex' : 'none';
        }

        // toggle delete account div
        let deleteForm = document.getElementById('deleteForm');
        let dtBt = document.getElementById('dtbt');
        deleteForm.style.display = "none";
        dtBt.disabled = true;
        function deleteConfirm() {
            deleteForm.style.display = (deleteForm.style.display === 'none') ? 'flex' : 'none';
            dtBt.disabled = false;
        } 
        
        //toggle password
        const passwordInput = document.getElementById("log-password");
        const toggleVisibility = document.getElementById("togglePassword");

        toggleVisibility.addEventListener("click", function() {
            
            (passwordInput.type == "text")?passwordInput.type = "password":passwordInput.type = "text";
            toggleVisibility.classList.toggle("fa-eye-slash");
          
        });
        
        document.getElementById("profile-message").addEventListener("click", () => {
            document.getElementById("profile-message").innerText = "";
            document.getElementById('profile-message').style.display = "none";
        });
        
        document.getElementById("login-error").addEventListener("click", () => {
            document.getElementById("login-error").innerText = "";
        });
        document.getElementById("error-message").addEventListener("click", () => {
            document.getElementById("error-message").innerText = "";
        });
         