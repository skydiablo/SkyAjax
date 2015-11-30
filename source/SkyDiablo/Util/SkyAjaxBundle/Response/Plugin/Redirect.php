<?php

namespace SkyDiablo\Util\SkyAjaxBundle\Response\Plugin;

use SkyDiablo\Util\SkyAjaxBundle\Entity\Command;

class Redirect implements PluginInterface {
    
    CONST PLUGIN_NAME = 'Redirect';

    private $command;

    public function __construct($url) {
        $this->command = new Command(self::PLUGIN_NAME);
        $this->setURL($url);
    }

    public function getCommand() {
        return $this->command;
    }

    public function getURL() {
        return $this->getCommand()->getData();
    }

    public function setURL($url) {
        $this->getCommand()->setData($url);
    }

}
