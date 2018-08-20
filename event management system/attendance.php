<?php
include("connect.php");
session_start();
$event_id = $_SESSION['event_id'];
$result = mysqli_query($db, "SELECT * FROM attendance WHERE event_id='$event_id'");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Event Management System</title>
</head>
<body>
	<table>
		<?php
			while ($rows = mysqli_fetch_assoc($result)) {
				$user_id = $rows['user_id'];
				$query2 = "SELECT * FROM user WHERE user_id='$user_id'";
				$result2 = mysqli_query($db, $query2);
				$rows2 = mysqli_fetch_assoc($result2);
		?>
		<tr>
			<th colspan="4"><h2>Attendance list</h2></th>
		</tr>
		<tr>
			<td>ID</td>
			<td>Name</td>
			<td>Contact</td>
			<td>Email</td>
		</tr>
		<tr>
			<td><?php echo $rows['attendance_id']; ?></td>
			<td><?php echo $rows2['name']; ?></td>
			<td><?php echo $rows2['contact']; ?></td>
			<td><?php echo $rows2['email']; ?></td>
		</tr>
		<?php
			}
		?>
	</table>
	<form method="post" action="attendance.php">
		<p>
			<input type="submit" value="Back" name="back">
		</p>
	</form>
</body>
</html>

<?php
if (isset($_POST['back'])) {
	header('location: eventPageOrganiser.php');
}
?>