<?php

namespace RS\TntExpress\Elements;

use RS\TntExpress\Elements\AbstractXml;
class TotalNumberOfPieces extends AbstractXml {

   
    /**
     * @var int
     * Element is required 
     * - Min 1 
     * - Max 99
     */
    public $totalNumberOfPieces;

    /**
     * Get element is required
     *
     * @return  int
     */ 
    public function getTotalNumberOfPieces()
    {
        return $this->totalNumberOfPieces;
    }

    /**
     * Set element is required
     *
     * @param  int  $totalNumberOfPieces  Element is required
     *
     * @return  self
     */ 
    public function setTotalNumberOfPieces(int $totalNumberOfPieces)
    {
        $this->totalNumberOfPieces = $totalNumberOfPieces;
        $this->xml->writeElementCData('totalNumberOfPieces', $this->totalNumberOfPieces);
        return $this;
    }
}
