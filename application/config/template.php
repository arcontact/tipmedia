<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Active template
|--------------------------------------------------------------------------
|
| The $template['active_template'] setting lets you choose which template 
| group to make active.  By default there is only one group (the 
| "default" group).
|
*/
$template['active_template'] = 'default';

/*
|--------------------------------------------------------------------------
| Default Template Configuration (adjust this or create your own)
|--------------------------------------------------------------------------
*/

$template['default']['template'] = 'default';
$template['default']['regions'] = array('content');
$template['default']['parser'] = 'parser';
$template['default']['parser_method'] = 'parse';
$template['default']['parse_template'] = FALSE;

$template['ajax']['template'] = 'ajax';
$template['ajax']['regions'] = array('content');
$template['ajax']['parser'] = 'parser';
$template['ajax']['parser_method'] = 'parse';
$template['ajax']['parse_template'] = FALSE;

/* End of file template.php */
/* Location: ./system/application/config/template.php */