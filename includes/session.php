<?php
	session_start();
	
	function logged_in() {
		return isset($_SESSION['user_id']);
	}
	function logged_inn() {
		return isset($_SESSION['fuser_id']);
	}
	function confirm_logged_in() {
		if (!logged_in()) {
			redirect_to("academics.php?link=");
		}
	}
	function confirm_logged_inn() {
		if (!logged_inn()) {
			redirect_to("index.php");
		}
	}
?>
