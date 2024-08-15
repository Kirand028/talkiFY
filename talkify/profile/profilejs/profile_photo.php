<?php

    include '../../connection.php';
        
        // echo '<script>alert("Profile");</script>';
        @$image = $_FILES["profile-img"]["tmp_name"];
        $message = "nothing";
        $profile_username = $_POST["profile-username"];
         
        $image_name = $_FILES["profile-img"]["name"];
        $image_type = $_FILES["profile-img"]["type"];
        
        $size=$_FILES["profile-img"]["size"]/1024;
        $size=$size/1024;
            
        if($image == "") {
                
            $message = '<p><span><i class="fa fa-warning" style="color:red;"></i> Select an image file</span> <i class="fa fa-times"></i></p>';
            echo $message;
        }
        else {
               
            if($image_type=="image/png"||$image_type=="image/jpg"||$image_type=="image/jpeg") {

                if($size > 1) {
                    $size = number_format($size,2);
                    $image="";
                    $image_name="";
				    $message = '<p><span><i class="fa fa-warning" style="color:red;"></i> Oops! Size is '.$size.'MB, Should be < 1MB</span> <i class="fa fa-times"></i></p>';
				    echo $message;
                }
                else
                {
                    @$image = addslashes(file_get_contents($_FILES["profile-img"]["tmp_name"]));
                    $iqry = "select username from users where username ='".$profile_username."'";
                    $irslt = $conn->query($iqry);
                    if($irslt->num_rows > 0) {
				    
				        $uque="update users set profile = '$image' where username = '$profile_username'";
                        if($uqr = $conn->query($uque)) {
                            
                            $image="";
                            $image_name="";
				            $message = '<p><span><i class="fa fa-check-circle" style="color:green;"></i> Profile set </span><i class="fa fa-times"></i></p>';
                            echo $message;
			            }
			            else {
			                $image="";
                            $image_name="";
				            $message = '<p><span><i class="fa fa-warning" style="color:red;"></i> Oops! Update error </span> <i class="fa fa-times"></i></p>';
				            echo $message;
			            }    
                    }
                }
            }
            else
            {
                $image="";
                $image_name="";
				$message = '<p><span><i class="fa fa-warning" style="color:red;"></i> Oops! Invalid file </span> <i class="fa fa-times"></i></p>';
				echo $message;
            }
        }

?>