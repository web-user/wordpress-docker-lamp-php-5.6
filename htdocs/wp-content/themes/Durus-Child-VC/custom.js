
jQuery( document ).ready( function()
{
	/* Swipe interaction for mobile menu { */
	jQuery(document).bind("mobileinit", function() 
	{
		$.mobile.ajaxEnabled = false;
	});
	
	var hideMobileMenu = function()
	{
		jQuery( 'body' ).removeClass( 'expanded' );
	}
	
	jQuery( window ).on( 'swipeleft.menuMobile', function() { if ( jQuery( window ).width() <= 1000 ) jQuery( 'body' ).addClass( 'expanded' ); } );
	jQuery( window ).on( 'swiperight.menuMobile', function() { hideMobileMenu(); } );
	jQuery( 'body' ).on( 'tap.menuMobile click.menuMobile', function() { hideMobileMenu(); } );
	jQuery( '#mobile_navigation, #toggle-menu' ).on( 'tap.menuMobile click.menuMobile', function( event ) { event.stopPropagation(); } );
	/* } Swipe interaction for mobile menu */
	
	
	/* Adwords conversion tracking { */
	jQuery(document).bind('gform_confirmation_loaded', function(event, formId)
	{
		if ( formId == '1' )
		{
			goog_report_conversion( window.location.href );
		}
	});
	/* } Adwords conversion tracking */
});
