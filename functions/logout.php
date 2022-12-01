<?php

if (isset($_POST['exit'])) {
	if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
	//setcookie(session_name(), '', 100); // если есть куки
	session_unset();
	session_destroy();
	$_SESSION = array();
}