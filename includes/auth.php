<?php
if(!isset($_SESSION['session123xyz'])) {
	session_destroy();
	header('location: ../login');
} else {
	$session_id = $_SESSION['session123xyz'];
	$sql_user = "SELECT * FROM users WHERE id = '$session_id'";
	$res_user = mysqli_query($conn, $sql_user);
	$row_user = mysqli_fetch_assoc($res_user);
	$is_admin = $row_user['is_admin'];
}
?>