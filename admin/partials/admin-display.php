<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://wpmozo.com/
 * @since      1.0.0
 */
?>
<div id="wpmozo_panel_license_section" class="wpmozo_panel_section wpmozo_panel_active_section">
	<?php
		include_once plugin_dir_path( __FILE__ ) . 'settings/license.php';
	?>
</div>