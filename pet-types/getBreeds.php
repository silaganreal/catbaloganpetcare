<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

include '../includes/connect.php';
include '../includes/auth.php';

if(isset($_GET['type'])) {
	$type = $_GET['type'];

	$sql = "SELECT * FROM breeds WHERE type_id = '$type'";
	$res = mysqli_query($conn, $sql);

	?>
	<div class="col-12" id="div_breeds">
		<div class="card radius-10">
			<div class="card-body">
				<div class="d-flex align-items-center justify-content-between mb-3 gap-2">
					<div class="row align-items-center gap-1">
						<div class="col">
							<h4 class="mb-0">Breeds</h4>
						</div>
						<div class="col-auto">
							<button class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#addNewBreed" style="background:#008040;color:white;">New Breed</button>
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
							<?php
							$a = 1;
							while($row = mysqli_fetch_assoc($res)) {
								$id = $row['id'];
								?>
								<tr>
									<td><div class="float-start" style="width:10px;"><?php echo $a; ?></div></td>
									<td><?php echo $row['breed']; ?></td>
									<td><div class="float-end d-flex gap-1" style="margin-right:10px;">
										<a href="./action.php?delete_breed=<?php echo $id; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Confirm Delete?')">Delete</a>
									</div></td>
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

	<div class="modal fade" id="addNewBreed" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header" style="background:#008040;">
	        <h5 class="modal-title" id="staticBackdropLabel" style="color:white;">Add New Breed</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	        <form action="./action.php" method="post">
	        	<div class="form-group mb-2">
                	<label class="mb-2">Breed</label>
                	<input
                		type="text"
                		name="breed"
                		class="form-control"
                		placeholder="eg. ASPIN, SHIH TZU"
                		oninput="this.value = this.value.toUpperCase()"
                		required
                	>
              	</div>
              	<input type="hidden" name="type_id" value="<?php echo $type; ?>">
              	<button type="submit" name="saveNewBreed" class="btn btn-sm mt-4" style="background:#008040;color:white;">Save</button>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
	<?php
}
?>