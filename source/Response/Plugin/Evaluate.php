<?php

namespace SkyDiablo\Util\SkyAjaxBundle\Response\Plugin;

use SkyDiablo\Util\SkyAjaxBundle\Entity\Command;

class Evaluate implements PluginInterface {
    
    CONST PLUGIN_NAME = 'Eval';

    private $command;

    public function __construct($src = '') {
        $this->command = new Command(self::PLUGIN_NAME);
        $this->setSource($src);
    }

    public function getCommand() {
        return $this->command;
    }

    public function getSource() {
        return $this->getCommand()->getData();
    }

    public function setSource($src) {
        $this->getCommand()->setData($src);
    }

}
