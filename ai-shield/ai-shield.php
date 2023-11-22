<?php
/*
 * Plugin Name:       AI Shield
 * Plugin URI:        https://github.com/KingMob/ai-shield
 * Description:       AI Shield helps protect your content from being used to train AI models, by inserting whitespace that's invisible to humans, but awkward for AIs.
 * Version:           1.0.2
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

if ( ! defined( 'AI_SHIELD_PLUGIN_FILE' ) ) {
	define( 'AI_SHIELD_PLUGIN_FILE', __FILE__ );
}

define( 'AI_SHIELD_VERSION', '1.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ai-shield-activator.php
 */
function ai_shield_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ai-shield-activator.php';
	Ai_Shield_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ai-shield-deactivator.php
 */
function ai_shield_deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ai-shield-deactivator.php';
	Ai_Shield_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'ai_shield_activate' );
register_deactivation_hook( __FILE__, 'ai_shield_deactivate' );

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
function ai_shield_run() {

	$plugin = new Ai_Shield();
	$plugin->run();

}
ai_shield_run();
