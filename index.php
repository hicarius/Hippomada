<?php
require 'library/Apps.php';

define('APPLICATION_PATH', __DIR__);
define('LIBRARY_PATH', (string) (APPLICATION_PATH . '/library'));
define('APPS_PATH', (string) (APPLICATION_PATH . '/apps'));
define('EXTENSIONS_PATH', (string) (APPLICATION_PATH . '/extensions'));

ini_set('display_errors', 1);

global $oLayout;

Apps::start()->dispatch();
