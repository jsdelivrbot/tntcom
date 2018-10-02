
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
  Drupal.behaviors.truckFilter = {
    attach: function (context) {

      /*************************************************************************
       * Start Custom Code
       * Filter Block Change Button Text Based on Breakpoint
       ************************************************************************/
      $("#trucks-filter__top").children().each(function () {
        /* JavaScript Media Queries */
        var mq = window.matchMedia("(min-width: 1000px)");
        if (matchMedia) {
          mq.addListener(WidthChange);
          WidthChange(mq);
        }
        // media query change listens for change in browser width
        function WidthChange(mq) {
          // If mq.matches then btnValue = "Sort" else btnValue = "Find a Truck"
          var btnValue = (mq.matches ? "Sort" : "Find a Truck");
          $("#edit-submit-trucks").val(btnValue);
          // If mq.matches...
          if (mq.matches) {
            // 
            // Accessibility -- Screenreader Support: Following items added to assist
            // screen readers to more effectively communicate the DOM
            //
            // Remove form elements from DOM so screenreaders do not read them twice
            $("#trucks-filter__top .form-item-tid, #trucks-filter__top .form-item-tid-1, #trucks-filter__top .form-item-tid-2").remove();
          }
        }
      }); // END jQuery function
      // 
      // Accessibility -- Screenreader Support: Following items added to assist
      // screen readers to more effectively communicate the DOM
      //
      // Remove 'sort by' element from sidebar Truck Search b/c it's already at top
      // of page and should not be duplicated
      $("#trucks-filter__sidebar .form-item-sort-bef-combine").remove();

      /*************************************************************************
       * End Custom Code
       ************************************************************************/
    }
  };
})(document, Drupal, jQuery);

