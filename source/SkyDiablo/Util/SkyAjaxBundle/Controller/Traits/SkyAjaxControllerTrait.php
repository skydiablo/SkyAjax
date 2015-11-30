<?php

namespace SkyDiablo\Util\SkyAjaxBundle\Controller\Traits;

trait SkyAjaxControllerTrait {

    /**
     * @return \SkyDiablo\Util\SkyAjaxBundle\Service\SkyAjaxService;
     */
    protected function getSkyAjax() {
        return $this->get('SkyDiablo.Util.SkyAjax');
    }
}
