<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

include '../includes/connect.php';
include '../includes/auth.php';

if($is_admin == 1) {
	$sql = "SELECT a.id, a.purpose, a.clinic, a.deyt, a.taym, a.status, b.owner_id, b.name, b.slug FROM appointments AS a LEFT JOIN pets AS b ON a.pet_id=b.id LEFT JOIN users AS c ON b.owner_id=c.id WHERE a.status = 'Pending' AND a.clinic = '$session_id'";
} else {
	$sql = "SELECT a.id, a.purpose, a.clinic, a.deyt, a.taym, a.status, b.name, b.slug, b.owner_id FROM appointments AS a LEFT JOIN pets AS b ON a.pet_id=b.id LEFT JOIN users AS c ON b.owner_id=c.id WHERE b.owner_id = '$session_id' AND a.status = 'Pending'";
}

$res = mysqli_query($conn, $sql);

$varSess = $_SESSION['varSess'] = time();
$currentDate = date('Y-m-d');
$lastDay = date('Y-m-t', strtotime($currentDate));
?>
<!doctype html>
<html lang="en" class="color-sidebar sidebarcolor8 color-header headercolor4">
<head>
	<?php include '../includes/head.php'; ?>
	<title>Pet Care | Appointments</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<?php
		$class_appointments = 'mm-active';
		$link_appointments = '#';

		$class_finished = '';
		$link_finished = '../finished';

		if($is_admin == 1) {
			$class_pettypes = '';
			$link_pettypes = '../pet-types';
		} else {
			$class_pets = '';
			$link_pets = '../pets';
		}

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

				<div class="card radius-10">
					<div class="card-body">
						<div class="d-flex align-items-center justify-content-between mb-3 gap-2">
							<div class="row align-items-center gap-1">
								<div class="col">
									<h4 class="mb-0">Appointments</h4>
								</div>
								<?php
								if($is_admin == 0) {
									?>
									<div class="col-auto">
										<button class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#addNewAppointment" style="background:#008040;color:white;">New Appointment</button>
									</div>
									<?php
								}
								?>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table align-middle mb-0 dt-tables" style="width:100%">
								<thead class="table-light">
									<tr>
								   		<th>
								   			<div class="float-start" style="width:10px;">#</div>
								   		</th>
								   		<th>Pet Name</th>
								   		<th>Purpose</th>
								   		<?php
								   		if($is_admin == 1) {
								   			?><th>Owner</th><?php
								   		} else {
								   			?><th>Clinic</th><?php
								   		}
								   		?>
								   		<th>Schedule</th>
								   		<th>
								   			<div class="float-end" style="margin-right:10px;">Action</div>
								   		</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$a = 1;
									while($row = mysqli_fetch_assoc($res)) {
										$id = $row['id'];
										if($is_admin == 1) {
											$owner_id = $row['owner_id'];
											$sql2 = "SELECT * FROM users WHERE id = '$owner_id'";
											$res2 = mysqli_query($conn, $sql2);
											$row2 = mysqli_fetch_assoc($res2);
										} else {
											$clinic_id = $row['clinic'];
											$sql2 = "SELECT * FROM users WHERE id = '$clinic_id'";
											$res2 = mysqli_query($conn, $sql2);
											$row2 = mysqli_fetch_assoc($res2);
										}
										?>
										<tr>
											<td><div class="float-start" style="width:10px;"><?php echo $a; ?></div></td>
											<td><?php echo $row['name']; ?></td>
											<td><?php echo $row['purpose']; ?></td>
											<td><?php echo $row2['firstname'] .' '. $row2['lastname']; ?></td>
											<td><?php echo $row['deyt'] .'-'. $row['taym']; ?></td>
											<td><div class="float-end d-flex gap-1" style="margin-right:10px;">
												<?php
												if($is_admin == 1) {
													?>
													<button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#finish<?php echo $id; ?>">Finish</button><a href="../history/?pet=<?php echo $row['slug']; ?>" class="btn btn-sm btn-success">View Profile</a
													<?php
												} else {
													?>
													<a href="./action.php?cancel=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger mr-1" onclick="return confirm('Are you sure you want to cancel this schedule?')">Cancel</a>
													<?php
												}
												?>
												
											</div></td>
										</tr>
										<?php
										$a++;
										if($is_admin == 1) {
											include './modalFinishAppointment.php';
										}
									}
									?>
							    </tbody>
							</table>
						</div>
					</div>
				</div>

			</div>
		</div>
		<!--end page wrapper -->

		<div class="modal fade" id="addNewAppointment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header" style="background:#008040;">
		        <h5 class="modal-title" id="staticBackdropLabel" style="color:white;">Add New Appointment</h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body">
		        <form action="./action.php" method="post">
		        	<div class="form-group mb-2">
	                	<label>Pet</label>
	                	<select name="pet_id" class="form-control" required>
	                		<option value="" selected>Select Pet</option>
	                		<?php
	                		$sql = "SELECT * FROM pets WHERE owner_id = '$session_id'";
							$res = mysqli_query($conn, $sql);
	                		while($row = mysqli_fetch_assoc($res)) {
	                			?>
	                			<option value="<?php echo $row['id'] ?>"><?php echo $row['name']; ?></option>
	                			<?php
	                		}
	                		?>
	                	</select>
	              	</div>
	              	<div class="form-group mb-2">
	              		<label>Purpose</label>
	              		<select name="purpose" class="form-control" required>
	              			<option value="">Select Purpose</option>
	              			<option value="Vaccination">Vaccination</option>
	              			<option value="Anti-Rabbies">Anti-Rabbies</option>
	              		</select>
	              	</div>
	              	<div class="form-group mb-2">
	              		<label>Clinic</label>
	              		<select name="clinic" id="sel_clinic" class="form-control" required onchange="select_clinic(this.value)">
	              			<option value="">Select Clinic</option>
	              			<?php
	              			$sql = "SELECT * FROM users WHERE is_admin = 1";
	              			$res = mysqli_query($conn, $sql);
	              			while($row = mysqli_fetch_assoc($res)) {
	              				?>
	              				<option value="<?php echo $row['id']; ?>"><?php echo $row['firstname'] .' '. $row['lastname']; ?></option>
	              				<?php
	              			}
	              			?>
	              		</select>
	              	</div>
	              	<div class="form-group mb-2">
	                	<label>Date</label>
	                	<input
	                		type="date"
	                		name="deyt"
	                		min="<?php echo date('Y-m-d') ?>"
	                		max="<?php echo $lastDay ?>"
	                		class="form-control"
	                		required
	                		onchange="select_appointment_date(this.value)"
	                		disabled
	                		id="inp_app_date"
	                	>
	              	</div>
		        	<div class="form-group mb-2">
	                	<label>Time</label>
	                	<select class="form-control" name="time_slot" id="time_slot" required disabled>
	                		<option value="">Select Time Slot</option>
	                	</select>
	              	</div>
	              	<button type="submit" name="saveNewPet" class="btn btn-sm mt-4" style="background:#008040;color:white;">Save</button>
		        </form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>

		<footer class="page-footer">
			<p class="mb-0">Copyright © <?php echo date('Y'); ?>. All rights reserved.</p>
		</footer>
	</div>
	<!--end wrapper-->

	<?php include '../includes/script.php'; ?>
</body>

</html>