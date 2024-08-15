
//send image and username details data to update

function profile_fetch() {
    
    // document.getElementById('profile-form').addEventListener('submit', function(event) {
    //     event.preventDefault(); // Prevent default form submission

    //     var formData = new FormData(this);
        
        var formData = document.getElementById('profile-username').value;
        
        // Send AJAX request
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let imageEle = document.getElementById('profile-img');
                    imageEle.src = 'data:image/jpeg;base64,'+ xhr.responseText;
                    // console.log(xhr.responseText);
                } else {
                    console.error('Error:', xhr.status);
                }
            }
        };
        xhr.open('POST', 'profilejs/profile_fetch.php', true);
        xhr.send(formData);
}
    // });

    
// });
