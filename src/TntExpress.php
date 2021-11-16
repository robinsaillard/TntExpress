<?php 

namespace RS\TntExpress;

use RS\TntExpress\XmlWriterOverride;

abstract class TntExpress {

    private $errorCode = 0;
    private $errorMessage = "";
    private $socketResponse = "";
    private $userId; 
    private $password;

    public function __construct($userId, $password) {
        $this->userId = $userId;
        $this->password = $password;
        $this->initXml();
    }

    
    public function httpPost($url, $strRequest)
    {
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $userPass = "";
        if ((trim($this->userId)!="") && (trim($this->password)!="")) {
            $userPass = $this->userId.":".$this->password;
            curl_setopt($ch, CURLOPT_USERPWD, $userPass);
        }
        curl_setopt($ch, CURLOPT_POST, 1) ;
        curl_setopt($ch, CURLOPT_POSTFIELDS, $strRequest);
        $isSecure = strpos($url,"https://");

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

    public function renderHtml($xml, $cssDir = null , $imgDir = null)
    {
        $scheme = $_SERVER['REQUEST_SCHEME'] . '://';
        if (is_null($cssDir)) {
            $cssDir = $scheme . $_SERVER['SERVER_NAME'] . "/bundles/tntexpress/css/";
        }
        if (is_null($imgDir)) {
            $imgDir = $scheme .  $_SERVER['SERVER_NAME']."/bundles/tntexpress/images/"; 
        }
        $xslt = new \xsltProcessor();
        $xslt->importStyleSheet(\DomDocument::load(__DIR__. '/Views/HTMLRoutingLabelRenderer.xsl'));
        $xslt->setParameter('', 'css_dir', $cssDir);
        $xslt->setParameter('', 'images_dir', $imgDir);
        return $xslt->transformToXML(\DomDocument::loadXML($xml));
    }

    public function initXml()
    {
        $this->xml = new XmlWriterOverride();
        $this->xml->openMemory();
        $this->xml->setIndent(true);
    }


    /**
     * Get the value of errorCode
     */ 
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * Get the value of errorMessage
     */ 
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * Get the value of socketResponse
     */ 
    public function getSocketResponse()
    {
        return $this->socketResponse;
    }



    /**
     * Get the value of userId
     */ 
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

        /**
     * Set the value of errorCode
     *
     * @return  self
     */ 
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;

        return $this;
    }

    /**
     * Set the value of errorMessage
     *
     * @return  self
     */ 
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;

        return $this;
    }

    /**
     * Set the value of socketResponse
     *
     * @return  self
     */ 
    public function setSocketResponse($socketResponse)
    {
        $this->socketResponse = $socketResponse;

        return $this;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */ 
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}