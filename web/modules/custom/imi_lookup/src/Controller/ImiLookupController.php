<?php

namespace Drupal\imi_lookup\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\imi_lookup\ImiLookForm;

class ImiLookupController extends ControllerBase {

    public function content() {

        return array(
            '#type' => 'markup',
            '#markup' => 'Custom controller',
        );
    }

}