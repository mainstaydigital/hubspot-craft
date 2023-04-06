<?php

use HubSpot\Factory;
use HubSpot\Client\Crm\Contacts\ApiException;
use HubSpot\Client\Crm\Contacts\Model\SimplePublicObjectInput;

/**
 * @throws ApiException
 */
function updateHubspotContact(string $contactId, array $properties): \HubSpot\Client\Crm\Contacts\Model\Error|\HubSpot\Client\Crm\Contacts\Model\SimplePublicObject
{
    $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
    $client = Factory::createWithAccessToken('pat-na1-d4510998-72ca-4578-ac83-03cc3fb95c5c', $guzzleClient);

    $newProperties = new SimplePublicObjectInput($properties);
    try {
        $apiResponse = $client->crm()->contacts()->basicApi()->update($contactId, $newProperties);
        echo json_encode($apiResponse);
        // var_dump($apiResponse);
        return $apiResponse;
    } catch (ApiException $e) {
        echo "Exception when calling crm()->contacts()->basicApi()->update: ", $e->getMessage();
        throw new ApiException("Exception when calling crm()->contacts()->basicApi()->update: ", $e->getMessage());
    }
}