<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @since      1.0.0
 *
 * @package    Ai_Shield
 * @subpackage Ai_Shield/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ai_Shield
 * @subpackage Ai_Shield/public
 * @author     Matthew Davidson <matthew@modulolotus.net>
 */
class Ai_Shield_Public {

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
	 * @param      string    $ai_shield       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $ai_shield, $version ) {

		$this->ai_shield = $ai_shield;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->ai_shield, plugin_dir_url( __FILE__ ) . 'css/ai-shield-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->ai_shield, plugin_dir_url( __FILE__ ) . 'js/ai-shield-public.js', array( 'jquery' ), $this->version, false );

	}

}
