<?php
use HubSpot\Factory;
use HubSpot\Client\Crm\Objects\ApiException;
use HubSpot\Client\Crm\Objects\Model\SimplePublicObjectInput;

function createCustomObject()
{
    $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
    $client = Factory::createWithAccessToken('pat-na1-d4510998-72ca-4578-ac83-03cc3fb95c5c', $guzzleClient);

    $properties1 = [
        'name' => 'Mainstay Digital',
        'email' => 'beck@sample.com',
        'phone' => '15724800',
        'products' => ['option_1', 'option_2', 'option_3'],
        'prices' => ['option_1', 'option_2', 'option_3'],
        'order_total' => 1450.00,
        'shipping_cost' => 120.00,
        'date_purchased' => date("l jS \of F Y h:i:s A"),
        'test_prices' => 'option_1;option_2',
    ];
    $simplePublicObjectInput = new SimplePublicObjectInput([
        'properties' => $properties1,
    ]);
    try {
        $apiResponse = $client->crm()->objects()->basicApi()->create('craftUser', $simplePublicObjectInput);
        var_dump($apiResponse);
    } catch (ApiException $e) {
        echo "Exception when calling basic_api->create: ", $e->getMessage();
    }
}