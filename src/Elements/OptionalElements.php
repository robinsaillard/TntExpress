<?php

namespace RS\TntExpress\Elements;

use RS\TntExpress\Elements\AbstractXml;

class OptionalElements extends AbstractXml{

    /**
     * @var string
     * Element is optional
     */
    public $bulkShipment;

    /**
     * @var string
     * Element is optional
     */
    public $specialInstructions; 
    
    /**
     * @var string
     * Element is optional
     */
    public $cashAmount; 
    
    /**
     * @var string
     * Element is optional
     */
    public $cashCurrency; 
    
    /**
     * @var string
     * Element is optional
     */
    public $cashType; 
    
    /**
     * @var string
     * Element is optional
     */
    public $customControlled; 

    /**
     * @var string
     * Element is optional
     */
    public $termsOfPayment;    


    /**
     * Get element is optional
     *
     * @return  string
     */ 
    public function getBulkShipment()
    {
        return $this->bulkShipment;
    }

    /**
     * Get element is optional
     *
     * @return  string
     */ 
    public function getSpecialInstructions()
    {
        return $this->specialInstructions;
    }

    /**
     * Get element is optional
     *
     * @return  string
     */ 
    public function getCashAmount()
    {
        return $this->cashAmount;
    }

    /**
     * Get element is optional
     *
     * @return  string
     */ 
    public function getCashCurrency()
    {
        return $this->cashCurrency;
    }

    /**
     * Get element is optional
     *
     * @return  string
     */ 
    public function getCashType()
    {
        return $this->cashType;
    }

    /**
     * Get element is optional
     *
     * @return  string
     */ 
    public function getCustomControlled()
    {
        return $this->customControlled;
    }

    /**
     * Get element is optional
     *
     * @return  string
     */ 
    public function getTermsOfPayment()
    {
        return $this->termsOfPayment;
    }

    /**
     * Set element is optional
     *
     * @param  string  $bulkShipment  Element is optional
     *
     * @return  self
     */ 
    public function setBulkShipment(?string $bulkShipment)
    {
        $this->bulkShipment = $bulkShipment;
        $this->xml->writeElementCData('bulkShipment', $this->bulkShipment);
        return $this;
    }

    /**
     * Set element is optional
     *
     * @param  string  $specialInstructions  Element is optional
     *
     * @return  self
     */ 
    public function setSpecialInstructions(?string $specialInstructions)
    {
        $this->specialInstructions = $specialInstructions;
        $this->xml->writeElementCData('specialInstructions', $this->specialInstructions);
        return $this;
    }

    /**
     * Set element is optional
     *
     * @param  string  $cashAmount  Element is optional
     *
     * @return  self
     */ 
    public function setCashAmount(?string $cashAmount)
    {
        $this->cashAmount = $cashAmount;
        $this->xml->writeElementCData('cashAmount', $this->cashAmount);
        return $this;
    }

    /**
     * Set element is optional
     *
     * @param  string  $cashCurrency  Element is optional
     *
     * @return  self
     */ 
    public function setCashCurrency(?string $cashCurrency)
    {
        $this->cashCurrency = $cashCurrency;
        $this->xml->writeElementCData('cashCurrency', $this->cashCurrency);
        return $this;
    }

    /**
     * Set element is optional
     *
     * @param  string  $cashType  Element is optional
     *
     * @return  self
     */ 
    public function setCashType(?string $cashType)
    {
        $this->cashType = $cashType;
        $this->xml->writeElementCData('cashType', $this->cashType);
        return $this;
    }

    /**
     * Set element is optional
     *
     * @param  string  $customControlled  Element is optional
     *
     * @return  self
     */ 
    public function setCustomControlled(?string $customControlled)
    {
        $this->customControlled = $customControlled;
        $this->xml->writeElementCData('customControlled', $this->customControlled);
        return $this;
    }

    /**
     * Set element is optional
     *
     * @param  string  $termsOfPayment  Element is optional
     *
     * @return  self
     */ 
    public function setTermsOfPayment(?string $termsOfPayment)
    {
        $this->termsOfPayment = $termsOfPayment;
        $this->xml->writeElementCData('termsOfPayment', $this->termsOfPayment);
        return $this;
    }
}