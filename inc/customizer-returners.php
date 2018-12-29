<?php
/**
 * Customizer settings returners for the Coldbox Ads Addon Extension
 *
 * @since 1.0.0
 * @package Coldbox_Ads_Extension
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
	if ( is_single() || is_page() ) {
		if ( $meta && is_array( $meta ) ) {
			if ( in_array( 'disable_all_ads', $meta, true ) ) {
				$switcher = false;
			}
		}
	}

	$switcher = apply_filters( 'coldbox_ads_is_ads_enabled', $switcher );

	return $switcher;
}

/**
 * Return whether the current page is AMP page or not.
 *
 * Always return `false` when the Coldbox Addons plugin is not activated or AMP feature is disabled. Otherwise return cd_is_amp().
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
	$pub_id = esc_html( get_theme_mod( 'ads_pub_id', '' ) );
	$pub_id = apply_filters( 'coldbox_ads_pub_id', $pub_id );
	return $pub_id;
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
	$label = apply_filters( 'coldbox_ads_label', $label );
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
	if ( is_single() || is_page() ) {
		if ( $meta && is_array( $meta ) ) {
			if ( in_array( 'disable_auto_ads', $meta, true ) ) {
				$switcher = false;
			}
		}
	}
	$switcher = apply_filters( 'coldbox_ads_is_auto_ads_enabled', $switcher );
	return $switcher;
}
/**
 * Return whether or not it uses auto-ads on front page.
 *
 * @return boolean
 */
function coldbox_ads_auto_on_front_page() {
	$val = get_theme_mod( 'ads_auto_on_front_page', true );
	$val = apply_filters( 'coldbox_ads_auto_on_front_page', $val );
	return $val;
}

/**
 * Return whether or not it uses auto-ads on archive pages.
 *
 * @return boolean
 */
function coldbox_ads_auto_on_archive() {
	$val = get_theme_mod( 'ads_auto_on_archive', true );
	$val = apply_filters( 'coldbox_ads_auto_on_archive', $val );
	return $val;
}

/**
 * Return whether or not it uses auto-ads on single pages.
 *
 * @return boolean
 */
function coldbox_ads_auto_on_single() {
	$val = get_theme_mod( 'ads_auto_on_single', true );
	$val = apply_filters( 'coldbox_ads_auto_on_single', $val );
	return $val;
}

/**
 * Return whether or not it uses auto-ads on pages.
 *
 * @return boolean
 */
function coldbox_ads_auto_on_pages() {
	$val = get_theme_mod( 'ads_auto_on_pages', true );
	$val = apply_filters( 'coldbox_ads_auto_on_pages', $val );
	return $val;
}

/**
 * Return the slot ID for matched content ad.
 *
 * @return number
 */
function coldbox_ads_matched_content_slot() {
	$id = absint( get_theme_mod( 'ads_matched_content', '' ) );
	$id = apply_filters( 'coldbox_ads_matched_content', $id );
	return $id;
}

/**
 * Return the slot ID for in-feed ad.
 *
 * @return number
 */
function coldbox_ads_in_feed_slot() {
	$id = absint( get_theme_mod( 'ads_in_feed', '' ) );
	$id = apply_filters( 'coldbox_ads_in_feed', $id );
	return $id;
}

/**
 * Return the layout key for in-feed ad.
 *
 * @return string
 */
function coldbox_ads_in_feed_layout_key() {
	$key = esc_html( get_theme_mod( 'ads_in_feed_layout', '' ) );
	$key = apply_filters( 'coldbox_ads_in_feed_layout', $key );
	return $key;
}

/**
 * Return per how many articles to show in-feed ad.
 *
 * @return integer
 */
function coldbox_ads_in_feed_num() {
	$num = absint( get_theme_mod( 'ads_in_feed_num', 4 ) );
	$num = apply_filters( 'coldbox_ads_in_feed_num', $num );
	return $num;
}

/**
 * Return slot ID for single middle one.
 *
 * @return number
 */
function coldbox_ads_single_mid1_slot() {
	$id = absint( get_theme_mod( 'ad_single_mid1', '' ) );
	$id = apply_filters( 'coldbox_ad_single_mid1', $id );
	return $id;
}
/**
 * Return slot ID for single middle two.
 *
 * @return number
 */
function coldbox_ads_single_mid2_slot() {
	$id = absint( get_theme_mod( 'ad_single_mid2', '' ) );
	$id = apply_filters( 'coldbox_ad_single_mid2', $id );
	return $id;
}

/**
 * Return slot ID for single bottom for desktop.
 *
 * @return number
 */
function coldbox_ads_single_bottom_desktop_slot() {
	$id = absint( get_theme_mod( 'ad_single_bottom_desktop', '' ) );
	$id = apply_filters( 'coldbox_ad_single_bottom_desktop', $id );
	return $id;
}

/**
 * Return slot ID for single bottom for mobile.
 *
 * @return number
 */
function coldbox_ads_single_bottom_mobile_slot() {
	$id = absint( get_theme_mod( 'ad_single_bottom_mobile', '' ) );
	$id = apply_filters( 'coldbox_ad_single_bottom_mobile', $id );
	return $id;
}

/**
 * Return slot ID for archive top.
 *
 * @return number
 */
function coldbox_ads_archive_top_slot() {
	$id = absint( get_theme_mod( 'ad_archive_top', '' ) );
	$id = apply_filters( 'coldbox_ad_archive_top', $id );
	return $id;
}

/**
 * Return slot ID for archive bottom for desktop.
 *
 * @return number
 */
function coldbox_ads_archive_bottom_desktop_slot() {
	$id = absint( get_theme_mod( 'ad_archive_bottom_desktop', '' ) );
	$id = apply_filters( 'coldbox_ad_archive_bottom_desktop', $id );
	return $id;
}

/**
 * Return slot ID for archive bottom for mobile.
 *
 * @return number
 */
function coldbox_ads_archive_bottom_mobile_slot() {
	$id = absint( get_theme_mod( 'ad_archive_bottom_mobile', '' ) );
	$id = apply_filters( 'coldbox_ad_archive_bottom_mobile', $id );
	return $id;
}

