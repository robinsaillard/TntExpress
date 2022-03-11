<?php 

namespace RS\TntExpress\Services;

use FluidXml\FluidXml;
use RS\TntExpress\TntExpressInfo;

class TownPostRequest
{
    protected $info; 
    protected $url = "https://express.tnt.com/expressconnect/pricing/gettownpost"; 

    public function __construct(TntExpressInfo $info, $url = null) {
        $this->info = $info;
        if(!is_null($url)){
            $this->url = $url;
        }
    }

    public function getTownPostRequest($pays, $town = null, $postcode = null){
        $xml = new FluidXml("townSearchRequest"); 
        $data = [
            "appId" => "PC", 
            "appVersion" => "1.0", 
            "townsearch" => [
                "country" => $pays, 
                "town" => $town, 
                "postcode" => $postcode
            ]
        ]; 
        $xml->addchild($data); 
        $this->httpPost($xml->__toString());
        echo $this->socketResponse;
        die(); 
        
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