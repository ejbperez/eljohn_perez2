<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'EmployeeController/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['login'] = 'EmployeeController/login';
$route['get-employees'] = 'EmployeeController/getEmployees';
$route['logout'] = 'EmployeeController/logout';
$route['get-access'] = 'EmployeeController/getAccessLevel';
$route['add-employee'] = 'EmployeeController/addEmployee';
$route['get-employeebyid'] = 'EmployeeController/getEmployeeById';
$route['update-employee'] = 'EmployeeController/updateEmployee';
$route['delete-employee'] = 'EmployeeController/deleteEmployee';
