<?php

namespace RS\TntExpress;

use DateTime;
use RS\TntExpress\Elements\Account;
use RS\TntExpress\TntExpress;
use RS\TntExpress\Elements\Address;
use RS\TntExpress\Elements\CollectionDateTime;
use RS\TntExpress\Elements\ConsignmentIdentity;
use RS\TntExpress\Elements\OptionalElements;
use RS\TntExpress\Elements\Package;
use RS\TntExpress\Elements\PieceLine;
use RS\TntExpress\Elements\PieceMeasurements;
use RS\TntExpress\Elements\Pieces;
use RS\TntExpress\Elements\Product;
use RS\TntExpress\Elements\TotalNumberOfPieces;

class TntExpressLabel extends TntExpress{

    public $sender; 
    public $delivery; 
    public $consignmentIdentity; 
    public $collectionDateTime; 
    public $product; 
    public $optionalElements;
    public $totalNumberOfPieces;
    public $pieceLine; 
    public $package; 
    
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
        return $this; 
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
        return $this; 
    }

    public function setConsignementIdentity(string $consignmentNumber, string $customerReference)
    {
        $this->consignmentIdentity = new ConsignmentIdentity();
        $this->consignmentIdentity->setConsignmentNumber($consignmentNumber)
                                  ->setCustomerReference($customerReference);
        return $this; 
    }

    public function setCollectionDateTime(DateTime $collectionDateTime)
    {
        $this->collectionDateTime = new CollectionDateTime();
        $this->collectionDateTime->setCollectionDateTime($collectionDateTime);
        return $this; 
    }

    public function setProduct(string $lineOfBusiness, string $groupId, string $subGroupId, string $type, string $option = null)
    {
        $this->product = new Product();
        $this->product->setLineOfBusiness($lineOfBusiness)
                      ->setGroupId($groupId)
                      ->setSubGroupId($subGroupId)
                      ->setType($type)
                      ->setOption($option);
        return $this;
    }


    public function setAccount(string $accountNumber, string $accountCountry)
    {
        $this->account = new Account();
        $this->account->setAccountNumber($accountNumber)
                      ->setAccountCountry($accountCountry);
        return $this;
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
        return $this->optionalElements;
    }

    public function setTotalPieces(int $totalNumberOfPieces)
    {
        $this->totalNumberOfPieces = new TotalNumberOfPieces(); 
        $this->totalNumberOfPieces->setTotalNumberOfPieces($totalNumberOfPieces);
        return $this;
    }

    /**
     * @param string $reference : Reference on label
     * @param string $description : Description on label
     * @param PieceMeasurements $mesurement : (length, width , height, weight)
     * @param Pieces[] $pieces
     */
    public function setPieceLine(string $reference, string $description, PieceMeasurements $mesurement, array $pieces)
    {
        if ($this->totalNumberOfPieces->getTotalNumberOfPieces() > 0) {
            $this->pieceLine = new PieceLine();
            $this->pieceLine->setIdentifier($reference)
                            ->setGoodsDescription($description)
                            ->setPieceMeasurements($mesurement);
            foreach ($pieces as $piece) {           
                $this->pieceLine->setPieces($piece);
            }
            return $this;
        }
    }

    public function setPackage(int $itemNumber, int $poids, float $longueur, float $largeur, float $hauteur)
    {
        $this->package = new Package();
        $this->package->setItemNumber($itemNumber)
                      ->setWeight($poids)
                      ->setWidth($longueur)
                      ->setLenght($largeur)
                      ->setHeight($hauteur); 
        return $this; 
    }
}