<?php
include("connect.php");
$query = "SELECT * FROM event";
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
			<th colspan="4"><h2>Event list</h2></th>
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
		<form method="post" action="eventlist.php" >
			<p>
				<label>Event ID that you want to view: 
					<input type="number" name="event_id" min="1" step="1" />
					<input type="submit" value="Enter" name="view_event">
				</label>
			</p>
			<input type="submit" value="Back" name="back">
		</form>
	</div>
</body>
</html>

<?php
session_start();
if (isset($_POST['view_event'])) {
	$event_id = $_POST['event_id'];
	$query2 = "SELECT * FROM event WHERE event_id='$event_id'";
    $results2 = mysqli_query($db, $query2);
	if (mysqli_num_rows($results2) > 0) {
		$_SESSION['event_id'] = $event_id;
		header('location: eventPage.php');
	}
	else {
?>
		<script type = "text/javascript">
            alert("The ID you type is invalid!");
            window.location.replace("eventlist.php");
        </script>
<?php
	}
}

if (isset($_POST['back'])) {
	header('location: Success.php');
}
?>