<!-- Bootstrap JS -->
	<script src="../assets/js/bootstrap.bundle.min.js"></script>
	<!--plugins-->
	<script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="../assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<script src="../assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<!--app JS-->
	<script src="../assets/js/app.js"></script>
	<!-- datatables -->
	<script type="text/javascript" src="../assets/dt/dataTables.js"></script>
	<script type="text/javascript">
		new DataTable('.dt-tables', {
		    order: [[0, 'asc']],
		    searching: false
		});

		function logout() {
			if(window.confirm('Are you sure you want to log out?')) {
				window.location.href='../login';
			}
		}

		$('td.ellipsis span').click(function(){
		    $(this).addClass("visited");
		    $(this).removeClass("text-primary");
		});

		function select_appointment_date(date) {
			var clinic = document.getElementById('sel_clinic').value;

			if(date != '') {
				if(window.XMLHttpRequest) {
					xmlhttp3 = new XMLHttpRequest();
				} else {
					xmlhttp3 = new ActiveObject("Microsoft.XMLHTTP");
				}

				xmlhttp3.onreadystatechange = function() {
					if(xmlhttp3.readyState == 4 && xmlhttp3.status == 200) {
						document.getElementById('time_slot').disabled = false;
	  					document.getElementById("time_slot").innerHTML = xmlhttp3.responseText;
					}
				}

				var queryString = "?date=" + date + "&clinic=" + clinic;

				xmlhttp3.open("GET","./getTimeSlot.php" + queryString, true);
				xmlhttp3.send();
			} else {
				document.getElementById('time_slot').disabled = true;
			}
		}

		function viewBreed(type) {
			// alert(type);
			if(window.XMLHttpRequest) {
				xmlhttp3 = new XMLHttpRequest();
			} else {
				xmlhttp3 = new ActiveObject("Microsoft.XMLHTTP");
			}

			xmlhttp3.onreadystatechange = function() {
				if(xmlhttp3.readyState == 4 && xmlhttp3.status == 200) {
  					document.getElementById("div_breeds").innerHTML = xmlhttp3.responseText;
  					document.getElementById('div_breeds').scrollIntoView();
				}
			}

			var queryString = "?type=" + type;

			xmlhttp3.open("GET","./getBreeds.php" + queryString, true);
			xmlhttp3.send();
		}

		function select_type(type) {
			// alert(type);
			if(window.XMLHttpRequest) {
				xmlhttp3 = new XMLHttpRequest();
			} else {
				xmlhttp3 = new ActiveObject("Microsoft.XMLHTTP");
			}

			xmlhttp3.onreadystatechange = function() {
				if(xmlhttp3.readyState == 4 && xmlhttp3.status == 200) {
  					document.getElementById("sel_breed").innerHTML = xmlhttp3.responseText;
				}
			}

			var queryString = "?type=" + type;

			xmlhttp3.open("GET","./getBreeds.php" + queryString, true);
			xmlhttp3.send();
		}

		function select_type2(type) {
			// alert(type);
			if(window.XMLHttpRequest) {
				xmlhttp3 = new XMLHttpRequest();
			} else {
				xmlhttp3 = new ActiveObject("Microsoft.XMLHTTP");
			}

			xmlhttp3.onreadystatechange = function() {
				if(xmlhttp3.readyState == 4 && xmlhttp3.status == 200) {
  					document.getElementById("sel_breed2").innerHTML = xmlhttp3.responseText;
				}
			}

			var queryString = "?type=" + type;

			xmlhttp3.open("GET","./getBreeds2.php" + queryString, true);
			xmlhttp3.send();
		}

		function select_clinic(clinic) {
			var inp_app_date = document.getElementById('inp_app_date');
			var time_slot = document.getElementById('time_slot');

			if(clinic != '') {
				inp_app_date.disabled = false;
				time_slot.disabled = true;
			} else {
				inp_app_date.disabled = true;
				time_slot.disabled = true;
			}
		}
	</script>