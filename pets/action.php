<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

include '../includes/connect.php';
include '../includes/auth.php';

$deyt = date('Y-m-d');
$taym = date('g:i A');

if(isset($_POST['saveNewPet'])) {
	$owner_id = $session_id;
	$pettype = $_POST['pettype'];
	$breed = $_POST['breed'];
	$petname = $_POST['petname'];
	$birthdate = $_POST['birthdate'];
	$slug = date('Y') .'-'. substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),0,5);

	$sql = "SELECT * FROM pets WHERE owner_id = '$owner_id' AND type = '$pettype' AND name = '$petname'";
	$res = mysqli_query($conn, $sql);
	$num = mysqli_num_rows($res);

	if($num == 0) {
		$sql2 = $conn->prepare("INSERT INTO pets(owner_id, type, name, breed, birthdate, slug, deyt, taym) VALUES(?,?,?,?,?,?,?,?)");
		$sql2->bind_param("ssssssss", $owner_id, $pettype, $petname, $breed, $birthdate, $slug, $deyt, $taym);

		if($sql2->execute()) {
			echo "<script>alert('New pet has been saved!');window.location.href='../pets'</script>";
		} else {
			$error = "Error: ". $conn->error;
			$error_explode = explode("'", $error);
			$error_implode = implode("", $error_explode);
			echo "<script>alert('$error_implode');window.location.href='../pets'</script>";
		}
	}
}

if(isset($_POST['editPet'])) {
	$pettype = $_POST['pettype'];
	$breed = $_POST['breed'];
	$petname = $_POST['petname'];
	$birthdate = $_POST['birthdate'];
	$pet_id = $_POST['pet_id'];

	$sql = $conn->prepare("UPDATE pets SET type=?, name=?, breed=?, birthdate=? WHERE id=?");
	$sql->bind_param("sssss", $pettype, $petname, $breed, $birthdate, $pet_id);

	if($sql->execute()) {
		echo "<script>alert('Pet Record has been updated!');window.location.href='../pets'</script>";
	} else {
		$error = "Error: ". $conn->error;
		$error_explode = explode("'", $error);
		$error_implode = implode("", $error_explode);
		echo "<script>alert('$error_implode');window.location.href='../pets'</script>";
	}
}

?>