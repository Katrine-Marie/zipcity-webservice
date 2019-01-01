<?php
  // error_reporting(E_ALL);
  // ini_set('display_errors', 1);

require_once 'classes/DbCon.php';

$dbCon = new DbCon();

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = explode("/", $_SERVER['REQUEST_URI']);

if($httpMethod == 'GET'){

}else {
  header('HTTP/1.0 403 Forbidden');
}
