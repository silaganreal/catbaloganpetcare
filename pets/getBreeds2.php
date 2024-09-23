<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

include '../includes/connect.php';
include '../includes/auth.php';

if(isset($_GET['type'])) {
	$type = $_GET['type'];

	$sql = "SELECT * FROM breeds WHERE type_id = '$type'";
	$res = mysqli_query($conn, $sql);
	$num = mysqli_num_rows($res);

	echo '<select name="breed" id="sel_breed2" class="form-control" required>';

	if($num > 0) {
		while($row = mysqli_fetch_assoc($res)) {
			echo '<option value="'.$row['id'].'">'.$row['breed'].'</option>';
		}
	} else {
		echo '<option value="">no breed available</option>';
	}
	
	echo '</select>';
}
?>