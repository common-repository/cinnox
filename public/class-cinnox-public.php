<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @since      1.0.0
 *
 * @package    Cinnox
 * @subpackage Cinnox/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Cinnox
 * @subpackage Cinnox/public
 * @author     M800 Ltd.
 */
class CinnoxPublic {

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

  }

  /**
   * Register the stylesheets for the public-facing side of the site.
   *
   * Note that we do not have any style for this plugin, this function is kept
   * to maintain extensibility only.
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
   * Register the JavaScript for the public-facing side of the site.
   *
   * @since    1.0.0
   */
  public function enqueue_scripts() {

    /**
     * An instance of this class should be passed to the run() function
     * defined in CinnoxLoader as all of the hooks are defined
     * in that particular class.
     *
     * The loader will then create the relationship
     * between the defined hooks and the functions defined in this
     * class.
     */

    $service_account = get_option( 'cinnox_service-account' );
    if ( !isset( $service_account ) || empty( $service_account ) ) {
      return;
    }

    // service name ends with ".cn" then get cxwc script from cn
    $src = sprintf(
      'https://cxwc.cx.cinnox.%s/cxwc/cxwc.js',
      preg_match( '/\.cn$/', $service_account) ? 'cn': 'com'
    );
    $settings = "window.wcSettings = { serviceName: '$service_account' };";
    wp_enqueue_script( 'cinnox-cxwc-script', $src, array(), null );
    wp_add_inline_script( 'cinnox-cxwc-script', $settings, 'before' );
    add_filter( 'script_loader_tag', array( $this, 'add_script_id' ), 10, 3 );
  }

  /**
   * Replace the script tag of wc to include id attribute.
   *
   * @since 1.0.0
   */
  public function add_script_id( $tag, $handle, $src ) {
    if ( 'cinnox-cxwc-script' === $handle ) {
      // The settings tag will be included in $tag as well,
      // simply replacing '<script' will causing the settings be defer as well,
      // and that will break wc.
      // Using more complicated script to match the exact script tag for accurate overwriting.
      $tag = preg_replace( '/(<script[^>]*) (src=[^>]*>)/i', '$1 id="wc-dom-id" defer $2', $tag );
    }
    return $tag;
  }

}
