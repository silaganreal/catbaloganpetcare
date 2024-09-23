<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

include '../includes/connect.php';
include '../includes/auth.php';

if(isset($_POST['btnUpdateProfile'])) {
	$pet_id = $_POST['pet_id'];
	$pet_slug = $_POST['pet_slug'];

	$filename = $_FILES['prof_photo']['name'];
	$filesize = $_FILES['prof_photo']['size'];
	$filetype = $_FILES['prof_photo']['type'];
	$filetemp = $_FILES['prof_photo']['tmp_name'];
	$extension = pathinfo($filename, PATHINFO_EXTENSION);

	$file_path = time() .'-'. $pet_id .'.'. $extension;

	if(move_uploaded_file($filetemp, '../assets/images/pets/'.$file_path)) {
		$sql = "UPDATE pets SET photo = '$file_path' WHERE id = '$pet_id'";
		if(mysqli_query($conn, $sql)) {
			header('location: ../history/?pet='.$pet_slug);
		} else {
			header('location: ../');
		}
	}
}

if(isset($_POST['editPet'])) {
	$pettype = $_POST['pettype'];
	$breed = $_POST['breed'];
	$petname = $_POST['petname'];
	$birthdate = $_POST['birthdate'];
	$pet_id = $_POST['pet_id'];
	$pet_slug = $_POST['pet_slug'];

	$sql = $conn->prepare("UPDATE pets SET type=?, name=?, breed=?, birthdate=? WHERE id=?");
	$sql->bind_param("sssss", $pettype, $petname, $breed, $birthdate, $pet_id);

	if($sql->execute()) {
		echo "<script>alert('Pet Record has been updated!');window.location.href='../history/?pet=$pet_slug'</script>";
	} else {
		$error = "Error: ". $conn->error;
		$error_explode = explode("'", $error);
		$error_implode = implode("", $error_explode);
		echo "<script>alert('$error_implode');window.location.href='../history/?pet=$pet_slug'</script>";
	}
}
?>