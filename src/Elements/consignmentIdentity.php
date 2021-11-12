<?php

namespace RS\TntExpress\Elements;

use RS\TntExpress\Elements\AbstractXml;

class consignmentIdentity extends AbstractXml{

    /**
     * @var string
     * Element is required
     */
    public $consignmentNumber;

    /**
     * @var string
     * Element is required
     */
    public $customerReference; 


    /**
     * Get element is required
     *
     * @return  string
     */ 
    public function getConsignmentNumber()
    {
        return $this->consignmentNumber;
    }

    /**
     * Get element is required
     *
     * @return  string
     */ 
    public function getCustomerReference()
    {
        return $this->customerReference;
    }

    /**
     * Set element is required
     *
     * @param  string  $consignmentNumber  Element is required
     *
     * @return  self
     */ 
    public function setConsignmentNumber(string $consignmentNumber)
    {
        $this->consignmentNumber = $consignmentNumber;

        return $this;
    }

    /**
     * Set element is required
     *
     * @param  string  $customerReference  Element is required
     *
     * @return  self
     */ 
    public function setCustomerReference(string $customerReference)
    {
        $this->customerReference = $customerReference;

        return $this;
    }
}