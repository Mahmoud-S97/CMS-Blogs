
        





      <?php

      header("X-XXS-Protection: 0");

      include "includes/config.php";
      include "includes/database.php";

      session_start();


      $message = "";
      $cat = null;

        if(isset($_POST['submit'])){

            $target = "images/" . basename($_FILES['image']['name']);
            $category = strtolower(htmlspecialchars($_POST['category'], ENT_QUOTES, 'UTF-8'));
            $image  = $_FILES['image']['name'];
            $title =  htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
            $comment =  htmlspecialchars($_POST['comment'], ENT_QUOTES, 'UTF-8');
            $keywords = $title;
            $author = (isset($_SESSION['username']) ? $_SESSION['username'] : "Guest");
            $date = date("Y-m-d H:i:s");

            if($category == "sports"){
            	$cat = 1;
            }elseif($category == "programming"){
            	$cat = 2;
            }else {
            	$cat = 3;
            }

            $errors = false;
            if(empty($title) || empty($category) || empty($comment) || empty($target)){
              $errors = true;
            }

         if(move_uploaded_file($_FILES['image']['tmp_name'], $target) && (!$errors)){

                  $query = "INSERT INTO posts(title, category, date,body,author,keywords,image)
                   values('$title',$cat, '$date' ,'$comment', '$author', '$title', '$image')";

                  $db->query($query);
                  
                   $message = "<p style=\"font-style: italic;color:green;text-align:center;font-size: 20px;font-family:sans-serif;opacity:.6\">Posted succesfully!</p>";

                   header("location: index.php");

               } else {

                      $message = "<p style=\"font-style: italic;color:#F00;text-align:center;font-size: 20px;font-family:sans-serif;opacity:.6\">Fields must be filled properly!</p>";
                }
          }
  ?>

  <!DOCTYPE html>
  <html>
  <head>
  	 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>BlogsCMS-Add Blog</title>
    <?php

    require "title-rout-function.php";

     change_title("Add blog");

    ?>
    	
    <link href="css/style.css" rel="stylesheet">	

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/blog.css" rel="stylesheet">
  </head>
  <body>

         <div class="blog-header">
         	<div class="container">
		        <h1 class="blog-title"><a href='index.php'>My Blogs</a></h1>
		        <p class="lead blog-description"> Post blogs here!</p>
		        <?php echo $message ?>
		    </div>
		   </div>

	<div class="container">
        <form method="post" action="" enctype="multipart/form-data">
          <input type="hidden" name="size" value="1000000">
          <div class="form-group">
            <label for="exampleInputEmail1">Title</label>
            <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Category</label>
            <input type="text" class="form-control" name="category" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
          <div class="form-group">
            <label for="exampleTextarea">Comment</label>
            <textarea class="form-control" name="comment" id="exampleTextarea" rows="3"></textarea>
          </div>
          <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <input type="file" class="form-control-file" name="image" id="exampleInputFile" aria-describedby="fileHelp">
            <small id="fileHelp" class="form-text text-muted">Please choose picture to post.</small>
          </div>
          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </form>

  </div>


</body>
</html>
            
