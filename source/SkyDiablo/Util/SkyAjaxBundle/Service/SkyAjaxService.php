<?php

namespace SkyDiablo\Util\SkyAjaxBundle\Service;

use SkyDiablo\Util\SkyAjaxBundle\Response\Response;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SkyAjaxService {

    /**
     * @var Response
     */
    private $response;
    
    /**
     * @var ContainerInterface
     */
    private $serviceContainer;

    public function __construct(ContainerInterface $serviceContainer) {
        $this->serviceContainer = $serviceContainer;
        $this->response = new Response;
    }

    /**
     * gibt das Ajax Response Object zurück. Dies ist für den
     * ganzen request immer das gleiche und sollte allgemein
     * bevorzugt werden.
     * 
     * @return Response
     */
    public function getResponse() {
        return $this->response;
    }

    /**
     * Gibt zurück ob der aktuelle Request ein Ajax-Request ist
     * @return boolean
     */
    public function isAjaxRequest() {
        return (boolean)$this->getRequest()->isXmlHttpRequest();
    }
    
    /**
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function getRequest() {
        return $this->serviceContainer->get('request');
    }

}
