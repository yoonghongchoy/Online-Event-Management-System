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
		<form method="post" action="eventPageOrganiser.php">
			<input type="submit" value="Edit" name="editEvent">
			<input type="submit" value="Delete" name="deleteEvent">
			<input type="submit" value="Attendance" name="viewAttendance">
			<input type="submit" value="Back" name="back">
		</form>
	</div>
</body>
</html>

<?php
if (isset($_POST['editEvent'])) {
	header('location: editEvent.php');
}

if (isset($_POST['deleteEvent'])) {
	$deleteQuery = "DELETE FROM event WHERE event_id='$event_id'";
	mysqli_query($db, $deleteQuery);
	if(mysqli_affected_rows($db) > 0) {
		?>
		<script type = "text/javascript">
            alert("Delete success!");
            window.location.replace("myEvent.php");
        </script>
        <?php
	}
	else {
		?>
		<script type = "text/javascript">
            alert("Delete fail");
            window.location.replace("eventPageOrganiser.php");
        </script>
        <?php
	}
}

if (isset($_POST['viewAttendance'])) {
	header('location: attendance.php');
}

if (isset($_POST['back'])) {
	header('location: myEvent.php');
}
?>