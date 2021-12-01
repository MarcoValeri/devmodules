<?php

/**
 * @file
 * A form with field member ID that get a formatted JSON response returned for 
 * that individual member
 */
namespace Drupal\imi_lookup\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ImiLookupForm extends FormBase {

    /**
     * @return Drupal\imi_lookup\Api
     */
    public function getPerson($environment) {

        $path = "C:\\xampp\htdocs\devmodules\web\modules\custom\imi_lookup\src\Api\\" . $environment . "\api-v-1-person-1.json";
        $api = file_get_contents($path);
        $person = json_decode($api, TRUE);

        return $person;

    }

    /**
     * @return Drupal\imi_lookup\Api
     */
    public function getJsonFormatted($environment) {

        $path = "C:\\xampp\htdocs\devmodules\web\modules\custom\imi_lookup\src\Api\\" . $environment . "\api-v-1-person-1.json";
        $api = file_get_contents($path);
        $person = json_decode($api, TRUE);

        //return $api;
        return json_encode($person, JSON_PRETTY_PRINT);

    }

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'imi_lookup_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {

        /**
         * Establish the $form render array.
         * It has 'member ID' text field,
         * radios menu for searching 'live' or 'UAT',
         * and a submit button
         */
        $form['member_id'] = [
            '#type' => 'textfield',
            '#title' => t('Member ID'),
            '#size' => 25,
            'description' => t('Enter a member ID in a search field and choose if searching LIVE or UAT prodrive.'),
            '#required' => TRUE,
        ];
        $form['environment_select'] = [
            '#type' => 'radios',
            '#title' => $this->t('Select the environment'),
            '#default_value' => 'uat',
            '#options' => [
                'uat' => $this->t('UAT'),
                'live' => $this->t('live'),
            ],
        ];
        $form['submit'] = [
            '#type' => 'submit',
            '#value' => t('Get a formatted JSON'),
        ];
        
        return $form;

    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {

        $submitted_member_id = $form_state->getValue('member_id');
        $environment = $form_state->getValue('environment_select');
        $status = "";
        $person = $this->getPerson($environment);
        $person_id = "";
        $person_name = "";
        $person_surname = "";
        $person_email = "";
        $person_phone = "";
        $person_formatted_json = "";

        if ($submitted_member_id != $person['person_id']) {
            $status = "Member ID not found";
        } else {
            $status = "Member ID found";
            $person_id = $person['person_id'];
            $person_name = $person['name_first'];
            $person_surname = $person['name_last'];
            $person_email = $person['work_email'];
            $person_phone = $person['work_number'];
            $person_formatted_json = $this->getJsonFormatted($environment);
        }

        $this->messenger()->addMessage(t(
                "You entered @member_id<br>
                Environment: @environment<br>
                Status: @status<br>
                Member ID: @person_id<br>
                Member name: @person_name<br>
                Member surname: @person_surname<br>
                Member email: @person_email<br>
                Member phone: @person_phone<br>
                Formatted json: @formatted_json",
            [
                '@member_id' => $submitted_member_id,
                '@environment' => $environment,
                '@status' => $status,
                '@person_id' => $person_id,
                '@person_name' => $person_name,
                '@person_surname' => $person_surname,
                '@person_email' => $person_email,
                '@person_phone' => $person_phone,
                '@formatted_json' => $person_formatted_json,
            ]
        ));

    }

}