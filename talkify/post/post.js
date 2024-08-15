document.addEventListener('DOMContentLoaded', function() {


    // Get the URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    
    // Get the value of the 'status' parameter
    const statusValue = urlParams.get('status');
    

    document.getElementById('file-input').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const imageType = /^image\//;
    const imageTitle = document.querySelector('.image-title');

    if (!file || !imageType.test(file.type)) {
        clearImageAndTitle();
        imageTitle.textContent = 'Please select an image file.';
        imageTitle.style.display = 'block';
        imageTitle.style.color = 'red';
        return;

    }

    const reader = new FileReader();
    reader.onload = function(event) {
        const imgElement = document.createElement('img');
        imgElement.src = event.target.result;

        const postImgDiv = document.querySelector('.post-img');
        clearImageAndTitle();
        postImgDiv.appendChild(imgElement);
        imageTitle.textContent = file.name; // Display image title
        document.querySelector('.remove').style.display = 'flex';
        document.querySelector('.wrapper').style.display = 'none';
        imageTitle.style.color = '#999';
    };
    reader.readAsDataURL(file);
    });

    document.querySelector('.remove').addEventListener('click', function() {
        clearImageAndTitle();
        const input = document.getElementById('file-input');
        input.value = ''; // Clear file input
        document.querySelector('.wrapper').style.display = 'flex';
    });

    function clearImageAndTitle() {
        const postImgDiv = document.querySelector('.post-img');
        const imageTitle = document.querySelector('.image-title');
        postImgDiv.innerHTML = ''; // Clear previous image
        imageTitle.textContent = 'Select an Image'; // Reset image title
        document.querySelector('.remove').style.display = 'none';
    }



    var visibilityTog = document.getElementById('visibility');
    document.getElementById('post-privacy').value = visibilityTog.innerText;
    visibilityTog.addEventListener('click', function(event) {
        visibilityTog.innerText = (visibilityTog.innerText === 'Public') ? 'Friends' : 'Public'; 
        document.getElementById('post-privacy').value = visibilityTog.innerText;
    });
    
    
    // writing heading function
    document.getElementById('post-status').addEventListener("click", () => {
        document.getElementById('post-status').style.display = "none";
    });
    
    
    
    // when to show loading animation
    
    var loader = document.getElementById("col");
    
    loader.style.display = "none";
    
    document.getElementById('postForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        
        var formData = new FormData(this);
        document.getElementById('post-btn').disabled = true;
        loader.style.display = "flex";
        document.getElementById('postForm').style.filter = "blur(2px)";
        
        // Send AJAX request
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    
                    // console.log(xhr.responseText);
                    document.getElementById('post-status').innerHTML = xhr.responseText;
                    document.getElementById('post-status').style.display = "flex";
                    
                } else {
                    console.error('Error:', xhr.status);
                }
                clearText();
                document.getElementById('post-btn').disabled = false;
                document.getElementById('file-input').value = "";
                loader.style.display = "none";
                document.getElementById('postForm').style.filter = "blur(0px)";
            }
        };
        
        // Check if the parameter exists and has a value
        if (statusValue !== null) {
            xhr.open('POST', 'post_action.php?status=Yes', true);
            // console.log("Status value:", statusValue);
        } else {
            xhr.open('POST', 'post_action.php?status=No', true);
            // console.log("Status parameter not found in the URL.");
        }
        xhr.send(formData);
    });
    
});