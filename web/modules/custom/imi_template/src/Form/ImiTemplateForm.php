<?php

/**
 * @file
 * A form with field member ID that get a formatted JSON response returned for 
 * that individual member
 */
namespace Drupal\imi_template\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ImiTemplateForm extends FormBase {

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'imi_template_form';
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
        $form['#theme'] = 'imi_members';
        
        return $form;

    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {

        // $value_member_id = $form_state->getValue('member_id');

        // $this->messenger()->addMessage(t(
        //         "You entered @member_id<br>",
        //     [
        //         '@member_id' => $value_member_id,
        //     ]
        // ));

        $field = $form_state->getValues();

    }

}