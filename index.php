<?
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
require 'config/database.php';
require 'config/paths.php';

// i did some changes
// i did some changes
// Use an autoloader

require 'libs/Controller.php';
require 'libs/Model.php';
require 'libs/View.php';
require 'libs/Bootstrap.php';
// Library
require 'libs/Database.php';
require 'libs/Session.php';
$app = new Bootstrap();