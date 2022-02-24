<?php 

namespace RS\TntExpress\Services;

use FluidXml\FluidXml;
use RS\TntExpress\TntExpressLabel;

class LabelRequest
{
    protected $url = "https://express.tnt.com/expresslabel/documentation/getlabel";
    protected $info; 

    public function __construct(TntExpressLabel $info) {
        $this->info = $info;
    }

    public function createLabel($consignmentNumber, $customerReference, $date)
    {
        $identifier = 1;  
        $sequenceNumber = "1"; 
        $pieceReference = "REF-PIECE"; 
        $xml = new FluidXml("labelRequest");

        $xml->addChild([
            "consignment" => [
                "@key" => "CON1", 
                "consignmentIdentity" => [
                    "consignmentNumber" => $consignmentNumber, 
                    "customerReference" => $customerReference
                ],
                "collectionDateTime" => $date, 
                "sender" => $this->getAddress($this->info->sender),
                "delivery" => $this->getAddress($this->info->delivery), 
                "product" => $this->getProduct(),
                "account" => [
                    "accountNumber" => $this->info->account->accountNumber, 
                    "accountCountry" => $this->info->account->accountCountry
                ], 
                "totalNumberOfPieces" => $this->info->totalItems, 
                "pieceLine" => [
                    "identifier" => $identifier, 
                    "goodsDescription" => "description",
                    "pieceMeasurements" => [
                        "length" => $this->info->package->lenght, 
                        "width" => $this->info->package->width, 
                        "height" => $this->info->package->height, 
                        "weight" => $this->info->package->weight, 
                    ], 
                    "pieces" => [
                        "sequenceNumbers" => $sequenceNumber,
                        "pieceReference" => $pieceReference
                    ]
                ]
            ]
        ]);  
        return $this->sendToTNTServer($xml->__toString());
    }

    public function getAddress($address, $account = null)
    {
        $res["name"] = $this->cD($address->name); 
        $res["addressLine1"] = $this->cD($address->addressLine1); 
        if (!empty($address->addressLine2)) {
            $res["addressLine2"] = $this->cD($address->addressLine2); 
        }
        if (!empty($address->addressLine3)) {
            $res["addressLine3"] = $this->cD($address->addressLine3); 
        }
        $res["town"] = $this->cD($address->town); 
        $res["exactMatch"] = "Y"; 
        if (!empty($address->province)) {
            $res["province"] = $this->cD($address->province); 
        }
        $res["postcode"] = $this->cD($address->postcode); 
        $res["country"] = $this->cD($address->country); 
        return $res;
    }

    public function getProduct($product = null)
    {
        return [
            "lineOfBusiness" => 2, 
            "groupId" => 0, 
            "subGroupId" => 0, 
            "id" => "EX", 
            "type" => "N", 
            "option" => ""
        ];
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
}
