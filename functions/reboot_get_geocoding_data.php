<?php

if (!defined('ABSPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('reboot_get_geocoding_data')) {

    function reboot_get_geocoding_data($lat, $lng)
    {
        if (empty($lat) || empty($lng)) {
            return null;
        }

        // set your API key here
        $api_key = reboot_get_google_map_api_key();
        if (empty($api_key)) {
            return null;
        }

        $language = reboot_get_current_lang();
        if (empty($language)) {
            $language = 'tr';
        }

        // format this string with the appropriate latitude longitude
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' . $lat . ',' . $lng . '&key=' . $api_key . '&sensor=true&language=' . $language;

        // make the HTTP request
        $data = @file_get_contents($url);
        // parse the json response

        $data = json_decode($data, true);


        if (is_array($data) && $data['status'] == 'OK') // this piece of code is looping through each component in ['address_components']
        {
            $result = [];
            $map = [
                'locality' => 'city',
                'administrative_area_level_1' => 'city',
                'administrative_area_level_2' => 'district',
                'administrative_area_level_3' => 'neighborhood',
                'administrative_area_level_4' => 'neighborhood',
            ];

            $map_keys = array_keys($map);

            foreach ($data['results'][0]['address_components'] as $comp) {
                foreach ($comp['types'] as $type) {
                    if(in_array($type, $map_keys) && !isset($result[$map[$type]])) {
                        $result[$map[$type]] = $comp['long_name'];
                    }
                }
            }

            // $result['geocoding'] = $data; // development purposes

            return $result;
        }

        return null;
    }

}

$sample_data = array(
    'address' => 'Güneştepe, Adanır Sk. 3A, 34164 Güngören/İstanbul, Türkiye',
    'lat' => '41.0296188938004',
    'lng' => '28.86282678564453',
    'city' => '',
    'area_level_2' => 'Güngören',
    'geocoding' =>
        array(
            'plus_code' =>
                array(
                    'compound_code' => '2VH7+R4 Avrupa Yakası, İstanbul, Türkiye',
                    'global_code' => '8GHC2VH7+R4',
                ),
            'results' =>
                array(
                    0 =>
                        array(
                            'address_components' =>
                                array(
                                    0 =>
                                        array(
                                            'long_name' => '3A',
                                            'short_name' => '3A',
                                            'types' =>
                                                array(
                                                    0 => 'street_number',
                                                ),
                                        ),
                                    1 =>
                                        array(
                                            'long_name' => 'Adanır Sokak',
                                            'short_name' => 'Adanır Sk.',
                                            'types' =>
                                                array(
                                                    0 => 'route',
                                                ),
                                        ),
                                    2 =>
                                        array(
                                            'long_name' => 'Güneştepe',
                                            'short_name' => 'Güneştepe',
                                            'types' =>
                                                array(
                                                    0 => 'administrative_area_level_4',
                                                    1 => 'political',
                                                ),
                                        ),
                                    3 =>
                                        array(
                                            'long_name' => 'Güngören',
                                            'short_name' => 'Güngören',
                                            'types' =>
                                                array(
                                                    0 => 'administrative_area_level_2',
                                                    1 => 'political',
                                                ),
                                        ),
                                    4 =>
                                        array(
                                            'long_name' => 'İstanbul',
                                            'short_name' => 'İstanbul',
                                            'types' =>
                                                array(
                                                    0 => 'administrative_area_level_1',
                                                    1 => 'political',
                                                ),
                                        ),
                                    5 =>
                                        array(
                                            'long_name' => 'Türkiye',
                                            'short_name' => 'TR',
                                            'types' =>
                                                array(
                                                    0 => 'country',
                                                    1 => 'political',
                                                ),
                                        ),
                                    6 =>
                                        array(
                                            'long_name' => '34164',
                                            'short_name' => '34164',
                                            'types' =>
                                                array(
                                                    0 => 'postal_code',
                                                ),
                                        ),
                                ),
                            'formatted_address' => 'Güneştepe, Adanır Sk. 3A, 34164 Güngören/İstanbul, Türkiye',
                            'geometry' =>
                                array(
                                    'location' =>
                                        array(
                                            'lat' => 41.029558,
                                            'lng' => 28.86282899999999,
                                        ),
                                    'location_type' => 'ROOFTOP',
                                    'viewport' =>
                                        array(
                                            'northeast' =>
                                                array(
                                                    'lat' => 41.0309069802915,
                                                    'lng' => 28.86417798029149,
                                                ),
                                            'southwest' =>
                                                array(
                                                    'lat' => 41.0282090197085,
                                                    'lng' => 28.86148001970849,
                                                ),
                                        ),
                                ),
                            'place_id' => 'ChIJtbLvYNS6yhQR34mSoE3ejkY',
                            'plus_code' =>
                                array(
                                    'compound_code' => '2VH7+R4 Avrupa Yakası, İstanbul, Türkiye',
                                    'global_code' => '8GHC2VH7+R4',
                                ),
                            'types' =>
                                array(
                                    0 => 'street_address',
                                ),
                        ),
                    1 =>
                        array(
                            'address_components' =>
                                array(
                                    0 =>
                                        array(
                                            'long_name' => '5',
                                            'short_name' => '5',
                                            'types' =>
                                                array(
                                                    0 => 'street_number',
                                                ),
                                        ),
                                    1 =>
                                        array(
                                            'long_name' => '4. Sokak',
                                            'short_name' => '4. Sk.',
                                            'types' =>
                                                array(
                                                    0 => 'route',
                                                ),
                                        ),
                                    2 =>
                                        array(
                                            'long_name' => 'Güneştepe',
                                            'short_name' => 'Güneştepe',
                                            'types' =>
                                                array(
                                                    0 => 'administrative_area_level_4',
                                                    1 => 'political',
                                                ),
                                        ),
                                    3 =>
                                        array(
                                            'long_name' => 'Güngören',
                                            'short_name' => 'Güngören',
                                            'types' =>
                                                array(
                                                    0 => 'administrative_area_level_2',
                                                    1 => 'political',
                                                ),
                                        ),
                                    4 =>
                                        array(
                                            'long_name' => 'İstanbul',
                                            'short_name' => 'İstanbul',
                                            'types' =>
                                                array(
                                                    0 => 'administrative_area_level_1',
                                                    1 => 'political',
                                                ),
                                        ),
                                    5 =>
                                        array(
                                            'long_name' => 'Türkiye',
                                            'short_name' => 'TR',
                                            'types' =>
                                                array(
                                                    0 => 'country',
                                                    1 => 'political',
                                                ),
                                        ),
                                    6 =>
                                        array(
                                            'long_name' => '34200',
                                            'short_name' => '34200',
                                            'types' =>
                                                array(
                                                    0 => 'postal_code',
                                                ),
                                        ),
                                ),
                            'formatted_address' => 'Güneştepe, 4. Sk. No:5, 34200 Güngören/İstanbul, Türkiye',
                            'geometry' =>
                                array(
                                    'location' =>
                                        array(
                                            'lat' => 41.0297125,
                                            'lng' => 28.8626087,
                                        ),
                                    'location_type' => 'RANGE_INTERPOLATED',
                                    'viewport' =>
                                        array(
                                            'northeast' =>
                                                array(
                                                    'lat' => 41.03106148029149,
                                                    'lng' => 28.8639576802915,
                                                ),
                                            'southwest' =>
                                                array(
                                                    'lat' => 41.02836351970849,
                                                    'lng' => 28.8612597197085,
                                                ),
                                        ),
                                ),
                            'place_id' => 'EjxHw7xuZcWfdGVwZSwgNC4gU2suIE5vOjUsIDM0MjAwIEfDvG5nw7ZyZW4vxLBzdGFuYnVsLCBUdXJrZXkiGhIYChQKEgnLB-1k1LrKFBE_nqiKayWPgBAF',
                            'types' =>
                                array(
                                    0 => 'street_address',
                                ),
                        ),
                    2 =>
                        array(
                            'address_components' =>
                                array(
                                    0 =>
                                        array(
                                            'long_name' => '3',
                                            'short_name' => '3',
                                            'types' =>
                                                array(
                                                    0 => 'street_number',
                                                ),
                                        ),
                                    1 =>
                                        array(
                                            'long_name' => 'Adanır Sokak',
                                            'short_name' => 'Adanır Sk.',
                                            'types' =>
                                                array(
                                                    0 => 'route',
                                                ),
                                        ),
                                    2 =>
                                        array(
                                            'long_name' => 'Güneştepe',
                                            'short_name' => 'Güneştepe',
                                            'types' =>
                                                array(
                                                    0 => 'administrative_area_level_4',
                                                    1 => 'political',
                                                ),
                                        ),
                                    3 =>
                                        array(
                                            'long_name' => 'Güngören',
                                            'short_name' => 'Güngören',
                                            'types' =>
                                                array(
                                                    0 => 'administrative_area_level_2',
                                                    1 => 'political',
                                                ),
                                        ),
                                    4 =>
                                        array(
                                            'long_name' => 'İstanbul',
                                            'short_name' => 'İstanbul',
                                            'types' =>
                                                array(
                                                    0 => 'administrative_area_level_1',
                                                    1 => 'political',
                                                ),
                                        ),
                                    5 =>
                                        array(
                                            'long_name' => 'Türkiye',
                                            'short_name' => 'TR',
                                            'types' =>
                                                array(
                                                    0 => 'country',
                                                    1 => 'political',
                                                ),
                                        ),
                                    6 =>
                                        array(
                                            'long_name' => '34164',
                                            'short_name' => '34164',
                                            'types' =>
                                                array(
                                                    0 => 'postal_code',
                                                ),
                                        ),
                                ),
                            'formatted_address' => 'Güneştepe, Adanır Sk. No:3, 34164 Güngören/İstanbul, Türkiye',
                            'geometry' =>
                                array(
                                    'bounds' =>
                                        array(
                                            'northeast' =>
                                                array(
                                                    'lat' => 41.0297125,
                                                    'lng' => 28.8627803,
                                                ),
                                            'southwest' =>
                                                array(
                                                    'lat' => 41.02946439999999,
                                                    'lng' => 28.8626087,
                                                ),
                                        ),
                                    'location' =>
                                        array(
                                            'lat' => 41.0295885,
                                            'lng' => 28.8626945,
                                        ),
                                    'location_type' => 'GEOMETRIC_CENTER',
                                    'viewport' =>
                                        array(
                                            'northeast' =>
                                                array(
                                                    'lat' => 41.03093743029149,
                                                    'lng' => 28.8640434802915,
                                                ),
                                            'southwest' =>
                                                array(
                                                    'lat' => 41.0282394697085,
                                                    'lng' => 28.8613455197085,
                                                ),
                                        ),
                                ),
                            'place_id' => 'ChIJ7btGYNS6yhQRFsJishw6YKM',
                            'types' =>
                                array(
                                    0 => 'route',
                                ),
                        ),
                    3 =>
                        array(
                            'address_components' =>
                                array(
                                    0 =>
                                        array(
                                            'long_name' => '34164',
                                            'short_name' => '34164',
                                            'types' =>
                                                array(
                                                    0 => 'postal_code',
                                                ),
                                        ),
                                    1 =>
                                        array(
                                            'long_name' => 'Güneştepe',
                                            'short_name' => 'Güneştepe',
                                            'types' =>
                                                array(
                                                    0 => 'administrative_area_level_4',
                                                    1 => 'political',
                                                ),
                                        ),
                                    2 =>
                                        array(
                                            'long_name' => 'Güngören',
                                            'short_name' => 'Güngören',
                                            'types' =>
                                                array(
                                                    0 => 'administrative_area_level_2',
                                                    1 => 'political',
                                                ),
                                        ),
                                    3 =>
                                        array(
                                            'long_name' => 'İstanbul',
                                            'short_name' => 'İstanbul',
                                            'types' =>
                                                array(
                                                    0 => 'administrative_area_level_1',
                                                    1 => 'political',
                                                ),
                                        ),
                                    4 =>
                                        array(
                                            'long_name' => 'Türkiye',
                                            'short_name' => 'TR',
                                            'types' =>
                                                array(
                                                    0 => 'country',
                                                    1 => 'political',
                                                ),
                                        ),
                                ),
                            'formatted_address' => 'Güneştepe, 34164 Güngören/İstanbul, Türkiye',
                            'geometry' =>
                                array(
                                    'bounds' =>
                                        array(
                                            'northeast' =>
                                                array(
                                                    'lat' => 41.029976,
                                                    'lng' => 28.872537,
                                                ),
                                            'southwest' =>
                                                array(
                                                    'lat' => 41.02025099999999,
                                                    'lng' => 28.858493,
                                                ),
                                        ),
                                    'location' =>
                                        array(
                                            'lat' => 41.0268068,
                                            'lng' => 28.8640496,
                                        ),
                                    'location_type' => 'APPROXIMATE',
                                    'viewport' =>
                                        array(
                                            'northeast' =>
                                                array(
                                                    'lat' => 41.029976,
                                                    'lng' => 28.872537,
                                                ),
                                            'southwest' =>
                                                array(
                                                    'lat' => 41.02025099999999,
                                                    'lng' => 28.858493,
                                                ),
                                        ),
                                ),
                            'place_id' => 'ChIJ9_qA_ym7yhQROuymIyLJ7t0',
                            'types' =>
                                array(
                                    0 => 'postal_code',
                                ),
                        ),
                    4 =>
                        array(
                            'address_components' =>
                                array(
                                    0 =>
                                        array(
                                            'long_name' => 'Güneştepe',
                                            'short_name' => 'Güneştepe',
                                            'types' =>
                                                array(
                                                    0 => 'administrative_area_level_4',
                                                    1 => 'political',
                                                ),
                                        ),
                                    1 =>
                                        array(
                                            'long_name' => 'Güngören',
                                            'short_name' => 'Güngören',
                                            'types' =>
                                                array(
                                                    0 => 'administrative_area_level_2',
                                                    1 => 'political',
                                                ),
                                        ),
                                    2 =>
                                        array(
                                            'long_name' => 'İstanbul',
                                            'short_name' => 'İstanbul',
                                            'types' =>
                                                array(
                                                    0 => 'administrative_area_level_1',
                                                    1 => 'political',
                                                ),
                                        ),
                                    3 =>
                                        array(
                                            'long_name' => 'Türkiye',
                                            'short_name' => 'TR',
                                            'types' =>
                                                array(
                                                    0 => 'country',
                                                    1 => 'political',
                                                ),
                                        ),
                                ),
                            'formatted_address' => 'Güneştepe, Güngören/İstanbul, Türkiye',
                            'geometry' =>
                                array(
                                    'bounds' =>
                                        array(
                                            'northeast' =>
                                                array(
                                                    'lat' => 41.0300281,
                                                    'lng' => 28.872537,
                                                ),
                                            'southwest' =>
                                                array(
                                                    'lat' => 41.02025099999999,
                                                    'lng' => 28.858493,
                                                ),
                                        ),
                                    'location' =>
                                        array(
                                            'lat' => 41.0268068,
                                            'lng' => 28.8640496,
                                        ),
                                    'location_type' => 'APPROXIMATE',
                                    'viewport' =>
                                        array(
                                            'northeast' =>
                                                array(
                                                    'lat' => 41.0300281,
                                                    'lng' => 28.872537,
                                                ),
                                            'southwest' =>
                                                array(
                                                    'lat' => 41.02025099999999,
                                                    'lng' => 28.858493,
                                                ),
                                        ),
                                ),
                            'place_id' => 'ChIJTXiI_ym7yhQRVPskn6tX1sE',
                            'types' =>
                                array(
                                    0 => 'administrative_area_level_4',
                                    1 => 'political',
                                ),
                        ),
                    5 =>
                        array(
                            'address_components' =>
                                array(
                                    0 =>
                                        array(
                                            'long_name' => 'Güngören',
                                            'short_name' => 'Güngören',
                                            'types' =>
                                                array(
                                                    0 => 'administrative_area_level_2',
                                                    1 => 'political',
                                                ),
                                        ),
                                    1 =>
                                        array(
                                            'long_name' => 'İstanbul',
                                            'short_name' => 'İstanbul',
                                            'types' =>
                                                array(
                                                    0 => 'administrative_area_level_1',
                                                    1 => 'political',
                                                ),
                                        ),
                                    2 =>
                                        array(
                                            'long_name' => 'Türkiye',
                                            'short_name' => 'TR',
                                            'types' =>
                                                array(
                                                    0 => 'country',
                                                    1 => 'political',
                                                ),
                                        ),
                                ),
                            'formatted_address' => 'Güngören/İstanbul, Türkiye',
                            'geometry' =>
                                array(
                                    'bounds' =>
                                        array(
                                            'northeast' =>
                                                array(
                                                    'lat' => 41.0385491,
                                                    'lng' => 28.90082289999999,
                                                ),
                                            'southwest' =>
                                                array(
                                                    'lat' => 41.001386,
                                                    'lng' => 28.858493,
                                                ),
                                        ),
                                    'location' =>
                                        array(
                                            'lat' => 41.020546,
                                            'lng' => 28.874244,
                                        ),
                                    'location_type' => 'APPROXIMATE',
                                    'viewport' =>
                                        array(
                                            'northeast' =>
                                                array(
                                                    'lat' => 41.0385491,
                                                    'lng' => 28.90082289999999,
                                                ),
                                            'southwest' =>
                                                array(
                                                    'lat' => 41.001386,
                                                    'lng' => 28.858493,
                                                ),
                                        ),
                                ),
                            'place_id' => 'ChIJucH_8yC7yhQRuJSIHq9T080',
                            'types' =>
                                array(
                                    0 => 'administrative_area_level_2',
                                    1 => 'political',
                                ),
                        ),
                    6 =>
                        array(
                            'address_components' =>
                                array(
                                    0 =>
                                        array(
                                            'long_name' => 'Avrupa Yakası',
                                            'short_name' => 'Avrupa Yakası',
                                            'types' =>
                                                array(
                                                    0 => 'neighborhood',
                                                    1 => 'political',
                                                ),
                                        ),
                                    1 =>
                                        array(
                                            'long_name' => 'İstanbul',
                                            'short_name' => 'İstanbul',
                                            'types' =>
                                                array(
                                                    0 => 'administrative_area_level_1',
                                                    1 => 'political',
                                                ),
                                        ),
                                    2 =>
                                        array(
                                            'long_name' => 'Türkiye',
                                            'short_name' => 'TR',
                                            'types' =>
                                                array(
                                                    0 => 'country',
                                                    1 => 'political',
                                                ),
                                        ),
                                ),
                            'formatted_address' => 'Avrupa Yakası, İstanbul, Türkiye',
                            'geometry' =>
                                array(
                                    'bounds' =>
                                        array(
                                            'northeast' =>
                                                array(
                                                    'lat' => 41.199239,
                                                    'lng' => 29.077487,
                                                ),
                                            'southwest' =>
                                                array(
                                                    'lat' => 40.954508,
                                                    'lng' => 28.595554,
                                                ),
                                        ),
                                    'location' =>
                                        array(
                                            'lat' => 41.0286909,
                                            'lng' => 28.92404269999999,
                                        ),
                                    'location_type' => 'APPROXIMATE',
                                    'viewport' =>
                                        array(
                                            'northeast' =>
                                                array(
                                                    'lat' => 41.199239,
                                                    'lng' => 29.077487,
                                                ),
                                            'southwest' =>
                                                array(
                                                    'lat' => 40.954508,
                                                    'lng' => 28.595554,
                                                ),
                                        ),
                                ),
                            'place_id' => 'ChIJhTq6hpGkyhQRC5OjsPQ0MVY',
                            'types' =>
                                array(
                                    0 => 'neighborhood',
                                    1 => 'political',
                                ),
                        ),
                    7 =>
                        array(
                            'address_components' =>
                                array(
                                    0 =>
                                        array(
                                            'long_name' => 'İstanbul',
                                            'short_name' => 'İstanbul',
                                            'types' =>
                                                array(
                                                    0 => 'locality',
                                                    1 => 'political',
                                                ),
                                        ),
                                    1 =>
                                        array(
                                            'long_name' => 'İstanbul',
                                            'short_name' => 'İstanbul',
                                            'types' =>
                                                array(
                                                    0 => 'administrative_area_level_1',
                                                    1 => 'political',
                                                ),
                                        ),
                                    2 =>
                                        array(
                                            'long_name' => 'Türkiye',
                                            'short_name' => 'TR',
                                            'types' =>
                                                array(
                                                    0 => 'country',
                                                    1 => 'political',
                                                ),
                                        ),
                                ),
                            'formatted_address' => 'İstanbul, Türkiye',
                            'geometry' =>
                                array(
                                    'bounds' =>
                                        array(
                                            'northeast' =>
                                                array(
                                                    'lat' => 41.199239,
                                                    'lng' => 29.4288049,
                                                ),
                                            'southwest' =>
                                                array(
                                                    'lat' => 40.811404,
                                                    'lng' => 28.595554,
                                                ),
                                        ),
                                    'location' =>
                                        array(
                                            'lat' => 41.0082376,
                                            'lng' => 28.9783589,
                                        ),
                                    'location_type' => 'APPROXIMATE',
                                    'viewport' =>
                                        array(
                                            'northeast' =>
                                                array(
                                                    'lat' => 41.199239,
                                                    'lng' => 29.4288049,
                                                ),
                                            'southwest' =>
                                                array(
                                                    'lat' => 40.811404,
                                                    'lng' => 28.595554,
                                                ),
                                        ),
                                ),
                            'place_id' => 'ChIJawhoAASnyhQR0LABvJj-zOE',
                            'types' =>
                                array(
                                    0 => 'locality',
                                    1 => 'political',
                                ),
                        ),
                    8 =>
                        array(
                            'address_components' =>
                                array(
                                    0 =>
                                        array(
                                            'long_name' => 'İstanbul',
                                            'short_name' => 'İstanbul',
                                            'types' =>
                                                array(
                                                    0 => 'administrative_area_level_1',
                                                    1 => 'political',
                                                ),
                                        ),
                                    1 =>
                                        array(
                                            'long_name' => 'Türkiye',
                                            'short_name' => 'TR',
                                            'types' =>
                                                array(
                                                    0 => 'country',
                                                    1 => 'political',
                                                ),
                                        ),
                                ),
                            'formatted_address' => 'İstanbul, Türkiye',
                            'geometry' =>
                                array(
                                    'bounds' =>
                                        array(
                                            'northeast' =>
                                                array(
                                                    'lat' => 41.58461,
                                                    'lng' => 29.915705,
                                                ),
                                            'southwest' =>
                                                array(
                                                    'lat' => 40.8026889,
                                                    'lng' => 27.971373,
                                                ),
                                        ),
                                    'location' =>
                                        array(
                                            'lat' => 41.1634302,
                                            'lng' => 28.7664408,
                                        ),
                                    'location_type' => 'APPROXIMATE',
                                    'viewport' =>
                                        array(
                                            'northeast' =>
                                                array(
                                                    'lat' => 41.58461,
                                                    'lng' => 29.915705,
                                                ),
                                            'southwest' =>
                                                array(
                                                    'lat' => 40.8026889,
                                                    'lng' => 27.971373,
                                                ),
                                        ),
                                ),
                            'place_id' => 'ChIJexVgWlG2yhQR6B1akfSarCI',
                            'types' =>
                                array(
                                    0 => 'administrative_area_level_1',
                                    1 => 'political',
                                ),
                        ),
                    9 =>
                        array(
                            'address_components' =>
                                array(
                                    0 =>
                                        array(
                                            'long_name' => 'Türkiye',
                                            'short_name' => 'TR',
                                            'types' =>
                                                array(
                                                    0 => 'country',
                                                    1 => 'political',
                                                ),
                                        ),
                                ),
                            'formatted_address' => 'Türkiye',
                            'geometry' =>
                                array(
                                    'bounds' =>
                                        array(
                                            'northeast' =>
                                                array(
                                                    'lat' => 42.3666999,
                                                    'lng' => 44.8178449,
                                                ),
                                            'southwest' =>
                                                array(
                                                    'lat' => 35.808592,
                                                    'lng' => 25.5377,
                                                ),
                                        ),
                                    'location' =>
                                        array(
                                            'lat' => 38.963745,
                                            'lng' => 35.243322,
                                        ),
                                    'location_type' => 'APPROXIMATE',
                                    'viewport' =>
                                        array(
                                            'northeast' =>
                                                array(
                                                    'lat' => 42.3666999,
                                                    'lng' => 44.8178449,
                                                ),
                                            'southwest' =>
                                                array(
                                                    'lat' => 35.808592,
                                                    'lng' => 25.5377,
                                                ),
                                        ),
                                ),
                            'place_id' => 'ChIJcSZPllwVsBQRKl9iKtTb2UA',
                            'types' =>
                                array(
                                    0 => 'country',
                                    1 => 'political',
                                ),
                        ),
                ),
            'status' => 'OK',
        ),
);