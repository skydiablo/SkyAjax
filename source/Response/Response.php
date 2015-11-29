<?php

namespace SkyDiablo\Util\SkyAjaxBundle\Response;

use Symfony\Component\HttpFoundation\Response AS SymfonyResponse;
use SkyDiablo\Util\SkyAjaxBundle\Response\Plugin\PluginInterface;

/**
 * TODO: eventuell von dieser klasse ableiten:
 *   -> Symfony\Component\HttpFoundation\JsonResponse
 */
class Response extends SymfonyResponse {

    const COMMAND_PART = 'c';
    const COMMAND_PART_PLUGIN_NAME = 'i';
    const COMMAND_PART_PLUGIN_DATA = 'd';

    private $commands = array();

    public function addCommand(PluginInterface $plugin) {
        $this->commands[] = $plugin;
    }
    
    public function addCommands(array $plugins) {
        foreach($plugins AS $plugin) {
            $this->addCommand($plugin);
        }
    }

    public function getCommands() {
        return $this->commands;
    }

    /**
     * Gibt das response als JSON string zurück
     * @return string
     * @throws \SkyDiablo\Util\SkyAjaxBundle\Exception\InvalidCommandException 
     */
    protected function getJSON() {
        $output = array();
        foreach ($this->getCommands() AS $plugin) {
            /* @var $plugin PluginInterface */
            $command = $plugin->getCommand();
            if ($command instanceof \SkyDiablo\Util\SkyAjaxBundle\Entity\Command) {
                $output[self::COMMAND_PART][] = array(
                    self::COMMAND_PART_PLUGIN_NAME => $command->getPluginName(),
                    self::COMMAND_PART_PLUGIN_DATA => $command->getData(), //TODO: sicherstellen dass es json_encode compatible is -> zB UTF8 save?????  ? 
                );
            } else {
                throw new \SkyDiablo\Util\SkyAjaxBundle\Exception\InvalidCommandException();
            }
        }
        return json_encode($output);
    }

    public function prepare(\Symfony\Component\HttpFoundation\Request $request) {
        $this->headers->set('Content-Type', 'application/json', true);
        $this->setContent($this->getJSON());
        parent::prepare($request);
    }

}
