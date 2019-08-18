<?php
/**
 * @file
 * Contains \Drupal\siteinfo_overwrite\Form\UpdateSiteInfoForm.
 */

namespace Drupal\siteinfo_overwrite\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\system\Form\SiteInformationForm;

/**
 * Update configure site information settings for this site.
 *
 * @external
 */
class UpdateSiteInfoForm extends SiteInformationForm {
  
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $site_config = $this->config('system.site');
        
    $form = parent::buildForm($form, $form_state);

    $form['api_details'] = [
      '#type' => 'details',
      '#title' => t('API details'),
      '#open' => TRUE,
    ];

    $form['api_details']['siteapikey'] = [
      '#type' => 'textfield',
      '#title' => t('Site API Key'),
      '#default_value' => (!empty($site_config->get('siteapikey'))) ? $site_config->get('siteapikey') : 'No API Key yet',
      '#size' => 40,
    ];

    if (!empty($site_config->get('siteapikey'))) {
      $form['actions']['submit']['#value'] = t('Update Configuration');
    }
        
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('system.site')
      ->set('siteapikey', $form_state->getValue('siteapikey'))
      ->save();

    \Drupal::messenger()->addStatus('Saved Site API Key: ' . $form_state->getValue('siteapikey'));
    parent::submitForm($form, $form_state);
  }
}
