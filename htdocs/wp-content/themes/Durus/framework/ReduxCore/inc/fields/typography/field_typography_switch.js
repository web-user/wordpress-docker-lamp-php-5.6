/*global redux_change, redux*/


(function( $ ) {
    "use strict";

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.typo_switch = redux.field_objects.typo_switch || {};

    $( document ).ready(
        function() {
            redux.field_objects.typo_switch.init();
        }
    );

    redux.field_objects.typo_switch.init = function( selector ) {

        if ( !selector ) {
            selector = $( document ).find( '.redux-container-typography-switch' );
        }

        $( selector ).each(
            function() {
                var el = $( this );
           
                el.find( ".cb-enable" ).click(
                    function() {
                        if ( $( this ).hasClass( 'selected' ) ) {
                            return;
                        }

                        var parent = $( this ).parents( '.switch-options' );

                        $( '.cb-disable', parent ).removeClass( 'selected' );
                        $( this ).addClass( 'selected' );
                        $( '.checkbox-input', parent ).val( 1 );
						el.parent().find(' > .typography-family').fadeOut("fast");
						el.parent().find(' > .font-family-custom').fadeIn("fast");
						
                        redux_change( $( '.checkbox-input', parent ) );
						

                    }
                );

                el.find( ".cb-disable" ).click(
                    function() {
                        if ( $( this ).hasClass( 'selected' ) ) {
                            return;
                        }

                        var parent = $( this ).parents( '.switch-options' );

                        $( '.cb-enable', parent ).removeClass( 'selected' );
                        $( this ).addClass( 'selected' );
                        $( '.checkbox-input', parent ).val( 0 );
						el.parent().find(' > .font-family-custom').fadeOut("fast");
						 el.parent().find(' > .typography-family').fadeIn("fast");
                        redux_change( $( '.checkbox-input', parent ) );

                      
                    }
                );

                el.find( '.cb-enable span, .cb-disable span' ).find().attr( 'unselectable', 'on' );
            }
        );
    };
})( jQuery );