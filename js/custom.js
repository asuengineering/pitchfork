"use strict";

// Cookie consent form initialization.
window.addEventListener("DOMContentLoaded", function (event) {
  AsuCookieConsent.init();
});
"use strict";

// Toggles visibility of ACF controls within a menu object in menu.php
jQuery(document).ready(function ($) {
  $('ul.menu.ui-sortable li.menu-item-depth-0').each(function () {
    if ($(this).next().hasClass('menu-item-depth-1')) {
      $(this).find('.menu-item-settings .acf-menu-item-fields .acf-field-true-false').each(function () {
        if ($(this).attr('data-name') == 'menu_cta_button') {
          $(this).hide();
        }
      });
    }
  });
});