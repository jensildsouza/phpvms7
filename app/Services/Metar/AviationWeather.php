<?php

namespace App\Services\Metar;

use App\Interfaces\Metar;
use App\Support\Http;

/**
 * Return the raw METAR string from the NOAA Aviation Weather Service
 * @package App\Services\Metar
 */
class AviationWeather extends Metar
{
    private const URL =
        'https://www.aviationweather.gov/adds/dataserver_current/httpparam?'
        .'dataSource=metars&requestType=retrieve&format=xml&hoursBeforeNow=3'
        .'&mostRecent=true&fields=raw_text&stationString=';

    /**
     * Implement the METAR- Return the string
     * @param $icao
     * @return mixed
     */
    public function get($icao)
    {
        $url = static::URL.$icao;
        $res = Http::get($url, []);
        $xml = simplexml_load_string($res);
        return $xml->data->METAR->raw_text;
    }
}
