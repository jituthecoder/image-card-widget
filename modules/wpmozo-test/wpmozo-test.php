<?php
/**
 * @author      Elicus <hello@elicus.com>
 * @link        https://www.elicus.com/
 * @copyright   2022 Elicus Technologies Private Limited
 * @version     1.0.0
 */

// if this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use \Elementor\Utils;
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;

class WPMOZO_Test extends Widget_Base {

		/**
		 * Get widget name.
		 *
		 * Retrieve widget name.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @return string Widget name.
		 */
	public function get_name() {
		return 'wpmozo_test';
	}

		/**
		 * Get widget title.
		 *
		 * Retrieve widget title.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @return string Widget title.
		 */
	public function get_title() {
		return esc_html__( 'Test', 'wpmozo-widgets-for-elementor' );
	}

		/**
		 * Get widget icon.
		 *
		 * Retrieve widget icon.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @return string Widget icon.
		 */
	public function get_icon() {
		return 'eicon-instagram-post';
	}

		/**
		 * Get widget categories.
		 *
		 * Retrieve the list of categories the widget belongs to.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @return array Widget categories.
		 */
	public function get_categories() {
		return array( 'wpmozo' );
	}

		/**
		 * Define Dependencies.
		 *
		 * Define the CSS files required to run the widget.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @return style handle.
		 */
//	public function get_style_depends() {

		/*wp_register_style( 'wpmozo-instagram-feed-style', plugins_url( 'assets/css/style.min.css', __FILE__ ) );
		return array( 'wpmozo-instagram-feed-style' );*/
//	}

		/**
		 * Get script dependencies.
		 *
		 * Retrieve the list of script dependencies the element requires.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @return array Element scripts dependencies.
		 */
//	public function get_script_depends() {
	/*	wp_register_script( 'wpmozo-instagram-feed-script', plugins_url( 'assets/js/instagram_feed_custom_script.min.js', __FILE__ ), array( 'jquery' ), WPMOZO_INSTAGRAM_FOR_ELEMENTOR_VERSION, false );

		wp_register_script( 'isotope-script', plugins_url( 'assets/js/isotope.pkgd.min.js', __FILE__ ), array( 'jquery', 'imagesloaded' ), WPMOZO_INSTAGRAM_FOR_ELEMENTOR_VERSION, true );

		wp_register_script( 'images-loaded-script', plugins_url( 'assets/js/imagesloaded.pkgd.min.js', __FILE__ ), array( 'jquery' ), WPMOZO_INSTAGRAM_FOR_ELEMENTOR_VERSION, false );

		return array( 'images-loaded-script', 'isotope-script', 'wpmozo-instagram-feed-script' );*/
//	}

		/**
		 * Register widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 * @since 1.0.0
		 * @access protected
		 */
	protected function register_controls() {

		// Content tab starts here
		// Integration settings
		$this->start_controls_section(
			'data',
			array(
				'label' => esc_html__( 'Data', 'wpmozo-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
			$this->add_control(
				'test_field',
				array(
					'label'       => esc_html__( 'Test Field', 'wpmozo-widgets-for-elementor' ),
					'label_block' => true,
					'type'        => Controls_Manager::TEXT,
					'separator'   => 'before',
					'dynamic'     => array( 'active' => true ),
					'placeholder' => esc_html__( 'Enter Text', 'wpmozo-widgets-for-elementor' ),
				)
			);
		$this->end_controls_section();



		$this->start_controls_section(
			'content',
			array(
				'label' => esc_html__( 'Content', 'wpmozo-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
			$this->add_control(
				'test_field_1',
				array(
					'label'       => esc_html__( 'Test Field 1', 'wpmozo-widgets-for-elementor' ),
					'label_block' => true,
					'type'        => Controls_Manager::TEXTAREA,
					'separator'   => 'before',
					'dynamic'     => array( 'active' => true ),
					'placeholder' => esc_html__( 'Enter Text', 'wpmozo-widgets-for-elementor' ),
				)
			);
		$this->end_controls_section();
		$this->start_controls_section(
			'style',
			array(
				'label' => esc_html__( 'Style', 'wpmozo-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
			$this->add_control(
				'test_color',
				array(
					'label'       => esc_html__( 'Content color', 'wpmozo-widgets-for-elementor' ),
					'label_block' => true,
					'type'        => Controls_Manager::COLOR,
					'separator'   => 'before',
					// 'dynamic'     => array( 'active' => true ),
					'placeholder' => esc_html__( 'Enter Text', 'wpmozo-widgets-for-elementor' ),
				)
			);
		$this->end_controls_section();
	}

		/**
		 * Render widget output on the frontend.
		 *
		 * Written in PHP and used to generate the final HTML.
		 *
		 * @since 1.0.0
		 * @access protected
		 */
	protected function render() {
		$settings 		= $this->get_settings_for_display();

		$output 		= $settings['test_field'];
		$output1 		= $settings['test_field_1'];
		$color 		= $settings['test_color'];

		echo   '<h1>'.$output.'</h1><p style="color:'.$color.'">'.$output1.'</p>';
	}

		/**
		 * Live widget output.
		 *
		 * @since 1.0.0
		 * @access protected
		 */
	protected function content_template() {}
}
