<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

include '../includes/connect.php';
include '../includes/auth.php';

$sql = "SELECT * FROM pettypes";
$res = mysqli_query($conn, $sql);

$varSess = $_SESSION['varSess'] = time();
?>
<!doctype html>
<html lang="en" class="color-sidebar sidebarcolor8 color-header headercolor4">
<head>
	<?php include '../includes/head.php'; ?>
	<title>Pet Care | Pet Types</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<?php
		$class_appointments = '';
		$link_appointments = '../appointments';

		$class_pettypes = 'mm-active';
		$link_pettypes = '#';

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
				<div class="row">

					<div class="col-md-7">
						<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center justify-content-between mb-3 gap-2">
									<div class="row align-items-center gap-1">
										<div class="col">
											<h4 class="mb-0">Types</h4>
										</div>
										<div class="col-auto">
											<button class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#addNewPetType" style="background:#008040;color:white;">Add New Type</button>
										</div>
									</div>
								</div>
								<div class="table-responsive">
									<table class="table align-middle mb-0 dt-tables" style="width:100%">
										<thead class="table-light">
											<tr>
										   		<th>
										   			<div class="float-start" style="width:10px;">#</div>
										   		</th>
										   		<th>Type</th>
										   		<th>No. of Breed</th>
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
												$sql2 = "SELECT * FROM breeds WHERE type_id = '$id'";
												$res2 = mysqli_query($conn, $sql2);
												$num2 = mysqli_num_rows($res2);
												?>
												<tr>
													<td><div class="float-start" style="width:10px;"><?php echo $a; ?></div></td>
													<td><?php echo $row['type']; ?></td>
													<td><?php echo $num2 ?></td>
													<td><div class="float-end d-flex gap-1" style="margin-right:10px;"><button class="btn btn-sm btn-primary mr-1" data-bs-toggle="modal" data-bs-target="#editType<?php echo $row['id']; ?>">Edit</button><a href="./action.php?delete=<?php echo $id; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a><button class="btn btn-sm btn-success" onclick="viewBreed('<?php echo $id; ?>')">Breeds</button></div></td>
												</tr>
												<?php
												$a++;
												include './modalEditType.php';
											}
											?>
									    </tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-5" id="div_breeds">
						<div class="card radius-10">
							<div class="card-body">
								<div class="d-flex align-items-center justify-content-between mb-3 gap-2">
									<div class="row align-items-center gap-1">
										<div class="col">
											<h4 class="mb-0">Breeds</h4>
										</div>
									</div>
								</div>
								<div class="table-responsive">
									<table class="table align-middle mb-0 dt-tables" style="width:100%">
										<thead class="table-light">
											<tr>
										   		<th>
										   			<div class="float-start" style="width:10px;">#</div>
										   		</th>
										   		<th>Breed</th>
										   		<th>
										   			<div class="float-end" style="margin-right:10px;">Action</div>
										   		</th>
											</tr>
										</thead>
										<tbody>
									    </tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<!--end page wrapper -->

		<div class="modal fade" id="addNewPetType" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header" style="background:#008040;">
		        <h5 class="modal-title" id="staticBackdropLabel" style="color:white;">Add New Pet Type</h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body">
		        <form action="./action.php" method="post">
		        	<div class="form-group mb-2">
	                	<label class="mb-2">Type</label>
	                	<input
	                		type="text"
	                		name="type"
	                		class="form-control"
	                		placeholder="eg. dog, cat"
	                		oninput="this.value = this.value.toUpperCase()"
	                		required
	                	>
	              	</div>
	              	<button type="submit" name="saveNewPetType" class="btn btn-sm mt-4" style="background:#008040;color:white;">Update</button>
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