<?php 

namespace RS\TntExpress\Services;

use RS\TntExpress\TntExpress;

class ShipRequest extends TntExpress
{
    protected $login; 

    protected $sender; 

    protected $consignement; 

    protected $activity; 

    protected $url = "https://express.tnt.com/expressconnect/shipping/ship"; 

    public function __construct($userId, $password, $url) {
        if(!is_null($url)){
            $this->url = $url;
        }
        parent::__construct($userId, $password, $this->url);
    }

    

}
