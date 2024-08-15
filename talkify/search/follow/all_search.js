document.getElementById('user-found-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        if (document.getElementById("search-user").value != "") {
            searchUserfn();
        }
});

    function searchUserfn() {
        var loading = document.getElementById("col");
        loading.style.display = "flex";
        
        // var myUsername = document.getElementById("my-username").value;
        // console.log(myUsername);
        
        var userFoundSection = document.getElementById("user-found-section");
        
        // Get the form element
        var form = document.getElementById("user-found-form");
        
        // Create FormData object with the form element
        var formData = new FormData(form);
        
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'follow/all_search.php', true);

        // Handle AJAX response
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                userFoundSection.style.display = 'flex';
                if (xhr.status === 200) {
                    // console.log(xhr.responseText);
                    userFoundSection.innerHTML = xhr.responseText;
                } else {
                    console.error('Error:', xhr.status);
                    userFoundSection.innerHTML = '<p class="wrong-msg"><i style="color: #ff8f00;" class="fa fa-warning"></i> &nbsp;Something went wrong.<br><br><span class="retry-btn" onclick="searchUserfn();">Retry</span></p>';
                }
                loading.style.display = "none";
            }
        };
        xhr.send(formData);
}