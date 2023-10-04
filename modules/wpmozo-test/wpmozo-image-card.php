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



class WPMOZO_Image_Card extends Widget_Base
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
        return 'wpmozo_image_card';
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
        return esc_html__('WPMOZO Image Card', 'wpmozo-widgets-for-elementor');
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
        return 'eicon-image';
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
        /* Image section control start */
        $this->start_controls_section(
            'wpmozo_image_card_image',
            array(
                'label' => esc_html__('Image', 'wpmozo-widgets-for-elementor'),
                'tab' => Controls_Manager::TAB_CONTENT,
            )
        );
            $this->add_control(
                'wpmozo_card_image',
                [
                    'label' => esc_html__( 'Choose Image', 'wpmozo-widgets-for-elementor' ),
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

        $this->end_controls_section();
        /* Image section control end */
        /* Content Section control start */

        $this->start_controls_section(
            'wpmozo_image_card_content',
            array(
                'label' => esc_html__('Content', 'wpmozo-widgets-for-elementor'),
                'tab' => Controls_Manager::TAB_CONTENT,
            )
        );
        $this->add_control(
            'wpmozo_content_title',
            array(
                'label' => esc_html__('Title', 'wpmozo-widgets-for-elementor'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'separator' => 'before',
                'dynamic' => array('active' => true),
                'default' => esc_html__( 'Image card Title', 'wpmozo-widgets-for-elementor' ),
                'placeholder' => esc_html__('Image Card Title', 'wpmozo-widgets-for-elementor'),
            )
        );
        $this->add_control(
            'wpmozo_content_description',
            [
                'label' => esc_html__( 'Content', 'wpmozo-widgets-for-elementor' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__( 'Image card Content', 'wpmozo-widgets-for-elementor' ),
                'placeholder' => esc_html__( 'Enter content here', 'wpmozo-widgets-for-elementor' ),
            ]
        );       

        $this->end_controls_section();
        /* Content Section control end */

        /* Icon Section control start */

        $this->start_controls_section(
            'wpmozo_image_card_icon',
            array(
                'label' => esc_html__('Icon', 'wpmozo-widgets-for-elementor'),
                'tab' => Controls_Manager::TAB_CONTENT,
            )
        );
        
        $this->add_control(
			'card_icon',
			[
				'label' => esc_html__( 'Icon', 'wpmozo-widgets-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-plus-circle',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'circle',
						'dot-circle',
						'square-full',
					],
					'fa-regular' => [
						'circle',
						'dot-circle',
						'square-full',
					],
				],
			]
		);

        $this->end_controls_section();
        /* Icon Section control end */


        /* Button section control start */
        $this->start_controls_section(
            'wpmozo_image_card_button',
            array(
                'label' => esc_html__('Button', 'wpmozo-widgets-for-elementor'),
                'tab' => Controls_Manager::TAB_CONTENT,
            )
        );

        $this->add_control(
            'wpmozo_button_text',
            array(
                'label' => esc_html__('Button Text', 'wpmozo-widgets-for-elementor'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'separator' => 'before',
                'dynamic' => array('active' => true),
                'default' => esc_html__( 'Click Me!', 'wpmozo-widgets-for-elementor' ),
                
            )
        );
        $this->add_control(
			'wpmozo_button_link',
			[
				'label' => esc_html__( 'Button Url', 'wpmozo-widgets-for-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '#',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);

        $this->add_control(
			'wpmozo_button_icon',
			[
				'label' => esc_html__( 'Icon', 'wpmozo-widgets-for-elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-plus-circle',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'circle',
						'dot-circle',
						'square-full',
					],
					'fa-regular' => [
						'circle',
						'dot-circle',
						'square-full',
					],
				],
			]
		);

        $this->add_control(
			'icon_position',
			[
				'label' => esc_html__( 'Button Icon Position', 'wpmozo-widgets-for-elementor' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Before', 'wpmozo-widgets-for-elementor' ),
						'icon' => 'eicon-chevron-left',
					],
					'right' => [
						'title' => esc_html__( 'After', 'wpmozo-widgets-for-elementor' ),
						'icon' => 'eicon-chevron-right',
					],
					
				],
				'default' => 'left',
				'toggle' => false,
				'selectors' => [
					'{{WRAPPER}} .your-class' => 'text-align: {{VALUE}};',
				],
			]
		);


        $this->add_control(
			'show_icon_on_hover',
			[
				'label' => esc_html__( 'Show Icon On Hover', 'wpmozo-widgets-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'wpmozo-widgets-for-elementor' ),
				'label_off' => esc_html__( 'No', 'wpmozo-widgets-for-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        
       

        $this->end_controls_section();
        /* Button section control end */


        /* Style tab start */

        /* Title style section control start */
        $this->start_controls_section(
            'wpmozo_style_title',
            array(
                'label' => esc_html__('Title', 'wpmozo-widgets-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'heading_type',                
            [
                'label' => esc_html__( 'Heading Level', 'wpmozo-widgets-for-elementor' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'label_block' => true,
                'options' => [
                    'h1' => [
                        'title' => esc_html__( 'H1', 'wpmozo-widgets-for-elementor' ),
                        'icon' => 'eicon-editor-h1',
                    ],
                    'h2' => [
                        'title' => esc_html__( 'H2', 'wpmozo-widgets-for-elementor' ),
                        'icon' => 'eicon-editor-h2',
                    ],
                    'h3' => [
                        'title' => esc_html__( 'H3', 'wpmozo-widgets-for-elementor' ),
                        'icon' => 'eicon-editor-h3',
                    ],
                    'h4' => [
                        'title' => esc_html__( 'H4', 'wpmozo-widgets-for-elementor' ),
                        'icon' => 'eicon-editor-h4',
                    ],
                    'h5' => [
                        'title' => esc_html__( 'H5', 'wpmozo-widgets-for-elementor' ),
                        'icon' => 'eicon-editor-h5',
                    ],
                    'h6' => [
                        'title' => esc_html__( 'H6', 'wpmozo-widgets-for-elementor' ),
                        'icon' => 'eicon-editor-h6',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .wpmozo-description' => 'text-align: {{VALUE}};',
                ],
            ]
        );

    
            $this->start_controls_tabs(
                'wpmozo_title_style_tabs'
            );
                $this->start_controls_tab(
                    'title_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'wpmozo-widgets-for-elementor' ),
                    ]
                );
                    $this->add_control(
                        'title_text_color',
                        [
                            'label' => esc_html__( 'Text Color', 'wpmozo-widgets-for-elementor' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wpmozo-title' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'title_default_typography',
                            'selector' => '{{WRAPPER}} .wpmozo-title',
                        ]
                    );
    
                    $this->add_group_control(
                        Group_Control_Text_Shadow::get_type(),
                        [
                            'name' => 'title_default_text_shadow',
                            'selector' => '{{WRAPPER}} .wpmozo-title',
                        ]
                    );
                $this->end_controls_tab();  
    
                $this->start_controls_tab(
                    'wpmozo_title_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'wpmozo-widgets-for-elementor' ),
                    ]
                );
                    $this->add_control(
                        'title_text_hover_color',
                        [
                            'label' => esc_html__( 'Text Color', 'wpmozo-widgets-for-elementor' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .wpmozo-title:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'title_hover_typography',
                            'selector' => '{{WRAPPER}} .wpmozo-title:hover',
                        ]
                    );
    
                    $this->add_group_control(
                        Group_Control_Text_Shadow::get_type(),
                        [
                            'name' => 'title_hover_text_shadow',
                            'selector' => '{{WRAPPER}} .wpmozo-title:hover',
                        ]
                    );                    

                    $this->add_responsive_control(
                        'title_hover_transition_duration',
                        [
                            'label' => esc_html__( 'Transition Duration (ms)', 'wpmozo-widgets-for-elementor' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'size_units' => [ 'ms'],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 10000,
                                    'step' => 100,
                                ],                            
                            ],
                            'devices' => [ 'desktop', 'tablet', 'mobile' ],
                            'desktop_default' => [
                                'size' => 300,
                                'unit' => 'ms',
                            ],
                            'tablet_default' => [
                                'size' => 200,
                                'unit' => 'ms',
                            ],
                            'mobile_default' => [
                                'size' => 100,
                                'unit' => 'ms',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .wpmozo-title-sec .wpmozo-content-icon not-defined' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    
                $this->end_controls_tab();
                $this->end_controls_tabs();
    
    
                $this->add_control(
                    'title_align',                
                    [
                        'label' => esc_html__( 'Alignment', 'wpmozo-widgets-for-elementor' ),
                        'type' => \Elementor\Controls_Manager::CHOOSE,
                        'label_block' => true,
                        'options' => [
                            'left' => [
                                'title' => esc_html__( 'Left', 'wpmozo-widgets-for-elementor' ),
                                'icon' => 'eicon-text-align-left',
                            ],
                            'center' => [
                                'title' => esc_html__( 'Center', 'wpmozo-widgets-for-elementor' ),
                                'icon' => 'eicon-text-align-center',
                            ],
                            'right' => [
                                'title' => esc_html__( 'Right', 'wpmozo-widgets-for-elementor' ),
                                'icon' => 'eicon-text-align-right',
                            ],
                            'justify' => [
                                'title' => esc_html__( 'Justify', 'wpmozo-widgets-for-elementor' ),
                                'icon' => 'eicon-text-align-right',
                            ],
                        ],
                        'default' => 'center',
                        'toggle' => true,
                        'selectors' => [
                            '{{WRAPPER}} .wpmozo-title' => 'text-align: {{VALUE}};',
                        ],
                    ]
                );       
    
        $this->end_controls_section();
        /* Title style section control end */

         /* Content style section control start */
         $this->start_controls_section(
            'wpmozo_style_content',
            array(
                'label' => esc_html__('Content', 'wpmozo-widgets-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );



        
        $this->start_controls_tabs(
			'wpmozo_content_style_tabs'
		);
            $this->start_controls_tab(
                'content_style_normal_tab',
                [
                    'label' => esc_html__( 'Normal', 'wpmozo-widgets-for-elementor' ),
                ]
            );
                $this->add_control(
                    'content_text_color',
                    [
                        'label' => esc_html__( 'Text Color', 'wpmozo-widgets-for-elementor' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .wpmozo-description' => 'color: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name' => 'content_default_typography',
                        'selector' => '{{WRAPPER}} .wpmozo-description',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Text_Shadow::get_type(),
                    [
                        'name' => 'content_default_text_shadow',
                        'selector' => '{{WRAPPER}} .wpmozo-description',
                    ]
                );
            $this->end_controls_tab();  

            $this->start_controls_tab(
                'wpmozo_content_style_hover_tab',
                [
                    'label' => esc_html__( 'Hover', 'wpmozo-widgets-for-elementor' ),
                ]
            );
                $this->add_control(
                    'content_text_hover_color',
                    [
                        'label' => esc_html__( 'Text Color', 'wpmozo-widgets-for-elementor' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .wpmozo-description:hover' => 'color: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name' => 'content_hover_typography',
                        'selector' => '{{WRAPPER}} .wpmozo-description:hover',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Text_Shadow::get_type(),
                    [
                        'name' => 'content_hover_text_shadow',
                        'selector' => '{{WRAPPER}} .wpmozo-description:hover',
                    ]
                );

                $this->add_responsive_control(
                    'content_hover_transition_duration',
                    [
                        'label' => esc_html__( 'Transition Duration (ms)', 'wpmozo-widgets-for-elementor' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => [ 'ms'],
                        'range' => [
                            'px' => [
                                'min' => 0,
                                'max' => 10000,
                                'step' => 100,
                            ],                            
                        ],
                        'devices' => [ 'desktop', 'tablet', 'mobile' ],
                        'desktop_default' => [
                            'size' => 300,
                            'unit' => 'ms',
                        ],
                        'tablet_default' => [
                            'size' => 200,
                            'unit' => 'ms',
                        ],
                        'mobile_default' => [
                            'size' => 100,
                            'unit' => 'ms',
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .wpmozo-title-sec .wpmozo-content-icon not-defined' => 'font-size: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );


            $this->end_controls_tab();
            $this->end_controls_tabs();


            $this->add_control(
                'content_align',                
                [
                    'label' => esc_html__( 'Alignment', 'wpmozo-widgets-for-elementor' ),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'label_block' => true,
                    'options' => [
                        'left' => [
                            'title' => esc_html__( 'Left', 'wpmozo-widgets-for-elementor' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'wpmozo-widgets-for-elementor' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__( 'Right', 'wpmozo-widgets-for-elementor' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => esc_html__( 'Justify', 'wpmozo-widgets-for-elementor' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'default' => 'center',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .wpmozo-description' => 'text-align: {{VALUE}};',
                    ],
                ]
            );       

        $this->end_controls_section();
        /* Content style section control end */

        /* Image style section start */

        $this->start_controls_section(
            'wpmozo_style_image',
            array(
                'label' => esc_html__('Image', 'wpmozo-widgets-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'image_align',                
            [
                'label' => esc_html__( 'Alignment', 'wpmozo-widgets-for-elementor' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,                
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'wpmozo-widgets-for-elementor' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'wpmozo-widgets-for-elementor' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'wpmozo-widgets-for-elementor' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'wpmozo-widgets-for-elementor' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .wpmozo-image-sec' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .wpmozo-image-sec img',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'image_background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .wpmozo-image-sec',
			]
		);

        $this->add_control(
            'image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'wpmozo-image-sec img' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .wpmozo-image-sec img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'wpmozo_image_space_tab'
        );
            $this->start_controls_tab(
                'wpmozo_image_padding_tab',
                [
                    'label' => esc_html__( 'Padding', 'wpmozo-widgets-for-elementor' ),
                ]
            );
            $this->add_control(
                    'image_padding',
                    [
                        'label' => esc_html__( 'Padding', 'wpmozo-widgets-for-elementor' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                        'selectors' => [
                            '{{WRAPPER}} .wpmozo-image-sec img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
            $this->end_controls_tab(); 

            $this->start_controls_tab(
                'wpmozo_image_margin_tab',
                [
                    'label' => esc_html__( 'Margin', 'wpmozo-widgets-for-elementor' ),
                ]
            );
            $this->add_control(
                'image_margin',
                [
                    'label' => esc_html__( 'Margin', 'wpmozo-widgets-for-elementor' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .wpmozo-image-sec img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->end_controls_tab(); 
            $this->end_controls_tabs();

        $this->end_controls_section();       

        /* Image style section end */


        /* Image icon section start */
        $this->start_controls_section(
            'wpmozo_icon_style',
            array(
                'label' => esc_html__('Icon', 'wpmozo-widgets-for-elementor'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

            $this->add_control(
                'wpmozo_style_icon_color',
                [
                    'label' => esc_html__( 'Color', 'wpmozo-widgets-for-elementor' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wpmozo-title-sec .wpmozo-content-icon' => 'color: {{VALUE}}',
                    ],
                ]
            );


            $this->add_control(
                'wpmozo_style_icon_size',
                [
                    'label' => esc_html__( 'Width', 'wpmozo-widgets-for-elementor' ),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => [ 'px'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ],
                        
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .wpmozo-title-sec .wpmozo-content-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );


            $this->add_control(
                'wpmozo_style_iconn_align',                
                [
                    'label' => esc_html__( 'Alignment', 'wpmozo-widgets-for-elementor' ),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    
                    'options' => [
                        'left' => [
                            'title' => esc_html__( 'Left', 'wpmozo-widgets-for-elementor' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'wpmozo-widgets-for-elementor' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__( 'Right', 'wpmozo-widgets-for-elementor' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => esc_html__( 'Justify', 'wpmozo-widgets-for-elementor' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'default' => 'center',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .wpmozo-title-sec .wpmozo-content-icon' => 'text-align: {{VALUE}};',
                    ],
                ]
            );    





            $this->start_controls_tabs(
                'wpmozo_icon_space_tab'
            );
                $this->start_controls_tab(
                    'wpmozo_icon_padding_tab',
                    [
                        'label' => esc_html__( 'Padding', 'wpmozo-widgets-for-elementor' ),
                    ]
                );
                $this->add_control(
                        'icon_padding',
                        [
                            'label' => esc_html__( 'Padding', 'wpmozo-widgets-for-elementor' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                            'selectors' => [
                                '{{WRAPPER}} .wpmozo-title-sec .wpmozo-content-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                $this->end_controls_tab(); 
    
                $this->start_controls_tab(
                    'wpmozo_icon_margin_tab',
                    [
                        'label' => esc_html__( 'Margin', 'wpmozo-widgets-for-elementor' ),
                    ]
                );
                $this->add_control(
                    'icon_margin',
                    [
                        'label' => esc_html__( 'Margin', 'wpmozo-widgets-for-elementor' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                        'selectors' => [
                            '{{WRAPPER}} .wpmozo-title-sec .wpmozo-content-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
                $this->end_controls_tab(); 
                $this->end_controls_tabs();

        $this->end_controls_section();  
        
        /* Image icon  style section end */
        

        /* Button style section start */
     $this->start_controls_section(
        'wpmozo_button_style',
        array(
            'label' => esc_html__('Button Styling', 'wpmozo-widgets-for-elementor'),
            'tab' => Controls_Manager::TAB_STYLE,
        )
    );


    $this->add_control(
        'wpmozo_button_style_color',
        [
            'label' => esc_html__( 'Text Color', 'wpmozo-widgets-for-elementor' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .wpmozo-button-sec .wpmozo-card-button,.wpmozo-button-sec .wpmozo-card-button a ' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'wpmozo_button_style_typography',
            'selector' => '{{WRAPPER}} .wpmozo-button-sec .wpmozo-card-button',
        ]
    );


    $this->add_control(
        'wpmozo_button_style_size',
        [
            'label' => esc_html__( 'Font Size', 'wpmozo-widgets-for-elementor' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
                
            ],
            'default' => [
                'unit' => 'px',
                'size' => 10,
            ],
            'selectors' => [
                '{{WRAPPER}} .wpmozo-button-sec .wpmozo-card-button' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Text_Shadow::get_type(),
        [
            'name' => 'wpmozo_button_style_text_shadow',
            'selector' => '{{WRAPPER}} .wpmozo-button-sec .wpmozo-card-button a',
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'wpmozo_button_style_box_shadow',
            'selector' => '{{WRAPPER}} .wpmozo-button-sec',
        ]
    );


    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'wpmozo_button_style_border',
            'selector' => '{{WRAPPER}} .wpmozo-button-sec .wpmozo-card-button a',
        ]
    );

    $this->add_control(
        'wpmozo_button_style_border_radius',
        [
            'label' => esc_html__( 'Border Radius', 'wpmozo-image-sec img' ),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
            'selectors' => [
                '{{WRAPPER}} .wpmozo-button-sec .wpmozo-card-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Background::get_type(),
        [
            'name' => 'wpmozo_button_style_background',
            'types' => [ 'classic', 'gradient', 'video' ],
            'selector' => '{{WRAPPER}} .wpmozo-button-sec',
        ]
    );


    $this->add_control(
        'wpmozo_button_style_align',                
        [
            'label' => esc_html__( 'Alignment', 'wpmozo-widgets-for-elementor' ),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'label_block' => true,
            'options' => [
                'left' => [
                    'title' => esc_html__( 'Left', 'wpmozo-widgets-for-elementor' ),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => esc_html__( 'Center', 'wpmozo-widgets-for-elementor' ),
                    'icon' => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => esc_html__( 'Right', 'wpmozo-widgets-for-elementor' ),
                    'icon' => 'eicon-text-align-right',
                ],
                'justify' => [
                    'title' => esc_html__( 'Justify', 'wpmozo-widgets-for-elementor' ),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'default' => 'center',
            'toggle' => true,
            'selectors' => [
                '{{WRAPPER}} .wpmozo-button-sec .wpmozo-card-button' => 'text-align: {{VALUE}};',
            ],
        ]
    );


    $this->start_controls_tabs(
        'wpmozo_button_space_tab'
    );
        $this->start_controls_tab(
            'wpmozo_button_padding_tab',
            [
                'label' => esc_html__( 'Padding', 'wpmozo-widgets-for-elementor' ),
            ]
        );
        $this->add_control(
                'button_padding',
                [
                    'label' => esc_html__( 'Padding', 'wpmozo-widgets-for-elementor' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .wpmozo-button-sec .wpmozo-card-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_tab(); 

        $this->start_controls_tab(
            'wpmozo_button_margin_tab',
            [
                'label' => esc_html__( 'Margin', 'wpmozo-widgets-for-elementor' ),
            ]
        );
        $this->add_control(
            'button_margin',
            [
                'label' => esc_html__( 'Margin', 'wpmozo-widgets-for-elementor' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .wpmozo-button-sec .wpmozo-card-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab(); 
        $this->end_controls_tabs();



    $this->end_controls_section();  
    /* Button style section end */


    /* Style Tab end */ 


     
       


    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $wpmozo_card_image = $settings['wpmozo_card_image'];
        $wpmozo_card_image_url = $wpmozo_card_image['url'];
        if(isset($wpmozo_card_image['alt']))
        {
            $wpmozo_card_image_alt_text = $wpmozo_card_image['alt'];
        }
                
        $wpmozo_button_link = $settings['wpmozo_button_link']; 
        $wpmozo_button_link_target = "_blank";
        if(empty($wpmozo_button_link['is_external']))
        {
            $wpmozo_button_link_target = "";
        }
        $show_icon_on_hover = $settings['show_icon_on_hover'];
        $active_class = "";
        if($show_icon_on_hover=="yes"){
            $active_class = 'active';
        }


        ?>
        <div class="wpmozo-main-container">
            <div class="wpmozo-image-sec">
                <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'wpmozo_card_image' ); ?>
                <?php /*
                <img src="<?php echo $wpmozo_card_image_url; ?>" alt="<?php echo $wpmozo_card_image_alt_text; ?>" >
                */ ?>
            </div>
            <div class="wpmozo-title-sec">
                <div class="wpmozo-content-icon">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['card_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </div>
                <h2 class="wpmozo-title"><?php echo $settings['wpmozo_content_title']; ?> </h2>
            </div>
            <div class="wpmozo-description-sec">
                <p class="wpmozo-description"> <?php echo $settings['wpmozo_content_description'];?> </p>
            </div>
            <div class="wpmozo-button-sec">
               <p class="wpmozo-card-button <?php echo $active_class; ?>" >
               
                <a href="<?php echo $wpmozo_button_link['url']; ?>" target="<?php echo $wpmozo_button_link_target; ?>"  >
                
                <?php 
                if($settings['icon_position']=='left'){
                        \Elementor\Icons_Manager::render_icon( $settings['wpmozo_button_icon'], [ 'aria-hidden' => 'true' ] );
                }
                ?>                
                <?php echo $settings['wpmozo_button_text']; ?> 
                <?php if($settings['icon_position']=='right'){
                        \Elementor\Icons_Manager::render_icon( $settings['wpmozo_button_icon'], [ 'aria-hidden' => 'true' ] );
                }
                ?>
                </a>                
            </p>                
            </div>     
        </div>
        <?php
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