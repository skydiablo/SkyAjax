<?php

namespace SkyDiablo\Util\SkyAjaxBundle\Response\Plugin;

interface PluginInterface {
    
    /**
     * @return \SkyDiablo\Util\SkyAjaxBundle\Entity\Command
     */
    function getCommand();
    
}
