<?php
/**
 * The ads styling for the Coldbox Ads Extension.
 *
 * @since   1.0.7
 * @package Coldbox_Ads_Extension
 */

/**
 * Class Coldbox_Ads_Style
 */
class Coldbox_Ads_Style {

	/**
	 * Coldbox_Ads_Style constructor.
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'mobile_grid_width' ), 99 );
	}

	/**
	 * Force 100% width on mobile for archive pages.
	 *
	 * @sice 1.0.7
	 * @return void
	 */
	public function mobile_grid_width() {
		if ( ! coldbox_ads_is_ads_enabled() || ! coldbox_ads_in_feed_slot() ) {
			return;
		}

		// No adjustment if it's already 100% width.
		if ( get_theme_mod( 'grid_columns_mobile', 1 ) === 1 ) {
			return;
		}

		$style = '@media screen and (max-width: 640px) {
					body .container .grid-view .post.post-ad {
						width: 100%;
					}
				}';

		if ( function_exists( 'cd_css_minify' ) ) {
			$style = cd_css_minify( $style );
		}

		wp_add_inline_style( 'cd-style', $style );
	}
}
