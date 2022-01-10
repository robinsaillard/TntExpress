<?php

namespace RS\TntExpress\Elements;

use RS\TntExpress\Elements\AbstractXml;

class PieceMeasurements extends AbstractXml{

    /**
     * @var float
     * Element is required 
     */
    private $length;

    /**
     * @var float
     * Element is required 
     */
    private $width;

    /**
     * @var float
     * Element is required 
     */
    private $height;

    /**
     * @var float
     * Element is required 
     */
    private $weight;

    
    public function __construct(float $length, float $width, float $height, float $weight) {
        $this->length = $length;
        $this->width = $width;
        $this->height = $height;
        $this->weight = $weight;
    }


    /**
     * Get element is required
     *
     * @return  float
     */ 
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set element is required
     *
     * @param  float  $length  Element is required
     *
     * @return  self
     */ 
    public function setLength(float $length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get element is required
     *
     * @return  float
     */ 
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set element is required
     *
     * @param  float  $width  Element is required
     *
     * @return  self
     */ 
    public function setWidth(float $width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get element is required
     *
     * @return  float
     */ 
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set element is required
     *
     * @param  float  $height  Element is required
     *
     * @return  self
     */ 
    public function setHeight(float $height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get element is required
     *
     * @return  float
     */ 
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set element is required
     *
     * @param  float  $weight  Element is required
     *
     * @return  self
     */ 
    public function setWeight(float $weight)
    {
        $this->weight = $weight;

        return $this;
    }
}