<?php
include("connect.php");
session_start();
$event_id = $_SESSION['event_id'];
$query = "SELECT * FROM event WHERE event_id='$event_id'";
$result = mysqli_query($db, $query);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Event Management System</title>
</head>
<body>
	<div class="container">
		<table>
			<?php
				while ($rows = mysqli_fetch_assoc($result)) {
			?>
			<tr>
				<th colspan="2"><h2><?php echo $rows['name']; ?></h2></th>
			</tr>
			<tr>
				<td>Created by: </td>
				<td><?php 
					$user_id = $rows['user_id'];
					$query2 = "SELECT name FROM user WHERE user_id='$user_id'";
					$result2 = mysqli_query($db, $query2);
					$rows2 = mysqli_fetch_assoc($result2);
					echo $rows2['name']; 
				?></td>
			</tr>
			<tr>
				<td>Location: </td>
				<td><?php echo $rows['location']; ?></td>
			</tr>
			<tr>
				<td>Start Date: </td>
				<td><?php echo $rows['start_date']; ?></td>
			</tr>
			<tr>
				<td>End Date: </td>
				<td><?php echo $rows['end_date']; ?></td>
			</tr>
			<tr>
				<td>Type: </td>
				<td><?php echo $rows['type']; ?></td>
			</tr>
			<tr>
				<td>Description: </td>
				<td><?php echo $rows['description']; ?></td>
			</tr>
			<?php
				}
			?>
		</table>
		<form method="post" action="eventPage.php">
			<input type="submit" value="Attend" name="attendEvent">
			<input type="submit" value="Back" name="back">
		</form>
	</div>
</body>
</html>

<?php
if (isset($_POST['attendEvent'])) {
	$user_id = $_SESSION['user_id'];
	$check = mysqli_query($db, "SELECT * FROM attendance WHERE user_id = '$user_id' AND event_id = '$event_id'");
	$check2 = mysqli_query($db, "SELECT * FROM event WHERE user_id = '$user_id' AND event_id = '$event_id'");

	if (mysqli_num_rows($check2) > 0) {
		?>
		<script type = "text/javascript">
	        alert("Organiser not allow to register event!");
	        window.location.replace("eventPage.php");
		</script>
		<?php
	} else if (mysqli_num_rows($check) > 0) {
		?>
		<script type = "text/javascript">
	        alert("You registered for this event!");
	        window.location.replace("eventPage.php");
		</script>
		<?php
	} else {
		mysqli_query($db, "INSERT INTO attendance (event_id, user_id) VALUES ('$event_id', '$user_id')");
		?>
		<script type = "text/javascript">
	        alert("Register for this event successfully!");
	        window.location.replace("eventlist.php");
		</script>
		<?php
	}
}

if (isset($_POST['back'])) {
	header('location: eventlist.php');
}
?>