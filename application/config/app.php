<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|-------------------------------------------------------------------------- 
| Code Version 
|-------------------------------------------------------------------------- 
| 
| This is the version of cms you're running 
| 
| 
*/ 
$config['application_version'] = '1.0.0';

/* 
|-------------------------------------------------------------------------- 
| Commit sha1 
|-------------------------------------------------------------------------- 
| 
| This is the commit hash for the version you are currently using 
| 
| 
*/
$config['commit_sha1'] = '$Id: f08f377cae978a8b3e6f1c7ca1da353c71d20a25 $';
 
$config['skin'] = 'teal';
$config['notify_horizontal_position'] = 'right';
$config['notify_vertical_position'] = 'bottom';
$config['theme']='default';
/* 
|-------------------------------------------------------------------------- 
| Internal to CMS XSS Clean 
|-------------------------------------------------------------------------- 
| 
| This is to indicated whether we want XSS clean to be performed or not 
| By default it's enabled as it's assumed the installation has Internet access and needs to be protected, 
| however intranet only installations may not need this so they can set FALSE to improve performance 
| 
*/ 
$config['dgn_xss_clean'] = TRUE;