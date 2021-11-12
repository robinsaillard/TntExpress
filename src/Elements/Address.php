<?php

namespace App\Service\Etiquette\Tnt\Inter\Entity;

use App\Service\Etiquette\Tnt\Inter\Entity\AbstractXml;

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
    public $postcode; 

    /**
     * @var string
     * Element is required
     */
    public $country; 

    
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
    public function getAddressLine2()
    {
        return $this->addressLine2;
    }

    /**
     * Get element is optional
     *
     * @return  string
     */ 
    public function getAddressLine3()
    {
        return $this->addressLine3;
    }

    /**
     * Get element is optional provided there is a postcode
     *
     * @return  string
     */ 
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Get element is optional
     *
     * @return  string
     */ 
    public function getExactMatch()
    {
        return $this->exactMatch;
    }

    /**
     * Get element is optional
     *
     * @return  string
     */ 
    public function getPostcode()
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
    public function setAddressLine2(string $addressLine2)
    {
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
    public function setAddressLine3(string $addressLine3)
    {
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
    public function setTown(string $town)
    {
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
    public function setExactMatch(string $exactMatch)
    {
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
    public function setPostcode(string $postcode)
    {
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
        $this->country = $country;

        return $this;
    }
}
