
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
  Drupal.behaviors.googleMaps = {
    attach: function (context) {

      /*************************************************************************
       * Start Custom Code
       ************************************************************************/
      // https://firstsiteguide.com/speed-site-properly-including-google-maps/
        // replace click with mouseenter if you want to activate the map on mouse hover
        // warning - mobile devices don't have a cursor so they can't trigger "hover"
        $('#gmap-jax-417 a, #gmap-lake-city a, #gmap-waycross a').on('click', function(e) {
          e.preventDefault();
          var map = $(this).parent();
          console.log("Map this ", map);
          var iframe_src = map.data('iframe-src');
          var iframe_width = map.data('iframe-width');
          var iframe_height = map.data('iframe-height');

          map.html('<iframe src="' + iframe_src + '" width="' + iframe_width + '" height="' + iframe_height + '" allowfullscreen></iframe>');

          return false;
        }); // end jQuery function
   
      /*************************************************************************
       * End Custom Code
       ************************************************************************/
    }
  };
})(document, Drupal, jQuery);

