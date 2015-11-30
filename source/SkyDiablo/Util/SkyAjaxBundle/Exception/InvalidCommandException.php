<?php

namespace SkyDiablo\Util\SkyAjaxBundle\Exception;

class InvalidCommandException extends \Exception {

    function __construct() {
        parent::__construct('Invalid Command');        
    }


}
