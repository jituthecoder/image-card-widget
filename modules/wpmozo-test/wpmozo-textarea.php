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

class WPMOZO_Textarea extends Widget_Base{
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
		return 'wpmozo_textarea';
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
		return esc_html__( 'WPMOZO Textarea', 'wpmozo-widgets-for-elementor' );
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
		return 'eicon-text';
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
    protected function register_controls() {
		$this->start_controls_section(
			'content',
			array(
				'label' => esc_html__( 'Content', 'wpmozo-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
			$this->add_control(
				'wpmozo_textarea',
				array(
					'label'       => esc_html__( 'WPMOZO Textarea', 'wpmozo-widgets-for-elementor' ),
					'label_block' => true,
					'type'        => Controls_Manager::WYSIWYG,
					'separator'   => 'before',
					'dynamic'     => array( 'active' => true ),
					'placeholder' => esc_html__( 'Enter Text', 'wpmozo-widgets-for-elementor' ),
				)
			);
		$this->end_controls_section();		
	}

    protected function render() {
		$settings 		= $this->get_settings_for_display();
		$content 		= $settings['wpmozo_textarea'];		
        echo $content;
	}
		/**
		 * Live widget output.
		 *
		 * @since 1.0.0
		 * @access protected
		 */
	protected function content_template() {}
}