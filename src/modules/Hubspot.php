<?php
namespace Beck\Hubspotintegrationmodule\modules;

require 'vendor/autoload.php';
use craft\commerce\elements\Order;
use yii\base\Event;
use Craft;

/**
 * Custom module class.
 *
 * This class will be available throughout the system via:
 * `Craft::$app->getModule('my-module')`.
 *
 * You can change its module ID ("my-module") to something else from
 * config/app.php.
 *
 * If you want the module to get loaded on every request, uncomment this line
 * in config/app.php:
 *
 *     'bootstrap' => ['my-module']
 *
 * Learn more about Yii module development in Yii's documentation:
 * http://www.yiiframework.com/doc-2.0/guide-structure-modules.html
 */
class Hubspot extends \yii\base\Module
{
    /**
     * Initializes the module.
     */
    public function init()
    {
        // Set a @modules alias pointed to the modules/ directory
        Craft::setAlias('@modules', __DIR__);

        // Set the controllerNamespace based on whether this is a console or web request
        if (Craft::$app->getRequest()->getIsConsoleRequest()) {
            $this->controllerNamespace = 'modules\\console\\controllers';
        } else {
            $this->controllerNamespace = 'modules\\controllers';
        }

        parent::init();

        $hubspot = \HubSpot\Factory::createWithAccessToken('pat-na1-d4510998-72ca-4578-ac83-03cc3fb95c5c');

        Event::on(
            Order::class,
            Order::EVENT_AFTER_ORDER_PAID,
            function(Event $event) {
                // @var Order $order
                $order = $event->sender;

                $customer = $order->customer;
                $fullName = $customer->fullName;

                $email = $order->email;

                $productsPurchased = $order->lineItems;

                $orderTotal = $order->totalPaid;

                $shippingCost = $order->totalShippingCost;

                // ...
            }
        );
    }
}
