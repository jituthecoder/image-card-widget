(function( $ ) {
	'use strict';

	$(
		function() {

			$( 'body' ).on(
				'click',
				'.wpmozo_panel_button_activate:not(.disabled)',
				function() {
					let $this    = $( this ),
					$license_key = $this.closest( '.wpmozo_panel_licensefield' ).find( '#license_key' ).val();
					$this.closest( '.wpmozo_panel_licensefield' ).find( '.wpmozo_panel_license_response' ).text( '' );
					$this.closest( '.wpmozo_panel_licensefield' ).find( '.wpmozo_panel_license_response' ).removeClass( 'success' ).removeClass( 'error' );
					$.ajax(
						{
							type: "POST",
							url: admin_ajax_object.ajaxurl,
							data: {
								action: 'wpmozo_panel_activate_license',
								security: admin_ajax_object.ajax_nonce,
								license_key: $license_key,
							},
							success: function (response) {
								if ( response.success ) {
									$this.addClass( 'disabled' );
									$this.prev( '.wpmozo_panel_button_deactivate' ).removeClass( 'disabled' );
									$this.closest( '.wpmozo_panel_licensefield' ).find( '#license_key' ).prop( 'disabled',true );
									$this.closest( '.wpmozo_panel_licensefield' ).find( '.wpmozo_panel_license_response' ).addClass( 'success' );
								} else {
									$this.closest( '.wpmozo_panel_licensefield' ).find( '#license_key' ).val( '' );
									$this.closest( '.wpmozo_panel_licensefield' ).find( '.wpmozo_panel_license_response' ).addClass( 'error' );
								}
								$this.closest( '.wpmozo_panel_licensefield' ).find( '.wpmozo_panel_license_response' ).text( response.message );
							},
							error: function (test) {
								alert( 'Oops!! Something went wrong!! Try later!' );
							}
						}
					);
				}
			);

			$( 'body' ).on(
				'click',
				'.wpmozo_panel_button_deactivate:not(.disabled)',
				function() {
					let $this    = $( this ),
					$license_key = $this.closest( '.wpmozo_panel_licensefield' ).find( '#license_key' ).val();
					$this.closest( '.wpmozo_panel_licensefield' ).find( '.wpmozo_panel_license_response' ).text( '' );
					$this.closest( '.wpmozo_panel_licensefield' ).find( '.wpmozo_panel_license_response' ).removeClass( 'success' ).removeClass( 'error' );
					$.ajax(
						{
							type: "POST",
							url: admin_ajax_object.ajaxurl,
							data: {
								action: 'wpmozo_panel_deactivate_license',
								security: admin_ajax_object.ajax_nonce,
								license_key: $license_key,
							},
							success: function (response) {
								if ( response.success ) {
									$this.addClass( 'disabled' );
									$this.next( '.wpmozo_panel_button_activate' ).removeClass( 'disabled' );
									$this.closest( '.wpmozo_panel_licensefield' ).find( '#license_key' ).val( '' );
									$this.closest( '.wpmozo_panel_licensefield' ).find( '#license_key' ).prop( 'disabled',false );
									$this.closest( '.wpmozo_panel_licensefield' ).find( '.wpmozo_panel_license_response' ).addClass( 'success' );
								} else {
									$this.closest( '.wpmozo_panel_licensefield' ).find( '.wpmozo_panel_license_response' ).addClass( 'error' );
								}
								$this.closest( '.wpmozo_panel_licensefield' ).find( '.wpmozo_panel_license_response' ).text( response.message );
							},
							error: function (test) {
								alert( 'Oops!! Something went wrong!! Try later!' );
							}
						}
					);
				}
			);

		}
	);

})( jQuery );
