<?php
  // error_reporting(E_ALL);
  // ini_set('display_errors', 1);

require_once 'classes/DbCon.php';

$dbCon = new DbCon();

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = explode("/", $_SERVER['REQUEST_URI']);

if($httpMethod == 'GET'){
  if(isset($uri[2]) && $uri[1] == 'zip'){
    // Is this a valid Danish zipcode?
    if(preg_match('/^(\d{3,4})?$/', $uri[2])){
      header('Content-type: application/json');

      $city = $dbCon->getCityByZipCode($uri[2]);
      echo json_encode($city);
    } else {
      echo 'ERROR WRONG ZIPCODE FORMAT!';
    }
  }else if(isset($uri[2]) && $uri[1] == 'city'){
    // Is this a valid Danish zipcode?
    if(preg_match('/^(\d{3,4})?$/', $uri[2])){
      header('Content-type: application/json');

      $city = $dbCon->getZipCodeByCity(urldecode($uri[2]));
      echo json_encode($city);
    } else {
      echo 'ERROR WRONG CITYNAME!';
    }
  }else if($uri[1] == 'zip'){
		header('Content-type: application/json');

    $zip = $dbCon->getAllCities();
    echo json_encode($zip);
  }else {
    echo 'WRONG PATH';
  }
}else {
  header('HTTP/1.0 403 Forbidden');
}
