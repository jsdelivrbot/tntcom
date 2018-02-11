
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
  Drupal.behaviors.truckConentType = {
    attach: function (context) {

      /*************************************************************************
       * Start Custom Code
       * String Replace "Category" Field Values 
       ************************************************************************/
      var str = document.getElementById("field-truck-category-value").innerHTML; 
      /* With sleeper */ 
      if (str = "Heavy Duty Trucks - Conventional Trucks w/ Sleeper") {
        var res = str.replace("Heavy Duty Trucks - Conventional Trucks w/ Sleeper", "Heavy Duty");
        document.getElementById("field-truck-category-value").innerHTML = res;
      }
      /* Without sleeper */
      if (str = "Heavy Duty Trucks - Conventional Trucks w/o Sleeper") {
        var res = str.replace("Heavy Duty Trucks - Conventional Trucks w/o Sleeper", "Heavy Duty");
        document.getElementById("field-truck-category-value").innerHTML = res;
      }

      /* Table: Detailed Specs: "Category" Field 
        $(this).html( $(this).html().replace(/Heavy Duty Trucks - Conventional Trucks w/o Sleeper/g, "Heavy Duty") );

        $(this).html( $(this).html().replace(/Trucks - Conventional Trucks/g, "-") );
        $(this).html( $(this).html().replace(/Tom Nehl Trucks - Jacksonville/g, "Tom Nehl Truck Jacksonville") );
        $(this).html( $(this).html().replace(/Tom Nehl Trucks - Lake City/g, "Tom Nehl Truck Lake City") );
      */
      /*************************************************************************
       * End Custom Code
       ************************************************************************/
    }
  };
})(document, Drupal, jQuery);

