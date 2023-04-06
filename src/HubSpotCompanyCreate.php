<?php

use HubSpot\Client\Crm\Deals\Model\SimplePublicObjectInput;
use HubSpot\Client\Files\ApiException;
use HubSpot\Factory;

function createCompany($companyData)
{
    $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
    $client = Factory::createWithAccessToken('pat-na1-d4510998-72ca-4578-ac83-03cc3fb95c5c', $guzzleClient);

    $properties1 = [
        'city' => 'Cambridge',
        'domain' => 'biglytics.net',
        'industry' => 'Technology',
        'name' => 'Biglytics',
        'phone' => '(877) 929-0687',
        'state' => 'Massachusetts'
    ];
    $simplePublicObjectInput = new SimplePublicObjectInput([
        'properties' => $properties1,
    ]);
    try {
        $apiResponse = $client->crm()->companies()->basicApi()->create($simplePublicObjectInput);
        var_dump($apiResponse);
    } catch (ApiException $e) {
        echo "Exception when calling basic_api->create: ", $e->getMessage();
    }
}