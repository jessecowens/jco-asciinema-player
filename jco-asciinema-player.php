<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://jco.dev
 * @since             1.0.0
 * @package           Jco_Asciinema_Player
 *
 * @wordpress-plugin
 * Plugin Name:       Asciinema Player
 * Plugin URI:        https://jco.dev
 * Description:       A Plugin To Host Asciinema Recordings. See the official <a href="https://asciinema.org/docs/installation">Asciinema site</a> for details on how to record terminal sessions
 * Version:           1.0.1
 * Author:            Jesse C Owens
 * Author URI:        https://jessecowens.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       jco
 * Domain Path:       /languages
 *
 * JCO Asciinema Player is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * JCO Asciinema Player is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with JCO Asciinema Player. If not, see https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html.
 *
 * This plugin is also inspired by and/or uses code from the following plugins/libraries:
 *
 * Advanced Custom Fields[https://github.com/AdvancedCustomFields/acf]
 * asciinema-player v2.6.1[https://asciinema.org/]
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
define( 'JCO_ASCIINEMA_PLAYER_VERSION', '1.0.4' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-jco-asciinema-player-activator.php
 */
function activate_jco_asciinema_player() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-jco-asciinema-player-activator.php';
	Jco_Asciinema_Player_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-jco-asciinema-player-deactivator.php
 */
function deactivate_jco_asciinema_player() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-jco-asciinema-player-deactivator.php';
	Jco_Asciinema_Player_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_jco_asciinema_player' );
register_deactivation_hook( __FILE__, 'deactivate_jco_asciinema_player' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-jco-asciinema-player.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_jco_asciinema_player() {

	$plugin = new Jco_Asciinema_Player();
	$plugin->run();

}
run_jco_asciinema_player();
