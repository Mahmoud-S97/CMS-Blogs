






<?php

  session_start();
   include "includes/config.php";
   include "includes/database.php";
   require "title-rout-function.php";

   $query = "SELECT * from categories";
   $categories = $db->query($query);

   $username = null;

   if(isset($_SESSION['username'])){
     $username = $_SESSION['username'];
   }else {
     $username = "Guest";
   }

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>BlogsCMS</title>
    	
    <link href="css/style.css" rel="stylesheet">	

    <link rel = "stylesheet" type="text/css" href = "css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/blog.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5c08ff8735e54100118bf341&product=inline-share-buttons' async='async'></script>

  </head>

  <body>
  	
    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <?php
          $nav = "";
          if(isset($_SESSION['username'])){
            $nav .= '<a href="logout.php" style="float:right;margin-top:10px;color:#fff;font-family: sans-serif;">&nbsp;| Logout</a>';
        }else {

          $nav .= '<a href="register.php" style="float:right;margin-top:10px;color:#fff;font-family: sans-serif;">| &nbsp;Sign Up</a>';
          $nav .= '<a href="login.php" style="float:right;margin-top:10px;color:#fff;font-family: sans-serif;"> Sign in &nbsp;</a>';
        }
         echo $nav; 
         echo '<span style="font-size: 15px; color:#fff;float:right;margin:10px 50px 0 0;font-family: sans-serif;">User: ' . '<a href=index.php style="color:#DDD">' . strtoupper($username) . '</a>' . '</span>';

          ?>


          <!-- Navigation bar with index of category -->
          <?php if(isset($_GET['category'])){ ?>
                <a class="blog-nav-item" href="index.php">Home</a>
            <?php  }else { ?>
          <a class="blog-nav-item active" href="index.php">Home</a>
           <?php } ?>

          <?php if($categories->num_rows > 0){ 
             while($row = $categories->fetch_assoc()) {
                  if(isset($_GET['category']) && $row['id'] == $_GET['category']){ ?> 
                     <a class="blog-nav-item active" href="index.php?category=<?php echo $row['id']; ?> "> <?php echo $row['name']; 
                     ?></a>
                     <?php  change_title($row['name']);  ?>
          <?php }else {
            echo "<a class='blog-nav-item' href='index.php?category=$row[id]'> $row[name]</a>";
          } } } ?>
        </nav>
      </div>
    </div>

    <div class="container">

      <div class="row">

        <div class="col-sm-8 blog-main">
          <h3 style="position:relative;top:20px;left:10px;color:#444;font-family:sans-serif;font-weight:bold">Enjoy With Blogs</h3>


