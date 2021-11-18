<?php

namespace Drupal\time\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\time\TimeNow;

/**
 * Time Controller
 */
class TimeController extends ControllerBase {

    /**
     * @var \Drupal\time\TimeNow
     */
    protected $timeNow;

    /**
     * TimeController contructor.
     * 
     * @param \Drupal\time\TimeNow $timeNow
     */
    public function __construct(TimeNow $timeNow) {
        $this->timeNow = $timeNow;
    }


    /**
     * Time
     * @return array
     * Our message.
     */
    public function timeMessage() {
        // return [
        //     '#markup' => 'Hello PHP',
        // ];
        return [
            '#markup' => $this->timeNow->getTime(),
        ];
    }

}