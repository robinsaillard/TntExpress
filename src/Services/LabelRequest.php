<?php 

namespace RS\TntExpress\Services;

use FluidXml\FluidXml;
use RS\TntExpress\TntExpress;
use RS\TntExpress\TntExpressInfo;

class LabelRequest extends TntExpress
{
    protected $url = "https://express.tnt.com/expresslabel/documentation/getlabel";
    protected $info; 

    public function __construct(TntExpressInfo $info, $url = null) {
        $this->info = $info;
        if(!is_null($url)){
            $this->url = $url;
        }
        parent::__construct($info->getUserId(), $info->getPassword(), $this->url);
    }

    public function createLabel($consignmentNumber, $customerReference, $date)
    {
        $identifier = 1;
        $pieceReference = $customerReference; 
        $xml = new FluidXml("labelRequest"); 
        $data = [
            "consignment" => [
                "@key" => "CON1", 
                "consignmentIdentity" => [
                    "consignmentNumber" => $this->cD($consignmentNumber), 
                    "customerReference" => $this->cd($customerReference)
                ],
                "collectionDateTime" => $this->cD($date . "T16:30:00"), 
                "sender" => $this->getAddress($this->info->sender),
                "delivery" => $this->getAddress($this->info->delivery), 
                "product" => $this->getProduct($this->info->product),
                "account" => [
                    "accountNumber" => $this->cD($this->info->account->accountNumber), 
                    "accountCountry" => $this->cD($this->info->account->accountCountry)
                ], 
                "totalNumberOfPieces" => $this->cD($this->info->package->itemNumber), 
                "pieceLine" => [
                    "identifier" => $this->cD($identifier), 
                    "goodsDescription" => $this->cD($pieceReference), 
                    "pieceMeasurements" => [
                        "lenght" => $this->cD($this->info->package->lenght),
                        "width" => $this->cD($this->info->package->width),
                        "height" => $this->cD($this->info->package->height),
                        "weight" => $this->cD($this->info->package->weight),
                    ], 
                ]
            ]
        ]; 
        for ($i=0; $i < $this->info->package->itemNumber; $i++) { 
            $data["consignment"]["pieceLine"][] = [
                "pieces" => [
                    "sequenceNumbers" => $this->cD($i + 1), 
                    "pieceReference" => $this->cD($pieceReference . "-" . ($i + 1))
                ]
            ];
        }
        $xml->addchild($data); 
        $this->httpPost($xml->__toString());
        return $this->renderHtml($this->socketResponse);
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
        $res["exactMatch"] = $this->cD("Y"); 
        if (!empty($address->province)) {
            $res["province"] = $this->cD($address->province); 
        }
        $res["postcode"] = $this->cD($address->postcode); 
        $res["country"] = $this->cD($address->country); 
        return $res;
    }

    public function getProduct($product)
    {
        return [
            "lineOfBusiness" => $this->cD($product->lineOfBusiness), 
            "groupId" => $this->cD($product->groupId), 
            "subGroupId" => $this->cD($product->subGroupId), 
            "id" => $this->cD($product->id), 
            "type" => $this->cD($product->type), 
            "option" => $this->cD($product->option)
        ];
    }

    public function cD($value)
    {
        if (!is_null($value)) {
            return "<![CDATA[" . $value . "]]>";
        }
        return null; 
    }

    public function httpPost($strRequest)
    {
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $userPass = "";
        if ((trim($this->info->getUserId())!="") && (trim($this->info->getPassword())!="")) {
            $userPass = $this->info->getUserId().":".$this->info->getPassword();
            curl_setopt($ch, CURLOPT_USERPWD, $userPass);
        }
        curl_setopt($ch, CURLOPT_POST, 1) ;
        curl_setopt($ch, CURLOPT_POSTFIELDS, $strRequest);
        $isSecure = strpos($this->url,"https://");

        if ($isSecure===0) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        } 
        $result = curl_exec($ch);
        $this->errorCode = curl_errno($ch);
        $this->errorMessage = curl_error($ch);
        $this->socketResponse = $result;
        curl_close($ch); 
    }
}
