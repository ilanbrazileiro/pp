<?php

session_start();

set_time_limit(60);
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once("vendor/autoload.php");
require_once("res/extras/funcoes.php");

use \Slim\Slim;
use Questoes\DB\Sql;

define('DS', DIRECTORY_SEPARATOR);

$app = new Slim();

$app->config('debug', true);

	include "frontend.php";

	include "admin.php";
	

$app->run();

 ?>