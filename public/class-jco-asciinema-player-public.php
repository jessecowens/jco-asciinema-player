<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://jessecowens.com
 * @since      1.0.0
 *
 * @package    Jco_Asciinema_Player
 * @subpackage Jco_Asciinema_Player/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Jco_Asciinema_Player
 * @subpackage Jco_Asciinema_Player/public
 * @author     Jesse C Owens <jesse@linux-goals.com>
 */
class Jco_Asciinema_Player_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_shortcode( 'asciinema', 'handle_asciinema_shortcode' );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Jco_Asciinema_Player_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Jco_Asciinema_Player_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_register_style( $this->plugin_name, plugin_dir_url( __DIR__ ) . 'includes/asciinema-player/css/asciinema-player.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Jco_Asciinema_Player_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Jco_Asciinema_Player_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_register_script( $this->plugin_name, plugin_dir_url( __DIR__ ) . 'includes/asciinema-player/js/asciinema-player.js', array(), $this->version, true );
	}

	/**
	 * Register the asciinema item public display templates
	 *
	 * @param $template_path string
	 *
	 * @return string
	 */
	public function asciinema_display( $template_path ) {
		global $wp_query, $post;
		if ( get_post_type() == 'jco_asciinema_post' ) {
			$template_path = plugin_dir_path( __FILE__ ) . '/partials/jco-asciinema-player-public-display.php';
		}
		return $template_path;
	}



}
