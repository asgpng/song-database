<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = 'pages';
$route['404_override'] = '';
$route['forms'] = 'forms';
//$route['forms/select?(any)'] = 'forms/select';
$route['files'] = 'files';
$route['news/(:any)'] = 'news/view/$1';
$route['news'] = 'news';
$route['pages'] = 'pages';
/* default (base) routes: */
$route['about'] = 'pages/about';
$route['contact'] = 'pages/contact';
$route['login'] = 'defaults/login';
$route['login_backup'] = 'defaults/login_backup';
$route['logout'] = 'defaults/logout';
$route['messages'] = 'pages/messages';
$route['test_login'] = 'defaults/test_login';
$route['test_logout'] = 'defaults/test_logout';
$route['semester'] = 'defaults/semester';
$route['student'] = 'student';



/* End of file routes.php */
/* Location: ./application/config/routes.php */