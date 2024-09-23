<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

include '../includes/connect.php';
include '../includes/auth.php';

if($is_admin == 1) {
	$sql = "SELECT a.purpose, a.remarks, a.deyt, a.taym, b.name, c.type, d.firstname, d.lastname FROM appointments AS a LEFT JOIN pets AS b ON a.pet_id=b.id LEFT JOIN pettypes AS c ON b.type=c.id LEFT JOIN users AS d ON b.owner_id=d.id WHERE a.status = 'Finished' AND a.clinic = '$session_id'";
} else {
	$sql = "SELECT a.purpose, a.remarks, a.deyt, a.taym, b.name, c.type, d.firstname, d.lastname FROM appointments AS a LEFT JOIN pets AS b ON a.pet_id=b.id LEFT JOIN pettypes AS c ON b.type=c.id LEFT JOIN users AS d ON a.clinic=d.id WHERE a.status = 'Finished' AND b.owner_id = '$session_id'";
}

$res = mysqli_query($conn, $sql);
?>
<!doctype html>
<html lang="en" class="color-sidebar sidebarcolor8 color-header headercolor4">
<head>
	<?php include '../includes/head.php'; ?>
	<title>Pet Care | Finished</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<?php
		$class_appointments = '';
		$link_appointments = '../appointments';

		$class_pets = '';
		$link_pets = '../pets';

		$class_pettypes = '';
		$link_pettypes = '../pet-types';

		$class_finished = 'mm-active';
		$link_finished = '#';

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
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col">
												<h5 class="">Finished Appointments</h5>
											</div>
										</div>
										<div class="table-responsive">
											<table class="table align-middle mb-0 dt-tables" style="width:100%">
												<thead class="table-light">
													<tr>
												   		<th>
												   			<div class="float-start" style="width:10px;">#</div>
												   		</th>
												   		<?php
												   		if($is_admin == 1) {
												   			?><th>Owner</th><?php
												   		} else {
												   			?><th>Clinic</th><?php
												   		}
												   		?>
												   		<th>Pet</th>
												   		<th>Purpose</th>
												   		<th>Date</th>
												   		<th>Remarks</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$a = 1;
													while($row = mysqli_fetch_assoc($res)) {
														?>
														<tr>
															<td><div class="float-start" style="width:10px;"><?php echo $a; ?></div></td>
															<td><?php echo $row['firstname'] .' '. $row['lastname']; ?></td>
															<td><?php echo $row['name'] .' - '. $row['type']; ?></td>
															<td><?php echo $row['purpose']; ?></td>
															<td><?php echo $row['deyt'] .' '. $row['taym']; ?></td>
															<td><?php echo $row['remarks']; ?></td>
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