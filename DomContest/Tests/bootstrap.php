<?php
/**
 * Created by PhpStorm.
 * User: sergiy
 * Date: 24.03.17
 * Time: 19:32
 */

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


spl_autoload_register(function ($name) {
    $name = str_replace(array('DomContest\\Tests\\','\\'), array('', '/'), $name);
    $pieces = explode('/', $name);
    switch ($pieces[0]) {
        case 'DiDom':
            $pieces[0] = '../../didom/src/DiDom';
            break;
        default:
            $pieces[0] = './'.$pieces[0];
    }
    $name = implode('/', $pieces);
    $name = $name.'.php';
    if (!file_exists($name)) {
        return false;
    }
    require_once($name);
});