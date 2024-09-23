<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

include '../includes/connect.php';
include '../includes/auth.php';

if($is_admin == 1) {
	$sql = "SELECT * FROM reports AS a LEFT JOIN refbrgy AS b ON a.barangay=b.id LEFT JOIN users AS c ON a.user_id=c.id";
} else {
	$sql = "SELECT * FROM reports AS a LEFT JOIN refbrgy AS b ON a.barangay=b.id WHERE a.user_id = '$session_id'";
}

$res = mysqli_query($conn, $sql);
?>
<!doctype html>
<html lang="en" class="color-sidebar sidebarcolor8 color-header headercolor4">
<head>
	<?php include '../includes/head.php'; ?>
	<title>Pet Care | Report Animal Bite</title>
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

		$class_finished = '';
		$link_finished = '../finished';

		$class_anti_rabies = '';
		$link_anti_rabies = '../anti-rabies';

		$class_animal_bite = 'mm-active';
		$link_animal_bite = '#';

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
										<div class="d-flex align-items-center justify-content-between mb-3 gap-2">
											<div class="row align-items-center gap-1">
												<div class="col">
													<h4 class="mb-0">Animal-Bite</h4>
												</div>
												<?php
												if($is_admin == 0) {
													?>
													<div class="col-auto">
														<button class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#addNewReport" style="background:#008040;color:white;">New Report</button>
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
												   		<th>Barangay</th>
												   		<th>Date</th>
												   		<?php
												   		if($is_admin == 1) {
												   			?><th>Name</th><?php
												   		}
												   		?>
												   		<th>Contact</th>
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
															<td><?php echo $row['brgyDesc']; ?></td>
															<td><?php echo $row['deyt'] .' '. $row['taym']; ?></td>
															<?php
													   		if($is_admin == 1) {
													   			?><td><?php echo $row['firstname'] .' '. $row['lastname']; ?></td><?php
													   		}
													   		?>
															<td><?php echo $row['contactno']; ?></td>
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

		<div class="modal fade" id="addNewReport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header" style="background:#008040;">
		        <h5 class="modal-title" id="staticBackdropLabel" style="color:white;">Add New Report</h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body">
		        <form action="./action.php" method="post">
		        	<div class="form-group mb-3">
		        		<label>Select Brgy</label>
		        		<select name="barangay" class="form-control" required>
		        			<option value="">Select Brgy</option>
		        			<?php
		        			$sql = "SELECT * FROM refbrgy";
		        			$res = mysqli_query($conn, $sql);
		        			while($row = mysqli_fetch_assoc($res)) {
		        				?>
		        				<option value="<?php echo $row['id']; ?>"><?php echo $row['brgyDesc']; ?></option>
		        				<?php
		        			}
		        			?>
		        		</select>
		        	</div>
		        	<div class="form-group mb-3">
		        		<label>Date</label>
		        		<input type="date" name="deyt" class="form-control" required>
		        	</div>
		        	<div class="form-group mb-3">
		        		<label>Time</label>
		        		<input type="time" name="taym" class="form-control" required>
		        	</div>
		        	<div class="form-group mb-3">
		        		<label>Contact No.</label>
		        		<input type="number" name="contactno" class="form-control" required>
		        	</div>
		        	<div class="form-group mb-4">
		        		<label>Remarks</label>
		        		<textarea name="remarks" rows="3" class="form-control" placeholder="Enter remarks here..." required></textarea>
		        	</div>
		        	<input type="hidden" name="user_id" value="<?php echo $session_id; ?>">
		        	<button type="submit" name="submitReport" class="btn btn-sm" style="background:#008040;color:white;">Submit</button>
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