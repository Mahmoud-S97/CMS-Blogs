






 

<!DOCTYPE html>
<html>
<head> 
	<title>CMS</title>
	<link rel = "stylesheet" type="text/css" href = "cms/dashboard/css/style.css">
	<link rel = "stylesheet" type="text/css" href = "css/font-awesome.min.css">
	<link href="css/blog.css" rel="stylesheet">
</head>
<body>
  
  <div class = "container-frm">
  	<div class = "frm">
  		<h2>Register</h2>
  		<form method = "post" action = "register.php">
  		 <div class = "input-fields">
  			<label>Username*</label>
  			<input type = "text" name = "username" class = "input">
  		</div>
  			 <div class = "input-fields">
  			<label>Password*</label>
  			<input type = "password" name = "password_1" class = "input">
  		</div>
  		<div class = "input-fields">
  			<label>Re-type Password*</label>
  			<input type = "password" name = "password_2" class = "input">
  		</div>
  			<input type = "submit" name = "reg_btn" value = "Register">
  			<p>Already Registered? <a href = "login.php">Login</a></p>
  		</div>
  		</form>
  	</div>
  </div>

  <a href="index.php"><<{Back}</a>

</body>
</html>





<?php

	

$conn = mysqli_connect("localhost","root","") or die(mysql_error());

$db = mysqli_select_db($conn,"cms");


$errors = array();

if(isset($_POST['reg_btn'])){

	$username = strtolower($_POST['username']);
	$password_1 = strtolower($_POST['password_1']);
	$password_2 = strtolower($_POST['password_2']);

	if(empty($username)){
		array_push($errors, "User Name Is Required!");
	}
	if(empty($password_1)){
		array_push($errors, "Password Is Required!");
	}
	if($password_1 != $password_2){
		array_push($errors, "The Two Passwords Not Matched!");
	}
	if(count($errors) == 0){

		$sql = mysqli_query($conn, "SELECT * from users where name='$username'");

		if(mysqli_num_rows($sql) > 0){

			echo "<div style = 'margin:0px auto;background-color:#DDD;
			text-align:center;color:#e44141; width:350px; border-radius:10px;'>";

				echo "This User Is Already Exists,"."</br>" . "Please Choose Another One!.";

				echo "</div>";
		} else {

				 $query = "INSERT into users (id,name,password)
				 values('$count','$username','$password_1')";

				mysqli_query($conn, $query);

				header("location: index.php");

	 			}

	} else {

		foreach ($errors as $error) {

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

?>