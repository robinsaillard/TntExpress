<?php

namespace RS\TntExpress;

use DateTime;
use RS\TntExpress\Elements\Account;
use RS\TntExpress\TntExpress;
use RS\TntExpress\Elements\Address;
use RS\TntExpress\Elements\CollectionDateTime;
use RS\TntExpress\Elements\ConsignmentIdentity;
use RS\TntExpress\Elements\OptionalElements;
use RS\TntExpress\Elements\Product;

class TntExpressLabel extends TntExpress{

    public $sender; 
    public $delivery; 
    public $consignmentIdentity; 
    public $collectionDateTime; 
    public $product; 
    public $optionalElements;
    
    public $url = 'https://express.tnt.com/expresslabel/documentation/getlabel'; 

    public function __construct($userId, $password, $url = null) {
        if(!is_null($url)){
            $this->url = $url;
        }
        parent::__construct($userId, $password, $this->url);
    }
    
    public function setSender(string $name, string $addressLine1, string $addressLine2 = null, string $addressLine3 = null, 
                              string $town, string $exactMatch = null, string $province = null, string $postcode = null , string $country)
    {
        $this->sender = new Address();
        $this->sender->setName($name)
                     ->setAddressLine1($addressLine1)
                     ->setAddressLine2($addressLine2)
                     ->setAddressLine3($addressLine3)
                     ->setTown($town)
                     ->setExactMatch($exactMatch)
                     ->setProvince($province)
                     ->setPostcode($postcode)
                     ->setCountry($country);
        $this->createElement("sender", $this->sender);
        return $this->sender; 
    }

    public function setDelivery(string $name, string $addressLine1, string $addressLine2 = null, string $addressLine3 = null, 
                                string $town, string $exactMatch = null, string $province = null, string $postcode = null , string $country)
    {
        $this->delivery = new Address();
        $this->delivery->setName($name)
                       ->setAddressLine1($addressLine1)
                       ->setAddressLine2($addressLine2)
                       ->setAddressLine3($addressLine3)
                       ->setTown($town)
                       ->setExactMatch($exactMatch)
                       ->setProvince($province)
                       ->setPostcode($postcode)
                       ->setCountry($country);
        $this->createElement("delivery", $this->delivery);
        return $this->delivery; 
    }

    public function setConsignementIdentity(string $consignmentNumber, string $customerReference)
    {
        $this->consignmentIdentity = new ConsignmentIdentity();
        $this->consignmentIdentity->setConsignmentNumber($consignmentNumber)
                                  ->setCustomerReference($customerReference);
        $this->createElement("consignmentIdentity", $this->consignmentIdentity);
        return $this->consignmentIdentity; 
    }

    public function setCollectionDateTime(DateTime $collectionDateTime)
    {
        $this->collectionDateTime = new CollectionDateTime();
        $this->collectionDateTime->setCollectionDateTime($collectionDateTime);
        $this->createElement("collectionDateTime", $this->collectionDateTime);
        return $this->collectionDateTime; 
    }

    public function setProduct(string $lineOfBusiness, string $groupId, string $subGroupId, string $type, string $option = null)
    {
        $this->product = new Product();
        $this->product->setLineOfBusiness($lineOfBusiness)
                      ->setGroupId($groupId)
                      ->setSubGroupId($subGroupId)
                      ->setType($type)
                      ->setOption($option);
        $this->createElement("product", $this->product);
        return $this->product;
    }


    public function setAccount(string $accountNumber, string $accountCountry)
    {
        $this->account = new Account();
        $this->account->setAccountNumber($accountNumber)
                      ->setAccountCountry($accountCountry);
        $this->createElement("account", $this->account);
        return $this->account;
    }

    public function setOptionalElements(string $bulkShipment = null , string $specialInstructions = null , string $cashAmount = null , string $cashCurrency = null , string $cashType = null , string $customControlled= null, string $termsOfPayment = null)
    {
        $this->optionalElements = new OptionalElements(); 
        $this->optionalElements->setBulkShipment($bulkShipment)
                               ->setSpecialInstructions($specialInstructions)
                               ->setCashAmount($cashAmount)
                               ->setCashCurrency($cashCurrency)
                               ->setCashType($cashType)
                               ->setCustomControlled($customControlled)
                               ->setTermsOfPayment($termsOfPayment); 
        $this->xml->getAsXml();
        return $this->optionalElements;
    }
}