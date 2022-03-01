<?php 

namespace RS\TntExpress;

use RS\TntExpress\XmlWriterOverride;

abstract class TntExpress {

    private $errorCode = 0;
    private $errorMessage = "";
    private $socketResponse = "";
    private $userId; 
    private $password;
    private $url; 

    public function __construct($userId, $password, $url) {
        $this->userId = $userId;
        $this->password = $password;
        $this->url = $url;
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
        $xslt->importStyleSheet(\DomDocument::load(Locale::loadXls("HTMLRoutingLabelRenderer")));
        $xslt->setParameter('', 'css_dir', $cssDir);
        $xslt->setParameter('', 'images_dir', $imgDir);
        return $xslt->transformToXML(\DomDocument::loadXML($xml));
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