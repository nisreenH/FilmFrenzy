<?php session_start(); ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="../css/stylelogin.css">
	</head>
	<body>
		<div class="container">
			<a href="mainpage.php">
				<img src="images/logo.png" class="logo" alt="logo">
			</a>
			<div class="title">Login</div>
			<p class="terms">Welcome to Film Frenzy!</p>
			<p>Login here.</p>
			<br><hr class="line">
			<form method="POST" enctype="multipart/form-data" action="login.php">
				<div class="user-details">
					<div class="input-box">
						<span class="details">Username:</span>
						<input type="text" class="emaillogo" name="username" placeholder="Enter your username" required>
					</div>
					<div class="input-box">
						<span class="details">Password:</span>
						<input type="password" class="passlogo" name="password" placeholder="Enter your password" required>
					</div>
				</div>
				<input type="submit" value="Login" class="btn"><br></br>
				<input type="reset" value="Reset" class="btn"><br></br>
				<hr class="line">
				<div class="login">
					<br><pre class="btnlog">Forgot your password? <a href="changepassword.php" class="textdec">Click here!</a></pre>
					<br><pre class="btnlog">New User? <a href="register.php" class="textdec">Register now!</a></pre>
				</div>
			</form>
		</div>
	</body>
</html>

<?php 


if(isset($_GET['Message'])){
	echo '<script>alert("Registration Successful! Please login")</script>';	
}

if (isset($_POST['username'], $_POST['password'])) {
   require_once 'connection.php';
    $username=$_POST['username'];
    $password=$_POST['password'];
	
	$query = "SELECT `user_id`,`username`,`email`,`password`,`type` FROM `users` WHERE username='$username';";
	$result= mysqli_query($con,$query);
	
	if(!$result){
	   die("Error insert: " . mysqli_error($con) . "</br> Error number: " . mysqli_errno($con));
                }

    else {
	     $row = mysqli_fetch_assoc($result);
			
		   if (mysqli_num_rows($result)==1) { 
			
			 	// if($row['password'] != $password ){
                if(!password_verify($password, $row['password'])){
				  echo '<script>alert("Wrong Password! Try again")</script>';	
			    }  
				else{
					  $_SESSION['useremail'] = $row['email'];
					  $_SESSION['username'] = $row['username'];
					  $_SESSION['user_id'] = $row['user_id'];
                    //   if(($row['type'] == 'Member' || $row['type'] == 'member')){
                        if (strcasecmp($row['type'], 'member') === 0) {
						    $_SESSION['memberlogin']= true;
						    header("location:../html/index.php"); 
						}
					  else{
						   $_SESSION['adminlogin']= true;
					    // header("location:admin\mancat.php");
                        header("location:..\html\index.php");
                        	
					    }							   
					}
		   }
		   else{ 
		        echo '<script>alert("User not found! Please Register first")</script>'; }
	 }
	 
mysqli_close($con);
}


?>