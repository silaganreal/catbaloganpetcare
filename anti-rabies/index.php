<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

include '../includes/connect.php';
include '../includes/auth.php';
?>
<!doctype html>
<html lang="en" class="color-sidebar sidebarcolor8 color-header headercolor4">
<head>
	<?php include '../includes/head.php'; ?>
	<title>Pet Care | Anti-Rabies Information</title>
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

		$class_anti_rabies = 'mm-active';
		$link_anti_rabies = '#';

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

				<div class="container">
					<div class="main-body">
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body">
										<div class="mb-5">
											<h4 class="fw-bold">Overview</h4>
											<p>
												Rabies is a vaccine-preventable, zoonotic, viral disease affecting the central nervous system. Once clinical symptoms appear, rabies is virtually 100% fatal. In up to 99% of cases, domestic dogs are responsible for rabies virus transmission to humans. Yet, rabies can affect both domestic and wild animals. It spreads to people and animals via saliva, usually through bites, scratches or direct contact with mucosa (e.g. eyes, mouth or open wounds). Children between the age of 5 and 14 years are frequent victims.
											</p>
											<p>
												Every year, more than 29 million people worldwide receive PEP. This is estimated to prevent hundreds of thousands of rabies deaths annually. Globally, the economic burden of dog-mediated rabies is estimated at US$ 8.6 billion per year, in addition to uncalculated psychological trauma for individuals and communities.
											</p>
										</div>
										<div class="mb-5">
											<h4 class="fw-bold">Symptoms</h4>
											<p>
												The incubation period for rabies is typically 2–3 months but may vary from 1 week to 1 year, depending on factors such as the location of virus entry and the viral load. Initial symptoms of rabies include generic signs like fever, pain and unusual or unexplained tingling, pricking, or burning sensations at the wound site. As the virus moves to the central nervous system, progressive and fatal inflammation of the brain and spinal cord develops. Clinical rabies in people can be managed but very rarely cured, and not without severe neurological deficits.
											</p>
											<p>
												There are two forms of rabies:
											</p>
											<ul>
												<li>
													Furious rabies results in hyperactivity, excitable behaviour, hallucinations, lack of coordination, hydrophobia (fear of water) and aerophobia (fear of drafts or of fresh air). Death occurs after a few days due to cardio-respiratory arrest.
												</li>
												<li>
													Paralytic rabies accounts for about 20% of the total number of human cases. This form of rabies runs a less dramatic and usually longer course than the furious form. Muscles gradually become paralysed, starting from the wound site. A coma slowly develops and eventually death occurs. The paralytic form of rabies is often misdiagnosed, contributing to the under-reporting of the disease.
												</li>
											</ul>
										</div>
										<div class="mb-5">
											<h4 class="fw-bold">Prevention</h4>
											<h6 class="fw-bold">Eliminating rabies in dogs</h6>
											<p>
												Rabies is a vaccine-preventable disease. Vaccinating dogs, including puppies, is the most cost-effective strategy for preventing rabies in people because it stops the transmission at its source. Moreover, dog vaccination reduces the need for PEP.
											</p>
											<p>
												Education on dog behaviour and bite prevention for both children and adults is an essential extension of rabies vaccination programmes and can decrease both the incidence of human rabies and the financial burden of treating dog bites.
											</p>
											<h6 class="fw-bold">Immunization of people</h6>
											<p>
												Very effective vaccines are available to immunize people after an exposure (as PEP) or before an exposure to rabies. Pre-exposure prophylaxis (PrEP) is recommended for people in certain high-risk occupations (such as laboratory workers handling live rabies and rabies-related viruses) and people whose professional or personal activities might lead to direct contact with bats or other mammals that may be infected with rabies (such as animal disease control staff and wildlife rangers).
											</p>
											<p>
												PrEP might be indicated also for outdoor travellers and people living in remote, highly rabies-endemic areas with limited local access to rabies biologics.
											</p>
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

		<footer class="page-footer">
			<p class="mb-0">Copyright © <?php echo date('Y'); ?>. All rights reserved.</p>
		</footer>
	</div>
	<!--end wrapper-->

	<?php include '../includes/script.php'; ?>
</body>