<?php

require __DIR__ . "/HubSpotContactCreate.php";
require __DIR__ . "/HubspotContactSearch.php";
require __DIR__ . "/HubSpotDealCreate.php";
require __DIR__ . "/HubspotDealToContact.php";

use HubSpot\Client\Crm\Contacts\ApiException;

/**
 * @throws ApiException
 */
function isContactExists(string $email): string | null
{
    $contact = searchHubspotContact($email);
    $total = $contact["total"];
    $results = $contact["results"];
    if ($total > 0) {
        return $results[0]["id"];
    }
    else {
        return null;
    }
}

function getContactProperties($order): array
{
    $customer = $order->customer;
    $fullName = $customer->fullName;
    $parts = explode(" ", $fullName);
    $firstname = implode(" ", $parts);
    $lastname = array_pop($parts);
//    $firstname = $customer->firstName;
//    $lastname = $customer->lastName;
    $email = $order->email;
    return array(
        "firstname" => $firstname,
        "lastname" => $lastname,
        "email" => $email,
    );
}

function array_map_assoc($array): array
{
    $r = array();
    foreach ($array as $key=>$value)
        $r[$key] = "$key ($value)";
    return $r;
}

function getProductTitles($lineItems): string
{
    function productTitles($carry, $item): string
    {
        $carry .= $item["snapshot"]["product"]["title"] . ", ";
        return $carry;
    }
    return array_reduce($lineItems, "productTitles", "");
}

function getProductPrices($lineItems): string
{
    function productPrices($carry, $item): string
    {
        $carry .= $item["snapshot"]["product"]["defaultPrice"] . ", ";
        return $carry;
    }
    return array_reduce($lineItems, "productPrices", "");
}

function getLineItemProperties($item): array
{
    $product = $item->snapshot->product;
    $productId = $item->snapshot->productId;
    $title = $product->title;
    $qty = $item->qty;
    $price = $product->defaultPrice;
    return array(
        'name' => $title,
        'hs_product_id' => $productId,
        'hs_recurring_billing_period' => '24',
        'recurringbillingfrequency' => 'monthly',
        'quantity' => $qty,
        'price' => $price,
    );
}

function getDealProperties($order): array
{
    $productsPurchased = $order->lineItems;
    $productTitles = getProductTitles($productsPurchased);
    $productPrices = getProductPrices($productsPurchased);
    $orderTotal = $order->totalPaid;

    $shippingCost = $order->totalShippingCost;
    return array(
        "amount" => $orderTotal,
        "products_purchased" => $productTitles,
        "product_prices" => $productPrices,
        "order_total" => $orderTotal,
        "shipping_cost" => $shippingCost,
        "dealname" => "Custom data integration"
    );
}

function addTransactionDataToHubspot($order): void
{
    try {
        $email = $order->email;

        $contactProperties = getContactProperties($order);
        $contactId = isContactExists($email);
        if (!$contactId) {
            $contactId = createHubspotContact($contactProperties);
        }
        $dealProperties = getDealProperties($order);
        $dealId = createHubspotDeal($dealProperties);
        associateDealToContact($dealId, $contactId);
    } catch (ApiException|\HubSpot\Client\Crm\Deals\ApiException $e) {
        echo $e->getMessage();
    }
}