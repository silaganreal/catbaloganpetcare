<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

include '../includes/connect.php';
include '../includes/auth.php';

if(isset($_GET['pet'])) {
	$slug = $_GET['pet'];
	$sql = "SELECT a.id, a.type AS type_id, a.name, a.breed AS breed_id, a.birthdate, a.photo, b.type, c.breed, d.firstname, d.lastname FROM pets AS a LEFT JOIN pettypes AS b ON a.type=b.id LEFT JOIN breeds AS c ON a.breed=c.id LEFT JOIN users AS d ON a.owner_id=d.id WHERE a.slug = '$slug'";
	$res = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($res);
	$pet_id = $row['id'];
	$pet_photo = $row['photo'];
	$type_id = $row['type_id'];
	$_age = floor((time() - strtotime($row['birthdate'])) / 31556926);

	$sql2 = "SELECT a.purpose, a.remarks, a.deyt, a.taym, b.firstname, b.lastname FROM appointments AS a LEFT JOIN users AS b ON a.clinic=b.id WHERE a.pet_id = '$pet_id' AND a.status = 'Finished'";
	$res2 = mysqli_query($conn, $sql2);
} else {
	header('location: ../');
}
?>
<!doctype html>
<html lang="en" class="color-sidebar sidebarcolor8 color-header headercolor4">
<head>
	<?php include '../includes/head.php'; ?>
	<title>Pet Care | History</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<?php
		$class_appointments = '';
		$link_appointments = '../appointments';

		$class_pets = 'mm-active';
		$link_pets = '#';

		$class_finished = '';
		$link_finished = '../finished';

		$class_anti_rabies = '';
		$link_anti_rabies = '../anti-rabies';

		$class_animal_bite = '';
		$link_animal_bite = '../animal-bite';

		$class_feedback = '';
		$link_feedback = '../feedback';

		include "../includes/sidebar.php";
		?>

		<?php include "../includes/header.php"; ?>
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">

				<div class="container">
					<div class="main-body">
						<div class="row">
							<div class="col-lg-4">
								<div class="card">
									<div class="card-body">
										<div class="d-flex flex-column align-items-center text-center">
											<?php
											if($pet_photo == '') {
												?>
												<img src="../assets/images/petcare-logo.png" id="profileImage" class="rounded-circle p-1 bg-primary" width="110" height="110" alt="...">
												<?php
											} else {
												?>
												<img src="../assets/images/pets/<?php echo $pet_photo; ?>" id="profileImage" class="rounded-circle p-1 bg-primary" width="110" height="110" alt="...">
												<?php
											}
											?>
											<div class="mt-2">
												<h4><?php echo $row['name']; ?></h4>
												<p class="text-secondary mb-1"><?php echo $row['type'] .' - '. $row['breed']; ?></p>
												<p class="text-muted font-size-sm">Owner: <?php echo $row['firstname'] .' '. $row['lastname']; ?></p>
												<button class="btn btn-primary" id="btnEditProfile">Change Profile</button>
												<form action="./action.php" method="post" enctype="multipart/form-data">
													<button type="submit" class="btn btn-sm btn-success" id="btnUpdateProfile" name="btnUpdateProfile" style="display:none;">Update</button>
												<!--------------------------------------Upload Photo----------------------------------------------------------->
													<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
													<div class="row justify-content-center gap-4">
														<div class="col-md-5" style="display:flex;align-items:center;justify-content:center;gap:20px;">
															<input id="imageUpload" type="file" name="prof_photo" placeholder="Photo" required capture style="display:none;">
														</div>
													</div>
													<script type="text/javascript">
														$("#btnEditProfile").click(function(e) {
															$("#imageUpload").click();
														});

														$("#profileImage").click(function(e) {
														    $("#imageUpload").click();
														});

														function fasterPreview( uploader ) {
														    if ( uploader.files && uploader.files[0] ){
														    	$('#profileImage').attr('src', window.URL.createObjectURL(uploader.files[0]) );
														    	document.getElementById('btnEditProfile').style.display = 'none';
														    	document.getElementById('btnUpdateProfile').style.display = '';
														    }
														}

														$("#imageUpload").change(function(){
														    fasterPreview( this );
														});
													</script>
												<!--------------------------------------Upload Photo----------------------------------------------------------->
													<input type="hidden" name="pet_slug" value="<?php echo $slug; ?>" required>
													<input type="hidden" name="pet_id" value="<?php echo $pet_id; ?>" required>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-8">
								<div class="card">
									<div class="card-body">
										<div class="row mb-3">
											<div class="col">
												<h5 class="">Pet Info</h5>
											</div>
											<div class="col">
												<?php
												if($is_admin == 1) {
													?><a href="../appointments" class="btn btn-sm btn-secondary float-end">Back</a><?php
												} else {
													?><a href="../pets" class="btn btn-sm btn-secondary float-end">Back</a><?php
												}
												?>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-2">
												<h6 class="mb-0">Name</h6>
											</div>
											<div class="col-sm-10 text-secondary">
												<input type="text" class="form-control" value="<?php echo $row['name']; ?>" readonly/>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-2">
												<h6 class="mb-0">Type</h6>
											</div>
											<div class="col-sm-10 text-secondary">
												<input type="text" class="form-control" value="<?php echo $row['type']; ?>" readonly/>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-2">
												<h6 class="mb-0">Breed</h6>
											</div>
											<div class="col-sm-10 text-secondary">
												<input type="text" class="form-control" value="<?php echo $row['breed']; ?>" readonly/>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-sm-2">
												<h6 class="mb-0">Birthdate</h6>
											</div>
											<div class="col-sm-10 text-secondary">
												<input type="text" class="form-control" value="<?php echo $row['birthdate'] .' ('. $_age .')'; ?>" readonly/>
											</div>
										</div>
										<div class="row mb-2">
											<div class="col-sm-2">
												<h6 class="mb-0">Owner</h6>
											</div>
											<div class="col-sm-10 text-secondary">
												<input type="text" class="form-control" value="<?php echo $row['firstname'] .' '. $row['lastname']; ?>" readonly/>
											</div>
										</div>
										<div class="row mt-3">
											<div class="col-sm-2">
												<h6 class="mb-0"></h6>
											</div>
											<div class="col-sm-10 text-secondary">
												<button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editPet<?php echo $row['id']; ?>">Edit Info</button>
											</div>
										</div>
										<?php include '../pets/modalEditPet.php'; ?>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col">
												<h5 class="">History</h5>
											</div>
										</div>
										<div class="table-responsive">
											<table class="table align-middle mb-0 dt-tables" style="width:100%">
												<thead class="table-light">
													<tr>
												   		<th>
												   			<div class="float-start" style="width:10px;">#</div>
												   		</th>
												   		<th>Purpose</th>
												   		<th>Date</th>
												   		<th>Clinic</th>
												   		<th>Remarks</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$a = 1;
													while($row2 = mysqli_fetch_assoc($res2)) {
														?>
														<tr>
															<td><div class="float-start" style="width:10px;"><?php echo $a; ?></div></td>
															<td><?php echo $row2['purpose']; ?></td>
															<td><?php echo $row2['deyt'] .' '. $row2['taym']; ?></td>
															<td><?php echo $row2['firstname'] .' '. $row2['lastname']; ?></td>
															<td><?php echo $row2['remarks']; ?></td>
														</tr>
														<?php
														$a++;
													}
													?>
											    </tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
		<!--end page wrapper -->

		<footer class="page-footer">
			<p class="mb-0">Copyright © <?php echo date('Y'); ?>. All rights reserved.</p>
		</footer>
	</div>
	<!--end wrapper-->

	<?php include '../includes/script.php'; ?>
</body>

</html>