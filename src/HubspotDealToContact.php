<?php

use HubSpot\Factory;
use HubSpot\Client\Crm\Deals\ApiException;

/**
 * @throws ApiException
 */
function associateDealToContact($dealId, $contactId): \HubSpot\Client\Crm\Deals\Model\SimplePublicObjectWithAssociations|\HubSpot\Client\Crm\Deals\Model\Error
{
    $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
    $client = Factory::createWithAccessToken('pat-na1-d4510998-72ca-4578-ac83-03cc3fb95c5c', $guzzleClient);

    try {
        $apiResponse = $client->crm()->deals()->associationsApi()->create(
            $dealId,
            'contacts',
            $contactId,
            'deal_to_contact'
        );
        echo $apiResponse;
        return $apiResponse;
    } catch (ApiException $e) {
        throw new ApiException("Exception when calling crm()->deals()->associationsApi()->create: " . $e->getMessage(), $e->getCode());
    }
}