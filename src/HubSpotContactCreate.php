<?php

use HubSpot\Factory;
use HubSpot\Client\Crm\Contacts\ApiException;
use HubSpot\Client\Crm\Contacts\Model\SimplePublicObjectInput;

/**
 * @throws ApiException
 */
function createHubspotContact(array $contactProperties): string
{
    $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
    $client = Factory::createWithAccessToken('pat-na1-d4510998-72ca-4578-ac83-03cc3fb95c5c', $guzzleClient);

    $simplePublicObjectInput = new SimplePublicObjectInput([
        'properties' => $contactProperties,
    ]);
    try {
        $apiResponse = $client->crm()->contacts()->basicApi()->create($simplePublicObjectInput);
//        echo $apiResponse, "<br>";
//        echo "Contact id ", $apiResponse["id"];
        // var_dump($apiResponse);
        return $apiResponse['id'];
    } catch (ApiException $e) {
        throw new ApiException("Exception when calling basic_api->create: " . $e->getMessage(), $e->getCode());
    }
}