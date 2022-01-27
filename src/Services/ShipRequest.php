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

    protected $label; 

    protected $url = "https://express.tnt.com/expressconnect/shipping/ship"; 


    public function __construct(TntExpressLabel $label, $url = null ) {
        $this->label = $label; 
       
    }

    public function getShippingRequest()
    {
        $sender = $this->label->sender;
        $receiver = $this->label->delivery;
        $date = new DateTime(); 
        $formatedDate = $date->format("d/m/Y");
        $reference = "";
        $account = "";
        $instruction = "";
        $emailReceiver = ""; 
        $emailSender = ""; 
        $xml = new FluidXml("ESHIPPER");
        $xml->addChild([
            "LOGIN" => [
                "COMPANY" => $this->label->getUserId(),
                "PASSWORD"=> $this->label->getPassword(),
                "APPID" => "EC",
                "APPVERSION"=> 2.2
            ]])
            ->addChild([
                "CONSIGNMENTBATCH" => [
                    "SENDER" => [
                        $this->getAddress($xml, $sender, $account),
                        "COLLECTION" => [
                            "COLLECTIONADDRESS" => $this->getAddress($xml, $sender, $account),
                            "SHIPDATE" => [
                                "PREFCOLLECTTIME" => [
                                    "FROM" => "09:00", 
                                    "TO" => "10:00"
                                ], 
                                "ALTCOLLECTTIME" => [
                                    "FROM" => "11:00", 
                                    "TO" => "12:00"
                                ], 
                            ], 
                            "COLLINSTRUCTIONS" => $instruction,                       
                        ]    
                    ], 
                    "CONSIGNMENT" => [
                        "CONREF" => $reference, 
                        "DETAILS" => [
                            "RECEIVER" => $this->getAddress($xml, $receiver, $account),
                            "DELIVERY" => $this->getAddress($xml, $sender, $account),
                            "CUSTOMERREF" => $reference, 
                            "CONTYPE" => "",
                            "PAYMENTIND" => "",
                            "ITEMS" => "",
                            "TOTALWEIGHT" => "",
                            "TOTALVOLUME" => "",
                            "CURRENCY" => "",
                            "GOODSVALUE" => "",
                            "INSURANCEVALUE" => "",
                            "INSURANCECURRENCY" => "",
                            "SERVICE" => "",
                            "OPTION" => "",
                            "DESCRIPTION" => "",
                            "DELIVERYINST" => "",
                            "PACKAGE" => [
                                "ITEMS" => "",
                                "DESCRIPTION" => "",
                                "LENGTH" => "",
                                "HEIGHT" => "",
                                "WIDTH" => "",
                                "WEIGHT" => "",
                                "ARTICLE" => [
                                    "ITEMS" => "",
                                    "DESCRIPTION" => "",
                                    "WEIGHT" => "",
                                    "ITEMS" => "",
                                    "ITEMS" => "",
                                ]
                            ]
                        ]
                    ]

                ], 
                "ACTIVITY" => [
                    "CREATE" => [
                        "CONREF" => ""
                    ], 
                    "SHIP" => [
                        "CONREF" => ""
                    ], 
                    "PRINT" => [
                        "CONNOTE" => [
                            "CONREF" => ""
                        ],
                        "LABEL" => [
                            "CONREF" => ""
                        ],
                        "MANIFEST" => [
                            "CONREF" => ""
                        ],
                        "INVOICE" => [
                            "CONREF" => ""
                        ],
                        "EMAILTO" => $emailReceiver,
                        "EMAILFROM" => $emailSender,
                    ],
                    "SHOW_GROUPCODE",
                ],
            ])
        ;
        return $xml; 
    }

    public function getAddress($xml, $address, $account = false)
    {
        $xml->cdata("COMPANY", $address->name)
            ->cdata("STREETADDRESS1", $address->addressLine1)
            ->cdata("STREETADDRESS2", $address->addressLine2)
            ->cdata("STREETADDRESS3", $address->addressLine3)
            ->cdata("CITY", $address->town)
            ->cdata("PROVINCE", $address->province)
            ->cdata("POSTCODE", $address->postcode)
            ->cdata("COUNTRY", $address->country)
            ->cdata("ACCOUNT", $address->town)
            ->cdata("VAT"); 
        if ($account) {
            $xml->cdata("CONTACTNAME", $account)
                ->cdata("CONTACTDIALCODE",$account)
                ->cdata("CONTACTTELEPHONE", $account)
                ->cdata("CONTACTEMAIL", $account); 
        } 
    }

    public function setPackage()
    {
        return ; 
    }

}
