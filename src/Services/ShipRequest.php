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
                        $this->getAddress($sender, $account),
                        "COLLECTION" => [
                            "COLLECTIONADDRESS" => $this->getAddress($sender, $account),
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
                            "RECEIVER" => $this->getAddress($receiver, $account),
                            "DELIVERY" => $this->getAddress($sender, $account),
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

    public function getAddress($address, $account = false)
    {
        $res = [
            "COMPANY" => $address->name,
            "STREETADDRESS1" => $address->name,
            "STREETADDRESS2" => $address->name,
            "STREETADDRESS3" => $address->name,
            "CITY" => $address->name,
            "PROVINCE" => $address->name,
            "POSTCODE" => $address->name,
            "COUNTRY" => $address->name,
            "ACCOUNT" => $address->name,
            "VAT" => $address->name,
        ];
        if ($account) {
            $merge = [
                "CONTACTNAME" => $account,
                "CONTACTDIALCODE" => $account,
                "CONTACTTELEPHONE" => $account,
                "CONTACTEMAIL" => $account,
            ];
            $res = array_merge($res, $merge);
        }
        return $res;
    }

    public function setPackage()
    {
        return ; 
    }

}
