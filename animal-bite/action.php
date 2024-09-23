<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

include '../includes/connect.php';
include '../includes/auth.php';

if(isset($_POST['submitReport'])) {
	$barangay = $_POST['barangay'];
	$deyt = $_POST['deyt'];
	$taym = $_POST['taym'];
	$contactno = $_POST['contactno'];
	$remarks = $_POST['remarks'];
	$user_id = $_POST['user_id'];

	$sql = $conn->prepare("INSERT INTO reports(barangay, deyt, taym, contactno, user_id, remarks) VALUES(?,?,?,?,?,?)");
	$sql->bind_param("ssssss", $barangay, $deyt, $taym, $contactno, $user_id, $remarks);

	if($sql->execute()) {
		echo "<script>alert('New report has been submitted! Please wait for the response of the officials. Thank you!');document.location.href='../animal-bite'</script>";
	} else {
		$error = "Error: ". $conn->error;
		$error_explode = explode("'", $error);
		$error_implode = implode("", $error_explode);
		echo "<script>alert('$error_implode');document.location.href='../animal-bite'</script>";
	}
}
?>