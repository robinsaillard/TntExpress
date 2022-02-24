<?php 

namespace RS\TntExpress\Services;

use DateTime;
use FluidXml\FluidXml;
use RS\TntExpress\TntExpress;
use RS\TntExpress\TntExpressLabel;
use RS\TntExpress\Elements\Address;
use RS\TntExpress\XmlWriterOverride;

class ShipRequest
{

    public $label; 
    public $reference;
    public $sender; 
    public $receiver; 
    public $product; 
    public $totalItems; 
    public $optional; 
    public $package; 

    protected $url = "https://express.tnt.com/expressconnect/shipping/ship"; 


    public function __construct(TntExpressLabel $label, $url = null ) {
        $this->label = $label; 
        $this->reference = $label->consignmentIdentity->customerReference; 
        $this->sender = $label->sender;
        $this->receiver = $label->delivery;
        $this->account = $label->account; 
        $this->product = $label->product; 
        $this->totalItems = $label->totalNumberOfPieces; 
        $this->optional = $label->optionalElements; 
        $this->package = $label->package; 
    }

    public function getShippingRequest()
    {
        $date = new DateTime(); 
        $formatedDate = $date->format("d/m/Y");
        $emailReceiver = "test.name@tnt.com"; 
        $emailSender = "test.name@tnt.com"; 
        $xml = new FluidXml("ESHIPPER");
        $xml->addChild([
            "LOGIN" => [
                "COMPANY" => $this->label->getUserId(),
                "PASSWORD"=> $this->label->getPassword(),
                "APPID" => "EC",
                "APPVERSION"=> "3.1"
            ]])
            ->addChild([
                "CONSIGNMENTBATCH" => [
                    "SENDER" => [
                        $this->getAddress($this->sender, $this->account),
                        "COLLECTION" => [
                            "COLLECTIONADDRESS" => $this->getAddress($this->sender),
                            "SHIPDATE" => $this->cD($formatedDate),
                            "PREFCOLLECTTIME" => [
                                "FROM" => $this->cD("09:00"), 
                                "TO" => $this->cD("10:00")
                            ], 
                            "ALTCOLLECTTIME" => [
                                "FROM" => $this->cD("11:00"), 
                                "TO" => $this->cD("12:00")
                            ], 
                            "COLLINSTRUCTIONS" => $this->cD($this->optional->specialInstructions),                       
                        ]    
                    ], 
                    "CONSIGNMENT" => [
                        "CONREF" => $this->reference, 
                        "DETAILS" => $this->getDetail()
                    ]

                ], 
                "ACTIVITY" => $this->getActivity(["CREATE", "SHIP", "PRINT"], false, $emailReceiver, $emailSender)
            ])
        ;
        return $xml->xml(); 
    }

    public function getAddress($address, $account = null)
    {
        $res["COMPANYNAME"] = $this->cD($address->name); 
        $res["STREETADDRESS1"] = $this->cD($address->addressLine1); 
        if (!empty($address->addressLine2)) {
            $res["STREETADDRESS2"] = $this->cD($address->addressLine2); 
        }
        if (!empty($address->addressLine3)) {
            $res["STREETADDRESS3"] = $this->cD($address->addressLine3); 
        }
        $res["CITY"] = $this->cD($address->town); 
        if (!empty($address->province)) {
            $res["PROVINCE"] = $this->cD($address->province); 
        }
        $res["POSTCODE"] = $this->cD($address->postcode); 
        $res["COUNTRY"] = $this->cD($address->country); 

        if (!empty($address->exactMatch)) {
            $res["VAT"] = $this->cD($address->exactMatch); 
        }

        if (!is_null($account)) {
            $merge = [
                "ACCOUNT" => $this->cD($account->accountNumber),
                "CONTACTNAME" => $this->cD($account->contactName),
                "CONTACTDIALCODE" => $this->cD($account->dialCode),
                "CONTACTTELEPHONE" => $this->cD($account->telephone),
                "CONTACTEMAIL" => $this->cD($account->mail),
            ];
            $res = array_merge($res, $merge);
        }
        return $res;
    }

    public function getDetail()
    {
        $res = [
            "RECEIVER" => $this->getAddress($this->receiver, $this->account),
            "DELIVERY" => $this->getAddress($this->sender, $this->account),
            "CONNUMBER",
            "CUSTOMERREF" => $this->cD($this->reference), 
            "CONTYPE" => $this->cD($this->product->type),
            "PAYMENTIND" => $this->cD($this->optional->termsOfPayment),
            "ITEMS" => $this->cD($this->totalItems->totalNumberOfPieces),
            "TOTALWEIGHT" => $this->cD(3),
            "TOTALVOLUME" => $this->cD(1.0),
            "CURRENCY",
            "GOODSVALUE",
            "INSURANCEVALUE",
            "INSURANCECURRENCY",
            "SERVICE" => $this->cD("48N"),
            "OPTION" => $this->cD($this->product->option),
            "DESCRIPTION" => $this->cD("TEST"),
            "DELIVERYINST" => $this->cD($this->optional->specialInstructions),
            "PACKAGE" => $this->setPackage($this->package)
        ];
        return $res;
    }

    public function setPackage($package)
    {
        return [
            "ITEMS" => $this->cD($package->itemNumber),
            "DESCRIPTION" => $this->cD($package->description),
            "LENGTH" => $this->cD($package->lenght),
            "HEIGHT" => $this->cD($package->height),
            "WIDTH" => $this->cD($package->width),
            "WEIGHT"  => $this->cD($package->weight)
            // "ARTICLE" => [
            //     "ITEMS" => $this->cD(""),
            //     "DESCRIPTION" => $this->cD(""),
            //     "WEIGHT" => $this->cD(""),
            //     "INVOICEVALUE" => $this->cD(""),
            //     "INVOICEDESC" => $this->cD(""),
            //     "HTS" => $this->cD(""),
            //     "COUNTRY" => $this->cD(""),
            // ]
        ] ;
    }

    public function getActivity($option, $groupeCode = false, $emailReceiver = null, $emailSender = null)
    {
        $res = []; 
        if (in_array("CREATE", $option)) {
            $res["CREATE"] = [
                "CONREF" => $this->cD($this->reference)
            ]; 
        }
        if (in_array("BOOK", $option)) {
            $res["BOOK"] = [
                '@ShowBookingRef' => 'Y',
                "CONREF" => $this->cD($this->reference)
            ];
        }
        if (in_array("SHIP", $option)) {
            $res["SHIP"] = [
                "CONREF" => $this->cD($this->reference)
            ];
        }
        if (in_array("PRINT", $option)) {
            $res["PRINT"] =  [
                "CONNOTE" => [
                    "CONREF" => $this->cD($this->reference)
                ],
                "LABEL" => [
                    "CONREF" => $this->cD($this->reference)
                ],
                "MANIFEST" => [
                    "CONREF" => $this->cD($this->reference)
                ],
                "INVOICE" => [
                    "CONREF" => $this->cD($this->reference)
                ],
                "EMAILTO" => $emailReceiver,
                "EMAILFROM" => $emailSender,
            ];
        }
        if ($groupeCode) {
            array_push($res, "SHOW_GROUPCODE");
        }
        
        return $res;
    }

    public function cD($value)
    {
        if (!is_null($value)) {
            return "<![CDATA[" . $value . "]]>";
        }
        return null; 
    }
}
