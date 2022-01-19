<?php

namespace RS\TntExpress\Elements;

use RS\TntExpress\Elements\AbstractXml;
class Pieces extends AbstractXml {

    /**
     * @var array|string
     * Element is required
     */
    public $sequenceNumbers;

    /**
     * @var string
     * Element is required
     */
    public $pieceReference;


    /**
     * Get element is required
     *
     * @return  array|string
     */ 
    public function getSequenceNumbers()
    {
        return $this->sequenceNumbers;
    }

    /**
     * Set element is required
     *
     * @param  array|string  $sequenceNumbers  Element is required
     *
     * @return  self
     */ 
    public function setSequenceNumbers($sequenceNumbers)
    {     
        if (is_array($sequenceNumbers)) {
            $this->sequenceNumbers = implode(",",$sequenceNumbers);
        }else {
            $this->sequenceNumbers = $sequenceNumbers;
        }
        $this->xml->writeElementCData('sequenceNumbers', $this->sequenceNumbers);
        return $this;
    }

    /**
     * Get element is required
     *
     * @return  string
     */ 
    public function getPieceReference()
    {
        return $this->pieceReference;
    }

    /**
     * Set element is required
     *
     * @param  string  $pieceReference  Element is required
     *
     * @return  self
     */ 
    public function setPieceReference(string $pieceReference)
    {
        $this->pieceReference = $pieceReference;
        $this->xml->writeElementCData('pieceReference', $this->pieceReference);
        return $this;
    }
}