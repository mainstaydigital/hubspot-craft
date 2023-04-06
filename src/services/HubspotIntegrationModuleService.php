<?php
/**
 * Hubspot-Integration module for Craft CMS 3.x
 *
 * custom integration between Craft and HubSpot
 *
 * @link      https://github.com/mainstaydigital
 * @copyright Copyright (c) 2022 Mainstay Digital
 */

namespace Beck\Hubspotintegrationmodule\services;

use Beck\Hubspotintegrationmodule\HubspotIntegrationModule;

use Craft;
use craft\base\Component;

/**
 * HubspotIntegrationModuleService Service
 *
 * All of your module’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other modules can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    Mainstay Digital
 * @package   HubspotIntegrationModule
 * @since     0.0.1
 */
class HubspotIntegrationModuleService extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin/module file, call it like this:
     *
     *     HubspotIntegrationModule::$instance->hubspotIntegrationModuleService->exampleService()
     *
     * @return mixed
     */
    public function exampleService()
    {
        $result = 'something';

        return $result;
    }
}
