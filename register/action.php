<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");

if(isset($_POST['btnSignUp'])) {
	include "../includes/connect.php";

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$contactno = $_POST['contactno'];
	$address = $_POST['address'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	$deyt = date('Y-m-d');
	$taym = date('g:i A');

	if($password === $confirm_password) {
		$sql = "SELECT * FROM users WHERE firstname LIKE '%$firstname%' AND lastname LIKE '%$lastname%' AND contactno = '$contactno' AND is_verified = 1";
		$res = mysqli_query($conn, $sql);
		$num = mysqli_num_rows($res);
		if($num == 0) {
			$slug = date('Y') .'-'. substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),0,5);
			$top = substr(str_shuffle('1234567890'),0,1);
			$top2 = substr(str_shuffle('1234567890'),0,1);
			$top3 = substr(str_shuffle('1234567890'),0,1);
			$top4 = substr(str_shuffle('1234567890'),0,1);
			$top5 = substr(str_shuffle('1234567890'),0,1);
			$code = $top . $top2 . $top3 . $top4 . $top5;

			$sql2 = $conn->prepare("INSERT INTO users(firstname, lastname, emailadd, contactno, address, username, password, slug, code, deyt, taym) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
			$sql2->bind_param("sssssssssss", $firstname, $lastname, $email, $contactno, $address, $username, $password, $slug, $code, $deyt, $taym);
			if($sql2->execute()) {
				//required files
				require '../phpmailer/src/Exception.php';
				require '../phpmailer/src/PHPMailer.php';
				require '../phpmailer/src/SMTP.php';

				//Create an instance; passing `true` enables exceptions
				$mail = new PHPMailer(true);

				//Server settings
				$mail->isSMTP();                              //Send using SMTP
				$mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
				$mail->SMTPAuth   = true;             //Enable SMTP authentication
				$mail->Username   = 'catbaloganpetcare@gmail.com';   //SMTP write your email
				//$mail->Password   = 'yqmzphdnunzusvgw';      //SMTP password for nagalislaer@gmail.com
				$mail->Password   = 'kerprtivwjudxels';
				$mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
				$mail->Port       = 465;                                    

				//Recipients
				$mail->setFrom('catbaloganpetcare@gmail.com', 'Catbalogan Pet Care'); // Sender Email and name
				$mail->addAddress($_POST['email']);     //Add a recipient email  
				//$mail->addReplyTo($_POST["email"], $_POST["name"]); // reply to sender email

				//Content
				$mail->isHTML(true);               //Set email format to HTML
				$mail->Subject = 'Confirmation Code';   // email subject headings
				$mail->Body    = 'Hello, good day!<br>Your confirmation code is '. $code; //email message

				// Success sent message alert
				$mail->send();
				echo "<script>alert('We sent a code to your email. Please check and return here after getting the code. Thank you!');document.location.href='../register/?slug=".$slug."';</script>";
			}
		} else {
			echo "<script>alert('User with the same info already exist in the database!');window.location.href='../register'</script>";
		}
	} else {
		echo "<script>alert('Password did not match!');window.location.href='../register'</script>";
	}
}

if(isset($_POST['btnConfirm'])) {
	include "../includes/connect.php";
	$confirmation = $_POST['confirmation'];
	$slug = $_POST['slug'];

	$sql = "SELECT * FROM users WHERE slug = '$slug' AND code = '$confirmation'";
	$res = mysqli_query($conn, $sql);
	$num = mysqli_num_rows($res);

	if($num > 0) {
		$row = mysqli_fetch_assoc($res);
		$id = $row['id'];
		$sql2 = "UPDATE users SET is_verified = 1 WHERE id = '$id'";
		if(mysqli_query($conn, $sql2)) {
			$_SESSION['session123xyz'] = $row['id'];
			echo "<script>alert('Congratulations, your account has been verified!');document.location.href='../appointments'</script>";
		} else {
			$error = "Error: ". mysqli_error($conn);
			$error_explode = explode("'", $error);
			$error_implode = implode("", $error_explode);
			echo "<script>alert('$error_implode');document.location.href='../register/?slug=".$slug."'</script>";
		}
	} else {
		echo "<script>alert('Incorrect confirmation code! Please try again.');document.location.href='../register/?slug=".$slug."'</script>";
	}
}

?>