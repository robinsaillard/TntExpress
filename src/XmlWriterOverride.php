<?php 

namespace RS\TntExpress;

use XMLWriter;

class XmlWriterOverride extends XMLWriter
{
    
    public function writeElementCData($name, $content = null, $wrap = true)
    {
                
        if ($wrap === false) {
            return $this->writeElement($name, $content);
        }
        
        $this->startElement($name);
            $state = $this->writeCdata($content);
        $this->endElement();
                
        return $state;
    }
}