<?php

/**
 * @file
 * Contains \Drupal\blocktabs\Plugin\Tab\ViewsTab.
 */

namespace Drupal\blocktabs\Plugin\Tab;

use Drupal\Core\Form\FormStateInterface;
use Drupal\blocktabs\ConfigurableTabBase;
use Drupal\blocktabs\BlocktabsInterface;

/**
 * views tab.
 *
 * @Tab(
 *   id = "views_tab",
 *   label = @Translation("views tab"),
 *   description = @Translation("views tab.")
 * )
 */
class ViewsTab extends ConfigurableTabBase {

  /**
   * {@inheritdoc}
   */
   
  public function addTab(BlocktabsInterface $blocktabs) {

    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public function getSummary() {
    $summary = array(
      '#theme' => 'tab_summary',
      '#data' => $this->configuration,
    );
    $summary += parent::getSummary();

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return array(
      'view_name' => NULL,
	  'view_display' => NULL,
	  'view_arg' => NULL,
    );
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form['view_name'] = array(
      '#type' => 'textfield',
      '#title' => t('view name'),
      '#default_value' => $this->configuration['view_name'],
      '#field_suffix' => ' ' ,
      '#required' => TRUE,
    );
    $form['view_display'] = array(
      '#type' => 'textfield',
      '#title' => t('Display'),
      '#default_value' => $this->configuration['view_display'],
      '#field_suffix' => ' ' ,
      '#required' => TRUE,
    );	
    $form['view_arg'] = array(
      '#type' => 'textfield',
      '#title' => t('Argument'),
      '#default_value' => $this->configuration['view_arg'],
      '#field_suffix' => ' ' ,

    );		
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    parent::submitConfigurationForm($form, $form_state);

    $this->configuration['view_name'] = $form_state->getValue('view_name');
	$this->configuration['view_display'] = $form_state->getValue('view_display');
	$this->configuration['view_arg'] = $form_state->getValue('view_arg');
  }

  /**
   * {@inheritdoc}
   */  
  public function getContent() {
    $tab_content = '';
    $view_name = $this->configuration['view_name'];
    $view_display = $this->configuration['view_display'];
    $view_arg = !empty($this->configuration['view_arg']) ? $this->configuration['view_arg'] : NULL;
    $tab_view = views_embed_view($view_name, $view_display, $view_arg);	
	$tab_content =  \Drupal::service('renderer')->render($tab_view);
    return $tab_content;
  }
}
