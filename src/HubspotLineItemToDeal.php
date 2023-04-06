<?php

use HubSpot\Factory;
use HubSpot\Client\Crm\LineItems\ApiException;

/**
 * @throws ApiException
 */
function associateLineItemToDeal($itemId, $dealId): \HubSpot\Client\Crm\LineItems\Model\SimplePublicObjectWithAssociations
{
    $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
    $client = Factory::createWithAccessToken('pat-na1-d4510998-72ca-4578-ac83-03cc3fb95c5c', $guzzleClient);

    try {
        $apiResponse = $client->crm()->lineItems()->associationsApi()->create(
            $itemId,
            'deals',
            $dealId,
            'lineItem_to_deal'
        );
        echo $apiResponse;
        return $apiResponse;
    } catch (ApiException $e) {
        throw new ApiException("Exception when calling crm()->lineItems()->associationsApi()->create: " . $e->getMessage(), $e->getCode());
    }
}