/******/ (() => { // webpackBootstrap
/*!*******************************!*\
  !*** ./src/scripts/custom.js ***!
  \*******************************/
/*
Initialize ASU React Components.
Includes header, footer, cookie consent.
*/

window.addEventListener("DOMContentLoaded", event => {
  AsuHeader.initGlobalHeader({
    targetSelector: "#header-container",
    props: {
      loggedIn: udsHeaderVars.loggedIn,
      logoutLink: udsHeaderVars.logoutLink,
      loginLink: udsHeaderVars.loginLink,
      userName: udsHeaderVars.userName,
      navTree: udsHeaderVars.navTree,
      // navTree: exampleNavTree,
      title: udsHeaderVars.title,
      baseUrl: udsHeaderVars.baseUrl,
      logo: udsHeaderVars.logo,
      isPartner: udsHeaderVars.isPartner,
      partnerLogo: udsHeaderVars.partnerLogo,
      animateTitle: udsHeaderVars.animateTitle,
      expandOnHover: udsHeaderVars.expandOnHover,
      parentOrg: udsHeaderVars.parentOrg,
      parentOrgUrl: udsHeaderVars.parentOrgUrl,
      breakpoint: udsHeaderVars.breakpoint,
      buttons: udsHeaderVars.buttons,
      searchUrl: udsHeaderVars.searchUrl,
      site: udsHeaderVars.site
    }
  });
});
window.addEventListener("DOMContentLoaded", event => {
  AsuFooter.initASUFooter({
    targetSelector: "#asu-react-footer",
    props: {
      // contact: udsFooterVars
    }
  });
});
window.addEventListener("DOMContentLoaded", event => {
  AsuCookieConsent.initCookieConsent({
    targetSelector: "#cookie-consent-container",
    props: {
      enableCookieConsent: true,
      expirationTime: 90 // Number of days to expire the consent
    }
  });
});

/*
Adding "scrolled" event listener to header wrapper to make CSS rule for adjacent siblings easier.
*/

document.addEventListener('DOMContentLoaded', function () {
  var headerContainer = document.getElementById('header-container');
  window.addEventListener('scroll', function () {
    if (window.scrollY === 0) {
      headerContainer.classList.remove('scrolled');
    } else {
      headerContainer.classList.add('scrolled');
    }
  });
});

/*
Toggles visibility of ACF controls within a menu object in menu.php
TODO: Detect the in the admin that this is on and only load if it's nav-menu.php?
*/
document.addEventListener('DOMContentLoaded', function () {
  var topLevelMenuItems = document.querySelectorAll('ul.menu.ui-sortable li.menu-item-depth-0');
  topLevelMenuItems.forEach(function (menuItem) {
    var nextSibling = menuItem.nextElementSibling;
    if (nextSibling && nextSibling.classList.contains('menu-item-depth-1')) {
      var acfFields = menuItem.querySelectorAll('.menu-item-settings .acf-menu-item-fields .acf-field-true-false');
      acfFields.forEach(function (acfField) {
        if (acfField.getAttribute('data-name') === 'menu_cta_button') {
          acfField.style.display = 'none';
        }
      });
    }
  });
});
/******/ })()
;
//# sourceMappingURL=custom.js.map