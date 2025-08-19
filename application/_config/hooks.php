<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/
$hook['pre_controller'][] = array(
    'class'    => 'Check_installer',
    'function' => 'check_for_installer',
    'filename' => 'check_installer.php',
    'filepath' => 'hooks'
);

$hook['post_controller_constructor'] = array(
    'class'    => 'MultiLanguageLoader',
    'function' => 'initialize',
    'filename' => 'MultiLanguageLoader.php',
    'filepath' => 'hooks'
);
