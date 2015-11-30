<?php

namespace SkyDiablo\Util\SkyAjaxBundle\EventListener;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Description of AjaxMethodListener
 *
 * @author skydiablo
 */
class AjaxMethodListener {
    
    public function onKernelRequest(GetResponseEvent $event) {
        /* @var $request \Symfony\Component\HttpFoundation\Request */
        $request = $event->getRequest();
        if($request->isXmlHttpRequest()) {
            $request->setMethod('AJAX');
        }
        
    }

}

?>
