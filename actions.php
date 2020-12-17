<?php

    include("functions.php");
    
    if($_GET['action'] == "loginSignup"){
        
            $error = "";
        
            if(!$_POST["email"]){
                
                $error .= "Please enter an email address. ";
                
            }else if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false){
                
                $error .= "Please enter a valid email address. ";
            }
        
        
            if(!$_POST["password"]){
                
                $error .= "Please enter a password. ";
            }
        
         
            if($error != ""){

                echo $error;
                exit();
            }
            
            if($_POST['loginActive'] == "0"){
                
                $query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1"; 
                $result = mysqli_query($link, $query);
                if(mysqli_num_rows($result) > 0){
                    $error .= "An account with that email address already exists.";
                } else {                    
                    $query = "INSERT INTO users (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['password'])."')"; 
                    if (mysqli_query($link, $query)){
                        
                        $_SESSION['id'] = mysqli_insert_id($link);
                        
                        $query = "UPDATE users SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password']). "' WHERE id =".$_SESSION['id']." LIMIT 1";  
                        mysqli_query($link, $query);
                        
                        echo "1";
                        
                    }else {
                        
                        echo "Error";
                    
                    }
                }
                
            } else {
                
                $query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1"; 
                $result = mysqli_query($link, $query);
                $row = mysqli_fetch_assoc($result);
                
                if ($row['password'] == md5(md5($row['id']).$_POST['password'])){
                    
                    echo "1";
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['email'] = $row['email'];
                        
                        
                } else {
                    
                    $error .= "Password incorrect. Please try again.";
                }
                
                
            }
    
            
            if($error != ""){

                echo $error;
                exit();
            }
    };

    if($_GET['action'] == "toggleFollow"){
        
        $query = "SELECT * FROM isFollowing WHERE follower = '".mysqli_real_escape_string($link, $_SESSION['id'])."' AND isFollowing ='".mysqli_real_escape_string($link, $_POST['userId'])."' LIMIT 1"; 
        $result = mysqli_query($link, $query); 

        if (mysqli_num_rows($result) > 0){
            
            $row = mysqli_fetch_assoc($result);
            mysqli_query($link, "DELETE FROM isFollowing WHERE id = '".mysqli_real_escape_string($link, $row['id'])."' LIMIT 1");
            echo "1";
              
        } else {
            
            mysqli_query($link, "INSERT INTO isFollowing (follower, isFollowing) VALUES (".mysqli_real_escape_string($link, $_SESSION['id']).",".mysqli_real_escape_string($link, $_POST['userId']).")");
            echo "2";
            
        }
    };

    if($_GET['action'] == "postTweet"){
        
        
        if($_POST['tweet'] != "" && strlen($_POST['tweet']) <= 240){
            
            mysqli_query($link,"INSERT INTO tweets (tweet, userid, datetime) VALUES ('".mysqli_real_escape_string($link, $_POST['tweet'])."',".mysqli_real_escape_string($link, $_SESSION['id']).", NOW())");
           
            echo "1";            
        
        } else {
            
            $tweetError = "";
            
            if ($_POST{'tweet'} == ""){
                
                $tweetError = "Tweets can not be empty.";
            
            } else {
                
                $tweetError = "Tweets must be between 1 and 240 characters in length.";
            
            }
            
            echo $tweetError;
            
        }
        

    };

?>