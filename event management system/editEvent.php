<?php
include("connect.php");
session_start();
$event_id = $_SESSION['event_id'];
$results = mysqli_query($db, "SELECT * FROM event WHERE event_id='$event_id'");
$row=mysqli_fetch_assoc($results);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Event Management System</title>
</head>
<body>
<div class="container">
	<form method="post" action="editEvent.php">
		<h1>Create Event</h1>
		
		<hr>
				
		<p>
			<label>Event Name: <input name="name" type="text" size="30" value="<?php echo $row['name']; ?>" /></label>
		</p>
				
		<p>
			<label>Location: <input name="location" type="text" size="30" value="<?php echo $row['location']; ?>"/></label>
		</p>
			
		<p>
			<label>Starting date: <input name="start_date" type="datetime-local" value="<?php echo date('Y-m-d\TH:i', strtotime($row['start_date'])); ?>"/></label>
		</p>
				
		<p>
			<label>Ending date: <input name="end_date" type="datetime-local" value="<?php echo date('Y-m-d\TH:i', strtotime($row['end_date'])); ?>"/></label>
		</p>
				
		<p>
			<strong>Event Type:</strong><br>
			<label>Conference<input type="radio" name="type" value="Conference" <?php echo ($row['type']=='Conference')?'checked':'' ?>/></label><br>
		    <label>Traning<input type="radio" name="type" value="Traning" <?php echo ($row['type']=='Traning')?'checked':'' ?>/></label><br>
		    <label>Business<input type="radio" name="type" value="Business" <?php echo ($row['type']=='Business')?'checked':'' ?>/></label><br>
		    <label>Other<input type="radio" name="type" value="Other" <?php echo ($row['type']=='Other')?'checked':'' ?>/></label>
		</p>

		<p>
			<strong>Description:</strong><br>
			<textarea rows="6" cols="40" name="description"><?php echo $row['description']; ?></textarea>
		</p>

		    <input type = "submit" value = "Save" name = "save_edit">
			<input type="submit" value="Back" name="back">
	</form>
</div>
</body>
</html>

<?php
if (isset($_POST['save_edit'])) {
	$name = $_POST['name'];
	$location = $_POST['location'];
	$start_date = $_POST['start_date'];
	$end_date = $_POST['end_date'];
	$type = $_POST['type'];
	$description = $_POST['description'];
	$query = "UPDATE event SET name='$name', location='$location', start_date='$start_date', end_date='$end_date', type='$type', description='$description' WHERE event_id='$event_id'";
	mysqli_query($db, $query);
	if(mysqli_affected_rows($db) > 0) {
		?>
		<script type = "text/javascript">
            alert("Edit success!");
            window.location.replace("eventPageOrganiser.php");
        </script>
        <?php
	}
	else {
		?>
		<script type = "text/javascript">
            alert("Edit fail");
            window.location.replace("editEvent.php");
        </script>
        <?php
	}
}
?>