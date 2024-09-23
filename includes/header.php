<!--start header -->
		<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>
					<div class="mobile-toggle-menu">
						<div class="d-flex align-items-center justify-content-center">
							<div class="ms-4">
								<img src="../assets/images/petcare-logo.png" class="logo-icon" alt="logo icon">
							</div>
							<div>
								<h4 class="logo-text text-white">Pet Care</h4>
							</div>
						</div>
					</div>
					
					<div class="top-menu ms-auto">
						<ul class="navbar-nav align-items-center">
							<div class="dropdown-menu dropdown-menu-end">
								<div class="header-notifications-list"></div>
							</div>
							<div class="dropdown-menu dropdown-menu-end">
								<div class="header-message-list"></div>
							</div>
						</ul>
					</div>
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="../assets/images/petcare-logo.png" class="user-img" alt="user avatar">
							<div class="user-info ps-3">
								<p class="user-name mb-0"><?php echo $row_user['firstname'] .' '. $row_user['lastname']; ?></p>
								<?php
								if($is_admin == '1') {
									?><p class="designattion mb-0">System Admin</p><?php
								} else {
									?><!--<p class="designattion mb-0">Local User</p>--><?php
								}
								?>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
							<!-- <li>
								<a class="dropdown-item" href="#">
									<i class="bx bx-user"></i>
									<span>Profile</span>
								</a>
							</li> -->
							<li>
								<a class="dropdown-item" href="#" onclick="logout()">
									<i class='bx bx-log-out-circle'></i>
									<span>Logout</span>
								</a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<!--end header -->