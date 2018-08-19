<?php

/**
 * Fired during plugin activation
 *
 * @link       https://jessecowens.com
 * @since      1.0.0
 *
 * @package    Jco_Asciinema_Player
 * @subpackage Jco_Asciinema_Player/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Jco_Asciinema_Player
 * @subpackage Jco_Asciinema_Player/includes
 * @author     Jesse C Owens <jesse@linux-goals.com>
 */
class Jco_Asciinema_Player_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		flush_rewrite_rules();
		
	}

}
