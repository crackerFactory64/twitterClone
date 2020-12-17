<?php

    session_start();

    $link = mysqli_connect("shareddb-v.hosting.stackcp.net", "twitter-31343752a5", "Nys*0!MOO7uj", "twitter-31343752a5");

    if (mysqli_connect_errno()){
        
        print_r(mysqli_connect_error());
        exit();
        
    }

    if ($_GET['function'] == "logout"){
        
        session_unset();
    }

    function time_since($since) {
        $chunks = array(
            array(60 * 60 * 24 * 365 , 'year'),
            array(60 * 60 * 24 * 30 , 'month'),
            array(60 * 60 * 24 * 7, 'week'),
            array(60 * 60 * 24 , 'day'),
            array(60 * 60 , 'hour'),
            array(60 , 'minute'),
            array(1 , 'second')
        );

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }

        $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
        return $print;
    }


    function displayTweets($type) {
        
        global $link;
        
        if ($type == 'public'){
            
            $whereCLause = "";
            
        } else if ($type == 'isFollowing') {
            
            $query = "SELECT * FROM isFollowing WHERE follower = ".mysqli_real_escape_string($link, $_SESSION['id']); 
            $result = mysqli_query($link, $query); 
        
            $whereClause = "";
            
            if(mysqli_num_rows($result) < 1){
                
                $whereClause = "WHERE userid = x";
                
            } else {
                
                while ($row = mysqli_fetch_assoc($result)) {

                    if ($whereClause == "") $whereClause = "WHERE";
                    else $whereClause.= " OR";
                    $whereClause.= " userid = ".$row['isFollowing'];
                }
            }
            
        } else if ($type == "yourTweets"){
            
            $query = "SELECT * FROM tweets WHERE userid = ".mysqli_real_escape_string($link, $_SESSION['id']); 
            $result = mysqli_query($link, $query); 
            
            if(mysqli_num_rows($result) < 1){
                
                $whereClause = "WHERE userid = x";
                
            } else {
                
                $whereClause = " WHERE userid = ".mysqli_real_escape_string($link, $_SESSION['id']);
                
            }
            
        } else if ($type == "search"){
            
            $query = "SELECT * FROM tweets WHERE tweet LIKE '".mysqli_real_escape_string($link, $_GET['q'])."'"; 
            $result = mysqli_query($link, $query); 
            
            if(mysqli_num_rows($result) < 1){
                
                $whereClause = "WHERE userid = x";
                
            } else {
          
                $whereClause = " WHERE tweet LIKE '%".mysqli_real_escape_string($link, $_GET['q'])."%'";
            
            }
            
        } else if ($type == "profile"){
                        
            $query = "SELECT * FROM tweets WHERE userid = ".mysqli_real_escape_string($link, $_GET['userid']); 
            $result = mysqli_query($link, $query); 
                        
            $whereClause = "WHERE userid = ".mysqli_real_escape_string($link, $_GET['userid']);
            
        }
        
        
        
        $query = "SELECT * FROM tweets ".$whereClause." ORDER BY `datetime` DESC LIMIT 10";
        
    
        $result = mysqli_query($link, $query);
        
        if (mysqli_num_rows($result) == 0) {
            
            echo "There are no Tweets to display.";
            
        } else {
            
            while ($row = mysqli_fetch_assoc($result)){
                
                $userQuery = "SELECT * FROM users WHERE id = ".mysqli_real_escape_string($link, $row['userid'])." LIMIT 1";
        
                $userResult = mysqli_query($link, $userQuery);
                
                $user = mysqli_fetch_assoc($userResult);
                                
                echo "<div class='tweet'>
                            <strong><a href='?page=publicprofiles&userid=".$user['id']."&email=".$user['email']."'>".$user['email']."</a></strong> <em>".time_since(time() - strtotime($row['datetime']))." ago</em><br>"
                            .$row['tweet']."<br>
                            <p><a class='toggleFollow' data-userid='".$row['userid']."'>";
                
                if ($_SESSION['id']){
                
                    $isFollowingQuery = "SELECT * FROM isFollowing WHERE follower = ".mysqli_real_escape_string($link, $_SESSION['id'])." AND isFollowing = ".mysqli_real_escape_string($link, $row['userid'])." LIMIT 1";
                    $isFollowingResult = mysqli_query($link, $isFollowingQuery);
                    if (mysqli_num_rows($isFollowingResult) > 0){

                        echo "Unfollow";

                    }else {

                        echo "Follow";
                    }
                }
                    
                    
                echo "</a></p></div>";
            }
        }
    }
  
function displayUsers(){
        
        global $link;
            
        $query = "SELECT * FROM users LIMIT 10";
        
        $result = mysqli_query($link, $query);
    
        if (mysqli_num_rows($result) == 0) {
            
            echo "There are no users to display.";
            
        } else {
            
            while ($row = mysqli_fetch_assoc($result)){
                               
            echo "<br><p><a href='?page=publicprofiles&userid=".$row['id']."&email=".$row['email']."'/>".$row['email']."</a></p>";
                                
            }
        }
    }

  function displaySearch(){
        
        echo  '<form id="searchBoxForm" class="form-inline">
                  <div class="form-group">
                      <input type="hidden" name="page" value="search">
                      <input type="text" name="q" class="form-control mb-2 mr-sm-2" id="searchBox">
                  </div>
                <button type="submit" class="btn btn-dark mb-2">Search Tweets</button>
              </form>';
    }
    
    function displayTweetBox(){
        
        if($_SESSION ['id'] > 0){
            
            echo "<hr>";
            
            echo '<div class="form-group">
            <label for="tweetArea">Post a Tweet</label>
            <textarea class="form-control" id="tweetArea" rows="5"></textarea>
            <div class="btn btn-dark mb-2" id="postTweetButton">Post</div>
            <div id="tweetFailed"></div></div>';
        }
    }

?>