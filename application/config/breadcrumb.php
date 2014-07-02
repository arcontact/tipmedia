<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| BREADCRUMB CONFIG
| -------------------------------------------------------------------
| This file will contain the settings needed to load the breadbrumb.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['divider']		The string used to divide the crumbs
|	['tag_open'] 	The opening tag placed on the left side of the breadcrumb.
|   ['tag_close'] 	The closing tag placed on the right side of the breadcrumb.
|   ['set_home'] 	Auto put first home element (example: array('href' => '.', 'title' => 'Home', 'class' => 'some_class')); disabled if false.
|
*/

$config['divider'] = '';
$config['tag_open'] = '<ol class="breadcrumb">';
$config['tag_close'] = '</ol>';
$config['set_home'] = array('href' => '.', 'title' => 'Strona główna', 'class' => 'home');


/* End of file breadcrumb.php */
/* Location: ./application/config/breadcrumb.php */