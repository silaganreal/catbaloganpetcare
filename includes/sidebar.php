<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="../assets/images/petcare-logo.png" class="user-img" alt="logo icon">
				</div>
				<div>
					<h4 class="logo-text">Pet Care</h4>
				</div>
				<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i></div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li class="<?php echo $class_appointments; ?>">
					<a href="<?php echo $link_appointments; ?>">
						<div class="parent-icon"><i class='bx bx-calendar-event'></i></div>
						<div class="menu-title">Appointments</div>
					</a>
				</li>
				<li class="<?php echo $class_finished; ?>">
					<a href="<?php echo $link_finished; ?>">
						<div class="parent-icon"><i class='bx bx-list-check'></i></div>
						<div class="menu-title">Finished</div>
					</a>
				</li>
				<?php
				if($is_admin == 0) {
					?>
					<li class="<?php echo $class_pets; ?>">
						<a href="<?php echo $link_pets; ?>">
							<div class="parent-icon"><i class='bx bx-book-heart'></i></div>
							<div class="menu-title">Pets</div>
						</a>
					</li>
					<li class="<?php echo $class_anti_rabies; ?>">
						<a href="<?php echo $link_anti_rabies; ?>">
							<div class="parent-icon"><i class='bx bx-message-edit'></i></div>
							<div class="menu-title">Anti-Rabies Info</div>
						</a>
					</li>
					<?php
				}
				?>
				<?php
				if($is_admin == 1) {
					?>
					<li class="<?php echo $class_pettypes; ?>">
						<a href="<?php echo $link_pettypes; ?>">
							<div class="parent-icon"><i class='bx bx-list-ul'></i></div>
							<div class="menu-title">Pet Types</div>
						</a>
					</li>
					<?php
				}
				?>
				<li class="<?php echo $class_animal_bite; ?>">
					<a href="<?php echo $link_animal_bite; ?>">
						<div class="parent-icon"><i class='bx bx-comment-detail'></i></div>
						<div class="menu-title">Report Animal Bite</div>
					</a>
				</li>
				<li class="<?php echo $class_feedback; ?>">
					<a href="<?php echo $link_feedback; ?>">
						<div class="parent-icon"><i class='bx bx-message-rounded-edit'></i></div>
						<div class="menu-title">Feedback</div>
					</a>
				</li>
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->