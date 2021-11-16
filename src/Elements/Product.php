<?php

namespace RS\TntExpress\Elements;

use RS\TntExpress\Elements\AbstractXml;
class Product extends AbstractXml {

    /**
     * @var string
     * Element is required
     */
    public $lineOfBusiness; 

    /**
     * @var string
     * Element is required
     */
    public $groupId;

    /**
     * @var string
     * Element is required
     */
    public $subGroupId; 

    /**
     * @var string
     * Element is required
     */
    public $type; 

    /**
     * @var string
     * Element is optional
     */
    public $option;   
    

    /**
     * Get element is required
     *
     * @return  string
     */ 
    public function getLineOfBusiness()
    {
        return $this->lineOfBusiness;
    }

    /**
     * Get element is required
     *
     * @return  string
     */ 
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * Get element is required
     *
     * @return  string
     */ 
    public function getSubGroupId()
    {
        return $this->subGroupId;
    }

    /**
     * Get element is required
     *
     * @return  string
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get element is optional
     *
     * @return  string
     */ 
    public function getOption()
    {
        return $this->option;
    }

    /**
     * Set element is required
     *
     * @param  string  $lineOfBusiness  Element is required
     *
     * @return  self
     */ 
    public function setLineOfBusiness(string $lineOfBusiness)
    {
        $this->lineOfBusiness = $lineOfBusiness;

        return $this;
    }

    /**
     * Set element is required
     *
     * @param  string  $groupId  Element is required
     *
     * @return  self
     */ 
    public function setGroupId(string $groupId)
    {
        $this->groupId = $groupId;

        return $this;
    }

    /**
     * Set element is required
     *
     * @param  string  $subGroupId  Element is required
     *
     * @return  self
     */ 
    public function setSubGroupId(string $subGroupId)
    {
        $this->subGroupId = $subGroupId;

        return $this;
    }

    /**
     * Set element is required
     *
     * @param  string  $type  Element is required
     *
     * @return  self
     */ 
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Set element is optional
     *
     * @param  string  $option  Element is optional
     *
     * @return  self
     */ 
    public function setOption(?string $option)
    {
        $this->option = $option;

        return $this;
    }
}