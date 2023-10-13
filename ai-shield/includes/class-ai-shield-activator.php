<?php

/**
 * Fired during plugin activation
 *
 * @since      1.0.0
 *
 * @package    Ai_Shield
 * @subpackage Ai_Shield/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Ai_Shield
 * @subpackage Ai_Shield/includes
 * @author     Matthew Davidson <matthew@modulolotus.net>
 */
class Ai_Shield_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		add_option(Ai_Shield_Admin::OPTION_NAME, Ai_Shield_Admin::DEFAULT_SETTINGS);
	}

}
