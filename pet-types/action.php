<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

include '../includes/connect.php';
include '../includes/auth.php';

if(isset($_POST['saveNewPetType'])) {
	$type = $_POST['type'];

	$sql = "SELECT * FROM pettypes WHERE type = '$type'";
	$res = mysqli_query($conn, $sql);
	$num = mysqli_num_rows($res);

	if($num === 0) {
		$sql2 = $conn->prepare("INSERT INTO pettypes(type) VALUES(?)");
		$sql2->bind_param("s", $type);

		if($sql2->execute()) {
			echo "<script>alert('New pet type has been saved!');window.location.href='../pet-types'</script>";
		} else {
			$error = $conn->error;
			$error_explode = explode("'", $error);
			$error_implode = implode("", $error_explode);
			echo "<script>alert('$error_implode');window.location.href='../pet-types'</script>";
		}
	} else {
		echo "<script>alert('Type and Breed already exist on the database.');window.location.href='../pet-types'</script>";
	}
}

if(isset($_POST['editType'])) {
	$type = $_POST['type'];
	$type_id = $_POST['type_id'];

	$sql = "UPDATE pettypes SET type = '$type' WHERE id = '$type_id'";
	if(mysqli_query($conn, $sql)) {
		echo "<script>alert('Type has been updated!');window.location.href='../pet-types'</script>";
	} else {
		$error = "Error: ". mysqli_error($conn);
		$error_explode = explode("'", $error);
		$error_implode = implode("", $error_explode);
		echo "<script>alert('$error_implode');window.location.href='../pet-types'</script>";
	}
}

if(isset($_GET['delete'])) {
	$id = $_GET['delete'];

	$sql = "DELETE FROM pettypes WHERE id = '$id'";
	if(mysqli_query($conn, $sql)) {
		echo "<script>alert('Type has been deleted!');window.location.href='../pet-types'</script>";
	} else {
		$error = "Error: ". mysqli_error($conn);
		$error_explode = explode("'", $error);
		$error_implode = implode("", $error_explode);
		echo "<script>alert('$error_implode');window.location.href='../pet-types'</script>";
	}
}

if(isset($_POST['saveNewBreed'])) {
	$breed = $_POST['breed'];
	$type_id = $_POST['type_id'];

	$sql = $conn->prepare("INSERT INTO breeds(type_id, breed) VALUES(?,?)");
	$sql->bind_param("ss", $type_id, $breed);

	if($sql->execute()) {
		echo "<script>alert('New Breed has been saved!');window.location.href='../pet-types'</script>";
	} else {
		$error = "Error: ". $conn->error;
		$error_explode = explode("'", $error);
		$error_implode = implode("", $error_explode);
		echo "<script>alert('$error_implode');window.location.href='../pet-types'</script>";
	}
}

if(isset($_GET['delete_breed'])) {
	$breed_id = $_GET['delete_breed'];

	$sql = "DELETE FROM breeds WHERE id = '$breed_id'";
	if(mysqli_query($conn, $sql)) {
		echo "<script>alert('Breed has been deleted!');window.location.href='../pet-types'</script>";
	} else {
		$error = "Error: ". mysqli_error($conn);
		$error_explode = explode("'", $error);
		$error_implode = implode("", $error_explode);
		echo "<script>alert('$error_implode');window.location.href='../pet-types'</script>";
	}
}
?>