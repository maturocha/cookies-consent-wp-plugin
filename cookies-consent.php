<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://maturocha.com.ar/
 * @since             1.0.0
 * @package           Cookies_Consent
 *
 * @wordpress-plugin
 * Plugin Name:       Cookies Consent
 * Plugin URI:        https://maturocha.com.ar/
 * Description:       Plugin lets visitors know that the site is using cookies.
 * Version:           1.0.0
 * Author:            Mati Rocha
 * Author URI:        https://maturocha.com.ar/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cookies-consent
 * Domain Path:       /languages
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
define( 'COOKIES_CONSENT_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cookies-consent-activator.php
 */
function activate_cookies_consent() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cookies-consent-activator.php';
	Cookies_Consent_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cookies-consent-deactivator.php
 */
function deactivate_cookies_consent() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cookies-consent-deactivator.php';
	Cookies_Consent_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cookies_consent' );
register_deactivation_hook( __FILE__, 'deactivate_cookies_consent' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cookies-consent.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cookies_consent() {

	$plugin = new Cookies_Consent();
	$plugin->run();

}
run_cookies_consent();
