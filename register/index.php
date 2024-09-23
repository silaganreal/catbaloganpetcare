<?php
session_start();
session_destroy();
?>
<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="../assets/images/petcare-logo.png" type="image/png" />
	<!--plugins-->
	<link href="../assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
	<link href="../assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
	<link href="../assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
	<!-- loader-->
	<link href="../assets/css/pace.min.css" rel="stylesheet" />
	<script src="../assets/js/pace.min.js"></script>
	<!-- Bootstrap CSS -->
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/bootstrap-extended.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="../assets/css/app.css" rel="stylesheet">
	<link href="../assets/css/icons.css" rel="stylesheet">
	<title>Pet Care - Register</title>
</head>

<body class="bg-login">
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
					<div class="col mx-auto">
						<div class="mb-3 mt-2 text-center">
							<img src="../assets/images/petcare-logo.png" style="width:120px;height:110px;" />
						</div>
						<div class="card">
							<div class="card-body">
								<div class="border p-4 rounded">
									<div class="text-center">
										<h3 class="">Pet Care</h3>
									</div>
									<div class="form-body">
										<?php
										if(isset($_GET['slug']) && $_GET['slug'] !== '') {
											$slug = $_GET['slug'];
											?>
											<form class="row g-1 mb-3 mt-3" action="./action.php" method="post">
												<div class="col-md-12 mb-3">
													<label class="form-label">Confirmation Code</label>
													<input
														type="text"
														name="confirmation"
														class="form-control"
														placeholder="Enter confirmation code"
														required
													>
												</div>
												<input type="hidden" name="slug" value="<?php echo $slug; ?>">
												<div class="col-12 mt-2">
													<div class="d-grid">
														<button type="submit" name="btnConfirm" class="btn btn-primary">Confirm</button>
													</div>
												</div>
											</form>
											<?php
										} else {
											?>
											<form class="row g-1 mb-3" action="./action.php" method="post">
												<div class="col-md-6">
													<label class="form-label">First Name</label>
													<input
														type="text"
														name="firstname"
														class="form-control"
														placeholder="Juan"
														required
													>
												</div>
												<div class="col-md-6">
													<label class="form-label">Last Name</label>
													<input
														type="text"
														name="lastname"
														class="form-control"
														placeholder="Dela Cruz"
														required
													>
												</div>
												<div class="col-md-6">
													<label class="form-label">Email Address</label>
													<input
														type="email"
														name="email"
														class="form-control"
														placeholder="asd@gmail.com"
														required
													>
												</div>
												<div class="col-md-6">
													<label class="form-label">Contact No.</label>
													<input
														type="number"
														name="contactno"
														class="form-control"
														placeholder="09351281496"
														required
													>
												</div>
												<div class="col-md-12">
													<label class="form-label">Address</label>
													<input
														type="text"
														name="address"
														class="form-control"
														placeholder="Brgy. 25 Catbalogan City"
														required
													>
												</div>
												<div class="col-md-12">
													<label class="form-label">Username</label>
													<input
														type="text"
														name="username"
														class="form-control"
														placeholder="Enter username"
														required
													>
												</div>
												<div class="col-md-12">
													<label class="form-label">Password</label>
													<div class="input-group" id="show_hide_password">
														<input
															type="password"
															name="password"
															id="inp_password"
															class="form-control border-end-0"
															placeholder="Enter password"
															required
															onkeyup="checkpass()"
														>
														<a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
													</div>
												</div>
												<div class="col-md-12">
													<label class="form-label">Confirm Password</label>
													<div class="input-group" id="show_hide_password2">
														<input
															type="password"
															name="confirm_password"
															id="inp_password2"
															class="form-control border-end-0"
															placeholder="Confirm password"
															required
															onkeyup="checkpass()"
														>
														<a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
													</div>
												</div>
												<div id="lbl_check_pass"></div>
												<div class="col-md-12 mt-2">
													<div class="d-grid">
														<button type="submit" name="btnSignUp" id="btnSignUp" class="btn btn-primary" disabled><i class="bx bxs-lock-open"></i>Register</button>
													</div>
												</div>
											</form>
											<span>Already have an account? <a href="../login">Log In</a></span>
											<?php
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="../assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="../assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="../assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});

			$("#show_hide_password2 a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password2 input').attr("type") == "text") {
					$('#show_hide_password2 input').attr('type', 'password');
					$('#show_hide_password2 i').addClass("bx-hide");
					$('#show_hide_password2 i').removeClass("bx-show");
				} else if ($('#show_hide_password2 input').attr("type") == "password") {
					$('#show_hide_password2 input').attr('type', 'text');
					$('#show_hide_password2 i').removeClass("bx-hide");
					$('#show_hide_password2 i').addClass("bx-show");
				}
			});
		});

		function checkpass() {
			var pass = document.getElementById('inp_password').value;
			var pass2 = document.getElementById('inp_password2').value;
			var lbl_check_pass = document.getElementById('lbl_check_pass');

			if(pass === pass2) {
				document.getElementById('btnSignUp').disabled = false;
				lbl_check_pass.innerHTML = '<span class="text-success">Password matched!</span>';
			} else {
				document.getElementById('btnSignUp').disabled = true;
				lbl_check_pass.innerHTML = '<span class="text-danger">Password did not matched!</span>';
			}
		}
	</script>
	<!--app JS-->
	<!-- <script src="../assets/js/app.js"></script> -->
</body>

</html>