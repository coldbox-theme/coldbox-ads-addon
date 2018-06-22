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
 * @param string $validity validity.
 * @param string $value value.
 *
 * @return mixed
 */
function coldbox_ads_validate_pub_id( $validity, $value ) {
	$value_num = mb_substr( $value, 7 );
	if ( empty( $value ) ) {
		$validity->add( 'required', __( 'You need to provide a valid publisher ID before using ads functions.', 'coldbox_ads_addon' ) );
	} elseif ( ! preg_match( '/^ca-pub-/i', $value ) ) {
		$validity->add( 'invalid_format', __( 'It\'s not a valid publisher ID, it should start with "ca-pub-".', 'coldbox_ads_addon' ) );
	} elseif ( strlen( $value ) <= 10 ) {
		$validity->add( 'too_short', __( 'ID is too short.' ) );
	} elseif ( ! is_numeric( $value_num ) ) {
		$validity->add( 'not_a_number', __( 'It should only contain numbers after "ca-pub-".', 'coldbox_ads_addon' ) );
	}
	return $validity;
}

/**
 * Validator for Ad Slot ID.
 *
 * @param string $validity validity.
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
