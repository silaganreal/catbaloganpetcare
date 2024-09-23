<?php
include "./connect.php";

if( isset($_GET['id'], $_GET['slug']) ) {
	
	$id = $_GET['id'];
	$slug = $_GET['slug'];

	$sql = "SELECT * FROM books WHERE id = '$id' AND file_path = '$slug'";
	$res = mysqli_query($conn, $sql);
	if(($count = mysqli_num_rows($res)) > 0) {
		while($row = mysqli_fetch_assoc($res)) {
			$doc_dir = $row['file_path'];
			$file = "../books/". $doc_dir;
			$type = mime_content_type($file);
			$size = filesize($file);

			if($type == 'application/pdf') {
				header("Content-type: application/pdf");  
				header("Content-Length: " . filesize($file));
				// header("Content-Disposition: attachment; filename=". $file);
				readfile($file);
			}

			else {
				header("Content-type: ". $type);  
				header("Content-Length: " . filesize($file));
				// header("Content-Disposition: attachment; filename=". $file);
				readfile($file);
			}
		}
	}
	else {
		echo "<script>alert('Requested book cannot be found on the shelf!');this.close();</script>";
	}
} else {
	header('location: ../');
}
?>