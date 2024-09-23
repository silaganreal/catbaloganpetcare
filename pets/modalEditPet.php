<div class="modal fade" id="editPet<?php echo $row['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header" style="background:#008040;color:white;">
		        <h5 class="modal-title" id="staticBackdropLabel" style="color:white;">Edit - <?php echo $row['name']; ?></h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body">
		      	<form action="./action.php" method="post">
		        	<div class="form-group mb-2">
	                	<label>Type</label>
	                	<select name="pettype" class="form-control" required onchange="select_type2(this.value)">
	                		<option value="<?php echo $type_id; ?>" selected><?php echo $row['type']; ?></option>
	                		<?php
	                		$sql3 = "SELECT * FROM pettypes WHERE id != '$type_id'";
	                		$res3 = mysqli_query($conn, $sql3);
	                		$num3 = mysqli_num_rows($res3);
	                		if($num3 > 0) {
	                			while($row3 = mysqli_fetch_assoc($res3)) {
	                				?>
		                			<option value="<?php echo $row3['id']; ?>"><?php echo $row3['type']; ?></option>
		                			<?php
	                			}
	                		}
	                		?>
	                	</select>
	              	</div>
	              	<div class="form-group mb-2" >
	                	<label>Breed</label>
	                	<select name="breed" id="sel_breed2" class="form-control" required>
	                		<option value="<?php echo $breed_id; ?>"><?php echo $row['breed']; ?></option>
	                	</select>
	              	</div>
		        	<div class="form-group mb-2">
	                	<label>Name</label>
	                	<input
	                		type="text"
	                		name="petname"
	                		class="form-control"
	                		value="<?php echo $row['name']; ?>"
	                		oninput="this.value = this.value.toUpperCase()"
	                		required
	                	>
	              	</div>
	              	<div class="form-group mb-2">
	                	<label>Birthday</label>
	                	<input
	                		type="date"
	                		name="birthdate"
	                		value="<?php echo $row['birthdate']; ?>"
	                		class="form-control"
	                		required
	                	>
	              	</div>
	              	<input type="hidden" name="pet_slug" value="<?php echo $slug; ?>">
	              	<input type="hidden" name="pet_id" value="<?php echo $row['id']; ?>">
	              	<button type="submit" name="editPet" class="btn btn-sm mt-4" style="background:#008040;color:white;">Save</button>
		        </form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>