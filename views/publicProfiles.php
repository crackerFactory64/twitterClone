<div class="container">
    
    <div class="row">
       
        <div class="col-md-8">
            
            <?php if ($_GET['userid']) { ?>
            
                <h1>Recent Tweets by <?php echo $_GET['email']; ?></h1>

                <?php displayTweets('profile') ?>           
            
                <br><p><a href = "?page=publicprofiles"> <button href="publicProfiles.php" class="button btn btn-dark mb-2">Back</button></a></p>

            
            <?php } else { ?> 
                
                <h1>Active Users</h1>
            
                <?php displayUsers(); ?>
          
            <?php } ?>
            

        </div>


        <div class="col-md-4">

            <?php displaySearch(); ?> 
            
            <?php displayTweetBox(); ?>
            
        </div>
        
    </div>
    
</div> 
