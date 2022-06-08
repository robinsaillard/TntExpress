# TntExpress v1.0.12
Création d'étiquette tnt à l'international via le webservice (https://express.tnt.com/expresswebservices-website/app/routinglabelrequest.html)

## Installation

`composer install robinsaillard/tnt-express`

## Add bundle symfony

`RS\TntExpress\TntExpressBundle::class => ['all' => true]`

## Installation ressource

`php bin/console assets:install`

## Création étiquette en html

```php

use RS\TntExpress\TntExpressInfo;
use RS\TntExpress\Services\ShipRequest;



$tnt = new TntExpressInfo("IdUser","password"); 

$tnt->setConsignementIdentity(string $customerReference, string $consignmentNumber = null)
    ->setCollectionDateTime(DateTime $collectionDateTime)

    ->setSender(string $name, string $addressLine1, string $addressLine2 = null, string $addressLine3 = null, 
                string $town, string $exactMatch = null, string $province = null, string $postcode = null , 
                string $country, string $contactName, string $dialCode, string $telephone, string $mail) 

    ->setDelivery(string $name, string $addressLine1, string $addressLine2 = null, string $addressLine3 = null, 
                string $town, string $exactMatch = null, string $province = null, string $postcode = null , 
                string $country, string $contactName, string $dialCode, string $telephone, string $mail)

    ->setProduct(string $lineOfBusiness, string $groupId, string $subGroupId, string $type , string $id, 
                 string $service, string $option = null)

    ->setAccount(string $accountNumber, string $accountCountry, string $contactName, string $dialCode, 
                 string $mail, string $telephone)

    ->setOptionalElements(string $bulkShipment = null , string $specialInstructions = null , string $cashAmount = null, 
                          string $cashCurrency = null , string $cashType = null , string $customControlled= null, 
                          string $termsOfPayment = null)

    ->setPackage(int $itemNumber, float $poids, float $longueur, float $largeur, float $hauteur, string $description); 

                
//$val = ["CREATE", "BOOK", "SHIP","PRINT"]
$xml = new ShipRequest($tnt, $val);

$html = $xml->getShippingRequest();

echo $html; 
```

## Vérification code postal ou ville

```php
use RS\TntExpress\TntExpressInfo;
use RS\TntExpress\Services\TownPostRequest;

$tnt = new TntExpressInfo("IdUser","password"); 
$request = new TownPostRequest($tnt); 
$result = $request->getTownPostRequest($pays = "FR", $ville,  $postcode); 

//output : 
$result : array(
    array(
        "searchItem" => 1,
        "postcode" => "NNNNN",
        "ville" => "xxxxxxxxx"
    ), 
    [],
);

```
