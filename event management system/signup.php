<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Web App Assignment</title>
</head>
<body>
	<div class="container">
		<form method="post" action="signup.php">
			<?php include('errors.php'); ?>
			<img src = "Pic\smallLogo.png"/>
			<h1>Welcome to Online Event Management System</h1>
			<HR>
			<h2><b>Register Page</b></h2>
			<HR>
			<p>Name: <input type = "name" name = "name" type = "text"></p>

		    <p>IC:
		    <input type = "text" name = "ic" value="<?php echo $ic; ?>"></p>
			
			<p>Contact:
			<input type= "tel" name = "contact" placeholder = "##########" pattern = "\d{10}"></p>
			
			<p>Email:
			<input type = "email" name = "email" type = "password" value="<?php echo $email; ?>"></p>
			
			<p>Address: </p>
			<p><textarea name = "address" rows = "4" cols ="36" placeholder="Enter address here..."></textarea></p>
			
			<input type = "submit" value = "Register" name = "sign_up">
			<input type = "reset" value = "Clear" >
		</form>
	</div>
</body>
</html>