    
        var headerBtn = document.getElementById('header');
        
        var profileSection = document.getElementById('profile-section');
        var chatSection = document.getElementById('chat-section');
        // const deviceWidth = window.innerWidth;
    
        headerBtn.addEventListener("click", () => {
                profileSection.style.display = "flex";
                chatSection.style.display = "none";
                console.log("clicked");
        });
        
        var showChatBtn = document.getElementById('showChat');
        showChatBtn.addEventListener("click", () => {
                profileSection.style.display = "none";
                chatSection.style.display = "flex";
                console.log("clicked");
        });