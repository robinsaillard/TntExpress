<?php

namespace RS\TntExpress\Elements;
class TotalNumberOfPieces {

   
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
        return $this;
    }
}
