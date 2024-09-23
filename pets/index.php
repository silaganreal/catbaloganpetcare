<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

include '../includes/connect.php';
include '../includes/auth.php';

$sql = "SELECT a.id, a.owner_id, a.name, a.birthdate, a.slug, b.id AS type_id, b.type, c.id AS breed_id, c.breed FROM pets AS a LEFT JOIN pettypes AS b ON a.type=b.id LEFT JOIN breeds AS c ON a.breed=c.id WHERE a.owner_id = '$session_id'";
$res = mysqli_query($conn, $sql);

$sql2 = "SELECT * FROM pettypes";
$res2 = mysqli_query($conn, $sql2);

$varSess = $_SESSION['varSess'] = time();
?>
<!doctype html>
<html lang="en" class="color-sidebar sidebarcolor8 color-header headercolor4">
<head>
	<?php include '../includes/head.php'; ?>
	<title>Pet Care | Pets</title>
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

				<div class="card radius-10">
					<div class="card-body">
						<div class="d-flex align-items-center justify-content-between mb-3 gap-2">
							<div class="row align-items-center gap-1">
								<div class="col">
									<h4 class="mb-0">Pets</h4>
								</div>
								<?php
								if($is_admin == 0) {
									?>
									<div class="col-auto">
										<button class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#addNewPet" style="background:#008040;color:white;">New Pet</button>
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
								   		<th>Name</th>
								   		<th>Type</th>
								   		<th>Breed</th>
								   		<th>Birthdate-Age</th>
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
										$type_id = $row['type_id'];
										$breed_id = $row['breed_id'];
										$birthdate = $row['birthdate'];
										$_age = floor((time() - strtotime($birthdate)) / 31556926);
										?>
										<tr>
											<td><div class="float-start" style="width:10px;"><?php echo $a; ?></div></td>
											<td><?php echo $row['name']; ?></td>
											<td><?php echo $row['type']; ?></td>
											<td><?php echo $row['breed']; ?></td>
											<td><?php echo $birthdate .' ('. $_age; ?>)</td>
											<td><div class="float-end d-flex gap-1" style="margin-right:10px;"><button class="btn btn-sm btn-primary mr-1" data-bs-toggle="modal" data-bs-target="#editPet<?php echo $row['id']; ?>">Edit</button><a href="../history/?pet=<?php echo $row['slug']; ?>" class="btn btn-sm btn-success">View Profile</a></div></td>
										</tr>
										<?php
										$a++;
										include './modalEditPet.php';
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

		<div class="modal fade" id="addNewPet" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header" style="background:#008040;">
		        <h5 class="modal-title" id="staticBackdropLabel" style="color:white;">Add New Pet</h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body">
		        <form action="./action.php" method="post">
		        	<div class="form-group mb-2">
	                	<label>Type</label>
	                	<select name="pettype" class="form-control" required onchange="select_type(this.value)">
	                		<option value="" selected>Select Type</option>
	                		<?php
	                		while($row2 = mysqli_fetch_assoc($res2)) {
	                			?>
	                			<option value="<?php echo $row2['id']; ?>"><?php echo $row2['type']; ?></option>
	                			<?php
	                		}
	                		?>
	                	</select>
	              	</div>
	              	<div class="form-group mb-2" >
	                	<label>Breed</label>
	                	<select name="breed" id="sel_breed" class="form-control" required>
	                		<option value="">Select Breed</option>
	                	</select>
	              	</div>
		        	<div class="form-group mb-2">
	                	<label>Name</label>
	                	<input
	                		type="text"
	                		name="petname"
	                		class="form-control"
	                		placeholder="Enter Pet Name"
	                		oninput="this.value = this.value.toUpperCase()"
	                		required
	                	>
	              	</div>
	              	<div class="form-group mb-2">
	                	<label>Birthday</label>
	                	<input
	                		type="date"
	                		name="birthdate"
	                		class="form-control"
	                		required
	                	>
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