<?php

namespace RS\TntExpress\Elements;

use RS\TntExpress\Elements\AbstractXml;
use RS\TntExpress\Elements\PieceMeasurements;

class PieceLine extends AbstractXml{

    /**
     * @var int
     * Element is required 
     * - Min 1 
     * - Max 99
     */
    private $totalNumberOfPieces;

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


}