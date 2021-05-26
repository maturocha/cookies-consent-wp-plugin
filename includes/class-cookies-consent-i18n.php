<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://maturocha.com.ar/
 * @since      1.0.0
 *
 * @package    Cookies_Consent
 * @subpackage Cookies_Consent/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Cookies_Consent
 * @subpackage Cookies_Consent/includes
 * @author     Mati Rocha <matu.rocha@gmail.com>
 */
class Cookies_Consent_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'cookies-consent',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
