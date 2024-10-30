<?php
/**
 * Plugin Name: cinnox
 * Description: Use the CINNOX plugin to instantly add live call and chat functions on your WordPress website and promptly answer your online customers’ enquiries. 
 * Version: 1.0.3
 * Requires at least: 5.2
 * Requires PHP: 5.6
 * Author: cinnox
 * Author URI: https://www.cinnox.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * CINNOX plugin is free software: you can redistribute it or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * CINNOX plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with cinnox plugin.
 * If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 */

// Forbid direct access to this file, must load from WP core
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define( 'CINNOX_PLUGIN', 'cinnox' );
define( 'CINNOX_PLUGINDIR', str_replace('\\','/', dirname(__FILE__)) );
define( 'CINNOX_VERSION', '1.0.3' );

// Include both internal and external service
define( 'CINNOX_REGEX', '/^[a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9](\.[a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9])*\.(cinnox|m800)\.(com|cn)$/' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cinnox-activator.php
 */
function activate_cinnox() {
  require_once plugin_dir_path( __FILE__ ) . 'includes/class-cinnox-activator.php';
  CinnoxActivator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cinnox-deactivator.php
 */
function deactivate_cinnox() {
  require_once plugin_dir_path( __FILE__ ) . 'includes/class-cinnox-deactivator.php';
  CinnoxDeactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cinnox' );
register_deactivation_hook( __FILE__, 'deactivate_cinnox' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cinnox.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 1.0.0
 */
function run_cinnox() {
  $plugin = new Cinnox();
  $plugin->run();
}
run_cinnox();
