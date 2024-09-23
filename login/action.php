<?php
session_start();

if(isset($_POST['btnSignIn'])) {
	include "../includes/connect.php";

	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
	$res = mysqli_query($conn, $sql);
	$num = mysqli_num_rows($res);
	if($num > 0) {
		$row = mysqli_fetch_assoc($res);
		$verify = $row['is_verified'];
		if($verify == '1') {
			$_SESSION['session123xyz'] = $row['id'];
			header('location: ../appointments');
		} else {
			echo "<script>alert('Account not yet verified! Please check the email that is used to create the account. Thank you!');document.location.href='../login'</script>";
		}
	} else {
		echo "<script>alert('Provided credentials did not match on our database!');window.location.href='../login'</script>";
	}

} else {
	header('location: ../login');
} 

?>