<?php
/**
 * @author      Elicus <hello@elicus.com>
 * @link        https://www.elicus.com/
 * @copyright   2022 Elicus Technologies Private Limited
 * @version     1.0.0
 */

//if this file is called directly, abort.
if( !defined( 'ABSPATH' ) ) {
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

class WPMOZO_Instagram extends Widget_Base {

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
			return 'wpmozo_instagram';
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
			return esc_html__( 'Instagram', 'wpmozo-widgets-for-elementor' );
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
		
		public function get_style_depends() {

			wp_register_style( 'wpmozo-instagram-feed-style', plugins_url( 'assets/css/style.min.css', __FILE__ ) );
			return array( 'wpmozo-instagram-feed-style' );
		}
		
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
	    
	    public function get_script_depends() {
			wp_register_script( 'wpmozo-instagram-feed-script', plugins_url( 'assets/js/instagram_feed_custom_script.min.js', __FILE__ ), array( 'jquery' ), WPMOZO_INSTAGRAM_FOR_ELEMENTOR_VERSION, false );
			
			wp_register_script( 'isotope-script', plugins_url( 'assets/js/isotope.pkgd.min.js', __FILE__ ), array( 'jquery' , 'imagesloaded' ), WPMOZO_INSTAGRAM_FOR_ELEMENTOR_VERSION, true );
			
			wp_register_script( 'images-loaded-script', plugins_url( 'assets/js/imagesloaded.pkgd.min.js', __FILE__ ), array( 'jquery' ), WPMOZO_INSTAGRAM_FOR_ELEMENTOR_VERSION, false );
			
			return array( 'images-loaded-script', 'isotope-script', 'wpmozo-instagram-feed-script'  );	
		}

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
			$this->start_controls_section( 'instagram_integration_settings',
				array(
					'label' => esc_html__( 'Instagram Integration', 'wpmozo-widgets-for-elementor' ),
					'tab'   => Controls_Manager::TAB_CONTENT,
				)
			);

			$this->add_control( 'instagram_token',
				array(
					'label'        	=> esc_html__( 'Access Token', 'wpmozo-widgets-for-elementor' ),
					'label_block'  	=> true,
					'type'         	=> Controls_Manager::TEXT,
					'separator'	    => 'before',
					'dynamic'       => array( 'active' => true ),
					'placeholder'   => esc_html__( 'Enter Access Token', 'wpmozo-widgets-for-elementor' ),
				)
			);

			$this->add_control( 'cache',
				array(
					'label'   => esc_html__( 'Cache (In Minutes)', 'wpmozo-widgets-for-elementor' ),
					'type'    => \Elementor\Controls_Manager::NUMBER,
					'min'     => 0,
					'step'    => 1,
					'default' => 60,
				)
			);
			

			$this->end_controls_section();

			// Display settings
			$this->start_controls_section( 'instagram_display_settings',
				array(
					'label' => esc_html__( 'Display', 'wpmozo-widgets-for-elementor' ),
					'tab'   => Controls_Manager::TAB_CONTENT,
				)
			);

			$this->add_control( 'image_count',
				array(
					'label'   => esc_html__( 'Number of Posts', 'wpmozo-widgets-for-elementor' ),
					'type'    => \Elementor\Controls_Manager::NUMBER,
					'min'     => 1,
					'max'     => 200,
					'step'    => 1,
					'default' => 20,
				)
			);

			$this->add_control( 'link_image',
				array(
					'label'        => esc_html__( 'Link Post to Instagram', 'wpmozo-widgets-for-elementor' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_off'    => esc_html__( 'NO', 'wpmozo-widgets-for-elementor' ),
					'label_on'     => esc_html__( 'YES', 'wpmozo-widgets-for-elementor' ),
					'return_value' => 'yes',//return value when the switch is on
					'default'      => 'no',
					'selectors_dictionary' 	=> array(
						'yes' 	=> 'yes',
						'' 		=> 'no',
					),
				)
			);

			$this->add_control( 'display_caption',
				array(
					'label'        => esc_html__( 'Display Caption', 'wpmozo-widgets-for-elementor' ),
					'separator'		=> 'before',
					'type'         => Controls_Manager::SWITCHER,
					'label_off'    => esc_html__( 'NO', 'wpmozo-widgets-for-elementor' ),
					'label_on'     => esc_html__( 'YES', 'wpmozo-widgets-for-elementor' ),
					'return_value' => 'yes',//return value when the switch is on
					'default'      => 'no',
					'selectors_dictionary' 	=> array(
						'yes' 	=> 'yes',
						'' 		=> 'no',
					),
				)
			);

			$this->add_control( 'display_button',
				array(
					'label'        => esc_html__( 'Display Button', 'wpmozo-widgets-for-elementor' ),
					'separator'	   => 'before',
					'type'         => Controls_Manager::SWITCHER,
					'label_off'    => esc_html__( 'NO', 'wpmozo-widgets-for-elementor' ),
					'label_on'     => esc_html__( 'YES', 'wpmozo-widgets-for-elementor' ),
					'return_value' => 'yes',//return value when the switch is on
					'default'      => 'no',
					'selectors_dictionary' 	=> array(
						'yes' 	=> 'yes',
						'' 	    => 'no',
					),
				)
			);

			$this->add_control( 'button_text',
				array(
					'label'        => esc_html__( 'Button Text', 'wpmozo-widgets-for-elementor' ),
					'label_block'  => true,
					'type'         => Controls_Manager::TEXT,
					'dynamic'      => array( 'active' => true ),
					'placeholder'  => 'Enter Button Text Here',
					'default'      => esc_html__( 'Follow Now', 'wpmozo-widgets-for-elementor' ),
					'condition'    => array( 'display_button' => 'yes' ),
				)
			);

			$this->add_control( 'button_icon',
				array(
					'label'            => esc_html__( 'Button Icon', 'wpmozo-widgets-for-elementor' ),
					'type'             => Controls_Manager::ICONS,
					'fa4compatibility' => 'button_icon_old',
					'default'          => array(
						'value'   => 'fab fa-instagram',
						'library' => 'fa-solid',
					),
					'condition'    => array( 'display_button' => 'yes' ),
				)
			);

			$this->add_control( 'button_icon_position',
				array(
					'label'     => esc_html__( 'Button Icon Position', 'wpmozo-widgets-for-elementor' ),
					'type'      => Controls_Manager::CHOOSE,
					'options'   => array(
						'before' => array(
							'title' => esc_html__( 'Before', 'wpmozo-widgets-for-elementor' ),
							'icon'  => 'eicon-angle-left',
						),
						'after' => array(
							'title' => esc_html__( 'After', 'wpmozo-widgets-for-elementor' ),
							'icon'  => 'eicon-angle-right',
						)
					),
					'default'   => 'after',
					'toggle'    => false, 
					'condition' => array( 'button_icon[value]!' => '', 'display_button' => 'yes' ),
				)
			);

			$this->add_control( 'show_icon_on_hover_switcher_before',
				array(
					'label'        => esc_html__( 'Show Icon On Hover', 'wpmozo-widgets-for-elementor' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_off'    => esc_html__( 'NO', 'wpmozo-widgets-for-elementor' ),
					'label_on'     => esc_html__( 'YES', 'wpmozo-widgets-for-elementor' ),
					'return_value' => 'yes',
					'default'      => '',
					'selectors'    => array(
						'{{WRAPPER}} .wpmozo_instagram_button_icon, {{WRAPPER}} .wpmozo_instagram_button_wrapper_inner svg' => 'opacity:0; transition:opacity 300ms;',
						'{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner .wpmozo_instagram_button' => 'margin-left:-{{button_font_size.SIZE}}{{button_font_size.UNIT}}; margin-right: calc( calc( {{button_font_size.SIZE}}{{button_font_size.UNIT}} / 2 ) - 5% );',
						'{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner:hover .wpmozo_instagram_button_icon, {{WRAPPER}} .wpmozo_instagram_button_wrapper_inner:hover svg' => 'opacity:1;',
						'{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner:hover .wpmozo_instagram_button' => ' margin-left:0;'
					),
					'condition'    => array(
						'button_icon_position' => 'before',
						'button_icon[value]!'  => '',
						'display_button'       => 'yes'
					)
				)
			);

			$this->add_control( 'show_icon_on_hover_switcher_after',
				array(
					'label'        => esc_html__( 'Show Icon On Hover', 'wpmozo-widgets-for-elementor' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_off'    => esc_html__( 'NO', 'wpmozo-widgets-for-elementor' ),
					'label_on'     => esc_html__( 'YES', 'wpmozo-widgets-for-elementor' ),
					'return_value' => 'yes',
					'default'      => '',
					'selectors'    => array(
						'{{WRAPPER}} .wpmozo_instagram_button_icon, {{WRAPPER}} .wpmozo_instagram_button_wrapper_inner svg' => 'opacity:0; transition:opacity 300ms;',
						'{{WRAPPER}} .wpmozo_instagram_button' => 'margin-right:-{{button_font_size.SIZE}}{{button_font_size.UNIT}}; margin-left: calc( calc( {{button_font_size.SIZE}}{{button_font_size.UNIT}} / 2 ) - 5% );',
						'{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner:hover .wpmozo_instagram_button_icon, {{WRAPPER}} .wpmozo_instagram_button_wrapper_inner:hover svg' => 'opacity:1;',
						'{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner:hover .wpmozo_instagram_button' => ' margin-right:0;'
					),
					'condition'    => array(
						'button_icon_position' => 'after',
						'button_icon[value]!'  => '',
						'display_button'       => 'yes'
					)
				)
			);	

			$this->end_controls_section();

			// Style tab.
			// Layout styling.
			$this->start_controls_section( 'instagram_layout_settings',
				array(
					'label' => esc_html__( 'Layout', 'wpmozo-widgets-for-elementor' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				)
			);

			$this->add_control( 'select_layout',
				array(
					'label'         => esc_html__( 'Layout', 'wpmozo-widgets-for-elementor' ),
					'label_block'   => false,
					'type'          => Controls_Manager::SELECT,
					'options'       => array(
						'_grid'      => esc_html__( 'Grid', 'wpmozo-widgets-for-elementor' ),
						'_masonry'   => esc_html__( 'Masonry', 'wpmozo-widgets-for-elementor' ),
					),
					'default'       => '_grid',
				)
			);

			

			$this->add_control( 'column_count',
				array(
					'label'         => esc_html__( 'Number Of Columns', 'wpmozo-widgets-for-elementor' ),
					'label_block'   => false,
					'type'          => Controls_Manager::SELECT,
					'options'       => array(
						2   => esc_html__( '2', 'wpmozo-widgets-for-elementor' ),
						3   => esc_html__( '3', 'wpmozo-widgets-for-elementor' ),
						4   => esc_html__( '4', 'wpmozo-widgets-for-elementor' ),
						5   => esc_html__( '5', 'wpmozo-widgets-for-elementor' ),
						6   => esc_html__( '6', 'wpmozo-widgets-for-elementor' ),
					),
					'default'       => 4,
				)
			);

			$this->add_responsive_control( 'column_spacing',
				array(
					'label' => esc_html__( 'Column Spacing', 'wpmozo-widgets-for-elementor' ),
					'type'  => \Elementor\Controls_Manager::SLIDER,
					'range' => array(
						'px' => array(
							'min' => 0,
							'max' => 100,
							'step' => 1,
						),
						'%' => array(
							'min' => 0,
							'max' => 200,
						),
						'vw' => array(
							'min' => 0,
							'max' => 200,
						),
						'vh' => array(
							'min' => 0,
							'max' => 200,
						),
					),
					'default' => array(
						'size' => 5,
						'unit' => 'px',
					),
					'size_units' => array( 'px', '%', 'vw', 'vh' ),
					'condition'  => array( 'select_layout' => '_masonry' )
				)
			);
			

			$this->end_controls_section();

			// Caption styling
			$this->start_controls_section( 'caption_styling_section',
				array(
					'label' => esc_html__( 'Caption', 'wpmozo-widgets-for-elementor' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				)
			);

			$this->start_controls_tabs( 'caption_normal_and_hover_state_control_tab'
			);

			// Tab 1
			$this->start_controls_tab( 'caption_normal_state_tab',
				array(
					'label' => esc_html__( 'Normal', 'wpmozo-widgets-for-elementor' ),
				)
			);

			// Settings for first tab
			$this->add_control( 'caption_text_color',
				array(
					'label'         => esc_html__( 'Text Color', 'wpmozo-widgets-for-elementor' ),
					'label_block'   => false,
					'type'          => Controls_Manager::COLOR,
					'default'   	=> '#222',
					'selectors'     => array( '{{WRAPPER}} .wpmozo_instagram_caption' => 'color: {{VALUE}};' ),
				)
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
				    'label'          => esc_html__( 'Caption Typography', 'wpmozo-widgets-for-elementor' ),
					'label_block'    => true,
					'name'           => 'caption_text_typography',
					'selector'       => '{{WRAPPER}} .wpmozo_instagram_caption',
					'fields_options' => array(
						'typography' => array( 
                            'default' =>'yes' 
                        ),
						'font_size' => array(
							'default' => array(
								'size' => 12,
								'unit' => 'px',
							)
						)
					)
				)
			);

			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				array(
					'name'		=> 'caption_text_shadow',
					'label'		=> esc_html__( 'Text Shadow', 'wpmozo-widgets-for-elementor' ),
					'selector'	=> '{{WRAPPER}} .wpmozo_instagram_caption',
					'separator'	=> 'before',
				)
			);

			$this->end_controls_tab();

			// Tab 2
			$this->start_controls_tab( 'caption_hover_state_tab',
				array(
					'label' => esc_html__( 'Hover', 'wpmozo-widgets-for-elementor' ),
				)
			);

			// Settings for second tab.
			$this->add_control( 'caption_text_hover_state_color',
				array(
					'label'         => esc_html__( 'Text Color', 'wpmozo-widgets-for-elementor' ),
					'label_block'   => false,
					'type'          => Controls_Manager::COLOR,
					'default'   	=> '',
					'selectors'     => array(
						'{{WRAPPER}} .wpmozo_instagram_image_inner_wrap:hover .wpmozo_instagram_caption' => 'color: {{VALUE}};',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
				    'label'         => esc_html__( 'Caption Typography', 'wpmozo-widgets-for-elementor' ),
					'label_block'   => true,
					'name'          => 'caption_text_hover_state_typography',
					'selector'      => '{{WRAPPER}} .wpmozo_instagram_image_inner_wrap:hover .wpmozo_instagram_caption',
				)
			);

			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				array(
					'name'		=> 'caption_text_hover_state_shadow',
					'label'		=> esc_html__( 'Text Shadow', 'wpmozo-widgets-for-elementor' ),
					'selector'	=> '{{WRAPPER}} .wpmozo_instagram_image_inner_wrap:hover .wpmozo_instagram_caption',
					'separator'	=> 'before',
				)
			);

			$this->add_responsive_control( 'caption_transition_duration',
				array(
					'type'      => Controls_Manager::SLIDER,
					'label'     => esc_html__( 'Transition Duration (ms) ', 'wpmozo-widgets-for-elementor' ),
					'range'     => array(
						'ms' => array(
							'min'  => 0,
							'max'  => 10000,
							'step' =>100,
						),
					),
					'default'   => array(
						'size' => 300,
						'unit' => 'ms',
					),
					'selectors' => array(
						'{{WRAPPER}} .wpmozo_instagram_caption' => 'transition: all {{SIZE}}{{UNIT}};',
					),
				)
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_control( 'caption_text_alignment',
				array(
					'label'         => esc_html__( 'Caption Alignment', 'wpmozo-widgets-for-elementor' ),
					'type'          => Controls_Manager::CHOOSE,
					'label_block'   => true,
					'options'       => array(
						'left'   => array(
							'caption' => esc_html__( 'Left', 'wpmozo-widgets-for-elementor' ),
							'icon'    => 'eicon-text-align-left',
						),
						'center' => array(
							'caption' => esc_html__( 'Center', 'wpmozo-widgets-for-elementor' ),
							'icon'    => 'eicon-text-align-center',
									),
						'right'  => array(
							'caption' => esc_html__( 'Right', 'wpmozo-widgets-for-elementor' ),
							'icon'    => 'eicon-text-align-right',
						),
					),
					'default'       => is_rtl() ? 'right' : 'left',
					'toggle'        => true, 
					'separator'	    => 'before',
					'selectors'     => array( '{{WRAPPER}} .wpmozo_instagram_caption' => 'text-align: {{VALUE}};' ),
				)
			);

			$this->add_control( 'caption_padding_margin_heading',
				array(
					'label'        => esc_html__( 'Padding and Margin', 'wpmozo-widgets-for-elementor' ),
					'type'         => Controls_Manager::HEADING,
					
				)
			);

			$this->start_controls_tabs( 'caption_padding_margin_control_tabs',
			);

			// Tab 1
			$this->start_controls_tab( 'caption_padding_tab',
				array(
					'label' => esc_html__( 'Padding', 'wpmozo-widgets-for-elementor' ),
				)
			);

			// Settings for first tab
			$this->add_responsive_control( 'caption_padding',
				array(
					'label'      => esc_html__( 'Padding', 'wpmozo-widgets-for-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', 'em', '%' ),
					'default'    => array( 'top'=>5,'right'=>5,'bottom'=>5,'left'=>5 ),
					'selectors'  => array(
						'{{WRAPPER}} .wpmozo_instagram_caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->end_controls_tab();

			// Tab 2
			$this->start_controls_tab( 'caption_margin_tab',
				array(
					'label' => esc_html__( 'Margin', 'wpmozo-widgets-for-elementor' ),
				)
			);

			// Settings for second tab
			$this->add_responsive_control( 'caption_margin',
				array(
					'label'			=> esc_html__( 'Margin', 'wpmozo-widgets-for-elementor' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units'	=> array( 'px', 'em', '%' ),
					'default'       => array( 'top'=>0,'right'=>0,'bottom'=>0,'left'=>0 ),
					'selectors' 	=> array(
						'{{WRAPPER}} .wpmozo_instagram_caption' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->end_controls_section();

			//Image styling
			$this->start_controls_section( 'post_styling_section',
				array(
					'label' => esc_html__( 'Post', 'wpmozo-widgets-for-elementor' ),
					'tab'   => Controls_Manager::TAB_STYLE,
				)
			);

			$this->add_responsive_control( 'image_rounded_corners',
				array(
					'label'       => esc_html__( 'Rounded Corners', 'wpmozo-widgets-for-elementor' ),
					'type'        => Controls_Manager::DIMENSIONS,
					'label_block' => true,
					'size_units'  => array( 'px', 'em', '%' ),
					'default'	  =>array( 'top'=>5, 'right'=>5, 'bottom'=>5, 'left'=>5 ),
					'selectors'   => array(
						'{{WRAPPER}} .wpmozo_instagram_image_inner_wrap .wpmozo_instagram_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'      => 'post_border',
					'selector'  => '{{WRAPPER}} .wpmozo_instagram_image_inner_wrap .wpmozo_instagram_item',
					'fields_options' => array(
						'color' => array(
							'default' => '#000000'
						)
					),
					'separator' => 'before',
				)
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'           => 'post_box_shadow',
					'selector'       => '{{WRAPPER}} .wpmozo_instagram_image_inner_wrap .wpmozo_instagram_item',
					'fields_options' => array(
						'box_shadow_type' => array( 
                            'default' =>'yes' 
                        ),
						'box_shadow' => array(
							'default' => array(
								'horizontal' => -4,
								'vertical'   => 4,
								'blur'       => 4,
								'spread'     => 0,
								'color'      => 'rgba(0,0,0,0.15)'
							)
						)
					)
				)
			);

			$this->end_controls_section();

			// Button styling
			$this->start_controls_section( 'button_styling',
				array(
					'label'     => esc_html__( 'Button Styling', 'wpmozo-widgets-for-elementor' ),
					'tab'       => Controls_Manager::TAB_STYLE,
					'condition' => array( 'display_button' => 'yes' ),
				)
			);

			$this->start_controls_tabs( 'button_normal_and_hover_state_control_tabs'
			);

			// Tab 1
			$this->start_controls_tab( 'button_normal_state_tab',
				array(
					'label' => esc_html__( 'Normal', 'wpmozo-widgets-for-elementor' ),
				)
			);

			// Settings for first tab
			$this->add_control( 'button_text_color_normal_state',
				array(
					'label'         => esc_html__( 'Text Color', 'wpmozo-widgets-for-elementor' ),
					'label_block'   => false,
					'type'          => Controls_Manager::COLOR,
					'default'       => '#000000',
					'selectors'     => array(
						'{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner, {{WRAPPER}} .wpmozo_instagram_button' => 'color: {{VALUE}}',
						'{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner svg' => 'color: {{VALUE}}; fill: {{VALUE}};'
					),
				)
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
				    'label'          => esc_html__( 'Typography', 'wpmozo-widgets-for-elementor' ),
					'label_block'    => true,
					'name'           => 'button_text_normal_state_typography',
					'selector'       => '{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner',
					'exclude'        => array( 'font_size' ),
				)
			);

			$this->add_responsive_control( 'button_font_size',
				array(
					'type'     => Controls_Manager::SLIDER,
					'label'    => esc_html__( 'Font Size', 'wpmozo-widgets-for-elementor' ),
					'range'    => array(
						'px' => array(
							'min' => 0,
							'max' => 1000,
							'step' => 1,
						),
						'%' => array(
							'min' => 0,
							'max' => 200,
						),
						'vw' => array(
							'min' => 0,
							'max' => 200,
						),
						'vh' => array(
							'min' => 0,
							'max' => 200,
						),
					),
					'default' => array(
						'size' => '18',
						'unit' => 'px'
					),
					'size_units' => array( 'px', '%', 'vw', 'vh' ),
					'selectors'  => array(
						'{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
					),
				)
			);
			
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				array(
					'name'		=> 'button_text_shadow_normal_state',
					'label'		=> esc_html__( 'Text Shadow', 'wpmozo-widgets-for-elementor' ),
					'selector'	=> '{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner',
					'separator'	=> 'before',
				)
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name' => 'button_box_shadow_normal_state',
					'label' => esc_html__( 'Box Shadow', 'wpmozo-widgets-for-elementor' ),
					'selector' => '{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner',
				)
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'		=> 'button_border_normal_state',
					'label'		=> esc_html__( 'Border', 'wpmozo-widgets-for-elementor' ),
					'selector'	=> '{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner',
					'fields_options'	=> array(
						'border' => array( 'default' => 'solid' ),
						'width'  => array( 'default' => array( 'top'=>2,'right'=>2,'bottom'=>2,'left'=>2 ) ),
					)

				)
			);

			$this->add_responsive_control( 'button_border_radius_normal_state',
				array(
					'label'       => esc_html__( 'Border Radius', 'wpmozo-widgets-for-elementor' ),
					'type'        => Controls_Manager::DIMENSIONS,
					'label_block' => true,
					'size_units'  => array( 'px', 'em', '%' ),
					'default'	  =>array( 'top'=>0, 'right'=>0, 'bottom'=>0, 'left'=>0 ),
					'selectors'   => array(
						'{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name' 		=> 'button_background_normal_state',
					'label' 	=> esc_html__( 'Background', 'wpmozo-widgets-for-elementor' ),
					'types' 	=> array( 'classic', 'gradient', ),
					'selector'	=> '{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner',
				)
			);

			$this->add_responsive_control( 'button_padding_normal_state',
				array(
					'label'      => esc_html__( 'Padding', 'wpmozo-widgets-for-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', 'em', '%' ),
					'default'    => array( 'top'=>3,'right'=>3,'bottom'=>3,'left'=>3 ),
					'selectors'  => array(
						'{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->end_controls_tab();

			// Tab 2
			$this->start_controls_tab( 'button_hover_state_tab',
				array(
					'label' => esc_html__( 'Hover', 'wpmozo-widgets-for-elementor' ),
				)
			);

			// Settings for second tab
			$this->add_control( 'button_text_color_hover_state',
				array(
					'label'         => esc_html__( 'Text Color', 'wpmozo-widgets-for-elementor' ),
					'label_block'   => false,
					'type'          => Controls_Manager::COLOR,
					'default'       => '',
					'selectors'     => array(
						'{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner:hover, {{WRAPPER}} .wpmozo_instagram_button_wrapper_inner:hover .wpmozo_instagram_button' => 'color: {{VALUE}}',
						'{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner:hover, {{WRAPPER}} .wpmozo_instagram_button_wrapper_inner:hover svg' => 'color: {{VALUE}}; fill: {{VALUE}};'
					),
				)
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
				    'label'         => esc_html__( 'Typography', 'wpmozo-widgets-for-elementor' ),
					'label_block'   => false,
					'name'          => 'button_text_hover_state_typography',
					'selector'      => '{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner:hover',
					'fields_options' => array(
						'font_size' => array( 'selectors' => array( '{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner:hover svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
							'{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner:hover'=> 'font-size:{{SIZE}}{{UNIT}};' ), 'default' => array( 'size' => 18 ) )
					)
				)
			);
			
			$this->add_group_control(
				Group_Control_Text_Shadow::get_type(),
				array(
					'name'		=> 'button_text_shadow_hover_state',
					'label'		=> esc_html__( 'Text Shadow', 'wpmozo-widgets-for-elementor' ),
					'selector'	=> '{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner:hover',
					'separator'	=> 'before',
				)
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'     => 'button_box_shadow_hover_state',
					'label'    => esc_html__( 'Box Shadow', 'wpmozo-widgets-for-elementor' ),
					'selector' => '{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner:hover',
				)
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'button_border_hover_state',
					'label'    => esc_html__( 'Border', 'wpmozo-widgets-for-elementor' ),
					'selector' => '{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner:hover',
				)
			);

			$this->add_responsive_control( 'button_border_radius_hover_state',
				array(
					'label'      => esc_html__( 'Border Radius', 'wpmozo-widgets-for-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', 'em', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				array(
					'name'     => 'button_background_hover_state',
					'label'    => esc_html__( 'Background', 'wpmozo-widgets-for-elementor' ),
					'types'    => array( 'classic', 'gradient', ),
					'selector' => '{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner:hover',
				)
			);

			$this->add_control( 'button_hover_animation',
				array(
					'label'     => esc_html__( 'Hover Animation', 'wpmozo-widgets-for-elementor' ),
					'type'      => Controls_Manager::HOVER_ANIMATION,
					'separator'	=>	'before',
					'default'	=> 'grow'
				)
			);

			$this->add_responsive_control( 'button_transition_duration',
				array(
					'type'  => Controls_Manager::SLIDER,
					'label' => esc_html__( 'Transition Duration (ms) ', 'wpmozo-widgets-for-elementor' ),
					'range' => array(
						'ms' => array(
							'min' => 0,
							'max' => 10000,
							'step'=>100,
						),
					),
					'default' => array(
						'size' => 200,
						'unit' => 'ms',
					),
					'selectors' => array(
						'{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner, {{WRAPPER}} .wpmozo_instagram_button_wrapper_inner .wpmozo_instagram_button' => 'transition: color {{SIZE}}{{UNIT}}, border {{SIZE}}{{UNIT}}, background {{SIZE}}{{UNIT}}, text-shadow {{SIZE}}{{UNIT}}, border-radius {{SIZE}}{{UNIT}}, transform {{SIZE}}{{UNIT}}, font {{SIZE}}{{UNIT}}, size {{SIZE}}{{UNIT}}, padding {{SIZE}}{{UNIT}}, letter-spacing {{SIZE}}{{UNIT}}, word-spacing {{SIZE}}{{UNIT}}, margin 300ms; animation-duration:{{SIZE}}{{UNIT}}; transition-timing-function: linear;',
						
						'{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner svg' => 'transition: color {{SIZE}}{{UNIT}}, fill {{SIZE}}{{UNIT}}, text-shadow {{SIZE}}{{UNIT}}, transform {{SIZE}}{{UNIT}}, height {{SIZE}}{{UNIT}}, width {{SIZE}}{{UNIT}}, opacity 300ms; animation-duration:{{SIZE}}{{UNIT}}; transition-timing-function: linear;'
					),
				)
			);

			$this->add_responsive_control( 'button_padding_hover_state',
				array(
					'label'      => esc_html__( 'Padding', 'wpmozo-widgets-for-elementor' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', 'em', '%' ),
					'default'    => array( 'top'=>3,'right'=>3,'bottom'=>3,'left'=>3 ),
					'selectors'  => array(
						'{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->end_controls_tab();

			$this->end_controls_tabs();

			$this->add_control( 'button_text_alignment',
				array(
					'label'   => esc_html__( 'Alignment', 'wpmozo-widgets-for-elementor' ),
					'type'    => Controls_Manager::CHOOSE,
					'options' => array(
						'left' => array(
							'title' => esc_html__( 'Left', 'wpmozo-widgets-for-elementor' ),
							'icon' => 'eicon-text-align-left',
						),
						'center' => array(
							'title' => esc_html__( 'Center', 'wpmozo-widgets-for-elementor' ),
							'icon' => 'eicon-text-align-center',
									),
						'right' => array(
							'title' => esc_html__( 'Right', 'wpmozo-widgets-for-elementor' ),
							'icon' => 'eicon-text-align-right',
						),
					),
					'toggle'  => true,
					'default' => 'center',
					'selectors' => array(
						'{{WRAPPER}} .wpmozo_instagram_button_wrapper' => 'text-align: {{VALUE}};',
					),
					'separator' => 'before', 
				)
			);

			//Button padding and margin section
			/*$this->add_control( 'button_padding_margin_heading',
				array(
					'label' => esc_html__( 'Padding and Margin', 'wpmozo-widgets-for-elementor' ),
					'type'  => Controls_Manager::HEADING,
				)
			);

			$this->start_controls_tabs( 'button_padding_margin_control_tabs',
				array(

				)
			)*/;

			// Tab 1
			/*$this->start_controls_tab( 'button_padding_tab',
				array(
					'label' => esc_html__( 'Padding', 'wpmozo-widgets-for-elementor' ),
				)
			);*/

			// Settings for first tab.
			

			

			// $this->end_controls_tab();

			// Tab 2
			/*$this->start_controls_tab( 'button_margin_tab',
				array(
					'label' => esc_html__( 'Margin', 'wpmozo-widgets-for-elementor' ),
				)
			);*/

			// Settings for second tab.
			$this->add_responsive_control( 'button_margin',
				array(
					'label'			=> esc_html__( 'Margin', 'wpmozo-widgets-for-elementor' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units'	=> array( 'px', 'em', '%' ),
					'selectors' 	=> array(
						'{{WRAPPER}} .wpmozo_instagram_button_wrapper_inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
					'default'       => array( 'top'=>5,'right'=>5,'bottom'=>5,'left'=>5 )
				)
			);

			/*$this->end_controls_tab();

			$this->end_controls_tabs();*/

			$this->end_controls_section();
		}

		private function wpmozo_instagram_callback( $cache, $instagram_token, $limit ) {

			$wpmozo_instagram_key   = 'wpmozo_instagram_key_' . md5( $instagram_token );
			$instagram_feed_data       = get_transient( $wpmozo_instagram_key );

			if ( !$instagram_feed_data || $limit !== $instagram_feed_data['limit'] ) {
				$request_args = array(
					'timeout' => 20,
				);
				$instagram_feed = wp_remote_retrieve_body( wp_remote_get( 'https://graph.instagram.com/me/media?fields=id,media_url,caption,media_type,thumbnail_url,timestamp,username,permalink&limit=' . $limit . '&access_token=' . $instagram_token, $request_args ) );
				$instagram_feed_data = json_decode( $instagram_feed, true );
				$instagram_feed_data['limit'] = $limit;

				if ( ! empty( $instagram_feed_data[ 'data' ] ) ) {
					set_transient( $wpmozo_instagram_key, $instagram_feed_data, $cache  );
				}
			} else {
				$instagram_feed_data = get_transient( $wpmozo_instagram_key );
			}
			return $instagram_feed_data;
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
			$settings           =	$this->get_settings_for_display();
			$instagram_token    = esc_attr( $settings[ 'instagram_token' ] );
			$cache              = esc_attr( $settings[ 'cache' ] ) * 60;
			$column_count       = esc_attr( $settings[ 'column_count' ] );
			$image_count        = esc_attr( $settings[ 'image_count' ] );
			$display_caption    = esc_attr( $settings[ 'display_caption' ] );
			$link_image         = esc_attr( $settings[ 'link_image' ] );
	        $display_button     = esc_attr( $settings[ 'display_button' ] );
	        $button_text        = esc_attr( $settings[ 'button_text' ] );
	        $select_layout      = esc_attr( $settings[ 'select_layout' ] );
	        $instagram_feed     = '';
	        $heading_content    = '';
	        $output             = '';

			$this->add_render_attribute( 'image_wrapper', 'class', array( 'wpmozo_instagram_images_wrapper', 'wpmozo_column_count_'.$column_count, 'wpmozo_layout'.$select_layout ) );
			$this->add_render_attribute( 'feed_wrapper', 'class', 'wpmozo_instagram' );
			$this->add_render_attribute( 'content_wrapper', 'class', 'wpmozo_instagram_content_wrapper' );
			$this->add_render_attribute( 'instagram_item', 'class', 'wpmozo_instagram_item' );
			$this->add_render_attribute( 'instagram_caption', 'class', 'wpmozo_instagram_caption' );
			$this->add_render_attribute( 'instagram_image_wrap', 'class', 'wpmozo_instagram_image_inner_wrap' );
			$this->add_render_attribute( 'wpmozo_instagram_button_wrapper', 'class', 'wpmozo_instagram_button_wrapper' );
			$this->add_render_attribute( 'wpmozo_instagram_button_wrapper_inner', 'class', 'wpmozo_instagram_button_wrapper_inner' );
			$this->add_render_attribute( 'button_text', array( 'class'=> 'wpmozo_instagram_button', 'style'=>'text-decoration:none;' ), );
			$this->add_inline_editing_attributes( 'button_text', 'none' );
			$this->add_render_attribute( 'gutter_width', 'class', 'wpmozo_instagram_item_gutter' );

			if ( '_masonry' === $select_layout) {
				$column_spacing	= esc_attr( $settings [ 'column_spacing' ][ 'size' ] . $settings [ 'column_spacing' ][ 'unit' ] );
				$gutter = esc_attr( $settings [ 'column_spacing' ][ 'size' ] );
		        $gutter_content = ( '_masonry' === $select_layout ) ? sprintf( '<div %1$s></div>', $this->get_render_attribute_string( 'gutter_width' ) ) : '';

		        $item_width_percentage = 100 / $column_count;
				$item_width_spacing	   = $gutter * ($column_count - 1) / $column_count;

				$item_width = 'calc( ' . $item_width_percentage . "% - " . $item_width_spacing . $settings[ 'column_spacing' ][ 'unit' ] . ' )';
			} else {
				$column_spacing = $gutter_content = $item_width = '';
			}

			if ( '' !== $settings[ 'button_hover_animation' ] ) {
				$this->add_render_attribute( 'wpmozo_instagram_button_wrapper_inner', 'class', 'elementor-animation-' . $settings[ 'button_hover_animation' ] );
			}

			//Retrieving data form instagram
	        $instagram_feed_data = $this->wpmozo_instagram_callback( $cache, $instagram_token, $image_count );

	        if ( isset( $instagram_feed_data ) ) {

	        	$button_url = 'https://www.instagram.com/' . $instagram_feed_data[ 'data' ][ 0 ][ 'username' ] . '/';

				if ( '' !== $button_url  ) {
					$this->add_link_attributes( 'wpmozo_instagram_button_wrapper_inner', array( 'url' => $button_url, 'is_external' => true, 'nofollow' => true ) );
				}

				foreach( array_slice( $instagram_feed_data[ 'data' ], 0, $image_count ) as $data) {
					$permalink 	= isset( $data[ 'permalink' ] ) ? $data[ 'permalink' ] : '' ;
					$media_type = isset( $data[ 'media_type' ] ) ? $data[ 'media_type' ] : '' ;
					$media_url  = ( 'VIDEO' === $media_type ) ? $data[ 'thumbnail_url' ] : ( isset( $data[ 'media_url' ] ) ? $data[ 'media_url' ] : '' );
					$username   = isset( $data[ 'username' ] ) ? $data[ 'username' ] : '' ;

					if ( '' === $media_url ) {
						continue;
					}

					//Instagram caption					
					if ( array_key_exists( 'caption', $data) && 'yes' === $display_caption ) {
						$caption = sprintf( '
							<p %1$s>
								%2$s
							</p>',
							$this->get_render_attribute_string( 'instagram_caption' ),
							esc_attr( $data[ 'caption' ] ) 
						);
					} else {
						$caption = '';
					}

					//Instagram image
					if( ( 'IMAGE' === $media_type || 'CAROUSEL_ALBUM' === $media_type ) ) {
						$instagram_feed .= sprintf( '
							<div %1$s>
                                %2$s
								   <img %3$s src="%4$s" >
                                %5$s
								%6$s
							</div>',
							$this->get_render_attribute_string( 'instagram_image_wrap' ),
                            'yes' == $link_image ? '<a href="' . $permalink . '">' : '',
							$this->get_render_attribute_string( 'instagram_item' ),
							$media_url,
                            'yes' == $link_image ? '</a>' : '',
							$caption
						);
					}

                    //Instagram video
					if ( 'VIDEO' === $media_type ) {
						$instagram_feed .= sprintf( '
							<div %1$s>
								<video %2$s controls poster="%3$s">
  									<source src="%4$s" type="video/mp4">
								</video>
								%5$s
							</div>',
							$this->get_render_attribute_string( 'instagram_image_wrap' ),
							$this->get_render_attribute_string( 'instagram_item' ),
							$media_url,
							$data[ 'media_url' ],
							$caption
						);
					}
				}
			}

            //Instagram button icon

			if ( '' !== $settings[ 'button_icon' ]) {
		        $button_icon =	Icons_Manager::try_get_icon_html( $settings[ 'button_icon' ], [ 'aria-hidden' => 'true', 'class'=>'wpmozo_instagram_button_icon ' ] );
        	}

            //Instagram button	
			if ( $button_text && 'after' === $settings[ 'button_icon_position' ] ) {
                $button_text = sprintf( '
                	<div %1$s>
                		<a %2$s>
                            <div %3$s>
                            	%4$s
                            </div>%5$s
                        </a>
                    </div>',
                    $this->get_render_attribute_string( 'wpmozo_instagram_button_wrapper' ), 
                    $this->get_render_attribute_string( 'wpmozo_instagram_button_wrapper_inner' ), 
                    $this->get_render_attribute_string( 'button_text' ), 
                    $button_text,
                    '' !== $button_icon ? ( '&nbsp;' . $button_icon ) : '' );
            } elseif ( $button_text && 'before' === $settings[ 'button_icon_position' ] ) {
            	$button_text = sprintf( '
                	<div %1$s>
                		<a %2$s>
                          %3$s
                          <div %4$s>
                          	%5$s
                          </div> 
                        </a>
                    </div>',
                    $this->get_render_attribute_string( 'wpmozo_instagram_button_wrapper' ),
                    $this->get_render_attribute_string( 'wpmozo_instagram_button_wrapper_inner' ),
                    '' !== $button_icon ? ( $button_icon . '&nbsp;' ) : '', 
                    $this->get_render_attribute_string( 'button_text' ), 
                    $button_text
                );
            } elseif ($button_text) {
            	$button_text = sprintf( '
                	<div %1$s>
                		<a %2$s>
                          %3$s
                          <div %4$s>
                          	%5$s
                          </div> 
                        </a>
                    </div>',
                    $this->get_render_attribute_string( 'wpmozo_instagram_button_wrapper' ),
                    $this->get_render_attribute_string( 'wpmozo_instagram_button_wrapper_inner' ),
                    '' !== $button_icon ? ( $button_icon . '&nbsp;' ) : '', 
                    $this->get_render_attribute_string( 'button_text' ), 
                    $button_text
                );
            }

			if ( '' !== $instagram_feed ) {
				$instagram_feed = sprintf( '
					<div %1$s data-item-width="%2$s" data-item-spacing="%3$s">
						%4$s
						%5$s
					</div>
					%6$s',
					$this->get_render_attribute_string( 'image_wrapper' ),
					$item_width,
					$column_spacing,
					$gutter_content,
					$instagram_feed,
					$button_text
				);
			}

			$output = sprintf( '
				<div %1$s>
					%2$s
				</div>',
				$this->get_render_attribute_string( 'feed_wrapper' ),
				$instagram_feed,
			);

			echo( $output );
		}

		/**
		 * Live widget output.
		 *
		 * @since 1.0.0
		 * @access protected
		 */
		protected function content_template() {}
	}