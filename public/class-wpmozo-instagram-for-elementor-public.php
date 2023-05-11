<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @since      1.0.0
 * @author     Elicus <hello@elicus.com>
 */
class WPMOZO_Instagram_For_Elementor_Public {

    public function init() {
        add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );
        add_action( 'elementor/widgets/register', [ $this, 'register_oembed_widget' ] );
    }

    public function add_elementor_widget_categories( $elements_manager ) {
        $elements_manager->add_category(
            'wpmozo',
            [
                'title' => esc_html__( 'WP Mozo', 'wpmozo-instagram-feed-for-elementor' ),
                'icon' => 'fa fa-plug',
            ]
        );
    }

    public function register_oembed_widget( $widgets_manager ) {

        require_once( plugin_dir_path( __DIR__ )  . '/modules/wpmozo-instagram/wpmozo-instagram.php' );
        $widgets_manager->register(new \WPMOZO_Instagram());

    }

}
