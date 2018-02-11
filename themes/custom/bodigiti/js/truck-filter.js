
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
          var btnValue = (mq.matches ? "Sort" : "Find a Truck");
          document.getElementById("edit-submit-trucks").value = btnValue;
        }

      }); // END jQuery function
      /*************************************************************************
       * End Custom Code
       ************************************************************************/
    }
  };
})(document, Drupal, jQuery);

