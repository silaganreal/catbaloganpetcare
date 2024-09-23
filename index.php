<?php
session_start();
if(!isset($_SESSION['session123xyz'])) {
	session_destroy();
	header('location: ./login');
} else {
	header('location: ./appointments');
}
?>