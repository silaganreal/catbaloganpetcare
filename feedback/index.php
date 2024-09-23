<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

include '../includes/connect.php';
include '../includes/auth.php';

if($is_admin == 1) {
	$sql = "SELECT * FROM messages AS a LEFT JOIN users AS b ON a.user_id=b.id";
} else {
	$sql = "SELECT * FROM messages AS a LEFT JOIN users AS b ON a.user_id=b.id WHERE a.user_id = '$session_id'";
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

		$class_finished = '';
		$link_finished = '../finished';

		$class_anti_rabies = '';
		$link_anti_rabies = '../anti-rabies';

		$class_animal_bite = '';
		$link_animal_bite = '../animal-bite';

		$class_feedback = 'mm-active';
		$link_feedback = '#';

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
											<div class="col-auto">
												<h5 class="">Feedback</h5>
											</div>
											<?php if($is_admin == 0) {
												?>
												<div class="col">
													<button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">New Feedback</button>
												</div>
												<?php
											} ?>
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
												   			?><th width="200">Sender</th><?php
												   		}
												   		?>
												   		<th width="200">Concern</th>
												   		<th>Message</th>
												   		<th width="200">Date</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$a = 1;
													while($row = mysqli_fetch_assoc($res)) {
														?>
														<tr>
															<td><div class="float-start" style="width:10px;"><?php echo $a; ?></div></td>
															<?php if($is_admin == 1) {
																echo "<td>". $row['firstname'] .' '. $row['lastname'] ."</td>";
															} ?>
															<td><?php echo $row['concern']; ?></td>
															<td><?php echo $row['message']; ?></td>
															<td><?php echo $row['deyt'] .' '. $row['taym']; ?></td>
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

		<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header" style="background:#0275d8;">
		        <h5 class="modal-title" id="staticBackdropLabel" style="color:white;">New Feedback</h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body">
		      	<form action="./action.php" method="post">
		      		<div class="form-group mb-2">
		      			<label>Concern</label>
		      			<input type="text" name="concern" class="form-control" placeholder="What is your concern all about..." required>
		      		</div>
		      		<div class="form-group mb-2">
		      			<label>Message</label>
		      			<textarea rows="3" name="message" class="form-control" placeholder="write here everything that you want to say about your concern..." required></textarea>
		      		</div>
		      		<input type="hidden" name="user_id" value="<?php echo $session_id; ?>">
		      		<div class="form-group mt-3">
		      			<input type="submit" name="submitFeedback" class="btn btn-sm btn-primary">
		      		</div>
		      	</form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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