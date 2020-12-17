        <footer class="footer mt-auto py-3">
          <div class="container">
            <span class="text-muted"><p style="text-align: center">&copy; Lee Mander 2020</p></span>
          </div>
        </footer>


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="loginModalTitle">Log In</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form>
                    <input type="hidden" id="loginActive" value="1">
                    <div class="" id="loginAlert"></div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                </form>
              </div>
              <div class="modal-footer">
                  <a id="loginToggle" href="javascript:void(0);">Need an account? Sign up</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="loginButton">Log In</button>
              </div>
            </div>
          </div>
        </div>

        <script>
                
            $("#loginToggle").click(function(){       
                
            
                if($("#loginActive").val() == "1"){
                
                    $("#loginToggle").html("Already have an account? Log in");
                    $("#loginModalTitle").html("Sign Up");
                    $("#loginButton").html("Sign Up");
                    $("#loginActive").val("0");

                    
                } else if($("#loginActive").val() == "0"){ 
                    
                    $("#loginToggle").html("Need an account? Sign up");
                    $("#loginModalTitle").html("Log In");
                    $("#loginButton").html("Log In");
                    $("#loginActive").val("1");
                } 
                
                
            });
            
            $("#loginButton").click(function(){
            
                $.ajax({
                    type: "POST",
                    url: "actions.php?action=loginSignup",
                    data: "email=" + $("#email").val() + "&password=" + $("#password").val() + "&loginActive=" + $("#loginActive").val(), 
                    success: function(result){
                       if(result == "1"){
                           
                            window.location.assign("http://leemander-com.stackstaging.com/content/12-mvc/");                           
                       } else {
                           
                           $("#loginAlert").html(result + "<br><br>").show();
                           
                       }
                    }
                })
                
            });
            
            $(".toggleFollow").click(function(){
                
                var id = $(this).attr("data-userid");
                
                 $.ajax({
                    type: "POST",
                    url: "actions.php?action=toggleFollow",
                    data: "userId=" + id, 
                    success: function(result){
                    
                        if (result == "1"){
                            
                            $("a[data-userid=" + id + "]").html("Follow");
                            
                        } else if (result == "2"){
                            
                            $("a[data-userid=" + id + "]").html("Unfollow");
                        }
                    }
                });
            });
            
            $("#postTweetButton").click(function(){
               
                $.ajax({
                   
                    type: "POST",
                    url: "actions.php?action=postTweet",
                    data: "tweet=" + $("#tweetArea").val(), 
                    success: function (result){
                        
                        if (result == "1"){
                            
                            location.reload();
                            
                        } else {
                            
                            $("#tweetFailed").html(result).show();
                            
                        }
                        
                    }
                    
                });
                
            });
        </script>

  </body>
</html>