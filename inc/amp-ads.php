<?php
/**
 * AdSense settings on AMP pages.
 *
 * @since 0.1.0
 * @package Coldbox_Ads_addon
 */

if ( coldbox_ads_is_amp() ) {
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
		add_action(
			'cd_addon_amp_head_action', function() {
			// phpcs:ignore
			echo '<script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>';
			}
		);
	} elseif (
		coldbox_ads_is_ads_enabled() &&
		coldbox_ads_is_auto_ads_enabled()
	) {
		add_action(
			'cd_addon_amp_head_action', function() {
			// phpcs:ignore
			echo '<script async custom-element="amp-auto-ads" src="https://cdn.ampproject.org/v0/amp-auto-ads-0.1.js"></script>';
			}
		);
		add_action(
			'cd_addon_amp_body_action', function() {
				echo '<amp-auto-ads type="adsense" data-ad-client="' . esc_attr( coldbox_ads_pub_id() ) . '"></amp-auto-ads>';
			}
		);
	}
}
