
<?php
session_start();
 include "includes/config.php";
 include "includes/database.php";

 $user = (isset($_SESSION['username'])? $_SESSION['username'] : "Guest");
 $comment_content = $_POST['comment_content'];
 $date = date("Y-m-d H:i:s");
 $post_id = $_POST['post_id'];
 $comment_id = $_POST["comment_id"];
 
 if(!empty($comment_content)){

 	$query = "INSERT INTO comments(parent_comment_id,comment,user,date,post_id)
 	          values('$comment_id','$comment_content','$user','$date','$post_id')";

 	 $db->query($query);
 	
 }


$author = (isset($_SESSION['username']) ? $_SESSION['username'] : "Guest");

function setComments($db){

	if(isset($_POST['comment'])){
		$user = $_POST['user'];
		$date = $_POST['date'];
		$newText = $_POST['message'];
		$id_post = $_POST['pid'];

		$sql = "INSERT INTO comments(user,date,message,id_post)
		values('$user','$date','$newText','$id_post')";
		$res = $db->query($sql);
	
	}
  
}


function getComment($db){
	$id_post = $_POST['pid'];
	$sql = "SELECT * FROM comments";
	$res = $db->query($sql);
	
	while($row = mysqli_fetch_array($res)){
		echo "<div style='border:1px solid #DDD'>";
		echo $_SESSION['username'] . ": ";
		echo $row['message'];
		echo "</div>";
	}
}
