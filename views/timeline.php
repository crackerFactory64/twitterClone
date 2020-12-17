<div class="container">
    
    <div class="row">
       
        <div class="col-md-8">
                
            <h1>Tweets by People You Follow</h1>

            <?php displayTweets('isFollowing'); ?>

        </div>


        <div class="col-md-4">

            <?php displaySearch(); ?> 
            
            <?php displayTweetBox(); ?>
            
        </div>
        
    </div>
    
</div> 
