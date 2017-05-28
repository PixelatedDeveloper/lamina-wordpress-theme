// code to enable side navigation
jQuery(document).ready(function () {
  // Initialize collapse button
  jQuery('.button-collapse').sideNav({
    menuWidth: 300, // Default is 300
    edge: 'left', // Choose the horizontal origin
    closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
    draggable: true // Choose whether you can drag to open on touch screens
  });

  jQuery('.carousel').carousel();

  jQuery('select').material_select();

    // Configure dropdown
    jQuery(".dropdown-button").dropdown({
        hover: false
    });
});