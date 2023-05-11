<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @since      1.0.0
 * @author     Elicus <hello@elicus.com>
 * @copyright   2023 Elicus Technologies Private Limited
 */

class WPMOZO_Instagram_For_Elementor_Admin {

	/**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string
     */
    private $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string
     */
    private $plugin_version;

    /**
     * Plugin Basename.
     *
     * @since 	 1.0.0
     * @access   private
     * @var 	 string
     */
	private $plugin_basename;

	/**
     * Plugin Option.
     *
     * @since 	 1.0.0
     * @access   private
     * @var 	 string
     */
	private $plugin_option;

    /**
     * Setting page title.
     * 
     * @since 	 1.0.0
     * @access 	 private
     * @var 	 string
     */
    private $page_title;

    /**
     * Admin menu title.
     *
     * @since 	 1.0.0
     * @access   private
     * @var 	 string
     */
    private $menu_title;

    /**
     * Settings page slug.
     *
     * @since 	 1.0.0
     * @access   private
     * @var 	 string
     */
    private $menu_slug;
    
    /**
     * Plugin option page hook.
     *
     * @since 	 1.0.0
     * @access   private
     * @var 	 string
     */
	private $hook_suffix;

	/**
     * Metadata Url.
     *
     * @since 	 1.0.0
     * @access   private
     * @var 	 string
     */
	private $metadata_url;

	/**
     * Plugin Upgrade Transient.
     *
     * @since 	 1.0.0
     * @access   private
     * @var 	 string
     */
	private $upgrade_transient;	

	/**
     * Last checked update.
     *
     * @since 	 1.0.0
     * @access   private
     * @var 	 string
     */
	private $last_checked;

	/**
     * Last checked update option.
     *
     * @since 	 1.6.6
     * @access   private
     * @var 	 string
     */
	private $last_checked_option;

	/**
     * Flag to check whether if this plugin is being updated.
     *
     * @since 	 1.0.0
     * @access   protected
     * @var 	 string
     */
	private $upgrading_this_plugin;

