<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 *
 * @package    Cinnox
 * @subpackage Cinnox/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Cinnox
 * @subpackage Cinnox/includes
 * @author     M800 Ltd.
 */
class CinnoxI18n {


  /**
   * Load the plugin text domain for translation.
   *
   * @since    1.0.0
   */
  public function load_plugin_textdomain() {

    load_plugin_textdomain(
      'cinnox-widget',
      false,
      dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/locales/'
    );

  }

}
