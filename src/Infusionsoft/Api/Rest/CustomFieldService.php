<?php namespace Infusionsoft\Api\Rest;

use Infusionsoft\Api\Rest\Traits\CannotCreate;
use Infusionsoft\Api\Rest\Traits\CannotDelete;
use Infusionsoft\Api\Rest\Traits\CannotModel;
use Infusionsoft\Api\Rest\Traits\CannotSave;
use Infusionsoft\Api\Rest\Traits\CannotSync;

class CustomFieldService extends RestModel {

    use CannotDelete, CannotSync, CannotSave, CannotCreate, CannotModel;

    public $full_url = 'https://api.infusionsoft.com/crm/rest/v1/contactCustomFields';

    public function CreateCustomField($customField = [])
    {
//        POST	/contacts/model/customFields
        // url https://api.infusionsoft.com/crm/rest//contacts/model/customFields
        /*
         * custom field structure
         $customField = {
  "field_type": "Text",
  "group_id": 0,
  "label": "sso_id",  // user camelCase
  "options": [
    {
      "label": "new_sso_id",
      "options": [
        {}
      ]
    }
  ],
  "user_group_id": 0
}
         */

        if (isset($customField['field_type'])) {
            if (!in_array($customField['field_type'], $this->allowed_type_of_new_field)) {
                dd("create throw new TypeErrorException");
//                throw new TypeErrorException
            }
        }
        $response = $this->client->restfulRequest('post', 'https://api.infusionsoft.com/crm/rest/v1/contacts/model/customFields', $customField);

        return $response;

    }
}