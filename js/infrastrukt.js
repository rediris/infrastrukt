// INFRASTRUKT JS

// INITIALIZE FOUNDATION JS @see: http://foundation.zurb.com/docs/javascript.html
jQuery(document).ready(function($) {
  'use strict';
  if (typeof $.foundation !== undefined) {
    $(document).foundation();
  }

  var $infrastrukt;

  // Sparkletown Menu Toggle
  (function() {
    var nav = $('#sparkletown');
    var button;
    var menu;
    if (!nav) {
      return;
    }

    button = nav.find('.menu-toggle');
    if (!button) {
      return;
    }

    // Hide button if menu is missing or empty.
    menu = nav.find('.menu');
    if (!menu || !menu.children().length) {
      button.addClass('hide');
      return;
    }

    $('.menu-toggle').on('click', function() {
      nav.toggleClass('toggled-on');
    });
  })();

}); // end jQuery
