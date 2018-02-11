/**
 * @file
 * blocktabs behaviors.
 */

(function ($, Drupal) {

  'use strict';

  /**
   * Add jquery ui tabs effect.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *
   */
  Drupal.behaviors.blocktabs = {
    attach: function (context, settings) {
      $(context).find('div.blocktabs').each(function () {
        if($(this).hasClass( "click" )){
          $(this).tabs({
            event: "click"
          });          			
        }
        else{
          $(this).tabs({
            event: "mouseover"
          });
        }
      });
    }
  };

}(jQuery, Drupal));
