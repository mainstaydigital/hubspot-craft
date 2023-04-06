<?php

use HubSpot\Factory;
use HubSpot\Client\Crm\Deals\ApiException;

function listHubspotDeals()
{
    $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
    $client = Factory::createWithAccessToken('pat-na1-d4510998-72ca-4578-ac83-03cc3fb95c5c', $guzzleClient);

    try {
        $apiResponse = $client->crm()->deals()->basicApi()->getPage(10, null, null, null, null, false);
        return json_encode($apiResponse);
    } catch (ApiException $e) {
        echo "Exception when calling basic_api->create: ", $e->getMessage();
    }
}