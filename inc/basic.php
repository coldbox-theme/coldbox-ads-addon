<?php
/**
 * Customizer settings for the Coldbox Ads Addon Extension
 *
 * @since 1.0.0
 * @package Coldbox_Ads_Extension
 */

/**
 * Enqueue AdSense script
 */
add_action(
	'wp_enqueue_scripts',
	function() {
		if (
			coldbox_ads_is_ads_enabled() &&
			coldbox_ads_matched_content_slot() ||
			coldbox_ads_in_feed_slot() ||
			coldbox_ads_single_mid1_slot() ||
			coldbox_ads_single_mid2_slot() ||
			coldbox_ads_single_bottom_desktop_slot() ||
			coldbox_ads_single_bottom_mobile_slot() ||
			coldbox_ads_archive_top_slot() ||
			coldbox_ads_archive_bottom_desktop_slot() ||
			coldbox_ads_archive_bottom_mobile_slot()
		) {
			wp_enqueue_script( 'adsbygoogle', '//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js', array(), '1.0.3', false );
		}
	}
);

/**
 * Load AdSense script as `async`
 */
add_filter(
	'script_loader_tag',
	function( $tag, $handle ) {
		if ( 'adsbygoogle' === $handle ) {
			return str_replace( ' src', ' async="async" src', $tag );
		}
		return $tag;
	},
	10,
	2
);

/**
 * Google AdSense Auto-Ads
 */
add_action(
	'wp_head',
	function() {
		if ( ! coldbox_ads_is_ads_enabled() || ! coldbox_ads_is_auto_ads_enabled() ) {
			return;
		}
		if ( ! coldbox_ads_auto_on_front_page() && is_front_page() ) {
			return;
		}
		if ( ! coldbox_ads_auto_on_archive() && is_archive() ) {
			return;
		}
		if ( ! coldbox_ads_auto_on_single() && is_single() ) {
			return;
		}
		if ( ! coldbox_ads_auto_on_pages() && is_page() ) {
			return;
		}
		// phpcs:disable
		$ad = '
			<script>
				(adsbygoogle = window.adsbygoogle || []).push({
					google_ad_client: "' . coldbox_ads_pub_id() . '",
					enable_page_level_ads: true
				});
			</script>
		';
		// phpcs:enable
		echo $ad; // WPCS: XSS OK.
	}
);

require_once plugin_dir_path( __FILE__ ) . 'class-coldbox-ads-content.php';
new Coldbox_Ads_Content();
