<?php

    session_start();
    @$user_id = $_SESSION['user-id'];
    
    if(@$user_id = '') {
        echo '<script>window.location.href="../Homepage"</script>';
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="friends.css">
    <link rel="stylesheet" href="../common.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/solid.min.css">
    <title>Friends</title>
</head>

<body>
    <div class="main-container">
        <div class="box">
            <div class="footer">
                <a href="../home/home.php"><i class="fas fa-home"></i><span>Home</span></a>
                <a href="friends.php" class="active"><i class="fas fa-search"></i><span>Search</span></a>
                <a href="../post/post.php"><i class="fas fa-circle-plus"></i><span>Post</span></a>
                <!-- <a href="#"><i class="fa-solid fa-message"></i><span>Chat</span></a> -->
                <a href="../profile/profile.php"><i class="fas fa-user"></i> <span>Profile</span></a>
            </div>
            <div class="search-head">
                <i class="fa fa-arrow-left" onclick="window.location.href='../home/home.php'"></i>
                <h4>Friends</h4>
                <form action="#" method="post" class="search-submit">
                    <input class="search-inp" type="search" placeholder="search users">
                    <!-- <button class="search-btn"><i class="fa fa-search"></i></button> -->
                </form>
            </div>
            <!--<input type="hidden" value="" id="my-username"/>-->
            <div class="list-section">
                <div class="nav-header">
                    <p class="nav-underline yes" onclick="showUnderline(this,1)">Followers</p>
                    <p class="nav-underline" onclick="showUnderline(this,2)">Following</p>
                    <p class="nav-underline" onclick="showUnderline(this,3)">All</p>
                    <p class="nav-underline" onclick="showUnderline(this,4)">Chat</p>
                </div>
                <div class="friends-list">
                    <div class="follower-list showDiv">
                        <div class="friend-chat-section">
                            <h5>Your Followers</h5>
                            <div class="friend-list">
                                <form id="followers-form" method="GET">
                                    
                                    <div class="friend-list-container">
                                        <div class="friend-photo">
                                            <img src="admin.png" alt="">
                                        </div>
                                        <div class="friend-username followers">
                                            <p>Username</p>
                                            <span>Hey there, I'm using talkify.</span>
                                        </div>
                                        <div class="followers-btn">
                                            <button>Follow</button>
                                            <button>Block</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="following-list">
                        <div class="friend-chat-section">
                            <h5>Your Followers</h5>
                            <div class="friend-list">
                                <form method="GET" id="followings-form">
                                    <div class="friend-list-container">
                                        <div class="friend-photo">
                                            <img src="admin.png" alt="">
                                        </div>
                                        <div class="friend-username following">
                                            <p>Username</p>
                                            <span>Hey there, I'm using talkify.</span>
                                        </div>
                                        <div class="followers-btn">
                                            <button>Unfollow</button>
                                        </div>
                                    </div>
                    
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="all-list">
                        <form method="POST" id="user-found-form" class="searched-list">
                            <input id="search-user" name="search-username" class="search-inp" type="search" placeholder="search users">
                            <button class="search-btn"><i class="fa fa-search"></i></button>
                        </form>
                        <form method="GET" class="searched-user-found" id="user-found-section">
                            
                            
                        </form>
                        <form method="GET" class="user-details" id="allTopUsers">
                            <h5 style="text-align: center;">Top Users</h5> 
                        </form>
                    </div>
                    <div class="chat-list">
                        <div class="friend-chat-section">
                            <h5>Recent Chats</h5>
                            <div class="friend-list">
                                <form method="GET" id="chat-form">
                                    <button class="chat-now">
                                        <div class="friend-list-container">
                                            <div class="friend-photo">
                                                <img src="admin.png" alt="">
                                            </div>
                                            <div class="friend-username">
                                                <p>Username</p>
                                                <span>Hey there, I'm using talkify.</span>
                                            </div>
                                        </div>
                                    </button>
                                    <button class="chat-now">
                                        <div class="friend-list-container">
                                            <div class="friend-photo">
                                                <img src="admin.png" alt="">
                                            </div>
                                            <div class="friend-username">
                                                <p>Username</p>
                                                <span>Hey there, I'm using talkify.</span>
                                            </div>
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="col">
        <div id="img-wrap">
            <span class="loader"></span>
        </div>
    </div>
<script src="friends.js"></script>
<script src="follow/followers_list.js"></script>
<script src='follow/allJs.js'></script>
<script src="follow/all_search.js"></script>
<script src="follow/btn_followb.js"></script>
<script src="follow/btn_block.js"></script>
<script src="follow/followings_list.js"></script>
<script src="follow/btn_unfollow.js"></script>
<script src="follow/chat_list.js"></script>
</body>

</html>