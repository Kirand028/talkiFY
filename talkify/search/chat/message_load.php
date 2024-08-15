<?php 
    
    include '../../connection.php';
    
    $my_username = $_GET['my-username'];
    $his_username = $_GET['his-username'];
    $total_message = $_GET['number-of-messages'];
    
    $message_query = "select * from chats where (outgoing_username = '$my_username' and incoming_username = '$his_username') or (outgoing_username = '$his_username' and incoming_username = '$my_username')";
    
    $message_rslt = $conn->query($message_query);
    
    if($message_rslt->num_rows > 0) {
        
        while($message_row = $message_rslt->fetch_assoc()) {
            
            $outgoing_username = $message_row['outgoing_username'];
            $chat_message = $message_row['message'];
            $chat_date = $message_row['mdate'];
            $chat_time = $message_row['mtime'];
            
            if($outgoing_username == $my_username) {
                echo '<div class="chat outgoing">';
                    echo '<div class="details">';
                        echo '<p>'.$chat_message.'</p>';
                        echo '<span>' . $chat_time . ' on ' . date('d-m-Y', strtotime($chat_date)) . '</span>';
                    echo '</div>';
                echo '</div>';
            }
            else {
                echo '<div class="chat incoming">';
                    echo '<div class="chatdiv-img"></div>';
                    echo '<div class="details">';
                        echo '<p>'.$chat_message.'</p>';
                        echo '<span>' . $chat_time . ' on ' . date('d-m-Y', strtotime($chat_date)) . '</span>';
                    echo '</div>';
                echo '</div>';   
            }
            
        }
        
    }
    else {
        echo '<div class="no-message"><i class="fa fa-info-circle"></i> &nbsp;No chats here yet, Send Hi.</div>';
    }
    
    
?>