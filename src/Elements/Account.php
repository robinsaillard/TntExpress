<?php

namespace App\Service\Etiquette\Tnt\Inter\Entity;

use App\Service\Etiquette\Tnt\Inter\Entity\AbstractXml;

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

        return $this;
    }
}