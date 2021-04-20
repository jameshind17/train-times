<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Http\Client;

class IrishRailComponent extends Component
{
    /**
     * Gets a list of DART train stations from the Irish Rail API
     *
     * @return SimpleXMLElement a list of train stations
     */
    public function getTrainStations(): \SimpleXMLElement
    {
        $http = new Client();

        $response = $http->get('http://api.irishrail.ie/realtime/realtime.asmx/getAllStationsXML_WithStationType?StationType=D');

        return $response->getXml();
    }

    /**
     * Gets a list of train times for the specified station from the Irish Rail API
     *
     * @param string a train station
     * @return SimpleXMLElement a list of train times
     */
    public function getTrainStationTimes(string $station): \SimpleXMLElement
    {
        $http = new Client();

        $response = $http->get('http://api.irishrail.ie/realtime/realtime.asmx/getStationDataByNameXML?StationDesc=' . $station);

        return $response->getXml();
    }
}
