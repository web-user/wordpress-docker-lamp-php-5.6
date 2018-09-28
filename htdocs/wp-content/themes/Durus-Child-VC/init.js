/* Disable jQuery Mobile's auto AJAX for page load and form submission */
jQuery( document ).on( "mobileinit", function() 
{
	jQuery.mobile.ajaxEnabled = false;
	jQuery.mobile.pushStateEnabled = false;
});
