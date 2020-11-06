<?php

include_once ("business.class.php");

$user = User::getLoggedUser();

if ($user != null) {
	switch ($user['tipo']) {
		case 1:
			header("Location:/administrator.profile.php");
			break;

		case 2:
			header("Location:/business.profile.php");
			break;
		
		case 3:
			header("Location:/user.profile.php");
			break;

		default:
			header("Location:index.php");
			break;
	}
}
