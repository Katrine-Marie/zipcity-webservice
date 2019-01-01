<?php
require_once 'Config.php';
require_once 'City.php';

class DbCon{

  private $ObjConnection;

  function __construct() {
    if(Config::useLocal){
      $this->ObjConnection = new mysqli(Config::localHost, Config::localUser, Config::localPassword, Config::localDatabase);
    } else {
        $this->ObjConnection = new mysqli(Config::host, Config::user, Config::password, Config::database);
    }

    if($this->testDbConnection()){
        $this->ObjConnection->set_charset('utf8');
        return $this->ObjConnection;
    }
  }

  private function testDbConnection(){

    if($this->ObjConnection->connect_error){
      die('Der er en fejl i databaseforbindelsen '.$this->ObjConnection->connect_errno. ' '.$this->ObjConnection->connect_error);
    } else {
      return TRUE;
    }
  }

  public function query($sql){
    return $this->ObjConnection->query($sql);
  }


  /* ========== METHODS TO FETCH ZIPCITY DATA ========== */

  public function getAllCities(){
    $sql = 'SELECT * FROM zipcity';
    $result = $this->query($sql);

    $cities = array();

    while($row = $result->fetch_object()){
      $cities[] = new City($row->zipcode, $row->cityname);
    }

    return $cities;
  }

  public function getCityByZipCode($zipCode){
    $sql = 'SELECT * FROM zipcity WHERE zipcode = ' . $zipCode . '';
    $result = $this->query($sql);

    while($row = $result->fetch_object()){
      return new City($row->zipcode, $row->cityname);
    }
  }

  public function getZipCodeByCity($city){
    $sql = 'SELECT * FROM zipcity WHERE cityname = ' . $city . '';
    $result = $this->query($sql);

    while($row = $result->fetch_object()){
      return new City($row->zipcode, $row->cityname);
    }
  }
