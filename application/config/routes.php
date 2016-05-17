<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

//Main Page routes
$route['default_controller'] = 'Products/mainPage';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['main']='Products/mainPage';
$route['details/(:num)']='Products/details/$1';

//User Stuff
$route['login']='Users/login';
$route['logout']='Users/logout';
$route['signup']='Users/signup';
$route['profile']='Users/profile';

//Games Stuff
$route['Products/search']='Products/search';
$route['rateGame']='Products/rateGame';
$route['postReview/(:num)']='Products/postReview/$1';
$route['Products/forum']='Products/forum';
$route['Products/forumGame/(:num)']='Products/forumGame/$1';
$route['thread/(:num)']='Products/thread/$1';
$route['deleteThread/(:num)']='Products/delThread/$1';
$route['reportThread']='Products/reportThread';
$route['editThread/(:num)']='Products/editThread/$1';
$route['createThread']='Products/createThread';
$route['postFeedback']='Products/postFeedback';

//Cart Stuff
$route['cart']='cart/index';
$route['cart/add']='cart/add';
$route['cart/update']='cart/update';
$route['cart/process']='cart/process';

//Admin Panel
$route['adminpanel'] ='admin/index';
$route['adminpanel/landing'] ='admin/landing';
$route['adminpanel/products'] ='admin/products';
$route['adminpanel/users'] ='admin/users';
$route['adminpanel/orders'] ='admin/orders';
$route['adminpanel/threads'] ='admin/threads';
$route['adminpanel/feedback'] ='admin/feedback';
$route['adminpanel/delUpGame'] ='admin/delUpGame';
$route['adminpanel/createGame'] ='admin/createGame';
$route['adminpanel/changeFirstPage'] ='admin/changePage';

//Admin Service
$route['adminService/delete'] ='adminService/delete_feedback';
$route['adminService/getGameData'] ='adminService/getGameData';
$route['adminService/getUserData'] ='adminService/getUserData';
$route['adminService/banUser'] ='adminService/banUser';
$route['adminService/changeUser'] ='adminService/changeUser';
$route['adminService/resetReport'] ='adminService/resetReport';
$route['adminService/deleteThread'] ='adminService/deleteThread';
$route['adminService/delbanThread'] ='adminService/delbanThread';

//Others
$route['(:any)']='Products/mainPage';
