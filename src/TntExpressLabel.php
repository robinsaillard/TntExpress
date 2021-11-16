<?php

namespace RS\TntExpress;

use RS\TntExpress\TntExpress;
use RS\TntExpress\Elements\Address;

class TntExpressLabel extends TntExpress{

    public $sender; 
    public $delivery; 

    
    public function setSender(string $name, string $addressLine1, string $addressLine2 = null, string $addressLine3 = null, 
                              string $town, string $exactMatch = null, string $province = null, string $postcode = null , string $country)
    {
        $sender = new Address();
        $sender->setName($name)
               ->setAddressLine1($addressLine1)
               ->setAddressLine2($addressLine2)
               ->setAddressLine3($addressLine3)
               ->setTown($town)
               ->setExactMatch($exactMatch)
               ->setProvince($province)
               ->setPostcode($postcode)
               ->setCountry($country);
        $this->sender = $sender;
        return $this->sender; 
    }

    public function setDelivery(string $name, string $addressLine1, string $addressLine2 = null, string $addressLine3 = null, 
                                string $town, string $exactMatch = null, string $province = null, string $postcode = null , string $country)
    {
        $delivery = new Address();
        $delivery->setName($name)
        ->setAddressLine1($addressLine1)
        ->setAddressLine2($addressLine2)
        ->setAddressLine3($addressLine3)
        ->setTown($town)
        ->setExactMatch($exactMatch)
        ->setProvince($province)
        ->setPostcode($postcode)
        ->setCountry($country);
        $this->delivery = $delivery;
        return $delivery; 
    }

}