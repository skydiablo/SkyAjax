<?php

namespace SkyDiablo\Util\SkyAjaxBundle\Entity;

class Command {

    private $pluginName;
    private $data;

    function __construct($pluginName = null) {
        if ($pluginName) {
            $this->setPluginName($pluginName);
        }
    }

    public function getPluginName() {
        return $this->pluginName;
    }

    public function setPluginName($pluginName) {
        $this->pluginName = (string)$pluginName;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

}
