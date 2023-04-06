<?php
/**
 * Hubspot-Integration module for Craft CMS 3.x
 *
 * custom integration between Craft and HubSpot
 *
 * @link      https://github.com/mainstaydigital
 * @copyright Copyright (c) 2022 Mainstay Digital
 */

namespace mainstaycraft\Hubspotintegrationmodule\models;

use mainstaycraft\Hubspotintegrationmodule\HubspotIntegrationModule;

use Craft;
use craft\base\Model;

/**
 * Contact Model
 *
 * Models are containers for data. Just about every time information is passed
 * between services, controllers, and templates in Craft, it’s passed via a model.
 *
 * https://craftcms.com/docs/plugins/models
 *
 * @author    Mainstay Digital
 * @package   HubspotIntegrationModule
 * @since     0.0.1
 */
class Contact
{
    public string $company;
    public string $email;
    public string $firstname;
    public string $lastname;
    public string $phone;
    public string $website;

    // Public Methods
    // =========================================================================

    /**
     * Returns the validation rules for attributes.
     *
     * Validation rules are used by [[validate()]] to check if attribute values are valid.
     * Child classes may override this method to declare different validation rules.
     *
     * More info: http://www.yiiframework.com/doc-2.0/guide-input-validation.html
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            [['email', 'firstname', "lastname"], "required"],
            ["email", "email"],
        ];
    }

    public function __toString()
    {
        return json_encode($this);
    }
}
