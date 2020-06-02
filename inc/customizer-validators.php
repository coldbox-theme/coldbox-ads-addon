<?php
/**
 * Customizer validators for the Coldbox Ads Addon Extension
 *
 * @since 1.0.0
 * @package Coldbox_Ads_Extension
 */

/**
 * Validator for Publisher ID.
 *
 * @param mixed  $validity validity.
 * @param string $value value.
 *
 * @return mixed
 */
function coldbox_ads_validate_pub_id( $validity, $value ) {
	$value_num = mb_substr( $value, 7 );
	if ( empty( $value ) ) {
		$validity->add( 'required', __( 'You need to provide a valid publisher ID before using ads functions.', 'coldbox-ads-extension' ) );
	} elseif ( ! preg_match( '/^ca-pub-/i', $value ) && ! preg_match( '/^pub-/i', $value ) ) {
		$validity->add( 'invalid_format', __( 'It\'s not a valid publisher ID, it should start with either "ca-pub-" or "pub-".', 'coldbox-ads-extension' ) );
	} elseif ( strlen( $value ) <= 10 ) {
		$validity->add( 'too_short', __( 'ID is too short.' ) );
	} elseif ( ! is_numeric( $value_num ) ) {
		$validity->add( 'not_a_number', __( 'It should only contain numbers after "ca-pub-" or "pub-".', 'coldbox-ads-extension' ) );
	}
	return $validity;
}

/**
 * Validator for Ad Slot ID.
 *
 * @param mixed  $validity validity.
 * @param string $value value.
 *
 * @return mixed
 */
function coldbox_ads_validate_slot_id( $validity, $value ) {
	if ( ! is_numeric( $value ) && ! empty( $value ) ) {
		$validity->add( 'not_a_num', __( 'It should only contain numbers.', 'coldbox_ads_addon' ) );
	}
	return $validity;
}


/**
 * Velidator for boolean value.
 *
 * @param mixed  $validity validity.
 * @param string $value value.
 *
 * @return mixed
 */
function coldbox_ads_validate_bool( $validity, $value ) {
	if ( ! is_bool( $value ) ) {
		$validity->add( 'invalid_value', __( 'Invalid value.', 'coldbox_ads_addon' ) );
	}
	return $validity;
}
