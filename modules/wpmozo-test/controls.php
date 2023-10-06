<?php 

use \Elementor\Utils;
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;


/* Content tab starts here */
/* Content One section starts */
$this->start_controls_section(
    'wpmozo_content_toggle_content_one',
    array(
        'label' => esc_html__( 'Content One', 'wpmozo-widgets-for-elementor' ),
        'tab'   => Controls_Manager::TAB_CONTENT,
    )
);   

    $this->add_control(
        'wpmozo_content_toggle_content_one_title',
        [
            'label' => esc_html__( 'Toggle Title', 'wpmozo-widgets-for-elementor' ),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'placeholder' => esc_html__( 'Enter Title', 'wpmozo-widgets-for-elementor' ),
        ]
    );

    $this->add_control(
        'wpmozo_content_toggle_content_one_type',
        [
            'label' => esc_html__( 'Content Type', 'wpmozo-widgets-for-elementor' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'text',
            'options' => [
                'text' => esc_html__( 'Text', 'wpmozo-widgets-for-elementor' ),
                'template' => esc_html__( 'Template', 'wpmozo-widgets-for-elementor' ),        
                'page' => esc_html__( 'Page', 'wpmozo-widgets-for-elementor' ),     
            ],
        ]
    );

    $this->add_control(
        'wpmozo_content_toggle_content_one_text_content',
        [
            'label' => esc_html__( 'Content', 'wpmozo-widgets-for-elementor' ),
            'type' => Controls_Manager::WYSIWYG,
            'default' => esc_html__( 'Default content', 'wpmozo-widgets-for-elementor' ),
            'placeholder' => esc_html__( 'Type your content here', 'wpmozo-widgets-for-elementor' ),
            'condition' => [
                'wpmozo_content_toggle_content_one_type' => 'text',
            ],
        ]        
    );
    $this->add_control(
        'wpmozo_content_toggle_content_one_template_content',
        [
            'label' => esc_html__( 'Select Template', 'wpmozo-widgets-for-elementor' ),
            'type' => Controls_Manager::SELECT,
            'default' => '0', // Set the default value as needed
            'options' => get_elementor_templates_as_options(), // Use the function to fetch template IDs and names
            'condition' => [
                'wpmozo_content_toggle_content_one_type' => 'template',
            ],
        ]
    );
    $this->add_control(
        'wpmozo_content_toggle_content_one_page_content',
        [
            'label' => esc_html__( 'Select Page', 'wpmozo-widgets-for-elementor' ),
            'type' => Controls_Manager::SELECT,
            'default' => '0', // Set the default value as needed
            'options' => get_pages_as_options(), // Use the function to fetch template IDs and names
            'condition' => [
                'wpmozo_content_toggle_content_one_type' => 'page',
            ],
        ]
    );
$this->end_controls_section();
/* Content One Section ends */

/* Content Two section starts */
$this->start_controls_section(
    'wpmozo_content_toggle_content_two',
    array(
        'label' => esc_html__( 'Content Two', 'wpmozo-widgets-for-elementor' ),
        'tab'   => Controls_Manager::TAB_CONTENT,
    )
);   

    $this->add_control(
        'wpmozo_content_toggle_content_two_title',
        [
            'label' => esc_html__( 'Toggle Title', 'wpmozo-widgets-for-elementor' ),
            'label_block' => true,
            'type' => Controls_Manager::TEXT,
            'placeholder' => esc_html__( 'Enter Title', 'wpmozo-widgets-for-elementor' ),
        ]
    );
    $this->add_control(
        'wpmozo_content_toggle_content_two_type',
        [
            'label' => esc_html__( 'Content Type', 'wpmozo-widgets-for-elementor' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'text',
            'options' => [
                'text' => esc_html__( 'Text', 'wpmozo-widgets-for-elementor' ),
                'template' => esc_html__( 'Template', 'wpmozo-widgets-for-elementor' ),      
                'page' => esc_html__( 'Page', 'wpmozo-widgets-for-elementor' ),       
            ],
        ]
    );
    $this->add_control(
        'wpmozo_content_toggle_content_two_text_content',
        [
            'label' => esc_html__( 'Content', 'wpmozo-widgets-for-elementor' ),
            'type' => Controls_Manager::WYSIWYG,
            'default' => esc_html__( 'Default content', 'wpmozo-widgets-for-elementor' ),
            'placeholder' => esc_html__( 'Type your content here', 'wpmozo-widgets-for-elementor' ),
            'condition' => [
                'wpmozo_content_toggle_content_two_type' => 'text',
            ],
        ]        
    );
    // Add a custom control to your Elementor widget
    $this->add_control(
        'wpmozo_content_toggle_content_two_template_content',
        [
            'label' => esc_html__( 'Select Template', 'wpmozo-widgets-for-elementor' ),
            'type' => Controls_Manager::SELECT,
            'default' => '0', // Set the default value as needed
            'options' => get_elementor_templates_as_options(), // Use the function to fetch template IDs and names
            'condition' => [
                'wpmozo_content_toggle_content_two_type' => 'template',
            ],
        ]
    );

    $this->add_control(
        'wpmozo_content_toggle_content_two_page_content',
        [
            'label' => esc_html__( 'Select Page', 'wpmozo-widgets-for-elementor' ),
            'type' => Controls_Manager::SELECT,
            'default' => '0', // Set the default value as needed
            'options' => get_pages_as_options(), // Use the function to fetch template IDs and names
            'condition' => [
                'wpmozo_content_toggle_content_two_type' => 'page',
            ],
        ]
    );

$this->end_controls_section();
/* Content Two Section ends */
/* Content tab ends here */

/* Style tab starts here */
//Toggle Switch Styling controls starts here
$this->start_controls_section(
    'wpmozo_content_toggle_switcher_style',
    array(
        'label' => esc_html__('Toggle Switch Styling', 'wpmozo-widgets-for-elementor'),
        'tab' => Controls_Manager::TAB_STYLE,
    )
);
    $this->add_control(
        'wpmozo_content_toggle_switcher_style_layout',
        [
            'label' => esc_html__( 'Select Toggle Layout', 'wpmozo-widgets-for-elementor' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'layout1',
            'options' => [
                'layout1' => esc_html__( 'Layout 1', 'wpmozo-widgets-for-elementor' ),
                'layout2' => esc_html__( 'Layout 2', 'wpmozo-widgets-for-elementor' ),             
            ],
        ]
    );

    $this->add_control(
        'wpmozo_content_toggle_switcher_style_alignment',
        [
            'label' => esc_html__('Alignment', 'wpmozo-widgets-for-elementor'),
            'type' => Controls_Manager::CHOOSE,
            'label_block' => true,
            'options' => [
                'left' => [
                    'title' => esc_html__('Left', 'wpmozo-widgets-for-elementor'),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => esc_html__('Center', 'wpmozo-widgets-for-elementor'),
                    'icon' => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => esc_html__('Right', 'wpmozo-widgets-for-elementor'),
                    'icon' => 'eicon-text-align-right',
                ],
                'justify' => [
                    'title' => esc_html__('Justify', 'wpmozo-widgets-for-elementor'),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'default' => 'center',
            'toggle' => true,
            'selectors' => [
                '{{WRAPPER}} .wpmozo_content_toggle_wrapper .wpmozo_toggle_button_wrapper' => 'justify-content: {{VALUE}};',
            ],
        ]
    );


    $this->add_control(
        'wpmozo_content_toggle_switcher_style_color',
        [
            'label' => esc_html__('Switch Color', 'wpmozo-widgets-for-elementor'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .your-class ' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'wpmozo_content_toggle_switcher_style_color_on_state',
        [
            'label' => esc_html__('Switch Color (ON State)', 'wpmozo-widgets-for-elementor'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .your-class ' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'wpmozo_content_toggle_switcher_style_bg_color',
        [
            'label' => esc_html__('Switch Background Color', 'wpmozo-widgets-for-elementor'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .your-class ' => 'color: {{VALUE}}',
            ],
        ]
    );


    $this->add_control(
        'wpmozo_content_toggle_switcher_style_bg_color',
        [
            'label' => esc_html__('Switch Background Color (ON State)', 'wpmozo-widgets-for-elementor'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .your-class ' => 'color: {{VALUE}}',
            ],
        ]
    );
$this->end_controls_section();
//Toggle Switch Styling controls ends here

// Toggle text label controls starts here
$this->start_controls_section(
    'wpmozo_content_toggle_text_label_style',
    array(
        'label' => esc_html__('Toggle Label Text Settings', 'wpmozo-widgets-for-elementor'),
        'tab' => Controls_Manager::TAB_STYLE,
    )
);

    $this->start_controls_tabs(
        'wpmozo_content_toggle_text_label_tabs'
    );
        $this->start_controls_tab(
            'wpmozo_content_toggle_text_label_active_tab',
            [
                'label' => esc_html__('Active Toggle', 'wpmozo-widgets-for-elementor'),
            ]
        );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'wpmozo_content_toggle_text_label_active_typography',
                    'selector' => '{{WRAPPER}} .your-class',
                ]
            );
       
    $this->end_controls_tab();

    $this->start_controls_tab(
        'wpmozo_content_toggle_text_label_inactive_tab',
        [
            'label' => esc_html__('Inactive Toggle', 'wpmozo-widgets-for-elementor'),
        ]
    );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'wpmozo_content_toggle_text_label_inactive_typography',
                'selector' => '{{WRAPPER}} .your-class',
            ]
        );
       

    $this->end_controls_tab();
$this->end_controls_tabs();
$this->end_controls_section();
// Toggle text label controls ends here


// Content One text text settings starts here
$this->start_controls_section(
    'wpmozo_content_toggle_content_one_style',
    array(
        'label' => esc_html__('Content One Text Settings', 'wpmozo-widgets-for-elementor'),
        'tab' => Controls_Manager::TAB_STYLE,
    )
);  
   
    $this->add_control(
        'wpmozo_content_toggle_content_one_text_color',
        [
            'label' => esc_html__('Content One Text Color', 'wpmozo-widgets-for-elementor'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .your-class ' => 'color: {{VALUE}}',
            ],
        ]
    );
    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'wpmozo_content_toggle_content_one_typography',
            'selector' => '{{WRAPPER}} .your-class',
        ]
    );

    $this->add_group_control(
        Group_Control_Text_Shadow::get_type(),
        [
            'name' => 'wpmozo_content_toggle_content_one_text_shadow',
            'selector' => '{{WRAPPER}} .your-class',
        ]
    );

    $this->add_control(
        'wpmozo_content_toggle_content_one_alignment',
        [
            'label' => esc_html__('Alignment', 'wpmozo-widgets-for-elementor'),
            'type' => Controls_Manager::CHOOSE,
            'label_block' => true,
            'options' => [
                'left' => [
                    'title' => esc_html__('Left', 'wpmozo-widgets-for-elementor'),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => esc_html__('Center', 'wpmozo-widgets-for-elementor'),
                    'icon' => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => esc_html__('Right', 'wpmozo-widgets-for-elementor'),
                    'icon' => 'eicon-text-align-right',
                ],
                'justify' => [
                    'title' => esc_html__('Justify', 'wpmozo-widgets-for-elementor'),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'default' => 'center',
            'toggle' => true,
            'selectors' => [
                '{{WRAPPER}} .your-selector' => 'text-align: {{VALUE}};',
            ],
        ]
    );
$this->end_controls_section();
// Content One text text settings ends here




// Content Two text text settings starts here
$this->start_controls_section(
    'wpmozo_content_toggle_content_two_style',
    array(
        'label' => esc_html__('Content Two Text Settings', 'wpmozo-widgets-for-elementor'),
        'tab' => Controls_Manager::TAB_STYLE,
    )
);  
   
    $this->add_control(
        'wpmozo_content_toggle_content_two_text_color',
        [
            'label' => esc_html__('Content Two Text Color', 'wpmozo-widgets-for-elementor'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .your-class ' => 'color: {{VALUE}}',
            ],
        ]
    );
    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'wpmozo_content_toggle_content_two_typography',
            'selector' => '{{WRAPPER}} .your-class',
        ]
    );

    $this->add_group_control(
        Group_Control_Text_Shadow::get_type(),
        [
            'name' => 'wpmozo_content_toggle_content_two_text_shadow',
            'selector' => '{{WRAPPER}} .your-class',
        ]
    );

    $this->add_control(
        'wpmozo_content_toggle_content_two_alignment',
        [
            'label' => esc_html__('Alignment', 'wpmozo-widgets-for-elementor'),
            'type' => Controls_Manager::CHOOSE,
            'label_block' => true,
            'options' => [
                'left' => [
                    'title' => esc_html__('Left', 'wpmozo-widgets-for-elementor'),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => esc_html__('Center', 'wpmozo-widgets-for-elementor'),
                    'icon' => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => esc_html__('Right', 'wpmozo-widgets-for-elementor'),
                    'icon' => 'eicon-text-align-right',
                ],
                'justify' => [
                    'title' => esc_html__('Justify', 'wpmozo-widgets-for-elementor'),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'default' => 'center',
            'toggle' => true,
            'selectors' => [
                '{{WRAPPER}} .your-selector' => 'text-align: {{VALUE}};',
            ],
        ]
    );
$this->end_controls_section();
// Content Two text text settings ends here
/* Style tab ends here */




// Function to get Elementor templates as options
function get_elementor_templates_as_options() {
    $templates = \Elementor\Plugin::$instance->templates_manager->get_source( 'local' )->get_items();
    $template_options = [];    
    // Add the "Select Template" option with an empty value as the first item
    $template_options['0'] = esc_html__('Select Template', 'wpmozo-widgets-for-elementor');    
    foreach ( $templates as $template ) {
        // Use the template's ID as the key and the title as the value
        $template_options[ $template['template_id'] ] = $template['title'];
    }    
    return $template_options;
}

// Function to get a list of pages as options
function get_pages_as_options() {
    $pages = get_pages();
    $page_options = [];

    // Add the "Select Page" option with an empty value as the first item
    $page_options['0'] = esc_html__('Select Page', 'wpmozo-widgets-for-elementor');

    foreach ($pages as $page) {
        // Use the page's ID as the key and the title as the value
        $page_options[$page->ID] = $page->post_title;
    }

    return $page_options;
}
