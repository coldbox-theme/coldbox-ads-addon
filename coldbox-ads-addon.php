<?php
/**
 * Plugin Name:     Coldbox Ads Addon Extension
 * Plugin URI:      https://coldbox.miruc.co/
 * Description:     Coldbox theme addon for easily showing Google AdSense in the appropriate places!
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
	load_plugin_textdomain( 'coldbox-ads-addon' );
}
add_action( 'plugins_loaded', 'coldbox_ads_languages' );

// Load plugin files.
require_once 'inc/ads-content.php';

require_once 'inc/customizer.php';

require_once 'inc/customizer-returners.php';
