<?php


namespace App\Service\Etiquette\Tnt\Inter\Entity;

use App\Service\Etiquette\Tnt\Inter\XmlWriterOverride;

abstract class AbstractXml
{
    protected $xml;
 
    public function __construct()
    {
        
        $this->xml = new XmlWriterOverride();
        $this->xml->openMemory();
        $this->xml->setIndent(true);
    }
    
    public function __destruct()
    {
    
        $this->xml->flush();
    }
    
    public function getAsXml()
    {
        
        return trim($this->xml->flush(false));
    }    
}