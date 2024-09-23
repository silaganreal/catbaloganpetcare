<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

include '../includes/connect.php';
include '../includes/auth.php';

if(isset($_POST['saveNewPet'])) {
	$pet_id = $_POST['pet_id'];
	$purpose = $_POST['purpose'];
	$clinic = $_POST['clinic'];
	$deyt = $_POST['deyt'];
	$time_slot = $_POST['time_slot'];

	$sql = $conn->prepare("INSERT INTO appointments(pet_id, purpose, clinic, deyt, taym) VALUES(?,?,?,?,?)");
	$sql->bind_param("sssss", $pet_id, $purpose, $clinic, $deyt, $time_slot);

	if($sql->execute()) {
		echo "<script>alert('New appointment has been scheduled!');window.location.href='../appointments'</script>";
	} else {
		$error = "Error: ". $conn->error;
		$error_explode = explode("'", $error);
		$error_implode = implode("", $error_explode);
		echo "<script>alert('$error_implode');window.location.href='../appointments'</script>";
	}
}

if(isset($_GET['cancel'])) {
	$id = $_GET['cancel'];
	$sql = "UPDATE appointments SET status = 'Cancelled' WHERE id = '$id'";
	if(mysqli_query($conn, $sql)) {
		echo "<script>alert('Schedule has been cancelled!');window.location.href='../appointments'</script>";
	}
}

if(isset($_POST['saveStatus'])) {
	$remarks = $_POST['remarks'];
	$appointment_id = $_POST['appointment_id'];

	$sql = "UPDATE appointments SET status = 'Finished', remarks = '$remarks' WHERE id = '$appointment_id'";
	if(mysqli_query($conn, $sql)) {
		echo "<script>alert('Appointment has been finished!');window.location.href='../appointments'</script>";
	} else {
		$error = "Error: ". mysqli_error($conn);
		$error_explode = explode("'", $error);
		$error_implode = implode("", $error_explode);
		echo "<script>alert('$error_implode');window.location.href='../appointments'</script>";
	}
}
?>