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

class WPMOZO_Content_Toggle extends Widget_Base {

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
		return 'wpmozo_content_toggle';
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
		return esc_html__( 'WPMOZO Content Toggle', 'wpmozo-widgets-for-elementor' );
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
		return 'eicon-menu-toggle';
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
		 * Register widget controls.
		 *
		 * Adds different input fields to allow the user to change and customize the widget settings.
		 *
		 * @since 1.0.0
		 * @access protected
		 */
	protected function register_controls() {

        
		require_once( plugin_dir_path( __DIR__ )  . '/wpmozo-test/controls.php' );

		
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
		$settings 		= $this->get_settings_for_display()	;	
        // var_dump($settings['wpmozo_content_toggle_content_one_type']);
        $page_type = $settings['wpmozo_content_toggle_content_one_type'];

        $first_content = "";


        echo '-----rrrr----'.$page_type;
        if($page_type == 'text')
        {
            $first_content = '<div class="wpmozo_text_content_container">'.$settings['wpmozo_content_toggle_content_one_text_content'].'</div>';
        }elseif($page_type =="template"){


            echo '-----fff----';
            echo '-----this is from template block-----';
            $template_id = $settings['wpmozo_content_toggle_content_one_template_content'];
            if (class_exists("\\Elementor\\Plugin")) {
                $post_ID = 124;
                $pluginElementor = \Elementor\Plugin::instance();
                $first_content = $pluginElementor->frontend->get_builder_content($template_id);
            }else{
                $first_content = "Something went wrong.";
            }   
        }elseif($page_type=="page")
        {
            $page_id = $settings['wpmozo_content_toggle_content_one_page_content'];           

            echo '------this is from page block-----';
            $post = get_post($page_id); 
            // $first_content = apply_filters('the_content', $post->post_content); 
            $first_content = $post->post_content;
        }else{
            $first_content ="Nothing";
        }
        ?>

            <div class="wpmozo_content_toggle_wrapper">
					<div class="wpmozo_toggle_button_wrapper wpmozo_toggle_layout_one">
					<div class="wpmozo_toggle_title_value wpmozo_toggle_off_value">
					<h5><?php echo $settings['wpmozo_content_toggle_content_one_title']; ?></h5>
				</div>
					<div class="wpmozo_toggle_button">
				        <div class="wpmozo_toggle_button_inner">
							<input class="wpmozo_toggle_field" type="checkbox" value="">
							<div class="wpmozo_switch"></div>
				          	<div class="wpmozo_toggle_bg"></div>
				        </div>
			      </div>
	                <div class="wpmozo_toggle_title_value wpmozo_toggle_on_value">
					<h5><?php echo $settings['wpmozo_content_toggle_content_two_title']; ?></h5>
				</div>
	           	</div><div class="wpmozo_content_one_toggle wpmozo_content_toggle_text" style="">
					<?php echo $first_content; ?>
				</div><div class="wpmozo_content_two_toggle wpmozo_content_toggle_text" style="display: none;">
					This is second content.
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
	protected function content_template() {}
}
