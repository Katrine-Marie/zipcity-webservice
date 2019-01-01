<?php
class City{

    public $cityName;
    public $zipCode;

    function __construct($zipCode, $cityName) {
      $this->zipCode = $zipCode;
      $this->cityName = $cityName;
    }

}
