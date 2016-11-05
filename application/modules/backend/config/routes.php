<?php defined('BASEPATH') OR exit('No direct script access allowed');

// backend route
$route['backoffice'] 				= 'backend/dashboard';
$route['backoffice/event'] 			= 'backend/dashboard/event';
$route['backoffice/event/list'] 	= 'backend/dashboard/list_places';
$route['backoffice/event/create'] 	= 'backend/dashboard/create_event';
$route['backoffice/reservation'] 	= 'backend/dashboard/reservation';
$route['backoffice/login'] 			= 'backend/login';
$route['backoffice/logout'] 		= 'backend/login/logout';
$route['debug'] 					= 'backend/login/debug';