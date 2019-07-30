




<?php

session_start();

$conn = mysqli_connect("localhost","root","") or die(mysql_error());

$db = mysqli_select_db($conn,"cms");

 $errors = array();

 if(isset($_POST['login_btn'])){

 	$username = strtolower($_POST['username']);
 	$password = strtolower($_POST['password']);
 	
 	if(empty($username)){

 		array_push($errors, 'Username is Required!');

 	}
 	if(empty($password)){

 		array_push($errors, 'Password is Required!');

 	}

 	if(count($errors) == 0){

 		$query = "SELECT * from users 
 			where name='$username' and password='$password'";

 		$sql = mysqli_query($conn,$query);

 		$rowCount = mysqli_num_rows($sql);

 		if($rowCount > 0){

 			$_SESSION['username'] = $username;

 			header("location: index.php");

 		} else {

 				include "login.php";

					echo "<div style = 'margin:0px auto;background-color:#DDD;
				text-align:center;color:#e44141; width:350px; border-radius:10px;'>";

				 echo "Wrong in Username or Password" . "</br>" . "Please, Try Agaian!.";

				echo "</div>";	
		}

	} else {

 		include "login.php";

	 	foreach($errors as $error){

	 		echo "<div style = 'margin:0px auto;background-color:#DDD;
				text-align:center;color:#e44141; width:350px; border-radius:10px;'>";

				foreach ($errors as $error) {

					echo "-" . $error . "</br>";
				}//end for each about type of error!

				echo "</div>";
				
				die();
		}
	}	

 }