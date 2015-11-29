<?php

namespace SkyDiablo\Util\SkyAjaxBundle\Response\Plugin;

use SkyDiablo\Util\SkyAjaxBundle\Entity\Command;

class Alert implements PluginInterface {
    
    CONST PLUGIN_NAME = 'Alert';

    private $command;

    public function __construct($text) {
        $this->command = new Command(self::PLUGIN_NAME);
        $this->setText($text);
    }

    public function getCommand() {
        return $this->command;
    }

    public function getText() {
        return $this->getCommand()->getData();
    }

    public function setText($text) {
        $this->getCommand()->setData($text);
    }

}
