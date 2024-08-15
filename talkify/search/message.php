<?php
    
    include 'message_user.php';
    if(empty($profile_img)) {
        $profile_img = strtoupper(substr($hisUsername, 0, 1));
         $profile_img = "<h4>$profile_img</h4>";
    }
    else {
        $profile_chat = $profile_img;
        $profile_img = 'data:image/jpeg;base64,' . base64_encode($profile_img);
        $profile_img = '<img src="'.$profile_img.'" alt="photo" />';
    }
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="message.css">
    <link rel="stylesheet" href="../common.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/solid.min.css">
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <title>Chat</title>
</head>
<body>
    <div class="main-container">
        <div class="box">
            <div class="chat-section" id="chat-section">
                <div class="header">
                    <i class="fa fa-angle-left" onclick="window.location.href='friends.php'"></i>
                    <h4><?= $hisUsername ?></h4>
                    <input type="hidden" id="my-UserName" value="<?= $myUsername ?>" />
                    <input type="hidden" id="his-UserName" value="<?= $hisUsername ?>" />
                    <p id="header"><i class="fa fa-ellipsis"></i></p>
                </div>
                <div class="chat-container">
                    <form method="GET" id="chat-container-form">
                        <div class="chat-box">
                            
                        </div>
                    </form>
                </div>
                <div class="inputs">
                    <form method="POST" class="typing-area" id="message-send-form">
                        <input type="hidden" class="outgoing_id" name="outgoing_id" value="<?= $myUsername ?>">
                        <input type="hidden" class="incoming_id" name="incoming_id" value="<?= $hisUsername ?>"> 
                        <input type="text" name="message" id="message-field" class="input-field" placeholder="Type a message here..." autocomplete="off">
                        <button><i class="fab fa-telegram-plane"></i></button>
                    </form>
                </div>
            </div>
            <div class="profile-section" id="profile-section">
                <div class="profile-photo-header">
                    <i class="fa fa-angle-left" id="showChat"></i>
                    <div class="profile-image">
                        <?= $profile_img ?>            
                    </div>
                </div>
                <div class="profile-info">
                    <h4 class="Username"><?= $hisUsername ?></h4>
                    <span class="about-status">About :</span>
                    <p><?= ($profile_bio === "")?"Hey there!, I'm using talkify.":$profile_bio ?></p>
                    <form action="load-block-form" method="POST">
                        <!--<button id="load-all-message">Load all message</button>-->
                        <button><i class="fa fa-ban"></i> &nbsp;&nbsp;Block</button>
                    </form>
                </div>                
            </div>
        </div>
    </div>
        
    <script>
        var imageHTML = "<?= $profile_img ?>";
    </script>
    
    <script src="message.js"></script>
    <script src="chat/message_load.js"></script>
    <script src="chat/message_send.js"></script>
</body>
</html>