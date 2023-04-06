<?php

use HubSpot\Factory;
use HubSpot\Client\Crm\Schemas\ApiException;
use HubSpot\Client\Crm\Schemas\Model\ObjectSchemaEgg;
use HubSpot\Client\Crm\Schemas\Model\ObjectTypePropertyCreate;

function listObjects()
{
    $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
    $client = Factory::createWithAccessToken('pat-na1-d4510998-72ca-4578-ac83-03cc3fb95c5c', $guzzleClient);

    $response = $client->crm()->schemas()->coreApi()->getAll(false);
    echo 'Response', $response;
    var_dump($response);
}

function testWithCurl()
{
    $curl = curl_init();

    $labels1 = [
        'singular' => 'CUser',
        'plural' => 'CUsers'
    ];
    $requiredProperties1 = [
        'name',
        'email',
        'products',
        'prices',
        'order_total',
        'shipping_cost'
    ];
    $searchableProperties1 = [
        'date_purchased',
        'name',
        'email'
    ];
    $secondaryDisplayProperties1 = 'order_total';
    $objectTypePropertyCreate1 = new ObjectTypePropertyCreate([
        'name' => 'name',
        'label' => 'Customer Name',
        'groupName' => null,
        'description' => null,
        'options' => null,
        'displayOrder' => null,
        'hasUniqueValue' => null,
        'hidden' => null,
        'type' => 'string',
        'fieldType' => 'text'
    ]);
    $objectTypePropertyCreate2 = new ObjectTypePropertyCreate([
        'name' => 'email',
        'label' => 'Email',
        'groupName' => null,
        'description' => null,
        'options' => null,
        'displayOrder' => null,
        'hasUniqueValue' => 'true',
        'hidden' => null,
        'type' => 'string',
        'fieldType' => 'text'
    ]);
    $properties1 = [
        $objectTypePropertyCreate1,
        $objectTypePropertyCreate2,
    ];
    $associatedObjects1 = 'CONTACT';
    $objectSchemaEgg = new ObjectSchemaEgg([
        'labels' => $labels1,
        'requiredProperties' => $requiredProperties1,
        'searchableProperties' => $searchableProperties1,
        'primaryDisplayProperty' => 'name',
        'secondaryDisplayProperties' => $secondaryDisplayProperties1,
        'properties' => $properties1,
        'associatedObjects' => $associatedObjects1,
        'name' => 'craft_user',
    ]);

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.hubapi.com/crm/v3/schemas",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $objectSchemaEgg,
        CURLOPT_HTTPHEADER => array(
            "accept: application/json",
            "authorization: Bearer pat-na1-d4510998-72ca-4578-ac83-03cc3fb95c5c"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
}

function createCustomObjectSchema() {
    $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
    $client = Factory::createWithAccessToken('pat-na1-d4510998-72ca-4578-ac83-03cc3fb95c5c', $guzzleClient);

    $response = $client->crm()->schemas()->coreApi()->getAll(false);
    echo 'Response', $response;
    var_dump($response);

    $labels1 = [
        'singular' => 'CUser',
        'plural' => 'CUsers'
    ];
    $requiredProperties1 = [
        'name',
        'email',
        'products',
        'prices',
        'order_total',
        'shipping_cost'
    ];
    $searchableProperties1 = [
        'date_purchased',
        'name',
        'email'
    ];
    $secondaryDisplayProperties1 = 'order_total';
    $objectTypePropertyCreate1 = new ObjectTypePropertyCreate([
        'name' => 'name',
        'label' => 'Customer Name',
        'groupName' => null,
        'description' => null,
        'options' => null,
        'displayOrder' => null,
        'hasUniqueValue' => null,
        'hidden' => null,
        'type' => 'string',
        'fieldType' => 'text'
    ]);
    $objectTypePropertyCreate2 = new ObjectTypePropertyCreate([
        'name' => 'email',
        'label' => 'Email',
        'groupName' => null,
        'description' => null,
        'options' => null,
        'displayOrder' => null,
        'hasUniqueValue' => 'true',
        'hidden' => null,
        'type' => 'string',
        'fieldType' => 'text'
    ]);
    $properties1 = [
        $objectTypePropertyCreate1,
        $objectTypePropertyCreate2,
    ];
    $associatedObjects1 = 'CONTACT';
    $objectSchemaEgg = new ObjectSchemaEgg([
        'labels' => $labels1,
        'requiredProperties' => $requiredProperties1,
        'searchableProperties' => $searchableProperties1,
        'primaryDisplayProperty' => 'name',
        'secondaryDisplayProperties' => $secondaryDisplayProperties1,
        'properties' => $properties1,
        'associatedObjects' => $associatedObjects1,
        'name' => 'craft_user',
    ]);
    try {
        $apiResponse = $client->crm()->schemas()->coreApi()->create($objectSchemaEgg);
        echo 'Created schema id', json_decode($apiResponse);
        var_dump($apiResponse);
    } catch (ApiException $e) {
        echo "Exception when calling core_api->create: ", $e->getMessage();
    }
}