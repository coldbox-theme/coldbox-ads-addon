<?php
/**
 * The custom class for output HTML on the customizer.
 *
 * @since 1.1.1
 * @package Coldbox
 */

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Coldbox_Ads_Custom_Content' ) ) {

	/**
	 * For adding HTML on the customizer.
	 *
	 * @since 0.1.0
	 */
	class Coldbox_Ads_Custom_Content extends WP_Customize_Control {

		/**
		 * A variable described below.
		 *
		 * @var string $content The string that will be output on the customizer
		 */
		public $content = '';
		/**
		 * Output the contents
		 *
		 * @since 1.1.1
		 */
		public function render_content() {
			if ( isset( $this->content ) ) {
				echo $this->content; // WPCS: XSS OK.
			}
			if ( isset( $this->description ) ) {
				echo '<span class="description customize-control-description">' . $this->description . '</span>'; // WPCS: XSS OK.
			}
		}
	}
}
