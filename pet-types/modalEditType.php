<div class="modal fade" id="editType<?php echo $row['id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header" style="background:#008040;color:white;">
		        <h5 class="modal-title" id="staticBackdropLabel" style="color:white;">Edit - <?php echo $row['type']; ?></h5>
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
	                		value="<?php echo $row['type']; ?>"
	                		oninput="this.value = this.value.toUpperCase()"
	                		required
	                	>
	              	</div>
	              	<input type="hidden" name="type_id" value="<?php echo $row['id'] ?>">
	              	<button type="submit" name="editType" class="btn btn-sm mt-4" style="background:#008040;color:white;">Update</button>
		      	</form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>