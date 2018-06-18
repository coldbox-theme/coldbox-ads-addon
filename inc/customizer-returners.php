<?php
/**
 * Customizer settings returners for the Coldbox Ads Addon Extension
 *
 * @since 0.1.0
 * @package Coldbox_Ads_Addon
 */

/**
 * Return whether or not use the AdSense feature.
 *
 * @return boolean
 */
function coldbox_ads_is_ads_enabled() {
	$switcher = get_theme_mod( 'ads_global_switcher', true );
	// Return false when no pub_id set.
	if ( ! get_theme_mod( 'ads_pub_id', '' ) ) {
		$switcher = false;
	}
	// Check if the ad has been disabled by meta box settings.
	$meta = get_post_meta( get_the_ID(), 'coldbox_ads_metabox', true );
	if ( in_array( 'disable_all_ads', $meta, true ) ) {
		$switcher = false;
	}

	return $switcher;
}

/**
 * Return Publisher's ID.
 *
 * @return boolean
 */
function coldbox_ads_is_amp() {
	if ( function_exists( 'cd_is_amp' ) ) {
		return cd_is_amp();
	}
	return false;
}

/**
 * Return Publisher's ID.
 *
 * @return string
 */
function coldbox_ads_pub_id() {
	return esc_html( get_theme_mod( 'ads_pub_id', '' ) );
}

/**
 * Return ad label.
 *
 * @return string
 */
function coldbox_ads_label() {
	$label = esc_html( get_theme_mod( 'ads_label', '' ) );
	if ( $label ) {
		$label = '<p class="ad-label">' . $label . '</p>';
	} else {
		$label = '';
	}
	return $label;
}

/**
 * Return whether or not it uses auto-ads.
 *
 * @return boolean
 */
function coldbox_ads_is_auto_ads_enabled() {
	$switcher = get_theme_mod( 'ads_auto_ads', false );

	// Check if the ad has been disabled by meta box settings.
	$meta = get_post_meta( get_the_ID(), 'coldbox_ads_metabox', true );
	if ( in_array( 'disable_auto_ads', $meta, true ) ) {
		$switcher = false;
	}

	return $switcher;
}
/**
 * Return whether or not it uses auto-ads on front page.
 *
 * @return boolean
 */
function coldbox_ads_auto_on_front_page() {
	return get_theme_mod( 'ads_auto_on_front_page', true );
}
/**
 * Return whether or not it uses auto-ads on archive pages.
 *
 * @return boolean
 */
function coldbox_ads_auto_on_archive() {
	return get_theme_mod( 'ads_auto_on_archive', true );
}
/**
 * Return whether or not it uses auto-ads on single pages.
 *
 * @return boolean
 */
function coldbox_ads_auto_on_single() {
	return get_theme_mod( 'ads_auto_on_single', true );
}
/**
 * Return whether or not it uses auto-ads on pages.
 *
 * @return boolean
 */
function coldbox_ads_auto_on_pages() {
	return get_theme_mod( 'ads_auto_on_pages', true );
}

/**
 * Return the slot ID for matched content ad.
 *
 * @return number
 */
function coldbox_ads_matched_content_slot() {
	return absint( get_theme_mod( 'ads_matched_content', '' ) );
}

/**
 * Return the slot ID for in-feed ad.
 *
 * @return number
 */
function coldbox_ads_in_feed_slot() {
	return absint( get_theme_mod( 'ads_in_feed', '' ) );
}
/**
 * Return the slot ID for in-feed ad.
 *
 * @return string
 */
function coldbox_ads_in_feed_layout_key() {
	return esc_html( get_theme_mod( 'ads_in_feed_layout', '' ) );
}
/**
 * Return per how many articles to show in-feed ad.
 *
 * @return integer
 */
function coldbox_ads_in_feed_num() {
	return absint( get_theme_mod( 'ads_in_feed_num', 4 ) );
}

/**
 * Return slot ID for single middle one.
 *
 * @return number
 */
function coldbox_ads_single_mid1_slot() {
	return absint( get_theme_mod( 'ad_single_mid1', '' ) );
}
/**
 * Return slot ID for single middle two.
 *
 * @return number
 */
function coldbox_ads_single_mid2_slot() {
	return absint( get_theme_mod( 'ad_single_mid2', '' ) );
}

/**
 * Return slot ID for single bottom for desktop.
 *
 * @return number
 */
function coldbox_ads_single_bottom_desktop_slot() {
	return absint( get_theme_mod( 'ad_single_bottom_desktop', '' ) );
}
/**
 * Return slot ID for single bottom for mobile.
 *
 * @return number
 */
function coldbox_ads_single_bottom_mobile_slot() {
	return absint( get_theme_mod( 'ad_single_bottom_mobile', '' ) );
}

/**
 * Return slot ID for archive top.
 *
 * @return number
 */
function coldbox_ads_archive_top_slot() {
	return absint( get_theme_mod( 'ad_archive_top', '' ) );
}

/**
 * Return slot ID for archive bottom for desktop.
 *
 * @return number
 */
function coldbox_ads_archive_bottom_desktop_slot() {
	return absint( get_theme_mod( 'ad_archive_bottom_desktop', '' ) );
}
/**
 * Return slot ID for archive bottom for mobile.
 *
 * @return number
 */
function coldbox_ads_archive_bottom_mobile_slot() {
	return absint( get_theme_mod( 'ad_archive_bottom_mobile', '' ) );
}

