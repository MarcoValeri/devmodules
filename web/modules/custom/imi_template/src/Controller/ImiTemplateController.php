<?php

namespace Drupal\imi_template\Controller;

use Drupal\Core\Controller\ControllerBase;

class ImiTemplateController extends ControllerBase {

    public function content() {

        return [
            '#theme' => 'imi_members',
            '#title' => $this->t('IMI Template'),
        ];

    }

}