<?php 
/*
|--------------------------------------------------------------------------
| MY Custom Modules
|--------------------------------------------------------------------------
|
| Specifies the module controller (key) and the name (value) for fuel
*/


/*********************** EXAMPLE ***********************************

$config['modules']['quotes'] = array(
	'preview_path' => 'about/what-they-say',
);

$config['modules']['projects'] = array(
	'preview_path' => 'showcase/project/{slug}',
	'sanitize_images' => FALSE // to prevent false positives with xss_clean image sanitation
);

*********************** EXAMPLE ***********************************/
$config['modules']['activity'] = array();
$config['modules']['agerange'] = array();
$config['modules']['athletes'] = array();
$config['modules']['clubs'] = array();
$config['modules']['events'] = array();
$config['modules']['exercises'] = array();
$config['modules']['filter'] = array();
$config['modules']['forums'] = array();
$config['modules']['members'] = array();
$config['modules']['notifications'] = array();
$config['modules']['sports'] = array();
$config['modules']['sports_links'] = array();
$config['modules']['sports_statistics'] = array();
$config['modules']['teams'] = array();
$config['modules']['trainers'] = array();
$config['modules']['certificates'] = array();
$config['modules']['specialties'] = array();
$config['modules']['preferences'] = array();




/*********************** OVERWRITES ************************************/
$config['module_overwrites']['categories']['hidden'] = TRUE; // change to FALSE if you want to use the generic categories module
$config['module_overwrites']['tags']['hidden'] = TRUE; // change to FALSE if you want to use the generic tags module