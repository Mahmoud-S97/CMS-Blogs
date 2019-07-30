
        


     

<?php
 include "includes/header.php";

 ?>


 <div style = "margin-top: 150px;margin-bottom:20px;text-align:left">
    <a href="add.php">Add a Post or Article</a>
  </div>

      
    <div class="container">
      <div class="post-form">

        <?php

        //Defining variables and fetch results from the database!
         $sql = "SELECT * FROM posts";

         $results = $db->query($sql);

         $number_of_results = mysqli_num_rows($results);

          $results_per_page = 4;

         $number_of_pages = ceil($number_of_results / $results_per_page);

         if(!isset($_GET['page'])){
              $page=1;
            } else {
              $page = $_GET['page'];
          }


         $this_page_first_result = ($page - 1) * $results_per_page;


         //Check where you are, in any category of page!
        if(isset($_GET['category'])){

          $cat = $_GET['category'];
          
           $sql = "SELECT * FROM posts
           where category = '$cat' LIMIT " . $this_page_first_result . "," . $results_per_page;

           $results = $db->query($sql);

        }else {

             $sql = "SELECT * FROM posts LIMIT " . $this_page_first_result . "," . $results_per_page;

             $results = $db->query($sql);
            }

        //Present the results of posts on the page content!
        while($row = mysqli_fetch_array($results)){
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
          //Start comment code!   
          echo "<span id='comment_message'></span><br>

                <div id='display_comment'></div>";

          echo "<form id='comment_form'> 
                  <input type='hidden' name='post_id' id='post_id' value='".$row['id']."'/>
                  <input type='hidden' name='comment_id' id='comment_id' value='0' /> 
                  <input type='hidden' name='user' value='" . $username . "'/>
                  <textarea rows='2' name='comment_content' id='comment_content' class='form-control' placeholder='Add a comment here...'></textarea> <br>
                  <input type='submit' class='btn btn-primary' name='comment' value='Comment'/> <br>
                  <div class='sharethis-inline-share-buttons'></div>
                </form>";

                
           //end div post
          echo "</div>";
          echo "<hr>";

        }

        ?>
      </div> <!-- End Post-Div -->
    
    <?php
     //Pagination to navigate between the pages!
      echo "<div class='paging'>";
        for($page=1; $page <= $number_of_pages; $page++){

            echo '<a href="index.php?page=' . $page . '"> ' . 
            ((isset($_GET['page']) && $page == $_GET['page'])? "<span class='page-hovered'>{$page}</span>" : $page) . '</a> ';
        }
      echo "</div>";
    ?>

      </div><!-- End Container Div -->


      <script>

        $(document).ready(function(){

          $('#comment_form').on('submit', function(event){
             event.preventDefault();

             var form_data = $(this).serialize();
             $.ajax({
              url:"comment.php",
              method:"POST",
              data:form_data,
              dataType:"JSON",
              success:function(data)
              {
                if(data.error != ''){
                  $('#comment_form')[0].reset();
                  $('#comment_message').html(data.error);
                }
              }

             })

          });

          load_comment();

          function load_comment(){

            $.ajax({
              url:"fetch_comment.php",
              method:"POST",
              success:function(data)
              {
                $('#display_comment').html(data);
              }
            })

          }

          $(document).on('click', '.reply', function(){
            var comment_id = $(this).attr("id");
            $('#comment_id').val(comment_id);
            $('#comment_content').focus();
          });

        });

      </script>

      <?php
      include "includes/footer.php";
   