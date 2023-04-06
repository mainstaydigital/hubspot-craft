<?php

use HubSpot\Factory;
use HubSpot\Client\Crm\Contacts\ApiException;

function listContacts()
{
    $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
    $client = Factory::createWithAccessToken('pat-na1-d4510998-72ca-4578-ac83-03cc3fb95c5c', $guzzleClient);

    try {
        $apiResponse = $client->crm()->contacts()->basicApi()->getPage(10, null, null, null, null, false);
        echo  json_encode($apiResponse);
        return $apiResponse;
        // var_dump($apiResponse);
    } catch (ApiException $e) {
        echo "Exception when calling basic_api->get_page: ", $e->getMessage();
    }
}