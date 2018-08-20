<?php 
include "connect.php";
session_start();
$user_id = $_SESSION["user_id"];
$query = mysqli_query($db,"SELECT * FROM event WHERE user_id='$user_id'");
$row = mysqli_fetch_assoc($query);

$TodayDate = date("m-d-Y",time());
?>

<!DOCTYPE html>
<html>
	<head>
		<title> Event Management System </title>
		<meta charset = "utf-8">
	</head>
	
	<body>
		<div class="container">
			<form method="post" action="createEvent.php">
				<h1>Create Event</h1>
		
				<hr>
				
				<p>
					<label>Event Name: <input name="name" type="text" size="30"/></label>
				</p>
				
				<p>
					<label>Location: <input name="location" type="text" size="30"/></label>
				</p>
			
				<p>
					<label>Starting date: <input name="start_date" type="datetime-local" /></label>
				</p>
				
				<p>
					<label>Ending date: <input name="end_date" type="datetime-local" /></label>
				</p>
				
				<p>
					<strong>Event Type:</strong><br>
					<label>Conference<input type="radio" name="type" value="Conference"/></label><br>
		            <label>Traning<input type="radio" name="type" value="Traning"/></label><br>
		            <label>Business<input type="radio" name="type" value="Business"/></label><br>
		            <label>Other<input type="radio" name="type" value="Other"/></label>
				</p>

				<p>
					<strong>Description:</strong><br>
					<textarea rows="6" cols="40" name="description" placeholder="Tell peoplemore about the event."></textarea>
		        </p>

		        <input type = "submit" value = "Create" name = "create_event">
				<input type = "reset" value = "Clear" >
				<input type="submit" value="Back" name="back">
			</form>
		</div>
	</body>
</html>

<?php
if (isset($_POST['create_event'])) {
	$name = $_POST['name'];
	$location = $_POST['location'];
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	$type = $_POST['type'];
	$description = $_POST['description'];

	$check = mysqli_query($db,"SELECT * FROM event WHERE start_date='$start_date' AND end_date ='$end_date' AND location ='$location' ");
    
    if (mysqli_num_rows($check) > 0)
    {
        ?>
	    <script type = "text/javascript">
	        alert("Date, Time, Location already exist!  ");
	        window.location.replace("createEvent.php");
		</script>
	<?php

    }

    else 
    {
    	mysqli_query($db,"INSERT INTO event (name, location, start_date, end_date, type, description, user_id) VALUES 
    ('$name', '$location', '$start_date', '$end_date', '$type', '$description', '$user_id')");  
        ?>
        <script type = "text/javascript">
            alert("Successfuly Created!");
            window.location.replace("createEvent.php");
        </script>
    <?php 
    }
}

if (isset($_POST['back'])) {
	header('location: myEvent.php');
}
?>