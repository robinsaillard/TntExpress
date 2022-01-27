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
                "COMPANY" => $this->cD($this->label->getUserId()),
                "PASSWORD"=>  $this->cD($this->label->getPassword()),
                "APPID" => $this->cD("EC"),
                "APPVERSION"=> $this->cD(2.2)
            ]])
            ->addChild([
                "CONSIGNMENTBATCH" => [
                    "SENDER" => [
                        $this->getAddress($sender, $account),
                        "COLLECTION" => [
                            "COLLECTIONADDRESS" => $this->getAddress($sender, $account),
                            "SHIPDATE" => [
                                "PREFCOLLECTTIME" => [
                                    "FROM" => $this->cD("09:00"), 
                                    "TO" => $this->cD("10:00")
                                ], 
                                "ALTCOLLECTTIME" => [
                                    "FROM" => $this->cD("11:00"), 
                                    "TO" => $this->cD("12:00")
                                ], 
                            ], 
                            "COLLINSTRUCTIONS" => $this->cD($instruction),                       
                        ]    
                    ], 
                    "CONSIGNMENT" => [
                        "CONREF" => $this->cD($reference), 
                        "DETAILS" => [
                            "RECEIVER" => $this->getAddress($receiver, $account),
                            "DELIVERY" => $this->getAddress($sender, $account),
                            "CUSTOMERREF" => $this->cD($reference), 
                            "CONTYPE" => $this->cD(""),
                            "PAYMENTIND" => $this->cD(""),
                            "ITEMS" => $this->cD(""),
                            "TOTALWEIGHT" => $this->cD(""),
                            "TOTALVOLUME" => $this->cD(""),
                            "CURRENCY" => $this->cD(""),
                            "GOODSVALUE" => $this->cD(""),
                            "INSURANCEVALUE" => $this->cD(""),
                            "INSURANCECURRENCY" => $this->cD(""),
                            "SERVICE" => $this->cD(""),
                            "OPTION" => $this->cD(""),
                            "DESCRIPTION" => $this->cD(""),
                            "DELIVERYINST" => $this->cD(""),
                            "PACKAGE" => [
                                "ITEMS" => $this->cD(""),
                                "DESCRIPTION" => $this->cD(""),
                                "LENGTH" => $this->cD(""),
                                "HEIGHT" => $this->cD(""),
                                "WIDTH" => $this->cD(""),
                                "WEIGHT" => $this->cD(""),
                                "ARTICLE" => [
                                    "ITEMS" => $this->cD(""),
                                    "DESCRIPTION" => $this->cD(""),
                                    "WEIGHT" => $this->cD(""),
                                    "ITEMS" => $this->cD(""),
                                    "ITEMS" => $this->cD(""),
                                ]
                            ]
                        ]
                    ]

                ], 
                "ACTIVITY" => [
                    "CREATE" => [
                        "CONREF" => $this->cD("")
                    ], 
                    "SHIP" => [
                        "CONREF" => $this->cD("")
                    ], 
                    "PRINT" => [
                        "CONNOTE" => [
                            "CONREF" => $this->cD("")
                        ],
                        "LABEL" => [
                            "CONREF" => $this->cD("")
                        ],
                        "MANIFEST" => [
                            "CONREF" => $this->cD("")
                        ],
                        "INVOICE" => [
                            "CONREF" => $this->cD("")
                        ],
                        "EMAILTO" => $emailReceiver,
                        "EMAILFROM" => $emailSender,
                    ],
                    "SHOW_GROUPCODE",
                ],
            ])
        ;
        return $xml->xml(); 
    }

    public function getAddress($address, $account = false)
    {
        $res = [
            "COMPANY" => $address->name,
            "STREETADDRESS1" => $address->addressLine1,
            "STREETADDRESS2" => $address->addressLine2,
            "STREETADDRESS3" => $address->addressLine3,
            "CITY" => $address->town,
            "PROVINCE" => $address->province,
            "POSTCODE" => $address->postcode,
            "COUNTRY" => $address->country,
            "VAT" => $address->exactMatch,
        ];
        if ($account) {
            $merge = [
                "ACCOUNT" => $account,
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


    public function cD($value)
    {
        return "<![CDATA[" . $value . "]]>";
    }
}
