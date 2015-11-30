<?php

namespace SkyDiablo\Util\SkyAjaxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

abstract class SkyAjaxController extends Controller {

    /**
     * @return \SkyDiablo\Util\SkyAjaxBundle\Service\SkyAjaxService;
     */
    protected function getSkyAjax() {
        return $this->get('SkyDiablo.Util.SkyAjax');
    }

}
