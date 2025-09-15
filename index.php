<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('Asia/Kolkata'); // comment

	require_once 'app/controllers/Controller.php';

	$request = $_SERVER['REQUEST_URI'];
	$request = str_replace('/haste_parchi', '', $request);

	if (substr($request, 0, 1) == '/') {
		$request = substr($request, 1);
	}

	$Controller = new Controller ();
	
	switch ($request) {
		case '' :
			$Controller->index();
			break;
		case 'index' :
			$Controller->index();
			break;
		case 'home' :
			$Controller->home();
			break;
		case 'master' :
			$Controller->master();
			break;
		case 'printout' :
			$Controller->printout();
			break;
		default :
			http_response_code ( 404 );
			$Controller->error404();
			break;
	}
	
?>
