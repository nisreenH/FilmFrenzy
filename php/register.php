<!DOCTYPE html>
<html>
	<head>
		<title>Registration</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="../css/styleregister.css">
        <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
		<script src="../js/registrationFunctions.js">
		</script>
	</head>
	<body>
		<div class="container">
			<a href="mainpage.php">
				<img src="images/logo.png" class="logo" alt="logo">
			</a>
            <div id="modalContainer"></div>
			<div class="title">Registration</div>
			<p class="terms">Thank you for joining us.</p>
			<p>Please register by filling the information below..</p>
			<br><hr class="line">
			<form method="POST" action="register.php" id="newForm" enctype="multipart/form-data">
				<div class="user-details">
					<div class="input-box">
						<span class="details">Username:</span>
						<input type="text" class="userlogo" name="username" placeholder="Enter your username" required>
					</div>
					<div class="input-box">
						<span class="details">Email:</span>
						<input type="email" class="emaillogo" name="email" placeholder="Enter your email" required>
					</div>
					<div class="input-box">
						<span class="details">Password:</span>
						<input type="password" class="passlogo" name="password" placeholder="New Password" id="firstpass" onblur="check_pass_strength()" onfocus="emptyMessages()" required>
						<br></br><h3 id="shortpassmessage"></h3>
					</div>
					<div class="input-box">
						<span class="details">Confirm Password:</span>
						<input type="password" class="passlogo" placeholder="Confirm your password" id="secondpass" onblur="check_pass_match()" onfocus="emptySecondpass()" required>
						</br></br><h3 id="second_pass_message"> </h3>
					</div>
					<div class="input-box">
						<span class="details">Date of birth:</span>
						<div class ="inputbox">
							<input id="birth" type="date" name="dob" required>
							<input type="hidden" id="calcAge" name="age">
						</div>
					</div>
					<div class="input-box">
						<input type="radio" name="gender" id="m" value="Male" required>
						<input type="radio" name="gender" id="f" value="Female" required>
						<span class="details">Gender:</span>
						<div class="category">
							<label for="m">
								<span class="dot one"></span>
								<span>Male</span>
							</label>
							<label for="f">
								<span class="dot two"></span>
								<span>Female</span>
							</label>
						</div>
					</div>
					<div class="input-box">
						<span class="question">Question:</span>
						<span class="details">What is the name of your favorite teacher?</span>
						<input type="text" class="questmarklogo" name="security" placeholder="Enter your favorite movie" required>
					</div>
				</div>
				<label class="containers">I have agreed to the terms and conditions
					<input type="checkbox" required><span class="checkmark"></span>
				</label>
				<input type="submit" value="Register" class="btn" onclick="ageCount()"  ><br></br>
				<input type="reset" value="Reset" class="btn" onclick="emptyMessages()"><br></br>
				<hr class="line">
				<div class="login">
					<br><pre class="btnlog">Already have an account? <a href="login.php" class="textdeco">Login here!</a></pre>
				</div>
				<p class="term">By clicking Register, you agree to our Terms, Data Policy and Cookie Policy<p>
			</form>
		</div>
	</body>
</html>

<?php

if (isset($_POST['username'], $_POST['password'],$_POST['gender'],$_POST['email'],$_POST['dob'],$_POST['security'])) {
   require_once 'connection.php';
    $uname=$_POST['username'];
    $password=$_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
	$Gender=$_POST['gender'];
	$mail=$_POST['email'];
	$dob=$_POST['dob'];
	$Security=$_POST['security'];
	$userType="Member";
	
	
   $query1 = "SELECT `email` FROM `users` WHERE `email`='$mail';";
   $query_exist = mysqli_query($con,$query1);

   if(!$query_exist){
	
	die("Error insert: " . mysqli_error($con) . "</br> Error number: " . mysqli_errno($con));

   }
   else{
	
	   if (mysqli_num_rows($query_exist)==1) {
                 echo '<script>
                         displayWarningMessage("Email already exist.")
                        </script>';
        }
        else{
            $usernameQuery = "SELECT `username` FROM `users` WHERE `username`='$uname';";
            $query_exist = mysqli_query($con,$usernameQuery);
         
            if(!$query_exist){
             
             die("Error insert: " . mysqli_error($con) . "</br> Error number: " . mysqli_errno($con));
         
            }
            else{
                if (mysqli_num_rows($query_exist)==1) {
                    echo '<script>alert("Username not available. Please choose a new one")</script>';
            } else{
                $query = "INSERT INTO users(email, username, password, gender, dob, type, security_answer) VALUES('$mail','$uname','$hashed_password','$Gender','$dob','$userType','$Security')";
                $result= mysqli_query($con,$query);
    
                if(!$result){
                  die("Error insert: " . mysqli_error($con) . "</br> Error number: " . mysqli_errno($con));
                            }
    
                else { 
                    $Message='';
                    // header("location:login.php?Message={$Message}");
                    header("Location: registerationSuccess.php"); // Redirect to a success page
                    exit(); // Make sure no other content is sent

                    }
                    
                }     
            }
        }
        } 

mysqli_close($con);
}


?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
