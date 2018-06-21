<?php
/**
 * Plugin Name:     Coldbox Ads Addon Extension
 * Plugin URI:      https://coldbox.miruc.co/
 * Description:     Coldbox theme extension for showing Google AdSense easily in the best places!
 * Author:          Toshihiro Kanai (mirucon)
 * Author URI:      https://miruc.co/
 * Text Domain:     coldbox-ads-addon
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Coldbox_Ads_Addon
 */

/**
 * Register the language pack.
 *
 * @since 0.1.0
 */
function coldbox_ads_languages() {
	load_plugin_textdomain( 'coldbox-ads-addon', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'coldbox_ads_languages' );

// Load plugin files.
require_once 'inc/ads-content.php';

require_once 'inc/customizer.php';

require_once 'inc/customizer-returners.php';

require_once 'inc/metabox.php';

// Load updater package if the PHP version is 5.6.0 or later.
if ( version_compare( phpversion(), '5.6.0' ) >= 0 ) {
	require_once 'vendor/autoload.php';
	$updater = new Inc2734\WP_GitHub_Plugin_Updater\GitHub_Plugin_Updater( plugin_basename( __FILE__ ), 'coldbox-theme', 'coldbox-ads-addon' );
}
