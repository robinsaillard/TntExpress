<?php

namespace RS\TntExpress\Elements;

use DateTime;
use RS\TntExpress\Elements\AbstractXml;

class CollectionDateTime extends AbstractXml {

    /**
     * @var string
     * Element is required
     */
    public $collectionDateTime; 

    

    /**
     * Get element is required
     *
     * @return  string
     */ 
    public function getCollectionDateTime()
    {
        return $this->collectionDateTime;
    }

    /**
     * Set element is required
     *
     * @param  DateTime $collectionDateTime  Element is required
     *
     * @return  self
     */ 
    public function setCollectionDateTime(?DateTime $collectionDateTime)
    {
        $datetime = new DateTime(); 
        if (is_null($collectionDateTime)) {
            $this->collectionDateTime = $datetime->format('Y-m-dTH:i:s');
            $this->xml->writeElementCData('collectionDateTime', $this->collectionDateTime);
        }else {
            $this->collectionDateTime = $collectionDateTime->format('Y-m-dTH:i:s');
            $this->xml->writeElementCData('collectionDateTime', $this->collectionDateTime);
        }
        return $this;
    }

    
}