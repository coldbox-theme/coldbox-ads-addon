<?php
/**
 * Plugin Name:     Coldbox Ads Extension
 * Plugin URI:      https://coldbox.miruc.co/addons/google-adsense-extension/
 * Description:     Coldbox theme extension for easy and high revenue Google AdSense. It supports responsive, in-feed, in-article, matched content and auto ads!
 * Author:          Toshihiro Kanai (mirucon)
 * Author URI:      https://miruc.co/
 * Text Domain:     coldbox-ads-extension
 * Domain Path:     /languages
 * Version:         1.0.3
 *
 * @package         Coldbox_Ads_Extension
 */

/**
 * Register the language pack.
 *
 * @since 1.0.0
 */
function coldbox_ads_languages() {
	load_plugin_textdomain( 'coldbox-ads-extension', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'coldbox_ads_languages' );

// Load plugin files.
require_once plugin_dir_path( __FILE__ ) . 'inc/basic.php';

require_once plugin_dir_path( __FILE__ ) . 'inc/customizer.php';

require_once plugin_dir_path( __FILE__ ) . 'inc/customizer-returners.php';

require_once plugin_dir_path( __FILE__ ) . 'inc/metabox.php';

require_once plugin_dir_path( __FILE__ ) . 'inc/amp-ads.php';

// Load updater package if the PHP version is 5.6.0 or later.
if ( version_compare( phpversion(), '5.6.0' ) >= 0 ) {
	require_once 'vendor/autoload.php';
	$updater = new Inc2734\WP_GitHub_Plugin_Updater\GitHub_Plugin_Updater( plugin_basename( __FILE__ ), 'coldbox-theme', 'coldbox-ads-extension' );
}
