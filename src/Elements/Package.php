<?php

namespace RS\TntExpress\Elements;

use Exception;

class Package {

    /**
     * @var int
     * Element is required
     */
    public $itemNumber;

    /**
     * @var string
     * Element is required
     */
    public $description;

    /**
     * @var float
     * Element is required
     */
    public $width;

    /**
     * @var float
     * Element is required
     */
    public $lenght;

    /**
     * @var float
     * Element is required
     */
    public $height;

    /**
     * @var float
     * Element is required
     */
    public $weight;

    /**
     * @var float
     * Element is required
     */
    public $totalVolume;


    /**
     * Get element is required
     *
     * @return  int
     */ 
    public function getItemNumber()
    {
        return $this->itemNumber;
    }

    /**
     * Set element is required
     *
     * @param  int  $itemNumber  Element is required
     *
     * @return  self
     */ 
    public function setItemNumber(int $itemNumber)
    {
        $this->itemNumber = $itemNumber;

        return $this;
    }

    /**
     * Get element is required
     *
     * @return  string
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set element is required
     *
     * @param  string  $description  Element is required
     *
     * @return  self
     */ 
    public function setDescription(string $description)
    {
        $this->description = $description;

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
     *  - MAX : 1.2 m 
     * @return  self
     */ 
    public function setWidth(float $width)
    {
        if($width <= 1.2) {
            $this->width = $width;
            return $this;
        }else {
            throw new Exception("La longueur du colis ne doit pas dépasser 1.2 mètre, votre longueur est ". $width);    
        }        
    }

    /**
     * Get element is required
     *
     * @return  float
     */ 
    public function getLenght()
    {
        return $this->lenght;
    }

    /**
     * Set element is required
     *
     * @param  float  $lenght  Element is required
     *  - MAX : 2.4 m 
     * @return  self
     */ 
    public function setLenght(float $lenght)
    { 
        if($lenght <= 2.4) {
            $this->lenght = $lenght;
            return $this;
        }else {
            throw new Exception("La largeur du colis ne doit pas dépasser 2.4 mètre, votre largeur est ". $lenght);    
        }
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
     * - $height <= 1.5 m 
     * @return  self
     */ 
    public function setHeight(float $height)
    {
        if($height <= 1.5) {
            $this->height = $height;
            return $this;
        }else {
            throw new Exception("La hauteur du colis ne doit pas dépasser 1.5 mètre, votre hauteur est ". $height);    
        }
      
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
     * - $weight <= 70.0 kg 
     * @return  self
     */ 
    public function setWeight(float $weight)
    {  
        if($weight <= 70.0) {
            $this->weight = $weight;
            return $this;
        }else{
            throw new Exception("Le poids du colis ne doit pas dépasser 70.0 kg , votre poids est ". $weight);    
        }
    }

    /**
     * Get element is required
     *
     * @return  float
     */ 
    public function getTotalVolume()
    {
        return $this->totalVolume;
    }

    /**
     * Set element is required
     *
     * @param  float  $totalVolume  Element is required
     *
     * @return  self
     */ 
    public function setTotalVolume(float $totalVolume)
    {
        $this->totalVolume = $totalVolume;

        return $this;
    }
}