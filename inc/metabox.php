<?php
/**
 * Adding meta box to post/page edit for the Coldbox Ads Extension.
 *
 * @since 0.1.0
 * @package Coldbox_Ads_Addon
 */

/**
 * Register meta box.
 *
 * @since 0.1.0
 */
add_action(
	'add_meta_boxes', function() {
		add_meta_box( 'coldbox_ads_metabox', __( 'Coldbox Ads Extension: Ads Settings for This Post', 'coldbox-ads-addon' ), 'coldbox_ads_meta_box_callback', array( 'post', 'page' ) );
	}
);

/**
 * Render meta box on the post edit.
 *
 * @since 0.1.0
 **/
function coldbox_ads_meta_box_callback() {
	wp_nonce_field( 'coldbox_ads_metabox_checkbox', 'coldbox_ads_metabox_checkbox_nonce' );
	$id = get_the_ID();

	$post_meta = get_post_meta( $id, 'coldbox_ads_metabox', true );
	$post_meta = $post_meta ? $post_meta : array();

	$items = array(
		array(
			'text'  => esc_html__( 'Do not show ads for this post', 'coldbox-ads-addon' ),
			'value' => 'disable_all_ads',
		),
		array(
			'text'  => esc_html__( 'Do not use auto-ads for this post', 'coldbox-ads-addon' ),
			'value' => 'disable_auto_ads',
		),
	);

	$name = 'coldbox_ads_metabox';
	foreach ( $items as $item ) {
		// phpcs:ignore
		$checked = array_search( $item['value'], $post_meta ) !== false ?
			'checked="checked"' : '';
		echo "<p><label><input type=\"checkbox\" name=\"{$name}[]\" value=\"{$item['value']}\" $checked>{$item['text']}</label></p>"; // WPCS: XSS OK.
	}
}

add_action(
	'save_post', function ( $post_id ) {
		// Check if nonce is set.
		if ( ! isset( $_POST['coldbox_ads_metabox_checkbox_nonce'] ) ) {
			return;
		}
		// Check if nonce is valid.
		if ( ! wp_verify_nonce( $_POST['coldbox_ads_metabox_checkbox_nonce'], 'coldbox_ads_metabox_checkbox' ) ) {
			return;
		}
		// Check if not an autosave.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Check if user has permissions to save data.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}

		$value = isset( $_POST['coldbox_ads_metabox'] ) && is_array( $_POST['coldbox_ads_metabox'] ) ?
		$_POST['coldbox_ads_metabox'] : array();
		if ( $value ) {
			update_post_meta( $post_id, 'coldbox_ads_metabox', $value );
		} else {
			delete_post_meta( $post_id, 'coldbox_ads_metabox' );
		}
	}
);
