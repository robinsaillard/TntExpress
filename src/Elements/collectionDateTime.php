<?php

namespace App\Service\Etiquette\Tnt\Inter\Entity;

use App\Service\Etiquette\Tnt\Inter\Entity\AbstractXml;
use DateTime;

class consignmentIdentity extends AbstractXml {

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
     * @param  string  $collectionDateTime  Element is required
     *
     * @return  self
     */ 
    public function setCollectionDateTime(?DateTime $collectionDateTime)
    {
        $datetime = new DateTime(); 
        if (is_null($collectionDateTime)) {
            $this->collectionDateTime = $datetime->format('Y-m-dTH:i:s');
        }else {
            $this->collectionDateTime = $collectionDateTime->format('Y-m-dTH:i:s');
        }
        return $this;
    }
}