<?php

namespace SkyDiablo\Util\SkyAjaxBundle\Response\Plugin;

use SkyDiablo\Util\SkyAjaxBundle\Entity\Command;

class Assign implements PluginInterface {
    
    CONST PLUGIN_NAME = 'Assign';

    private $command;

    public function __construct($query = '', $value = '') {
        $this->command = new Command(self::PLUGIN_NAME);
        $this->setQuery($query);
        $this->setValue($value);
    }

    public function getCommand() {
        return $this->command;
    }

    public function getQuery() {
        $data = $this->getCommand()->getData();
        return $data['query'];
    }

    public function setQuery($query) {
        $data = $this->getCommand()->getData();
        $data['query'] = $query;
        $this->getCommand()->setData($data);
    }
    
    public function getValue() {
        $data = $this->getCommand()->getData();
        return $data['value'];
    }

    public function setValue($value) {
        $data = $this->getCommand()->getData();
        $data['value'] = $value;
        $this->getCommand()->setData($data);
    }

}
