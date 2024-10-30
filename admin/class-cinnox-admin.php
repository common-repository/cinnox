<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @since      1.0.0
 *
 * @package    Cinnox
 * @subpackage Cinnox/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cinnox
 * @subpackage Cinnox/admin
 * @author     M800 Ltd.
 */
class CinnoxAdmin {

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
    $this->admin_pages = [];

    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/cinnox-admin-display.php';
  }

  /**
   * Initialize the plugin.
   * It register the admin setting page.
   * 
   * @since 1.0.0
   */
  public function register_admin_settings() {

    $option_prefix = 'cinnox';
    $option_group = 'cinnox-options';
    $setting_page = 'cinnox-settings';
    $setting_default_section = 'cinnox_section';

    register_setting(
      $option_group,
      'cinnox_service-account', // option name
      array(
        'type' => 'string',
        'description' => 'Service account is your service identifier to access cinnox'
      )
    );

    add_settings_section(
      $setting_default_section,
      'General Settings',
      'cinnox_render_section',
      $setting_page
    );

    add_settings_field(
      'cinnox_service-account',
      'Service Account',
      'cinnox_render_service_account',
      $setting_page,
      $setting_default_section
    );
  }

  public function register_admin_menu() {

    $general_setting_page = add_options_page(
      'cinnox Setting',
      'cinnox',
      'manage_options',
      'cinnox-settings',
      'cinnox_render_settings_page'
    );
    $this->admin_pages[] = $general_setting_page;

    add_filter('plugin_action_links', 'cinnox_plugin_action_links', 10, 2);

  }

  /**
   * Register the stylesheets for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_styles() {

    /**
     * An instance of this class should be passed to the run() function
     * defined in CinnoxLoader as all of the hooks are defined
     * in that particular class.
     *
     * The CinnoxLoader will then create the relationship
     * between the defined hooks and the functions defined in this
     * class.
     */

  }

  /**
   * Register the JavaScript for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_scripts( $hook ) {

    /**
     * An instance of this class should be passed to the run() function
     * defined in CinnoxLoader as all of the hooks are defined
     * in that particular class.
     *
     * The CinnoxLoader will then create the relationship
     * between the defined hooks and the functions defined in this
     * class.
     */

    if ( !in_array( $hook, $this->admin_pages ) ) {
      return;
    }

    wp_enqueue_script( 'popper', plugin_dir_url( __DIR__ ) . '/resources/js/popper.min.js', array(), true );
    wp_enqueue_script( 'cinnox-tooltip', plugin_dir_url( __FILE__ ) . '/js/tooltip.js', array(), true, true );

  }

}
