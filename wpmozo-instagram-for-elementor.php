<?php
/**
 * Plugin Name: WPMozo Instagram For Elementor
 * Plugin URI:  https://wpmozo.com
 * Description: Display Instagram Feeds on your website easily.
 * Version:     1.0.0
 * Author:      Elicus
 * Author URI:  https://elicus.com/
 * Update URI:  https://wpmozo.com/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wpmozo-instagram-for-elementor
 * Domain Path: /languages
 * Requires at least:   5.3
 * Tested up to:        5.9.3
 * Elementor tested up to: 3.6.2
 * Elementor Pro tested up to: 3.6.4
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define( 'WPMOZO_INSTAGRAM_FOR_ELEMENTOR_SLUG', 'wpmozo-instagram-for-elementor' );
define( 'WPMOZO_INSTAGRAM_FOR_ELEMENTOR_VERSION', '1.0.0' );
define( 'WPMOZO_INSTAGRAM_FOR_ELEMENTOR_OPTION', 'wpmozo_instagram_for_elementor' );
define( 'WPMOZO_INSTAGRAM_FOR_ELEMENTOR_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'WPMOZO_INSTAGRAM_FOR_ELEMENTOR_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'WPMOZO_INSTAGRAM_FOR_ELEMENTOR_BASENAME', plugin_basename( __FILE__ ) );

require_once WPMOZO_INSTAGRAM_FOR_ELEMENTOR_DIR_PATH . 'includes/class-wpmozo-instagram-for-elementor.php';

function wpmozo_instagram_for_elementor() {

    $plugin = new WPMOZO_Instagram_For_Elementor();
    $plugin->run();

}
wpmozo_instagram_for_elementor();