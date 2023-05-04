<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/KingMob/ai-shield
 * @since             1.0.0
 * @package           Ai_Shield
 *
 * @wordpress-plugin
 * Plugin Name:       AI Shield
 * Plugin URI:        https://github.com/KingMob/ai-shield
 * Description:       AI Shield helps protect your content from being used to train AI models, by inserting whitespace
that's invisible to humans, but awkward for AIs.
 * Version:           1.0.0
 * Author:            Matthew Davidson
 * Author URI:        https://github.com/KingMob
 * License:           GPL-2.0
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ai-shield
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'AI_SHIELD_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ai-shield-activator.php
 */
function activate_ai_shield() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ai-shield-activator.php';
	Ai_Shield_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ai-shield-deactivator.php
 */
function deactivate_ai_shield() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ai-shield-deactivator.php';
	Ai_Shield_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ai_shield' );
register_deactivation_hook( __FILE__, 'deactivate_ai_shield' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ai-shield.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ai_shield() {

	$plugin = new Ai_Shield();
	$plugin->run();

}
run_ai_shield();
