<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

include '../includes/connect.php';
include '../includes/auth.php';

if(isset($_GET['date']) && isset($_GET['clinic'])) {
	$date = $_GET['date'];
	$clinic = $_GET['clinic'];

	$sql = "SELECT * FROM timeslots";
	$res = mysqli_query($conn, $sql);

	echo '<select class="form-control" name="time_slot" id="time_slot" required>';
	echo '<option value="">Select Time Slot</option>';
	while($row = mysqli_fetch_assoc($res)) {
		$time = $row['time'];
		$sql2 = "SELECT * FROM appointments WHERE deyt = '$date' AND taym = '$time' AND status = 'Pending' AND clinic = '$clinic'";
		$res2 = mysqli_query($conn, $sql2);
		$num2 = mysqli_num_rows($res2);
		if($num2 > 0) {
			$disabled = 'disabled';
			$class = 'text-warning';
			$label = ' - occupied';
		} else {
			$disabled = '';
			$class = 'text-success';
			$label = ' - available';
		}
		?>
    	<option value="<?php echo $row['time']; ?>" class="<?php echo $class ?>" <?php echo $disabled; ?>><?php echo $row['time'] . $label; ?></option>
		<?php
	}
	echo '</select>';
}
?>