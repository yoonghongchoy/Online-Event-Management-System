<!DOCTYPE html>

<html>
	<head>
	 <div align="center">
		<meta charset="utf-8">
		<title>Web App Assignment</title>
	</head>
	
	<body>
		<div id="header">
			<img src = "Pic\smallLogo.png" width:"500" height = "220" alt = "Multimedia University" />
			<h1>Welcome to Online Event Management System<h1>
		</div>
		
		<div id = "link1"><a href = "eventlist.php"><h4><B>Attandee</B></h4></a></div>
		<div id = "link2"><a href = "myEvent.php"><h4>Organizer</h4></a></div>
		<form method="post" action="Success.php">
			<p>
				<input type="submit" value="Logout" name="logout">
			</p>
		</form>
		
<tr>

<td valign="bottom"><a href = "https://www.mmu.edu.my/"><img src="background.jpg" width="350" align="right" alt=""></a></td>
</tr>
	</body>
</html>

<?php
if (isset($_POST['logout'])) {
	session_start();
	session_unset();
	session_destroy();
	$_SESSION = array();
	header('location:Home.html');
}
?>