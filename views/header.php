<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    
    <link rel="stylesheet" href="http://leemander-com.stackstaging.com/content/12-mvc/style.css" type="text/css">
      
    <title>Twitter</title>
  </head>
    
  <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="http://leemander-com.stackstaging.com/content/12-mvc/">Twitter</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

          <li class="nav-item">
            <a class="nav-link" href="?page=yourtimeline">Your Timeline</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=yourtweets">Your Tweets</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=publicprofiles">Public Profiles</a>
          </li>

        </ul>
        <div class="form-inline my-2 my-lg-0">
            <?php 
                
                if($_SESSION['id']){?>
                    <p class="my-2 my-sm-0" id="loggedInEmail"><?php print_r($_SESSION['email']);?></p>
                    <a  class="btn btn-outline-success my-2 my-sm-0" href="http://leemander-com.stackstaging.com/content/12-mvc?function=logout">Logout</a>  <?php
                }
                else{?>
                    <button class="btn btn-outline-success my-2 my-sm-0" data-toggle="modal" data-target="#exampleModal">Log In/Register</button><?php
                }
            ?>
        </div>
      </div>
    </nav>