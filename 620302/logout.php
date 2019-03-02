<?php
	session_start();
	session_destroy();
	setcookie("member_id", "", time() - 3600);
	header("location:/");
?>