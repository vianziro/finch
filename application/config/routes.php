<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] 	= 'home';
$route['background'] 			= 'home/background_process/';
$route['profile/(:any)'] 		= 'home/profiledetail/(:any)';
$route['q/(:any)'] 				= 'home/questiondetail/(:any)';
$route['answer/(:any)'] 		= 'home/answerdetail/(:any)';
$route['my-post'] 		 		= 'home/userpost';
$route['edit/post/(:any)'] 		= 'home/editpost/(:any)';
$route['explore'] 				= 'home/explore';
$route['auth'] 					= 'home';
$route['auth/(:any)'] 			= 'home';
$route['logout'] 				= 'home/logout'; 
$route['read/(:any)/(:any)'] 	= 'home/read_post/(:any)/(:any)';
$route['404_override'] 			= '';
$route['translate_uri_dashes'] 	= FALSE;
