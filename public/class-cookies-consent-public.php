<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://maturocha.com.ar/
 * @since      1.0.0
 *
 * @package    Cookies_Consent
 * @subpackage Cookies_Consent/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Cookies_Consent
 * @subpackage Cookies_Consent/public
 * @author     Mati Rocha <matu.rocha@gmail.com>
 */
class Cookies_Consent_Public {

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
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cookies_Consent_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cookies_Consent_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cookies-consent-public.css', array(), $this->version, 'all' );
		wp_register_style( 'cookies-styles' , plugin_dir_url( __FILE__ ) . 'css/cookies-box.css', array(), $this->version, 'all' );

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
		 * defined in Cookies_Consent_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cookies_Consent_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cookies-consent-public.js', array( 'jquery' ), $this->version, false );
		wp_register_script( 'cookies-script' , plugin_dir_url( __FILE__ ) . 'js/cookies-script.js', array( 'jquery' ), $this->version, 'all' );

	}

	public function add_cookies_on_site() {

		$options_list = get_option('wzb_cookies_options');
		$enable_cookies = ( isset($options_list['wzb_enable_cookies']) && 
												((!isset($_COOKIE['cookies-consent'])) ||
												(isset($_COOKIE['cookies-consent']) && (!($_COOKIE['cookies-consent'])) ))
											) ? true : false;

											echo $enable_cookies;
											
		if ($enable_cookies) {

			wp_enqueue_style( 'cookies-styles' );
			wp_enqueue_script( 'cookies-script' );


			include( plugin_dir_path( __FILE__ ) . 'partials/cookies-consent-box-layout.php' );
	
		}
	
	}

}
