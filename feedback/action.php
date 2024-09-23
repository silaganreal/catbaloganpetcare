<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

include '../includes/connect.php';
include '../includes/auth.php';

if(isset($_POST['submitFeedback'])) {
	$concern = $_POST['concern'];
	$message = $_POST['message'];
	$user_id = $_POST['user_id'];
	$deyt = date('Y-m-d');
	$taym = date('g:i A');

	$sql2 = "SELECT * FROM messages WHERE concern LIKE '%$concern%' AND user_id = '$user_id'";
	$res2 = mysqli_query($conn, $sql2);
	$num2 = mysqli_num_rows($res2);

	if($num2 == 0) {
		$sql = $conn->prepare("INSERT INTO messages(user_id, concern, message, deyt, taym) VALUES(?,?,?,?,?)");
		$sql->bind_param("sssss", $user_id, $concern, $message, $deyt, $taym);

		if($sql->execute()) {
			echo "<script>alert('Feedback has been sent successfully!');document.location.href='../feedback'</script>";
		} else {
			$error = "Error: ". $conn->error;
			$error_explode = explode("'", $error);
			$error_implode = implode("", $error_explode);
			echo "<script>alert('$error_implode');document.location.href='../feedback'</script>";
		}
	}
}
?>