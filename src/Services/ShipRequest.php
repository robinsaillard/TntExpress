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
    }

    public function getShippingRequest()
    {
        $date = new DateTime(); 
        $formatedDate = $date->format("d/m/Y");
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
                        $this->getAddress($this->sender, $this->account),
                        "COLLECTION" => [
                            "COLLECTIONADDRESS" => $this->getAddress($this->sender, $this->account),
                            "SHIPDATE" => $formatedDate,
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
                        "CONREF" => $this->cD($this->reference), 
                        "DETAILS" => $this->getDetail()
                    ]

                ], 
                "ACTIVITY" => [
                    "CREATE" => [
                        "CONREF" => $this->cD($this->reference)
                    ], 
                    "SHIP" => [
                        "CONREF" => $this->cD($this->reference)
                    ], 
                    "PRINT" => [
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
                    ],
                    "SHOW_GROUPCODE",
                ],
            ])
        ;
        return $xml->xml(); 
    }

    public function getAddress($address, $account = null)
    {
        $res = [
            "COMPANY" => $this->cD($address->name),
            "STREETADDRESS1" => $this->cD($address->addressLine1),
            "STREETADDRESS2" => $this->cD($address->addressLine2),
            "STREETADDRESS3" => $this->cD($address->addressLine3),
            "CITY" => $this->cD($address->town),
            "PROVINCE" => $this->cD($address->province),
            "POSTCODE" => $this->cD($address->postcode),
            "COUNTRY" => $this->cD($address->country),
            "VAT" => $this->cD($address->exactMatch),
        ];
        if (!is_null($account)) {
            $merge = [
                "ACCOUNT" => $this->cD($account->accountNumber),
                "CONTACTNAME" => $this->cD($account->accountNumber),
                "CONTACTDIALCODE" => $this->cD($account->accountNumber),
                "CONTACTTELEPHONE" => $this->cD($account->accountNumber),
                "CONTACTEMAIL" => $this->cD($account->accountNumber),
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
            "DESCRIPTION",
            "DELIVERYINST" => $this->cD($this->optional->specialInstructions),
            "PACKAGE" => [
                "ITEMS" => $this->cD($this->totalItems->totalNumberOfPieces),
                "DESCRIPTION" => $this->cD(""),
                "LENGTH",
                "HEIGHT" ,
                "WIDTH" ,
                "WEIGHT" => $this->cD(3),
                // "ARTICLE" => [
                //     "ITEMS" => $this->cD(""),
                //     "DESCRIPTION" => $this->cD(""),
                //     "WEIGHT" => $this->cD(""),
                //     "INVOICEVALUE" => $this->cD(""),
                //     "INVOICEDESC" => $this->cD(""),
                //     "HTS" => $this->cD(""),
                //     "COUNTRY" => $this->cD(""),
                // ]
            ]
        ];

    }

    public function setPackage()
    {
        return ; 
    }


    public function cD($value)
    {
        if (!is_null($value)) {
            return "<![CDATA[" . $value . "]]>";
        }
        return null; 
    }
}
