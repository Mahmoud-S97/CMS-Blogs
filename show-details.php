





<?php

include "includes/header.php";



	$id = $_GET['id'];

	$sql = "SELECT * FROM POSTS where id = '$id'";
	$res = $db->query($sql);

?>
    <div class="container">
      <div class="post-form">

        <?php

        //Present the results of posts on the page content!
        while($row = mysqli_fetch_array($res)){
        	echo "<br><br><br>";
          //start div
          echo "<div class='post'>";

          echo "<strong><a href='show-details.php?id={$row['id']}' style='color:#445'>" . $row['title'] . "</a></strong>" . "<br>";

          echo "<img src='images/{$row['image']}'>" . "<br>";

          echo "<strong>". $row['author'] . "</strong>" . " ";

          echo "on " . $row['date'] . "<br>";

          echo "<strong>Category:</strong> ";
           if($row['category'] == 1){
            echo "Sports<br>";
           }else if($row['category'] == 2){
            echo "Programming<br>";
           }else {
            echo "News<br>";
           }

          echo "<strong>Comments:</strong>";
          echo "<div class='cmts'>" . $row['author'] . ": " . $row['body'];
          echo "</div>";
           
          echo "<span id='comment_message'></span><br>

                <div id='display_comment'></div>";

          echo "<form id='comment_form'> 
                  <input type='hidden' name='post_id' value='".$row['id']."'/>
                  <input type='hidden' name='comment_id' id='comment_id' value='0' />
                  <input type='hidden' name='user' value='" . $username . "'/>
                  <textarea rows='2' name='comment_content' class='form-control' placeholder='Add a comment here...'></textarea> <br>
                  <input type='submit' class='btn btn-primary' name='comment' value='Comment'/> <br>
                  <div class='sharethis-inline-share-buttons'></div>
                </form>";

                
           //end div
          echo "</div>";
          echo "<hr>";

        }

        ?>
      </div> <!-- End Post Div -->
    

<?php
