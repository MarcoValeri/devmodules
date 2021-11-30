<?php

namespace Drupal\imi_lookup\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\imi_lookup\ImiLookForm;

class ImiLookupController extends ControllerBase {

    public function getPerson() {
        $api = json_decode(file_get_contents('file:///C:/xampp/htdocs/devmodules/web/modules/custom/imi_lookup/src/Api/api-v-1-person-1.json'), TRUE);
        $person_id = $api->person_id;
        return $person_id;
    }

    public function content() {
        return array(
            '#type' => 'markup',
            '#markup' => $this->getPerson(),
        );
    }

}