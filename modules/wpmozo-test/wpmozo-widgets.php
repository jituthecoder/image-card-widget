<?php
/**
 * @author      Elicus <hello@elicus.com>
 * @link        https://www.elicus.com/
 * @copyright   2022 Elicus Technologies Private Limited
 * @version     1.0.0
 */

// if this file is called directly, abort.
if (!defined('ABSPATH')) {
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

class WPMOZO_Button extends Widget_Base
{
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
    public function get_name()
    {
        return 'wpmozo_button';
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
    public function get_title()
    {
        return esc_html__('WPMOZO Button', 'wpmozo-widgets-for-elementor');
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
    public function get_icon()
    {
        return 'eicon-button';
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
    public function get_categories()
    {
        return array('wpmozo');
    }
    protected function register_controls()
    {
        $this->start_controls_section(
            'wpmozo_button',
            array(
                'label' => esc_html__('Button', 'wpmozo-widgets-for-elementor'),
                'tab' => Controls_Manager::TAB_CONTENT,
            )
        );
        $this->add_control(
            'wpmozo_button',
            array(
                'label' => esc_html__('WPMOZO Button', 'wpmozo-widgets-for-elementor'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'separator' => 'before',
                'dynamic' => array('active' => true),
                'placeholder' => esc_html__('Button text', 'wpmozo-widgets-for-elementor'),
            )
        );

        $this->end_controls_section();
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $content = $settings['wpmozo_button'];
        echo "<button>" . $content . "</button>";
    }
    /**
     * Live widget output.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function content_template()
    {
    }
}




class WPMOZO_Checkbox extends Widget_Base{



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
    public function get_name()
    {
        return 'wpmozo_checkbox';
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
    public function get_title()
    {
        return esc_html__('WPMOZO Checkbox', 'wpmozo-widgets-for-elementor');
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
    public function get_icon()
    {
        return 'eicon-checkbox';
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
    public function get_categories()
    {
        return array('wpmozo');
    }





    protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'wpmozo-widgets-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'show_title',
			[
				'label' => esc_html__( 'Show Title', 'wpmozo-widgets-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'wpmozo-widgets-for-elementor' ),
				'label_off' => esc_html__( 'Hide', 'wpmozo-widgets-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'wpmozo-widgets-for-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Default title', 'wpmozo-widgets-for-elementor' ),
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( 'yes' === $settings['show_title'] ) {
			echo '<h2>' . $settings['title'] . '</h2>';
		}
	}

	protected function content_template() {
		
	}
}



class WPMOZO_Banner_Title extends Widget_Base{

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
    public function get_name()
    {
        return 'wpmozo_banner_title';
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
    public function get_title()
    {
        return esc_html__('WPMOZO Banner Title', 'wpmozo-widgets-for-elementor');
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
    public function get_icon()
    {
        return 'eicon-title';
    }
    public function get_categories()
    {
        return array('wpmozo');
    }

    protected function register_controls() 
    {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'wpmozo-widgets-for-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

            $this->add_control(
                'item_description',
                [
                    'label' => esc_html__( 'Banner Title', 'wpmozo-widgets-for-elementor' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'rows' => 10,
                    'default' => esc_html__( 'Default description', 'wpmozo-widgets-for-elementor' ),
                    'placeholder' => esc_html__( 'Type your description here', 'wpmozo-widgets-for-elementor' ),
                ]
            );



            $this->add_control(
                'image',
                [
                    'label' => esc_html__( 'Choose Image', 'textdomain' ),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );
    
            $this->add_group_control(
                \Elementor\Group_Control_Image_Size::get_type(),
                [
                    'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                    'exclude' => [ 'custom' ],
                    'include' => [],
                    'default' => 'large',
                ]
            );


            $this->add_control(
                'price',
                [
                    'label' => esc_html__( 'Price', 'wpmozo-widgets-for-elementor' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 5,
                    'max' => 100,
                    'step' => 5,
                    'default' => 10,
                ]
            );

            $this->add_control(
                'open_lightbox',
                [
                    'type' => Controls_Manager::SELECT,
                    'label' => esc_html__( 'Lightbox', 'wpmozo-widgets-for-elementor' ),
                    'options' => [
                        'default' => esc_html__( 'Default', 'wpmozo-widgets-for-elementor' ),
                        'yes' => esc_html__( 'Yes', 'wpmozo-widgets-for-elementor' ),
                        'no' => esc_html__( 'No', 'wpmozo-widgets-for-elementor' ),
                    ],
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'font_size',
                [
                    'type' => Controls_Manager::SLIDER,
                    'label' => esc_html__( 'Size', 'wpmozo-widgets-for-elementor' ),
                    'size_units' => [ 'px', 'em', 'rem', 'custom' ],
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 200,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 20,
                    ],
                ]
            );

            $this->add_control(
                'custom_html',
                [
                    'label' => esc_html__( 'Custom HTML', 'wpmozo-widgets-for-elementor' ),
                    'type' => \Elementor\Controls_Manager::CODE,
                    'language' => 'html',
                    'rows' => 20,
                ]
            );

            $this->add_control(
                'border_style',
                [
                    'label' => esc_html__( 'Border Style', 'wpmozo-widgets-for-elementor' ),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'solid',
                    'options' => [
                        '' => esc_html__( 'Default', 'wpmozo-widgets-for-elementor' ),
                        'none' => esc_html__( 'None', 'wpmozo-widgets-for-elementor' ),
                        'solid'  => esc_html__( 'Solid', 'wpmozo-widgets-for-elementor' ),
                        'dashed' => esc_html__( 'Dashed', 'wpmozo-widgets-for-elementor' ),
                        'dotted' => esc_html__( 'Dotted', 'wpmozo-widgets-for-elementor' ),
                        'double' => esc_html__( 'Double', 'wpmozo-widgets-for-elementor' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .banner-title' => 'border-style: {{VALUE}};',
                    ],
                ]
            );


        $this->end_controls_section();	
        
        
        $this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Banner Title Style', 'wpmozo-widgets-for-elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->start_controls_tabs(
			'style_tabs'
		);
            
            $this->start_controls_tab(
                'style_normal_tab',
                [
                    'label' => esc_html__( 'Normal', 'wpmozo-widgets-for-elemento' ),
                ]
            );

                $this->add_control(
                    'text_color',
                    [
                        'label' => esc_html__( 'Banner Title Color', 'wpmozo-widgets-for-element' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .banner-title' => 'color: {{VALUE}}',
                        ],
                    ]
                );

                

                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name' => 'content_typography',
                        'selector' => '{{WRAPPER}} .banner-title',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Text_Shadow::get_type(),
                    [
                        'name' => 'text_shadow',
                        'selector' => '{{WRAPPER}} .banner-title',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'background',
                        'types' => [ 'classic', 'gradient', 'video' ],
                        'selector' => '{{WRAPPER}} .banner-title',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'border',
                        'selector' => '{{WRAPPER}} .banner-title',
                    ]
                );

                $this->add_group_control(
                    \Elementor\Group_Control_Css_Filter::get_type(),
                    [
                        'name' => 'custom_css_filters',
                        'selector' => '{{WRAPPER}} .banner-title',
                    ]
                );


            $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'wpmozo-widgets-for-element' ),
            ]
        );
            $this->add_control(
                'text_hover_color',
                [
                    'label' => esc_html__( 'Banner Title Color', 'wpmozo-widgets-for-element' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .banner-title:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();	
    }

    protected function render() {
		$settings 		= $this->get_settings_for_display();
		$content 		= $settings['item_description'];		

        $open_lightbox = $settings['open_lightbox'];

        $custom_html = $settings['custom_html'];

        $border_style = $settings['border_style'];

        echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );

        

        echo '<div class="banner-title">'.$content.'</div>';

        /* echo '<div class="open_lightbox"><h2>Select Type control value : '.$open_lightbox.'</h2></div>';*/

        /*
        if(!empty($custom_html))
        {
            echo "<h2> Here is the custom html";
            echo $custom_html;
        }
        */
	}

	protected function content_template() {
		
	}

}