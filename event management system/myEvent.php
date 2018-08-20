<?php
include("connect.php");
session_start();
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM event WHERE user_id='$user_id'";
$result = mysqli_query($db, $query);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Event Management System</title>
</head>
<body>
	<table>
		<tr>
			<th colspan="4"><h2>My Events</h2></th>
		</tr>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Location</th>
			<th>End Date</th>
		</tr>
		<?php
			while ($rows = mysqli_fetch_assoc($result)) {
		?>
				<tr>
					<td><?php echo $rows['event_id']; ?></td>
					<td><?php echo $rows['name']; ?></td>
					<td><?php echo $rows['location']; ?></td>
					<td><?php echo $rows['end_date']; ?></td>
				</tr>
		<?php
			}
		?>
	</table>

	<div class="container">
		<form method="post" action="myEvent.php" >
			<p>
				<label>
					Enter Event ID: 
					<input type="number" name="event_id" min="1" step="1" />
					<input type="submit" value="View" name="view_event2">
				</label>
			</p>
			<p>
				<label>
					<input type="submit" value="Add" name="add_event">
					<input type="submit" value="Back" name="back">
				</label>
			</p>
		</form>
	</div>
</body>
</html>

<?php
if (isset($_POST['view_event2'])) {
	$event_id = $_POST['event_id'];
	$query2 = "SELECT * FROM event WHERE event_id='$event_id'";
    $results2 = mysqli_query($db, $query2);
	if (mysqli_num_rows($results2) > 0) {
		$_SESSION['event_id'] = $event_id;
		header('location: eventPageOrganiser.php');
	}
	else {
?>
		<script type = "text/javascript">
            alert("The ID you type is invalid!");
            window.location.replace("myEvent.php");
        </script>
<?php
	}
}

if (isset($_POST['add_event'])) {
	header('location: createEvent.php');
}

if (isset($_POST['back'])) {
	header('location: Success.php');
}
?>