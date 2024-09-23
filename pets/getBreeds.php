<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

include '../includes/connect.php';
include '../includes/auth.php';

if(isset($_GET['type'])) {
	$type = $_GET['type'];

	$sql = "SELECT * FROM breeds WHERE type_id = '$type'";
	$res = mysqli_query($conn, $sql);

	// echo '<label>Breed</label>';
	echo '<select name="breed" id="sel_breed" class="form-control" required>';
	echo '<option value="">Select Breed</option>';

	while($row = mysqli_fetch_assoc($res)) {
		echo '<option value="'.$row['id'].'">'.$row['breed'].'</option>';
	}

	echo '</select>';
}
?>