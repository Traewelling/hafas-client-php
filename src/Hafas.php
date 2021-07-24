<?php

namespace HafasClient;

use stdClass;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;

abstract class Hafas {

    /**
     * @throws GuzzleException
     */
    public static function getDepartures(int $lid, Carbon $timestamp, int $maxJourneys = 5): stdClass {
        $data = [
            'req'  => [
                'type'     => 'DEP',
                'stbLoc'   => [
                    'lid' => 'A=1@L=' . $lid . '@',
                ],
                'dirLoc'   => null,
                //[ //direction, not required
                //                'lid' => '',
                //],
                'maxJny'   => $maxJourneys,
                'date'     => $timestamp->format('Ymd'),
                'time'     => $timestamp->format('His'),
                'dur'      => -1,
                'jnyFltrL' => [
                    [
                        'type'  => 'PROD',
                        'mode'  => 'INC',
                        'value' => '1023'
                    ]
                ]
            ],
            'meth' => 'StationBoard'
        ];

        return Request::request($data);
    }

    /**
     * @throws GuzzleException
     */
    public static function getArrivals(int $lid, Carbon $timestamp, int $maxJourneys = 5): stdClass {
        $data = [
            'req'  => [
                'type'     => 'ARR',
                'stbLoc'   => [
                    'lid' => 'A=1@L=' . $lid . '@',
                ],
                'dirLoc'   => null,
                //[ //direction, not required
                //                'lid' => '',
                //],
                'maxJny'   => $maxJourneys,
                'date'     => $timestamp->format('Ymd'),
                'time'     => $timestamp->format('His'),
                'dur'      => -1,
                'jnyFltrL' => [
                    [
                        'type'  => 'PROD',
                        'mode'  => 'INC',
                        'value' => '1023'
                    ]
                ]
            ],
            'meth' => 'StationBoard'
        ];

        return Request::request($data);
    }

}