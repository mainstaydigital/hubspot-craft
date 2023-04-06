<?php

use HubSpot\Factory;
use HubSpot\Client\Crm\Deals\ApiException;
use HubSpot\Client\Crm\Deals\Model\SimplePublicObjectInput;

/**
 * @throws ApiException
 */
function createHubspotDeal(array $dealProperties): string
{
    $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
    $client = Factory::createWithAccessToken('pat-na1-d4510998-72ca-4578-ac83-03cc3fb95c5c', $guzzleClient);

    $simplePublicObjectInput = new SimplePublicObjectInput([
        'properties' => $dealProperties,
    ]);
    try {
        $apiResponse = $client->crm()->deals()->basicApi()->create($simplePublicObjectInput);
        // var_dump($apiResponse);
        return $apiResponse['id'];
    } catch (ApiException $e) {
        throw new ApiException("Exception when calling crm()->deals()->basicApi()->create: " . $e->getMessage(), $e->getCode());
    }
}
