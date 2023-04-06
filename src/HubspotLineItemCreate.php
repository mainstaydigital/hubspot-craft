<?php

use HubSpot\Factory;
use HubSpot\Client\Crm\LineItems\ApiException;
use HubSpot\Client\Crm\LineItems\Model\SimplePublicObjectInput;

/**
 * @throws ApiException
 */
function createLineItem(array $properties): string
{
    $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
    $hubspotClient = Factory::createWithAccessToken('pat-na1-d4510998-72ca-4578-ac83-03cc3fb95c5c', $guzzleClient);


    $simplePublicObjectInput = new SimplePublicObjectInput([
        'properties' => $properties,
    ]);
    try {
        $apiResponse = $hubspotClient->crm()->lineItems()->basicApi()->create($simplePublicObjectInput);
        return $apiResponse['id'];
    } catch (ApiException $e) {
        throw new ApiException("Exception when calling basic_api->create: " .  $e->getMessage(), $e->getCode());
    }
}