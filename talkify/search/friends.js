    var flagAll = 0;
    var flagFollowing = 0;
    var chatFlag = 0;
    var loader = document.getElementById("col");
    loader.style.display = "none";
    function showUnderline(a,whichDiv) {
            let selectedOne = document.querySelector(".yes");
            let followerList = document.querySelector(".follower-list");
            let followingList = document.querySelector(".following-list");
            let allList = document.querySelector(".all-list");
            let chatList = document.querySelector(".chat-list");
            let showDiv = document.querySelector(".showDiv");
            
            if(a != selectedOne) {
                a.classList = "nav-underline yes";
                selectedOne.classList = "nav-underline";
                if(whichDiv === 1) {
                    showDiv.classList.remove("showDiv");
                    followerList.classList.add("showDiv");
                }
                else if(whichDiv === 2) {
                    showDiv.classList.remove("showDiv");
                    followingList.classList.add("showDiv");
                    if(flagFollowing === 0) {
                        flagFollowing = 1;
                        followingsfn(flagFollowing);
                    }
                }
                else if(whichDiv === 3) {
                    showDiv.classList.remove("showDiv");
                    allList.classList.add("showDiv");
                    if (flagAll === 0) {
                        flagAll = 1;
                        allTopUsersfn(flagAll);
                    }
                }
                else {
                    showDiv.classList.remove("showDiv");
                    chatList.classList.add("showDiv");
                    if(chatFlag === 0) {
                        chatFlag = 1;
                        chatListfn(chatFlag);
                    }
                }
            }
    }