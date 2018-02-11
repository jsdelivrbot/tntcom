
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
  Drupal.behaviors.popup = {
    attach: function (context) {
      /*************************************************************************
       * Custom Code
       ************************************************************************/

      /*************************************************************************
       * Modal 1
       ************************************************************************/
      // https://css-tricks.com/snippets/jquery/smooth-scrolling/

      var modal1 = document.querySelector("#modal1");
      var trigger1 = document.querySelector("#trigger1");
      var closeButton1 = document.querySelector("#close-button1");

      function toggleModal1() {
        modal1.classList.toggle("show-modal");
      }
      
      /* Check if trigger1 exists in DOM b/c if not then addEventListener will throw error */
      if (trigger1 !== null ) {
        trigger1.addEventListener("click", toggleModal1);
      }
      if (closeButton1 !== null ) {
        closeButton1.addEventListener("click", toggleModal1);
      }

      /*************************************************************************
       * Modal 2
       ************************************************************************/

      var modal2 = document.querySelector("#modal2");
      var trigger2 = document.querySelector("#trigger2");
      var closeButton2 = document.querySelector("#close-button2");

      function toggleModal2() {
        modal2.classList.toggle("show-modal");
      }

      /* Check if trigger1 exists in DOM b/c if not then addEventListener will throw error */
      if (trigger2 !== null ) {
        trigger2.addEventListener("click", toggleModal2);
      }
      if (closeButton2 !== null ) {
        closeButton2.addEventListener("click", toggleModal2);
      }

      /*************************************************************************
       * Window Click = Close Modal
       ************************************************************************/

      function windowOnClick(event) {
        if (event.target === modal1) {
          toggleModal1();
        }
        if (event.target === modal2) {
          toggleModal2();
        }
      }

      window.addEventListener("click", windowOnClick);

      /*************************************************************************
       * End Custom Code
       ************************************************************************/
    }
  };
})(document, Drupal, jQuery);

