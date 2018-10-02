

/**
  * @file
  * Attach behaviors for the Trucks View Filter.
  */

!(function (document, Drupal, $) {
  'use strict';

  /**
   * Attach filter manipulation to the Truck View Filter.
   *
   * @type {Drupal~behavior}
   */
  Drupal.behaviors.contactForms = {
    attach: function (context) {

      /*************************************************************************
       * Start Custom Code
       ************************************************************************/

      // Accessibility -- Screenreader Support: Following items added to assist
      // screen readers to more effectively communicate the DOM
      // Add asterisk to required fields that could not be edited in admin ui      
      $("label[for=edit-name]").text("Your name *");
      $("label[for=edit-mail]").text("Your email address *");
      $("label[for=edit-message-0-value]").text("Message *");
      // Remove default 'none' field
      $("option[value=_none]").remove();

      /*************************************************************************
       * End Custom Code
       ************************************************************************/
    }
  };
})(document, Drupal, jQuery);

