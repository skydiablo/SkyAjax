<?php

namespace SkyDiablo\Util\SkyAjaxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SkyDiablo\Util\SkyAjaxBundle\Controller\Traits\SkyAjaxControllerTrait;

abstract class SkyAjaxController extends Controller {
    use SkyAjaxControllerTrait;
}
