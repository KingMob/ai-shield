<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @since      1.0.0
 *
 * @package    Ai_Shield
 * @subpackage Ai_Shield/admin
 */

/**
 * The admin-specific functionality of the plugin.
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
	 * The option name
	 *
	 * @since    1.0.1
	 * @access   private
	 * @var      string    $option_name    The key all options are stored under
	 */
	public const OPTION_NAME = 'ai_shield';

	/**
	 * The option group of this plugin.
	 *
	 * @since    1.0.1
	 * @access   private
	 * @var      string    $option_group    The option group
	 */
	private $option_group = 'ai_shield_group';

	/**
	 * The option page of this plugin.
	 *
	 * @since    1.0.1
	 * @access   private
	 * @var      string    $option_page    The option page
	 */
	private $option_page = 'ai_shield_page';

	public const DEFAULT_SETTINGS = [
		'enabled' => true,
		'use_cache' => true,
		'cache_duration' => 5
	];

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

	public function register_settings () {
		$settings_section = self::OPTION_NAME . '_section';
		
		register_setting( 
			$this->option_group, 
			self::OPTION_NAME ,
			[	
				'sanitize_callback' => [$this, 'sanitize_fields'],
			    'default'           => self::DEFAULT_SETTINGS
			]
		);

		add_settings_section( 
			$settings_section,
			'', // __( 'AI Shield', 'ai-shield' ),
			'', // 'ai_shield_main_section_text_output',
			$this->option_page
		);

		add_settings_field(
			'enabled',
			__('Enabled', 'ai-shield' ),
			[$this, 'render_checkbox_input'],
			$this->option_page,
			$settings_section,
			['label_for' => 'enabled']
		);

		add_settings_field(
			'use_cache',
			__('Cache enabled', 'ai-shield' ),
			[$this, 'render_checkbox_input'],
			$this->option_page,
			$settings_section,
			['label_for' => 'use_cache']
		);

		add_settings_field(
			'cache_duration',
			__('Cache duration', 'ai-shield' ),
			[$this, 'render_cache_duration_input'],
			$this->option_page,
			$settings_section,
			['label_for' => 'cache_duration']
		);
	}

	public function register_options_page() {
		// add_menu_page(
		// 	'AI Shield Settings',
		// 	'AI Shield',
		// 	'manage_options',
		// 	'ai_shield',
		// 	[$this, 'options_page_html']
		// );

		add_options_page(
			'AI Shield',
			'AI Shield',
			'manage_options',
			'ai_shield',
			[$this, 'options_page_html']
		);
	}

	public function options_page_html() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
	
		// WP displays its own notice if using a submenu
		// if ( isset( $_GET['settings-updated'] ) ) {
		// 	add_settings_error(
		// 		'options_messages',
		// 		'my_options_message',
		// 		esc_html__( 'Settings saved', 'ai-shield' ),
		// 		'success'
		// 	);
		// }
	
		settings_errors( 'options_messages' );
	
		?>
		<div class="wrap">
			<h1><?php esc_html_e( get_admin_page_title() ); ?></h1>
			<form action="options.php" method="post">
				<?php
					settings_fields( $this->option_group );
					do_settings_sections( $this->option_page );
					submit_button( 'Save Settings' );
				?>
			</form>
		</div>
		<?php
	}
	

	function render_checkbox_input( $args ) {
		$value = get_option( self::OPTION_NAME )[$args['label_for']] ?? '';
		?>
		<input
			type="checkbox"
			id="<?php esc_attr_e( $args['label_for'] ); ?>"
			name="<?php esc_attr_e( self::OPTION_NAME ) ?>[<?php esc_attr_e( $args['label_for'] ); ?>]"
			<?php if( $value ) esc_attr_e("checked"); ?>>
		<?php
	}

	function render_cache_duration_input( $args ) {
		$value = get_option( self::OPTION_NAME )[$args['label_for']] ?? '';
		?>
		<input
			type="number"
			id="<?php esc_attr_e( $args['label_for'] ); ?>"
			name="<?php esc_attr_e( self::OPTION_NAME ) ?>[<?php esc_attr_e( $args['label_for'] ); ?>]"
			value="<?php esc_attr_e( $value ); ?>"
			min="1"
			required
			list="AiShieldDefaultCacheDurations">
		<datalist id="AiShieldDefaultCacheDurations">
			<option value="1"></option>
			<option value="5"></option>
			<option value="15"></option>
			<option value="60"></option>
			<option value="480"></option>
			<option value="1440"></option>
		</datalist>
		<p class="description"><?php esc_html_e( 'How many minutes should the transformed content be cached for? (Changing the content will always update the cache immediately.)', 'ai-shield' ); ?></p>
		<?php
	}

	function sanitize_checkbox( $settings, $key ) {
		if ( array_key_exists( $key, $settings ) ) {
			// Checking multiple values because, if the old value was the default, WP 
			// calls add_option(), which effectively double-sanitizes the value. So
			// sanitization should always be ready to handle its output values
			return in_array( $settings[$key], ['on', '1', 'true', 'yes', true, 1] );
		} else {
			return false;
		}
	}

	function sanitize_fields( $value ) {
		$value = (array) $value;

		// error_log('Sanitizing from top-level: ' . $_SERVER['PHP_SELF']);

		// ob_start();
        // debug_print_backtrace();
        // $trace = ob_get_contents();
        // ob_end_clean();
		// error_log("Backtrace: " . $trace);

		// error_log('Input: ' . var_export($value, true));

		$value['enabled'] = $this->sanitize_checkbox( $value, 'enabled' );
		$value['use_cache'] = $this->sanitize_checkbox( $value, 'use_cache' );
		

		if ( array_key_exists( 'cache_duration', $value )) {
			if( !is_numeric( $value['cache_duration'] ) || $value['cache_duration'] <= 0) {
				add_settings_error(
					'options_messages',
					'cache_duration',
					esc_html__( 'Cache duration must be a number > 0', 'ai-shield' ),
					'error'
				);
			} else {
				$value['cache_duration'] = intval($value['cache_duration']);
			}
		}

		// error_log('Output: ' . var_export($value, true));

		return $value;
	}

	public function plugin_action_links( $links ) {
		$action_links = [
			'settings' => '<a href="' . admin_url( 'options-general.php?page=ai_shield' ) . '" aria-label="' . esc_attr__( 'View AI Shield settings', 'ai-shield' ) . '">' . esc_html__( 'Settings', 'ai-shield' ) . '</a>',
			'invisible' => '<a href="https://invisible-characters.com/view.html" aria-label="' . esc_attr__( 'View invisible characters', 'ai-shield' ) . '">' . esc_html__( 'View invisible characters', 'ai-shield' ) . '</a>',
		];

		return array_merge( $action_links, $links );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->ai_shield, plugin_dir_url( __FILE__ ) . 'css/ai-shield-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->ai_shield, plugin_dir_url( __FILE__ ) . 'js/ai-shield-admin.js', array( 'jquery' ), $this->version, false );

	}

}
