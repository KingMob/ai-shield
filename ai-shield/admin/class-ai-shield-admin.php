<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Ai_Shield
 * @subpackage Ai_Shield/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ai_Shield
 * @subpackage Ai_Shield/admin
 * @author     Matthew Davidson <matthew@modulolotus.net>
 */
class Ai_Shield_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $ai_shield    The ID of this plugin.
	 */
	private $ai_shield;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $ai_shield       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $ai_shield, $version ) {

		$this->ai_shield = $ai_shield;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ai_Shield_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ai_Shield_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->ai_shield, plugin_dir_url( __FILE__ ) . 'css/ai-shield-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ai_Shield_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ai_Shield_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->ai_shield, plugin_dir_url( __FILE__ ) . 'js/ai-shield-admin.js', array( 'jquery' ), $this->version, false );

	}

}
