<?php

use HubSpot\Client\Crm\Contacts\ApiException;
use HubSpot\Factory;

/**
 * @throws ApiException
 */
function searchHubspotContact(string $email): \HubSpot\Client\Crm\Contacts\Model\Error|\HubSpot\Client\Crm\Contacts\Model\CollectionResponseWithTotalSimplePublicObjectForwardPaging
{
    $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
    $hubspotClient = Factory::createWithAccessToken('pat-na1-d4510998-72ca-4578-ac83-03cc3fb95c5c', $guzzleClient);

    try {
        $filter = new \HubSpot\Client\Crm\Contacts\Model\Filter();
        $filter
            ->setOperator('EQ')
            ->setPropertyName('email')
            ->setValue($email);

        $filterGroup = new \HubSpot\Client\Crm\Contacts\Model\FilterGroup();
        $filterGroup->setFilters([$filter]);

        $searchRequest = new \HubSpot\Client\Crm\Contacts\Model\PublicObjectSearchRequest();
        $searchRequest->setFilterGroups([$filterGroup]);
        // @var CollectionResponseWithTotalSimplePublicObject $contactsPage
        $contactsPage = $hubspotClient->crm()->contacts()->searchApi()->doSearch($searchRequest);
        echo $contactsPage;
        return $contactsPage;
    } catch (ApiException $e) {
        throw new ApiException("Exception when calling crm()->contacts()->searchApi()->doSearch: " . $e->getMessage(), $e->getCode());
    }
}