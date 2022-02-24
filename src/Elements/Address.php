<?php

namespace RS\TntExpress\Elements;

use RS\TntExpress\Elements\AbstractXml;

class Address extends AbstractXml{

    /**
     * @var string
     * Element is required
     */
    public $name;

    /**
     * @var string
     * Element is required
     */
    public $addressLine1; 

    /**
     * @var string
     * Element is optional
     */
    public $addressLine2;

    /**
     * @var string
     * Element is optional
     */
    public $addressLine3; 

    /**
     * @var string
     * Element is optional provided there is a postcode
     */
    public $town; 

    /**
     * @var string
     * Element is optional
     */
    public $exactMatch; 

    /**
     * @var string
     * Element is optional
     */
    public $province; 

    /**
     * @var string
     * Element is optional
     */
    public $postcode; 

    /**
     * @var string
     * Element is required
     */
    public $country; 
   
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get element is required
     *
     * @return  string
     */ 
    public function getAddressLine1()
    {
        return $this->addressLine1;
    }

    /**
     * Get element is optional
     *
     * @return  string
     */ 
    public function getAddressLine2() : ?string
    {
        return $this->addressLine2;
    }

    /**
     * Get element is optional
     *
     * @return  string
     */ 
    public function getAddressLine3() : ?string
    {
        return $this->addressLine3;
    }

    /**
     * Get element is optional provided there is a postcode
     *
     * @return  string
     */ 
    public function getTown() : ?string
    {
        return $this->town;
    }

    /**
     * Get element is optional
     *
     * @return  string
     */ 
    public function getExactMatch() : ?string
    {
        return $this->exactMatch;
    }

    /**
     * Get element is optional
     *
     * @return  string
     */ 
    public function getPostcode() : ?string
    {
        return $this->postcode;
    }

    /**
     * Get element is required
     *
     * @return  string
     */ 
    public function getCountry() 
    {
        return $this->country;
    }

    /**
     * Set element is required
     *
     * @param  string  $name  Element is required
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->xml->writeElementCData('name', $name);
        $this->name = $name;

        return $this;
    }

    /**
     * Set element is required
     *
     * @param  string  $addressLine1  Element is required
     *
     * @return  self
     */ 
    public function setAddressLine1(string $addressLine1)
    {
        $this->xml->writeElementCData('addressLine1', $addressLine1);
        $this->addressLine1 = $addressLine1;

        return $this;
    }

    /**
     * Set element is optional
     *
     * @param  string  $addressLine2  Element is optional
     *
     * @return  self
     */ 
    public function setAddressLine2(?string $addressLine2)
    {
        $this->xml->writeElementCData('addressLine2', $addressLine2);
        $this->addressLine2 = $addressLine2;

        return $this;
    }

    /**
     * Set element is optional
     *
     * @param  string  $addressLine3  Element is optional
     *
     * @return  self
     */ 
    public function setAddressLine3(?string $addressLine3)
    {
        $this->xml->writeElementCData('addressLine3', $addressLine3);
        $this->addressLine3 = $addressLine3;

        return $this;
    }

    /**
     * Set element is optional provided there is a postcode
     *
     * @param  string  $town  Element is optional provided there is a postcode
     *
     * @return  self
     */ 
    public function setTown(?string $town)
    {
        $this->xml->writeElementCData('town', $town);
        $this->town = $town;

        return $this;
    }

    /**
     * Set element is optional
     *
     * @param  string  $exactMatch  Element is optional
     *
     * @return  self
     */ 
    public function setExactMatch(?string $exactMatch)
    {
        $this->xml->writeElementCData('exactMatch', $exactMatch);
        $this->exactMatch = $exactMatch;

        return $this;
    }

    /**
     * Set element is optional
     *
     * @param  string  $postcode  Element is optional
     *
     * @return  self
     */ 
    public function setPostcode(?string $postcode)
    {
        $this->xml->writeElementCData('postcode', $postcode);
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Set element is required
     *
     * @param  string  $country  Element is required
     *
     * @return  self
     */ 
    public function setCountry(string $country)
    {
        $this->xml->writeElementCData('country', $country);
        $this->country = $country;

        return $this;
    }

    /**
     * Get element is optional
     *
     * @return  string
     */ 
    public function getProvince() : ?string
    {
        return $this->province;
    }

    /**
     * Set element is optional
     *
     * @param  string  $province  Element is optional
     *
     * @return  self
     */ 
    public function setProvince(?string $province)
    {
        $this->xml->writeElementCData('province', $province);
        $this->province = $province;

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
