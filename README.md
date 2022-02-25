# TntExpress
Création d'étiquette tnt à l'international via le webservice (https://express.tnt.com/expresswebservices-website/app/routinglabelrequest.html)

## Add bundle symfony

`RS\TntExpress\TntExpressBundle::class => ['all' => true]`

## Installation ressource

`php bin/console assets:install`


## Utilisation de base

        $tntExpressLabel = new TntExpressLabel("IdUser","password"); 
        $tntExpressLabel->setConsignementIdentity(string $consignmentNumber, string $customerReference)
                    ->setCollectionDateTime(DateTime $collectionDateTime)
                    ->setSender(string $name, string $addressLine1, string $addressLine2 = null, string $addressLine3 = null, 
                              string $town, string $exactMatch = null, string $province = null, string $postcode = null , 
                              string $country, string $contactName, string $dialCode, string $telephone, string $mail) 
                    ->setDelivery(string $name, string $addressLine1, string $addressLine2 = null, string $addressLine3 = null, 
                                string $town, string $exactMatch = null, string $province = null, string $postcode = null , 
                                string $country, string $contactName, string $dialCode, string $telephone, string $mail)
                    ->setProduct(string $lineOfBusiness, string $groupId, string $subGroupId, string $type, string $option = null)
                    ->setAccount(string $accountNumber, string $accountCountry, string $contactName, string $dialCode, string $mail, string $telephone)
                    ->setOptionalElements(string $bulkShipment = null , string $specialInstructions = null , string $cashAmount = null , string $cashCurrency = null , string $cashType = null , string $customControlled= null, string $termsOfPayment = null)
                    ->setTotalPieces(int $totalNumberOfPieces)
                    ->setPackage(int $itemNumber, int $poids, float $longueur, float $largeur, float $hauteur, string $description); 
        //$val = ["CREATE", "BOOK", "SHIP","PRINT"]
        $xml = new ShipRequest($tntExpressLabel, $val);

        $html = $xml->getShippingRequest();

        echo $html; 
