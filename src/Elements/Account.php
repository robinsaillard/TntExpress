<?php

namespace RS\TntExpress\Elements;
class Account {

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
     * @var string
     * Element is required
     */
    public $contactName; 

    /**
     * @var string
     * Element is required
     */
    public $dialCode; 

    /**
     * @var string
     * Element is required
     */
    public $telephone; 

    /**
     * @var string
     * Element is required
     */
    public $mail; 

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

    /**
     * Get element is required
     *
     * @return  string
     */ 
    public function getContactName()
    {
        return $this->contactName;
    }

    /**
     * Set element is required
     *
     * @param  string  $contactName  Element is required
     *
     * @return  self
     */ 
    public function setContactName(string $contactName)
    {
        $this->contactName = $contactName;

        return $this;
    }

    /**
     * Get element is required
     *
     * @return  string
     */ 
    public function getDialCode()
    {
        return $this->dialCode;
    }

    /**
     * Set element is required
     *
     * @param  string  $dialCode  Element is required
     *
     * @return  self
     */ 
    public function setDialCode(string $dialCode)
    {
        $this->dialCode = $dialCode;

        return $this;
    }

    /**
     * Get element is required
     *
     * @return  string
     */ 
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set element is required
     *
     * @param  string  $telephone  Element is required
     *
     * @return  self
     */ 
    public function setTelephone(string $telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get element is required
     *
     * @return  string
     */ 
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set element is required
     *
     * @param  string  $mail  Element is required
     *
     * @return  self
     */ 
    public function setMail(string $mail)
    {
        $this->mail = $mail;

        return $this;
    }
}