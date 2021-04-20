<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Trains controller
 *
 * This controller will render views from templates/Trains/
 *
 */
class TrainsController extends AppController
{
    /**
     * Displays the index view for the trains controller
     *
     */
    public function index()
    {

    }

    /**
     * Returns a response to the message inputted by the user
     *
     */
    public function checkMessage()
    {
        if ($this->request->is('ajax')) {
            $this->loadComponent('IrishRail');
            $this->loadComponent('Parser');

            $message = trim(strtolower($this->request->getData('message')));

            $xml = $this->IrishRail->getTrainStations();
            $stations = $this->Parser->parseTrainStations($xml);

            if (stripos($message, 'train stations') !== false) {
                $this->set(['message' => implode('<br/>', $stations)]);
            } elseif ($station = array_intersect(explode(' ', $message), array_map('strtolower', $stations))) {
                $xml = $this->IrishRail->getTrainStationTimes(reset($station));
                if ($xml) {
                    $times = $this->Parser->parseTrainTimes($xml);
                    $this->set(['message' => "Next train times:<br/>" . implode('<br/>', $times)]);
                } else {
                    $this->set(['message' => "No train times available"]);
                }
            } else {
                $this->set(['message' => "Sorry, I don't know how to answer that"]);
            }
        }
    }
}
