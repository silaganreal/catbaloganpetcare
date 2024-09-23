<div class="modal fade" id="finish<?php echo $id; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header" style="background:#008040;color:white;">
		        <h5 class="modal-title" id="staticBackdropLabel" style="color:white;">Finish Appointment - <?php echo $row['name'] ?></h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body">
		      	<form action="./action.php" method="post">
		      		<div class="form-group mb-4">
		      			<label>Remarks</label>
		      			<textarea name="remarks" rows="3" class="form-control" required placeholder="Enter remarks here..."></textarea>
		      		</div>
	              	<input type="hidden" name="appointment_id" value="<?php echo $id ?>">
	              	<button type="submit" name="saveStatus" class="btn btn-sm btn-success">Save</button>
		      	</form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>