<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://jessecowens.com
 * @since      1.0.0
 *
 * @package    Jco_Asciinema_Player
 * @subpackage Jco_Asciinema_Player/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Jco_Asciinema_Player
 * @subpackage Jco_Asciinema_Player/admin
 * @author     Jesse C Owens <jesse@linux-goals.com>
 */
class Jco_Asciinema_Player_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
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
		 * defined in Jco_Asciinema_Player_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Jco_Asciinema_Player_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/jco-asciinema-player-admin.css', array(), $this->version, 'all' );
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
		 * defined in Jco_Asciinema_Player_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Jco_Asciinema_Player_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/jco-asciinema-player-admin.js', array(), $this->version, false );
	}

	/**
	 * Add the Shortcode
	 */
	public function create_asciinema_shortcode() {
		add_shortcode( 'asciinema', array( $this, 'handle_asciinema_shortcode') );
	}

	/**
	 * Handle the Shortcode
	 *
	 * @param $atts
	 *
	 * @return string
	 */
	public function handle_asciinema_shortcode( $atts ) {

		// Attributes
		$attributes = shortcode_atts(
			array(
				'id' => '0',
			),
			$atts
		);

		$file = get_field('asciienma_file', $attributes['id']);
		$playback_options = array(
			"src" => $file['url'],
			"cols" => get_field('columns', $attributes['id']),
			"rows" => get_field('rows', $attributes['id']),
			"autoplay" => get_field('autoplay', $attributes['id']),
			"loop" => get_field('loop', $attributes['id']),
			"start_at" => get_field('start_at', $attributes['id']),
			"speed" => get_field('speed', $attributes['id']),
			"idle_time_limit" => get_field('idle_time_limit', $attributes['id']),
			"poster_type" => get_field('poster_type', $attributes['id']),
			"poster_time" => get_field('poster_time', $attributes['id']),
			"poster_text" => get_field('poster_text', $attributes['id']),
			"theme" => get_field('theme', $attributes['id']),
			"font_size" => get_field('font_size', $attributes['id'])
		);

	$player_tag = "<asciinema-player src=\"{$playback_options['src']}\"
					cols=\"{$playback_options['cols']}\"
					rows=\"{$playback_options['rows']}\"
					start-at=\"{$playback_options['start_at']}\"
					speed=\"{$playback_options['speed']}\"
					idle-time-limit=\"{$playback_options['idle_time_limit']}\"
					font-size=\"{$playback_options['font_size']}\"
					theme=\"{$playback_options['theme']}\" ";
	if ($playback_options['autoplay']) {
		$player_tag .= "autoplay=\"true\" ";
	}
	if ($playback_options['loop']) {
		$player_tag .= "loop=\"true\" ";
	}
	if ($playback_options['poster_text']){
		$player_tag .= "poster=data:text/plain,{$playback_options['poster_text']}\" ";
	} else {
		$player_tag .= "poster=npt:{$playback_options['poster_time']}\" ";
	}

	$player_tag .= "></asciinema-player>";
		return $player_tag;

	}


	/**
	 * Enable JSON uploads
	 *
	 * @since 1.0.0
	 *
	 * @param array $mime_types The Accepted upload mime types
	 *
	 * @return array
	 */
	public function add_json_mime( $mime_types ) {
		if ( current_user_can('activate_plugins' ) ) {
			$mime_types['json'] = 'application/json';
		}
		return $mime_types;
	}

	/**
	 * @param $filter_arg
	 */
	public function add_shortcode_prompt( $filter_arg ) {
		$screen = get_current_screen();
		if ( $screen->post_type == 'jco_asciinema_post' ) {
			$post = get_post();
			echo '<h3>Insert this Asciinema with shortcode: [asciinema id="'. $post->ID . '"]</h3>';
			if ( get_post_status($post->ID) != 'auto-draft') {
			echo $this->handle_asciinema_shortcode($post->ID);
		} else {
			//silence
		}
		}
	}

	/**
	 * Creates the Custom Post Type for Asciinema
	 *
	 * @since 1.0.0
	 */
	public function create_asciinema_post() {

		$labels = array(
			'name'                  => _x( 'Asciinema Casts', 'Post Type General Name', 'jco' ),
			'singular_name'         => _x( 'Asciinema Cast', 'Post Type Singular Name', 'jco' ),
			'menu_name'             => __( 'Asciinema', 'jco' ),
			'name_admin_bar'        => __( 'Asciinema', 'jco' ),
			'archives'              => __( 'Asciinema Archives', 'jco' ),
			'attributes'            => __( 'Asciinema Attributes', 'jco' ),
			'parent_item_colon'     => __( 'Parent Asciinema:', 'jco' ),
			'all_items'             => __( 'Asciinemas', 'jco' ),
			'add_new_item'          => __( 'Add New Asciinema', 'jco' ),
			'add_new'               => __( 'Add New', 'jco' ),
			'new_item'              => __( 'New Asciinema', 'jco' ),
			'edit_item'             => __( 'Edit Asciinema', 'jco' ),
			'update_item'           => __( 'Update Asciinema', 'jco' ),
			'view_item'             => __( 'View Asciinema', 'jco' ),
			'view_items'            => __( 'View Asciinemas', 'jco' ),
			'search_items'          => __( 'Search Asciinema', 'jco' ),
			'not_found'             => __( 'Not found', 'jco' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'jco' ),
			'featured_image'        => __( 'Featured Image', 'jco' ),
			'set_featured_image'    => __( 'Set featured image', 'jco' ),
			'remove_featured_image' => __( 'Remove featured image', 'jco' ),
			'use_featured_image'    => __( 'Use as featured image', 'jco' ),
			'insert_into_item'      => __( 'Insert into Asciinema', 'jco' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Asciinema', 'jco' ),
			'items_list'            => __( 'Asciinema list', 'jco' ),
			'items_list_navigation' => __( 'Asciinema list navigation', 'jco' ),
			'filter_items_list'     => __( 'Filter Asciinemas list', 'jco' ),
		);
		$args = array(
			'label'                 => __( 'Asciinema Cast', 'jco' ),
			'description'           => __( 'Asciinema casts are command line recordings.', 'jco' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'comments', 'custom-fields'),
			'taxonomies'            => array( 'category', 'post_tag' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => 'upload.php',
			'menu_position'         => 80,
			'menu_icon'             => 'dashicons-welcome-view-site',
			'show_in_admin_bar'     => false,
			'show_in_nav_menus'     => false,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
			'show_in_rest'          => true,
		);
		register_post_type( 'jco_asciinema_post', $args );
		$this->create_asciinema_fields();
	}

	public function create_asciinema_fields() {
		if(function_exists("register_field_group"))
		{
			register_field_group(array (
				'id' => 'acf_asciinema-fields',
				'title' => 'Asciinema Fields',
				'fields' => array (
					array (
						'key' => 'field_5af84e4a11c8d',
						'label' => __('Asciienma File','jco'),
						'name' => 'asciienma_file',
						'type' => 'file',
						'instructions' => __('Upload the Asciinema JSON file here.','jco'),
						'required' => 1,
						'save_format' => 'object',
						'library' => 'all',
					),
					array (
						'key' => 'field_5af85223f0f63',
						'label' => __('Description','jco'),
						'name' => 'description',
						'type' => 'textarea',
						'instructions' => __('Enter an SEO-Friendly description for this Asciinema. (max 256 chars)','jco'),
						'default_value' => '',
						'placeholder' => '',
						'maxlength' => 256,
						'rows' => 4,
						'formatting' => 'br',
					),
					array (
						'key' => 'field_5af850e97fec9',
						'label' => __('Columns','jco'),
						'name' => 'columns',
						'type' => 'number',
						'instructions' => __('The number of columns to display (default 80)','jco'),
						'default_value' => 80,
						'placeholder' => 80,
						'prepend' => '',
						'append' => '',
						'min' => 0,
						'max' => 1024,
						'step' => 1,
					),
					array (
						'key' => 'field_5af8518c7fecb',
						'label' => __('Rows','jco'),
						'name' => 'rows',
						'type' => 'number',
						'instructions' => __('The number of rows to display (default 24)','jco'),
						'default_value' => 24,
						'placeholder' => 24,
						'prepend' => '',
						'append' => '',
						'min' => 0,
						'max' => 1024,
						'step' => 1,
					),
					array (
						'key' => 'field_5af851b97fecc',
						'label' => __('Autoplay?','jco'),
						'name' => 'autoplay',
						'type' => 'true_false',
						'instructions' => __('Set this to true for playback to start automatically. (Default: false)','jco'),
						'message' => '',
						'default_value' => 0,
					),
					array (
						'key' => 'field_5af85294f0f64',
						'label' => __('Loop?','jco'),
						'name' => 'loop',
						'type' => 'true_false',
						'instructions' => __('Set this to true for playback to continuously loop.. (Default: false)','jco'),
						'message' => '',
						'default_value' => 0,
					),
					array (
						'key' => 'field_5af852e9f0f65',
						'label' => __('Start At?','jco'),
						'name' => 'start_at',
						'type' => 'number',
						'instructions' => __('Start playback at a given time in seconds.','jco'),
						'default_value' => 0,
						'placeholder' => 0,
						'prepend' => '',
						'append' => '',
						'min' => 0,
						'max' => 1024,
						'step' => 1,
					),
					array (
						'key' => 'field_5af85339f0f66',
						'label' => 'Speed',
						'name' => 'speed',
						'type' => 'number',
						'instructions' => __('Playback speed. Default is 1 (normal speed). 2 means 2x faster.','jco'),
						'default_value' => 1,
						'placeholder' => 1,
						'prepend' => '',
						'append' => '',
						'min' => 1,
						'max' => 10,
						'step' => 1,
					),
					array (
						'key' => 'field_5af8559bf0f67',
						'label' => __('Idle Time Limit','jco'),
						'name' => 'idle_time_limit',
						'type' => 'number',
						'instructions' => __('Limit inactivity to a given number of seconds. For example, any inactivity longer than 2 seconds will be "compressed" to 2 seconds. Default is unlimited.','jco'),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => 1,
						'max' => '',
						'step' => 1,
					),
					array (
						'key' => 'field_5af856a5f0f69',
						'label' => __('Poster Type','jco'),
						'name' => 'poster_type',
						'type' => 'radio',
						'instructions' => __('Choose a time or create a custom poster. Defaults to the the start time.','jco'),
						'choices' => array (
							'Time' => 'Time',
							'Custom Text' => 'Custom Text',
						),
						'other_choice' => 0,
						'save_other_choice' => 0,
						'default_value' => 'Time',
						'layout' => 'horizontal',
					),
					array (
						'key' => 'field_5af85668f0f68',
						'label' => __('Poster Time','jco'),
						'name' => 'poster_time',
						'type' => 'text',
						'instructions' => __('The time, in the format MM:SS, to use for the preview thumbnail.','jco'),
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5af856a5f0f69',
									'operator' => '==',
									'value' => 'Time',
								),
							),
							'allorany' => 'all',
						),
						'default_value' => '00:00',
						'placeholder' => '00:00',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
					array (
						'key' => 'field_5af85799f0f6a',
						'label' => __('Poster Text','jco'),
						'name' => 'poster_text',
						'type' => 'text',
						'instructions' => __('Enter custom text to use as the preview. ANSI escape codes can be used to add color and move the cursor. For example:
	I\'m regular \\x1b[1;32mI\'m bold green\\x1b[3BI\'m 3 lines down','jco'),
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_5af856a5f0f69',
									'operator' => '==',
									'value' => 'Custom Text',
								),
							),
							'allorany' => 'all',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
					array (
						'key' => 'field_5af85890f0f6b',
						'label' => __('Theme','jco'),
						'name' => 'theme',
						'type' => 'select',
						'instructions' => __('Choose the theme for this Asciinema.','jco'),
						'choices' => array (
							'asciinema' => __('Asciinema','jco'),
							'tango' => __('Tango','jco'),
							'solarized-dark' => __('Solarized Dark','jco'),
							'solarized-light' => __('Solarized Light','jco'),
							'monokai' => __('Monokai','jco'),
						),
						'default_value' => 'asciinema',
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_5af85a5eb21d6',
						'label' => __('Font Size','jco'),
						'name' => 'font_size',
						'type' => 'select',
						'instructions' => __('Choose a Font Size for Playback','jco'),
						'choices' => array (
							'small' => 'Small',
							'medium' => 'Medium',
							'big' => 'Big',
						),
						'default_value' => 'small',
						'allow_null' => 0,
						'multiple' => 0,
					),
				),
				'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'jco_asciinema_post',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
				),
				'options' => array (
					'position' => 'normal',
					'layout' => 'no_box',
					'hide_on_screen' => array (
					),
				),
				'menu_order' => 0,
			));
		}

	}

}
