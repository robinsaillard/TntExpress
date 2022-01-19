<?php

namespace RS\TntExpress\Elements;

use RS\TntExpress\Elements\AbstractXml;
use RS\TntExpress\Elements\PieceMeasurements;

class PieceLine extends AbstractXml{

    /**
     * @var int
     * Element is required 
     */
    private $identifier;

    /**
     * @var string
     * Element is required 
     */
    private $goodsDescription;

   
    /**
     * @var PieceMeasurements
     * Element is required 
     */
    private $pieceMeasurements;


    /**
     * @var array
     * Element is required 
     */
    private $pieces;



    /**
     * Get element is required
     *
     * @return  int
     */ 
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Set element is required
     *
     * @param  int  $identifier  Element is required
     *
     * @return  self
     */ 
    public function setIdentifier(int $identifier)
    {
        $this->identifier = $identifier;
        $this->xml->writeElementCData('identifier', $this->identifier);
        return $this;
    }

    /**
     * Get element is required
     *
     * @return  string
     */ 
    public function getGoodsDescription()
    {
        return $this->goodsDescription;
    }

    /**
     * Set element is required
     *
     * @param  string  $goodsDescription  Element is required
     *
     * @return  self
     */ 
    public function setGoodsDescription(string $goodsDescription)
    {
        $this->goodsDescription = $goodsDescription;
        $this->xml->writeElementCData('goodsDescription', $this->goodsDescription);
        return $this;
    }

    /**
     * Get element is required
     *
     * @return  PieceMeasurements
     */ 
    public function getPieceMeasurements()
    {
        return $this->pieceMeasurements;
    }

    /**
     * Set element is required
     *
     * @param  PieceMeasurements  $pieceMeasurements  Element is required
     *
     * @return  self
     */ 
    public function setPieceMeasurements(PieceMeasurements $pieceMeasurements)
    {
        $this->pieceMeasurements = $pieceMeasurements;
        $this->xml->writeElementCData('pieceMeasurements', $this->pieceMeasurements, false);
        return $this;
    }

    /**
     * Get element is required
     *
     * @return Pieces[]
     */ 
    public function getPieces()
    {
        return $this->pieces;
    }

    /**
     * Set element is required
     *
     * @param Pieces  $pieces  Element is required
     *
     * @return Pieces[]
     */ 
    public function setPieces(Pieces $pieces)
    {
        $this->pieces[] = $pieces;
        $this->xml->writeElementCData('pieces', $this->pieces);
        return $this;
    }
}