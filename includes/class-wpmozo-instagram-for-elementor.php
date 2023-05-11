<?php
/**
 * @author      Elicus Technologies <hello@elicus.com>
 * @link        https://www.elicus.com/
 * @copyright   2023 Elicus Technologies Private Limited
 * @version     1.0.0
 */


class WPMOZO_Instagram_For_Elementor {

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      Object    $loader    Maintains and registers all hooks for the plugin.
     */
    private $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name = WPMOZO_INSTAGRAM_FOR_ELEMENTOR_SLUG;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $plugin_version = WPMOZO_INSTAGRAM_FOR_ELEMENTOR_VERSION;

    /**
     * Plugin option name.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_option    The plugin option name where all the settings are stored.
     */
    protected $plugin_option = WPMOZO_INSTAGRAM_FOR_ELEMENTOR_OPTION;

    /**
     * Minimum Elementor Version
     *
     * @since 1.0.0
     *
     * @var string Minimum Elementor version required to run the plugin.
     */
    const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

    /**
     * Minimum PHP Version
     *
     * @since 1.0.0
     *
     * @var string Minimum PHP version required to run the plugin.
     */
    const MINIMUM_PHP_VERSION = '5.6';


    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct() {

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();

    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - WPMOZO_INSTAGRAM_For_Elementor_Loader. Orchestrates the hooks of the plugin.
     * - WPMOZO_INSTAGRAM_For_Elementor_i18n. Defines internationalization functionality.
     * - WPMOZO_INSTAGRAM_For_Elementor_Admin. Defines all hooks for the admin area.
     * - WPMOZO_INSTAGRAM_For_Elementor_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies() {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wpmozo-instagram-for-elementor-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wpmozo-instagram-for-elementor-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wpmozo-instagram-for-elementor-admin.php';

        /**
         * The class responsible for defining all settings that occur on the settings page in the admin area.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/settings/class-wpmozo-instagram-for-elementor-settings.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing side of the site.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wpmozo-instagram-for-elementor-public.php';

        $this->loader = new WPMOZO_Instagram_For_Elementor_Loader();

    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the WPMOZO_INSTAGRAM_For_Elementor_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale() {

        $plugin_i18n = new WPMOZO_Instagram_For_Elementor_i18n();

        $this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

    }


    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks() {
        global $wp_version;

        $settings       = new WPMOZO_Instagram_For_Elementor_Settings( $this->get_plugin_option() );
        $plugin_admin   = new WPMOZO_Instagram_For_Elementor_Admin( $settings );
        $action_hook    = 'in_plugin_update_message-' . WPMOZO_INSTAGRAM_FOR_ELEMENTOR_BASENAME;

        $this->loader->add_action( 'plugins_loaded', $plugin_admin, 'init' );
        $this->loader->add_action( 'admin_menu', $plugin_admin, 'admin_menu' );
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
        $this->loader->add_action( 'wp_ajax_wpmozo_panel_activate_license', $plugin_admin, 'activate_license' );
        $this->loader->add_action( 'wp_ajax_wpmozo_panel_deactivate_license', $plugin_admin, 'deactivate_license' );
        $this->loader->add_filter( 'upgrader_package_options', $plugin_admin, 'check_upgrading_product' );
        if ( version_compare( $wp_version, '5.5.0', '>=' ) ) {
            $this->loader->add_filter( 'upgrader_pre_download', $plugin_admin, 'update_error_message', 20, 4 );
        } else {
            $this->loader->add_filter( 'upgrader_pre_download', $plugin_admin, 'update_error_message', 20, 3 );
        }
        $this->loader->add_action( $action_hook, $plugin_admin, 'append_custom_notification', 10, 2 );
        $this->loader->add_action( 'delete_site_transient', $plugin_admin, 'delete_update_transient' );
        $this->loader->add_filter( 'pre_set_site_transient_update_plugins', $plugin_admin, 'check_update' );
        $this->loader->add_filter( 'plugins_api', $plugin_admin, 'check_info', 10, 3 );

    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks() {

        $plugin_public = new WPMOZO_Instagram_For_Elementor_Public();
        $this->loader->add_action( 'elementor/init', $plugin_public, 'init' );
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run() {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name() {
        return $this->plugin_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     * @return    WPMOZO_INSTAGRAM_For_Elementor_Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader() {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_plugin_version() {
        return $this->plugin_version;
    }

    /**
     * Retrieve the option name of the plugin.
     *
     * @since     1.0.0
     * @return    string    The option name of the plugin.
     */
    public function get_plugin_option() {
        return $this->plugin_option;
    }
}