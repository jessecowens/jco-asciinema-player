<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://jessecowens.com
 * @since      1.0.0
 *
 * @package    Jco_Asciinema_Player
 * @subpackage Jco_Asciinema_Player/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Jco_Asciinema_Player
 * @subpackage Jco_Asciinema_Player/includes
 * @author     Jesse C Owens <jesse@linux-goals.com>
 */
class Jco_Asciinema_Player_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'jco-asciinema-player',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
