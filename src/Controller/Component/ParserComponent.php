<?php

namespace App\Controller\Component;

use Cake\Collection\Collection;
use Cake\Controller\Component;

class ParserComponent extends Component
{
    /**
     * Parses an XML object into a list of train stations
     *
     * @param SimpleXMLElement $xml
     * @return array An array of train stations by name
     */
    public function parseTrainStations(\SimpleXMLElement $xml): array
    {
        $trainStations = [];

        foreach ($xml as $key => $value) {
            $trainStations[] = (string) $value->StationDesc;
        }

        return $trainStations;
    }

    /**
     * Retrieves the next two train times for the DART train type
     *
     * @param SimpleXMLElement $xml
     * @return array An array of ascending train times
     */
    public function parseTrainTimes(\SimpleXMLElement $xml): array
    {
        $trainTimes = [];

        foreach ($xml as $key => $value) {
            if ($value->Traintype == 'DART') {
                $trainTimes[] = (string) $value->Exparrival;
            }
        }

        sort($trainTimes);

        return array_slice($trainTimes, 0, 2);
    }
}
