<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @since      1.0.0
 *
 * @package    Ai_Shield
 * @subpackage Ai_Shield/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Ai_Shield
 * @subpackage Ai_Shield/includes
 * @author     Matthew Davidson <matthew@modulolotus.net>
 */
class Ai_Shield {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Ai_Shield_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $ai_shield    The string used to uniquely identify this plugin.
	 */
	protected $ai_shield;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

    protected $zero_width_chars;
    protected $space_substitute_chars;

    /**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'AI_SHIELD_VERSION' ) ) {
			$this->version = AI_SHIELD_VERSION;
		} else {
			$this->version = '1.0.1';
		}
		$this->ai_shield = 'ai-shield';

//        $this->zero_width_chars = array_map('mb_chr', [0x180e, 0x034f, 0x17b4, 0x17b5, 0x200b, 0x2060, 0x2062, 0x2061]);
        $this->zero_width_chars = array_map('mb_chr', [0x034f, 0x2060, 0x2062, 0x2061]);
        $this->space_substitute_chars = array_map('mb_chr', [0x0009, 0x000d, 0x000A]);

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Ai_Shield_Loader. Orchestrates the hooks of the plugin.
	 * - Ai_Shield_i18n. Defines internationalization functionality.
	 * - Ai_Shield_Admin. Defines all hooks for the admin area.
	 * - Ai_Shield_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ai-shield-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ai-shield-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ai-shield-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-ai-shield-public.php';

		$this->loader = new Ai_Shield_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Ai_Shield_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Ai_Shield_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Ai_Shield_Admin( $this->get_ai_shield(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

    public function obscure_content( $content ) {
//        $len = mb_strlen($content);
//        return chunk_split($content, mt_rand(2, 20), mb_chr(0x180E));
//        $content = chunk_split($content, mt_rand(2, 20), '❄');
//        $content = chunk_split($content, mt_rand(2, 20), '❄');
//        $content = chunk_split($content, mt_rand(2, 20), '❄');

//        $num_iters = 3;
//        $rand_keys = array_rand($this->zero_width_chars, $num_iters);
//        for ($i = 0; $i < $num_iters; $i++) {
//            $content = implode($this->zero_width_chars[$rand_keys[$i]], mb_str_split($content, mt_rand(2,20)));
//        }

//        $content = implode(mb_chr(0x180E), mb_str_split($content, mt_rand(2,20)));
//        $content = implode(mb_chr(0x180E), mb_str_split($content, mt_rand(2,20)));
//        $content = implode('❄', mb_str_split($content, mt_rand(2,20)));
//        $content = implode('❄', mb_str_split($content, mt_rand(2,20)));

//        $pattern = '>[^<]+<';
//        $content = mb_ereg_replace_callback($pattern, function ($matches) {
//            return '>' . implode('❄', mb_str_split(mb_substr($matches[0], 1, mb_strlen($matches[0]) - 2), mt_rand(2,20))) . '<';
//        }, $content, 'm');


//        $pattern = '(\>|\&\w+;)([^<]*)(\<|\&\w+;)';
//        (>|&\w+;)([^<&]+)(<|&\w+;)
//        $pattern = '(>|;)\s*([^<&]+)\s*(<|&)';
        $pattern = '((?:>|;)\s*)([^<&]+)(\s*(?:<|&))';
        $content = mb_ereg_replace_callback($pattern, function ($matches) {
            return $matches[1]
                . implode($this->zero_width_chars[array_rand($this->zero_width_chars)],
                    mb_str_split($matches[2], mt_rand(2,10)))
                . $matches[3];
//            return $matches[1] . implode('❄', mb_str_split($matches[2], mt_rand(2,20))) . $matches[3];
        }, $content, 'm');


        $content = mb_ereg_replace_callback(' ', function ($matches) {
//            return '❄';
            return $this->space_substitute_chars[array_rand($this->space_substitute_chars)];
        }, $content, 'm');

        return $content;
    }

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Ai_Shield_Public( $this->get_ai_shield(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

        $this->loader->add_filter('the_content', $this, 'obscure_content');
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_ai_shield() {
		return $this->ai_shield;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Ai_Shield_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
