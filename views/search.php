<div class="container">
    
    <div class="row">
       
        <div class="col-md-8">
                
            <h1>Tweets Containing "<?php echo $_GET['q']; ?>"</h1>
            
            <?php displayTweets('search'); ?>

        </div>


        <div class="col-md-4">

            <?php displaySearch(); ?> 
            
            <?php displayTweetBox(); ?>
            
        </div>
        
    </div>
    
</div> 
