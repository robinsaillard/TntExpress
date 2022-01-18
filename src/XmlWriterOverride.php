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
            $state = $this->writeCdata($content) . "\n";
        $this->endElement();
                
        return $state;
    }

    // public function writeArrayElements(string $parent, array $array){
    //     $state = "";
    //     $this->startElement($parent);
    //         foreach ($array as $name => $content) {
    //             $this->startElement($name);
    //             $state .= $this->writeCdata($content) . "\n";
    //             $this->endElement();
    //         }
    //     $this->endElement();
    //     return $state;
    // }
}