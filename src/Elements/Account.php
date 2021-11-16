<?php

namespace RS\TntExpress\Elements;

use RS\TntExpress\Elements\AbstractXml;

class Account extends AbstractXml {

    /**
     * @var string
     * Element is required
     */
    public $accountNumber; 
    
    /**
     * @var string
     * Element is required
     */
    public $accountCountry; 




    /**
     * Get element is required
     *
     * @return  string
     */ 
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * Get element is required
     *
     * @return  string
     */ 
    public function getAccountCountry()
    {
        return $this->accountCountry;
    }

    /**
     * Set element is required
     *
     * @param  string  $accountNumber  Element is required
     *
     * @return  self
     */ 
    public function setAccountNumber(string $accountNumber)
    {
        $this->accountNumber = $accountNumber;
        $this->xml->writeElementCData('accountNumber', $accountNumber);
        return $this;
    }

    /**
     * Set element is required
     *
     * @param  string  $accountCountry  Element is required
     *
     * @return  self
     */ 
    public function setAccountCountry(string $accountCountry)
    {
        $this->accountCountry = $accountCountry;
        $this->xml->writeElementCData('accountCountry', $accountCountry);
        return $this;
    }
}