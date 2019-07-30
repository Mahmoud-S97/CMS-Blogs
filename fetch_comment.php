





<?php


 include "includes/config.php";
 include "includes/database.php";
 $post_id = $_POST['post_id'];

 $sql = "SELECT * FROM comments where parent_comment_id = '0'";

 $results = $db->query($sql);

 $output = '';
 
 foreach ($results as $row) {
 	
 	$output .= '
 	  <div class="panel panel-default">
	 	  <div class="panel-heading"> By <b>' 
	 	  . $row['user'] . '</b> on <i>' . $row["date"] . '</i>
	 	  </div> 
	 	  <div class="panel-body">' . $row["comment"] . '</div>
	 	  <div class="panel-footer" align="right">
	 	  <button type="button" class="btn btn-default reply" id="' . $row['comment_id'] .'">Reply</button>
	 	  </div>
 	  </div>';
 	  //$output .= get_reply_comment($db, $row['comment_id']);
 }
 echo $output;



function get_reply_comment($connect,$parent_id = 0, $marginleft = 0)
{
	$query = "SELECT * FROM comment parent_comment_id = '$parent_id'";

	$statement = $connect->query($query);

	if($parent_id == 0){
		$marginleft = 0;
	}else{
		$marginleft = $marginleft + 48;
	}
	
		foreach($statement as $row) {
			
			$output .= '
			<div class="panel panel-default" style="margin-left:' . $marginleft .'px">
			  <div class="panel-heading"> By <b>' 
			 	  . $row['user'] . '</b> on <i>' . $row["date"] . '</i>
			 	  </div> 
			 	  <div class="panel-body">' . $row["comment"] . '</div>
			 	  <div class="panel-footer" align="right">
			 	  <button type="button" class="btn btn-default reply" id="' . $row['comment_id'] .'">Reply</button>
		 	  </div>
			</div>';

			$output .= get_reply_comment($db, $comment_id, $marginleft);
		}
	global $output;	
	return $output;
}