<?php 

namespace RS\TntExpress\Services;

use DateTime;
use Exception;
use DateInterval;
use FluidXml\FluidXml;
use RS\TntExpress\TntExpressInfo;
use RS\TntExpress\Services\LabelRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

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
    public $option; 

    protected $url = "https://express.tnt.com/expressconnect/shipping/ship"; 


    public function __construct(TntExpressInfo $label, $option, $url = null ) {
        $this->label = $label; 
        $this->reference = $label->consignmentIdentity->customerReference; 
        $this->sender = $label->sender;
        $this->receiver = $label->delivery;
        $this->account = $label->account; 
        $this->product = $label->product; 
        $this->totalItems = $label->package->itemNumber; 
        $this->optional = $label->optionalElements; 
        $this->package = $label->package; 
        $this->option = $option;
    }

    public function getShippingRequest()
    {
        $date = new DateTime(); 
        $dateMax = new DateTime(date("Y-m-d 14:30:00"));  
        if ($date > $dateMax) {
            $date = $date->add(new DateInterval('P1D'));
        }
        if ($this->isWeekend($date)) {
            $addDay = $this->getValueWeekend($date); 
            $date = $date->add(new DateInterval("P{$addDay}D"));
        }
        $formatedDate = $date->format("d/m/Y");
        $emailReceiver = $this->receiver->mail; 
        $emailSender = $this->sender->mail; 
        $xml = new FluidXml("ESHIPPER");
        $xml->addChild([
            "LOGIN" => [
                "COMPANY" => $this->label->getUserId(),
                "PASSWORD"=> $this->label->getPassword(),
                "APPID" => $this->product->id,
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
                                "FROM" => $this->cD("16:00"), 
                                "TO" => $this->cD("18:00")
                            ], 
                            "ALTCOLLECTTIME" => [
                                "FROM" => "", 
                                "TO" => ""
                            ], 
                            "COLLINSTRUCTIONS" => $this->cD($this->package->description),                       
                        ]    
                    ], 
                    "CONSIGNMENT" => [
                        "CONREF" => $this->reference, 
                        "DETAILS" => $this->getDetail()
                    ]

                ], 
                "ACTIVITY" => $this->getActivity($this->option, false, $emailReceiver, $emailSender)
            ])
        ;
        $access = $this->sendToTNTServer($xml->__toString()); 
        $result = $this->sendToTNTServer("GET_RESULT:" . preg_replace("/[^0-9]/", "", $access));
        $xmlResult = new \SimpleXMLElement($result);
        
        if ((string) $xmlResult->CREATE->SUCCESS === "Y") {
            $conNumber = preg_replace("/[^0-9]/", "",(string) $xmlResult->CREATE->CONNUMBER); 
            $this->label->setConsignementIdentity($this->reference, $conNumber);
            $label = new LabelRequest($this->label); 
            $conRef = (string) $xmlResult->CREATE->CONREF;
            $res = $label->createLabel($conNumber, $conRef, $date->format('Y-m-d'));   
            return $res;
        }elseif((string) $xmlResult->ERROR->CODE !== ""){
            return new JsonResponse([
                "code" => (string) $xmlResult->ERROR->CODE, 
                "description" => (string) $xmlResult->ERROR->DESCRIPTION, 
                "source" => (string) $xmlResult->ERROR->SOURCE
            ], 401); 
        }
        elseif((string) $xmlResult->error_reason !== ""){
            return new JsonResponse([
                "code" => null,
                "description" => (string) $xmlResult->error_reason . " // ". (string) $xmlResult->error_srcText, 
                "source" => null
            ], 401); 
        }
        else {
            return new JsonResponse([
                "code" => null,
                "description" => "création étiquette impossible",
                "source" => null
            ], 401);       
        }
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
            $res["ACCOUNT"] = $this->cD($account->accountNumber);
            $res["CONTACTNAME"] = $this->cD($account->contactName);
            $res["CONTACTDIALCODE"] = $this->cD($account->dialCode);
            $res["CONTACTTELEPHONE"] = $this->cD($account->telephone);
            $res["CONTACTEMAIL"] = $this->cD($account->mail);
        }else {
            $res["CONTACTNAME"] = $this->cD($address->contactName);
            $res["CONTACTDIALCODE"] = $this->cD($address->dialCode);
            $res["CONTACTTELEPHONE"] = $this->cD($address->telephone);
            $res["CONTACTEMAIL"] = $this->cD($address->mail);
        }
        return $res;
    }

    public function getDetail()
    {
        $res = [
            "RECEIVER" => $this->getAddress($this->receiver),
            "DELIVERY" => $this->getAddress($this->sender),
            "CONNUMBER",
            "CUSTOMERREF" => $this->cD($this->reference), 
            "CONTYPE" => $this->cD($this->product->type),
            "PAYMENTIND" => $this->cD($this->optional->termsOfPayment),
            "ITEMS" => $this->cD($this->totalItems),
            "TOTALWEIGHT" => $this->cD($this->package->weight),
            "TOTALVOLUME" => $this->cD($this->package->totalVolume),
            "CURRENCY",
            "GOODSVALUE",
            "INSURANCEVALUE",
            "INSURANCECURRENCY",
            "SERVICE" => $this->cD($this->product->service),
            "OPTION" => $this->cD($this->product->option),
            "DESCRIPTION" => $this->cD($this->package->description),
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


    function sendToTNTServer($Xml) {

        $postdata = http_build_query(
                           array(
                            'xml_in' => $Xml 
                           )
                );
     
        $opts = array('http' =>
                    array(
                       'method'  => 'POST',
                       'header'  => 'Content-type: application/x-www-form-urlencoded',
                       'content' => $postdata
                     )
                 );
     
        $context  = stream_context_create($opts);
        try {
            $output = file_get_contents( 
                $this->url, 
                false, 
                $context 
              );
              return $output;
        } catch (\Throwable $th) {
            dd($th);
        }    
    }    

    function isWeekend($date) {
        return in_array($date->format("l"), ["Saturday", "Sunday"]);
    }

    public function getValueWeekend($date)
    {
        if ($date->format("l") === "Saturday") {
            return 2; 
        }elseif ($date->format("l") === "Sunday") {
            return 1; 
        }
        return 0;
    }
}