	/**
     * Settings Class Object.
     *
     * @since 	 1.0.0
     * @access   private
     * @var 	 Object
     */
	private $settings;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $settings ) {
		$this->page_title				= esc_html__( 'WPMozo Instagram For Elementor', 'wpmozo-instagram-for-elementor' );
        $this->menu_title   			= esc_html__( 'WPMozo Instagram', 'wpmozo-instagram-for-elementor' );
        $this->menu_slug    			= WPMOZO_INSTAGRAM_FOR_ELEMENTOR_SLUG;
        $this->plugin_name 				= WPMOZO_INSTAGRAM_FOR_ELEMENTOR_SLUG;
		$this->plugin_version 			= WPMOZO_INSTAGRAM_FOR_ELEMENTOR_VERSION;
        $this->plugin_option 			= WPMOZO_INSTAGRAM_FOR_ELEMENTOR_OPTION;
        $this->plugin_basename			= WPMOZO_INSTAGRAM_FOR_ELEMENTOR_BASENAME;
        $this->last_checked_option 		= 'WPMOZO_INSTAGRAM_FOR_ELEMENTOR_last_checked';
        $this->upgrade_transient    	= 'upgrade_WPMOZO_INSTAGRAM_FOR_ELEMENTOR';
        $this->metadata_url 			= 'https://cdn.wpmozo.com';
        $this->last_checked 			= get_site_option( $this->last_checked_option, 0 );
        $this->settings 				= $settings;
        $this->upgrading_this_plugin 	= false;
	}

	/**
	 * Check for minimum requirements of the plugin
	 *
	 * @since    1.0.0
	 */
	public function init() {
		// Check if Elementor installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
            return;
        }

        // Check for required Elementor version
   //     if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
     //       add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
        //    return;
       // }

        // Check for required PHP version
        //if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
          //  add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
            //return;
        //}
	}

	/**
     * Admin notice
     *
     * Warning when the site doesn't have Elementor installed or activated.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_missing_main_plugin() {

        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'wpmozo-instagram-for-elementor' ),
            '<strong>' . esc_html__( 'WPMozo Masonry Gallery For Elementor', 'wpmozo-instagram-for-elementor' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'wpmozo-instagram-for-elementor' ) . '</strong>'
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required Elementor version.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_minimum_elementor_version() {

        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'wpmozo-instagram-for-elementor' ),
            '<strong>' . esc_html__( 'WPMozo Masonry Gallery For Elementor', 'wpmozo-instagram-for-elementor' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'wpmozo-instagram-for-elementor' ) . '</strong>',
             self::MINIMUM_ELEMENTOR_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required PHP version.
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function admin_notice_minimum_php_version() {

        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = sprintf(
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'wpmozo-instagram-for-elementor' ),
            '<strong>' . esc_html__( 'WPMozo Masonry Gallery For Elementor', 'wpmozo-instagram-for-elementor' ) . '</strong>',
            '<strong>' . esc_html__( 'PHP', 'wpmozo-instagram-for-elementor' ) . '</strong>',
             self::MINIMUM_PHP_VERSION
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

    }

	/**
	 * Register the admin menu for the plugin.
	 *
	 * @since    1.0.0
	 */
	public function admin_menu() {
		$this->hook_suffix = add_menu_page( $this->page_title, $this->menu_title, 'manage_options', $this->menu_slug,  array( $this, 'plugin_settings' ), 'dashicons-layout', 85 );
	}
	
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles( $hook_suffix ) {

		if ( $hook_suffix === $this->hook_suffix ) {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/css/admin.css', array(), $this->plugin_version );
		}

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts( $hook_suffix ) {

		if ( $hook_suffix === $this->hook_suffix ) {
			$nonce = wp_create_nonce( $this->plugin_name . '-admin-nonce' );
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'assets/js/admin.js', array( 'jquery' ), $this->plugin_version, false );
			wp_localize_script( $this->plugin_name, 'admin_ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'ajax_nonce' => $nonce ) );
		}

	}

	/**
	 * Display settings in the admin area.
	 *
	 * @since    1.0.0
	 */
	public function plugin_settings() {
		?>
            <div class="wpmozo_panel_wrapper">
            	<div class="wpmozo_panel_header">
            		<div class="wpmozo_panel_logo">
            			<img src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/images/elicus-logo.png'; ?>" />
            		</div>
            		<h1 class="wpmozo_panel_title"><?php echo $this->page_title; ?></h1>
            		<ul class="wpmozo_panel_menu">
            			<li class="wpmozo_panel_menu_item wpmozo_panel_active_menu_item" data-href="#wpmozo_panel_license_section"><?php echo esc_html__( 'License', 'wpmozo-instagram-for-elementor' ); ?></li>
            		</ul>
            	</div>
            	<div class="wpmozo_panel_section_wrapper" >
            		<?php include_once plugin_dir_path( __FILE__ ) . 'partials/admin-display.php'; ?>
            		<div class="wpmozo_panel_ajax_processor wpmozo_panel_loader">
            			<div class="wpmozo_panel_processor"></div>
            		</div>
            	</div>
            </div>
        <?php
	}

	/**
	 * Save settings in the database.
	 *
	 * @since    1.0.0
	 */
	public function save_options() {
		$nonce = $this->plugin_name . '-admin-nonce';
		check_ajax_referer( $nonce, 'security', true );

		$options 		= isset( $_POST['options'] ) ? $_POST['options'] : array();
		$plugin_option 	= get_site_option( $this->plugin_option, array() );

		if ( is_array( $options ) && ! empty( $options ) ) {
			foreach( $options as $option ){
	            $name   = sanitize_text_field( $option['name'] );
	            $value  = sanitize_text_field( $option['value'] );
	            if ( '' === $value && isset( $plugin_option[ $name ] ) ) {
	                unset( $plugin_option[ $name ] );
	            } else {
	                $plugin_option[ $name ] = $value;
	            }
	        }
		}
		
        update_site_option( $this->plugin_option, $plugin_option );
       	echo 'success';
        exit;
	}

	/**
	 * Activate license for the plugin.
	 *
	 * @since    1.0.0
	 */
	public function activate_license() {
		$nonce = $this->plugin_name . '-admin-nonce';
		check_ajax_referer( $nonce, 'security', true );

		$license_key  = isset( $_POST['license_key'] ) ? sanitize_text_field( $_POST['license_key'] ) : '';

		if ( '' === $license_key ) {
			wp_send_json(
				array(
					'success' => false,
					'message' => esc_html__( 'Key must not be empty', 'wpmozo-instagram-for-elementor' ),
				)
			);
			exit;
		}

		global $wp_version;
 		$params	= array(
 		    'timeout'    => ( ( defined('DOING_CRON') && DOING_CRON ) ? 30 : 5 ),
    		'user-agent' => 'WordPress/' . $wp_version . ';' . home_url( '/' ),
           	'body'       => array(
                'action'		=> 'activate',
                'slug'			=> $this->plugin_name,
                'license_key'	=> $license_key,
                'site_url' 		=> home_url( '/' ),
            )
		);
        $request = wp_safe_remote_post( $this->metadata_url, $params );
		if ( ! is_wp_error( $request ) ) {
		    $response = json_decode( wp_remote_retrieve_body( $request ) );
			if ( $response->success ) {
				$plugin_option 					= get_site_option( $this->plugin_option, array() );
				$plugin_option['license_key'] 	= $license_key;
				update_site_option( $this->plugin_option, $plugin_option );
				delete_site_transient( $this->upgrade_transient );
				wp_send_json(
					array(
						'success' => true,
						'message' => $response->message,
					)
				);
			} else {
			    wp_send_json(
					array(
						'success' => false,
						'message' => $response->message,
					)
				);
			}
		} else {
		    wp_send_json(
    			array(
    				'success' => false,
    				'message' => esc_html__( $request->get_error_message(), 'wpmozo-instagram-for-elementor' ),
    			)
    		);
		}
		exit;
	}

	/**
	 * Deactivate license for the plugin.
	 *
	 * @since    1.0.0
	 */
	public function deactivate_license() {
		$nonce = $this->plugin_name . '-admin-nonce';
		check_ajax_referer( $nonce, 'security', true );

		$license_key = isset( $_POST['license_key'] ) ? sanitize_text_field( $_POST['license_key'] ) : '';

		global $wp_version;
 		$params	= array(
 		    'timeout'    => ( ( defined('DOING_CRON') && DOING_CRON ) ? 30 : 5 ),
    		'user-agent' => 'WordPress/' . $wp_version . ';' . home_url( '/' ),
           	'body'       => array(
                'action'		=> 'deactivate',
                'slug'			=> $this->plugin_name,
                'license_key'	=> $license_key,
                'site_url' 		=> home_url( '/' ),
            )
		);
        $request = wp_safe_remote_post( $this->metadata_url, $params );
		if ( ! is_wp_error( $request ) ) {
		    $response = json_decode( wp_remote_retrieve_body( $request ) );
			if ( $response->success ) {
				$plugin_option = get_site_option( $this->plugin_option, array() );
				if ( isset( $plugin_option['license_key'] ) ) {
					unset( $plugin_option['license_key'] );
				}
				update_site_option( $this->plugin_option, $plugin_option );
				delete_site_transient( $this->upgrade_transient );
				wp_send_json(
					array(
						'success' => true,
						'message' => $response->message,
					)
				);
			} else {
			    wp_send_json(
					array(
						'success' => false,
						'message' => $response->message,
					)
				);
			}
		} else {
		    wp_send_json(
    			array(
    				'success' => false,
    				'message' => esc_html__( $request->get_error_message(), 'wpmozo-instagram-for-elementor' ),
    			)
    		);
		}
        exit;
	}

	/**
	 * Set the upgrading_this_plugin flag if this plugin is about to upgrade
	 *
	 * @since    1.0.0
	 */
	public function check_upgrading_product( $options ) {
		if ( ! isset( $options['hook_extra'] ) ) {
			return $options;
		}

		// set the upgrading_this_plugin flag if this plugin is about to upgrade
		if ( isset( $options['hook_extra']['plugin'] ) && $this->plugin_basename === $options['hook_extra']['plugin'] ) {
			$this->upgrading_this_plugin = true;
		}

		return $options;
	}

	/**
	 * Show the error message when no package was found to download
	 *
	 * @since    1.0.0
	 */
	public function update_error_message( $reply, $package, $upgrader, $hook_extra = array() ) {
		if ( ! $this->upgrading_this_plugin ) {
			return $reply;
		}

		// reset the upgrading_this_plugin flag
		$this->upgrading_this_plugin = false;

		if ( ! empty( $package ) ) {
			return $reply;
		}
		
		$error_message = '<em>To update plugins, authenticate your license by entering the License Key in the License Tab of plugin settings. You could find the License Key in your WPMozo account. Check our website for more information. Double-check License Key for errors if issues arise.</em>';
		// output custom error message for WPMozo Products if package is empty

		return new WP_Error( 'no_package', $error_message );
	}

	/**
	 * Check for updates.
	 *
	 * @since    1.0.0
	 */
	public function check_update( $transient ) {
	    
	    if ( ! isset( $transient->response ) ) {
			return $transient;
		}
	  
		$response = get_site_transient( $this->upgrade_transient );
		
		if ( $response && ! isset( $transient->response[$this->plugin_basename] ) ) {
			$transient->response[$this->plugin_basename] = $response;
			return $transient;
		}

		if ( current_user_can( 'update_plugins' ) && 
			( 
				( false === $response && ( ( time() - $this->last_checked ) > 43200 ) ) || 
			  	( false === $response && isset( $_REQUEST['force-check'] ) && $_REQUEST['force-check'] == '1' )
			)
		) {
			global $wp_version;
			
			$plugin_option  = get_site_option( $this->plugin_option, array() );
			$license_key    = isset( $plugin_option['license_key'] ) ? sanitize_text_field( $plugin_option['license_key'] ) : '';
			
			$params	= array(
			    'timeout'    => ( ( defined('DOING_CRON') && DOING_CRON ) ? 30 : 5 ),
        		'user-agent' => 'WordPress/' . $wp_version . ';' . home_url( '/' ),
               	'body'       => array(
                    'action'		=> 'update',
                    'slug'			=> sanitize_text_field( $this->plugin_name ),
                    'license_key'	=> $license_key,
                    'site_url' 		=> home_url( '/' ),
                )
			);

            $request = wp_safe_remote_post( $this->metadata_url, $params );
	 		if ( ! is_wp_error( $request ) ) {
	 			$response = maybe_unserialize( wp_remote_retrieve_body( $request ) );
				if ( $response && version_compare( $this->plugin_version, $response->new_version, '<' ) ) {
				    $transient->response[$response->plugin] = $response;
				    set_site_transient( $this->upgrade_transient, $response, 43200 ); // 12 hours cache
				}
			}
			
		    update_site_option( $this->last_checked_option, time() );
			$this->last_checked = time();
		}

        return $transient;
	}
	
	public function append_custom_notification( $plugin_data, $response ) {
		if ( empty( $response ) ) {
			$package_available = false;
		} else {
			// for themes response is array for plugins - object, so check the format of data to get the correct results
			$package_available = is_array( $response ) ? ! empty( $response['package'] ) : ! empty( $response->package );
		}

		if ( $package_available ) {
			return;
		}

		$message = '</p><p>To receive updates for WPMozo products, authenticate your subscription via the License tab in your plugin settings. Ensure that your License Key is entered correctly to enable updates.';
		echo $message;
	}

	/**
	 * Display metadata in popup.
	 *
	 * @since    1.0.0
	 */
	public function check_info( $res, $action, $args ) {
		
		// do nothing if this is not about getting plugin information
		if ( 'plugin_information' !== $action ) {
			return $res;
		}
	 
		// do nothing if it is not our plugin	
		if ( $this->plugin_name !== $args->slug ) {
			return $res;
		}
	 
		$response = get_site_transient( $this->upgrade_transient );
	 	
		if ( $response && current_user_can( 'update_plugins' ) ) {
			if ( version_compare( $this->plugin_version, $response->new_version, '<' ) ) {
				$metadata 					= $response;
				$metadata->download_link 	= $response->package;
	        	return $metadata;
	        }
		}
	 
		return $res;
	}

	/**
	 * Delete transient
	 *
	 * @since    1.0.0
	 */
	public function delete_update_transient( $transient_name ) {
	    
	    $update_transients_names = array(
			'update_plugins' => $this->upgrade_transient,
		);

		if ( empty( $update_transients_names[ $transient_name ] ) ) {
			return;
		}

		delete_site_transient( $this->upgrade_transient );
	
	}

}
