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
	'wp_enqueue_scripts', function() {
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
	'script_loader_tag', function( $tag, $handle ) {
		if ( 'adsbygoogle' === $handle ) {
			return str_replace( ' src', ' async="async" src', $tag );
		}
		return $tag;
	}, 10, 2
);

/**
 * Google AdSense Auto-Ads
 */
add_action(
	'wp_head', function() {
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

/**
 * Matched content ad.
 *
 * @since 1.0.0
 */
add_action(
	'cd_related_posts_bottom', function() {
		if ( ! coldbox_ads_is_ads_enabled() || ! coldbox_ads_matched_content_slot() ) {
			return;
		}

		// phpcs:ignore
		$ad = '
		<ins class="adsbygoogle"
			 style="display:block"
			 data-ad-format="autorelaxed"
			 data-ad-client="' . coldbox_ads_pub_id() . '"
			 data-ad-slot="' . coldbox_ads_matched_content_slot() . '"></ins>
		<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>';
		if ( coldbox_ads_is_amp() ) {
			$ad = '
				<amp-ad
					layout="fixed-height"
					height="500"
					type="adsense"
					data-ad-client="' . coldbox_ads_pub_id() . '"
					data-ad-slot="' . coldbox_ads_matched_content_slot() . '">
				</amp-ad>
			';
		}
		echo $ad; // WPCS: XSS OK.
	}
);

/**
 * In-feed ads.
 *
 * @since 1.0.0
 */
add_action(
	'cd_archive_midst_content', function( $count ) {

		if ( ! coldbox_ads_is_ads_enabled() || ! coldbox_ads_in_feed_slot() ) {
			return;
		}

		$layout = coldbox_ads_in_feed_layout_key();
		if ( $layout ) {
			$layout = 'data-ad-layout-key="' . coldbox_ads_in_feed_layout_key() . '"';
		} else {
			$layout = '';
		}

		$per_page      = absint( get_option( 'posts_per_page' ) );
		$number_of_ads = floor( $per_page / coldbox_ads_in_feed_num() );
		$ads_array     = array();

		for ( $num = 1; $num <= $number_of_ads; $num++ ) {
			$ads_array[] = coldbox_ads_in_feed_num() * $num;
		}

		if ( in_array( $count, $ads_array, true ) ) {
			if ( wp_is_mobile() ) {
				// phpcs:disable
				$content = '
					<div style="width:100%" class="post">
						<ins class="adsbygoogle"
							style="display:block"
							data-ad-format="fluid"
							' . $layout . '
							data-ad-client="' . coldbox_ads_pub_id() . '"
							data-ad-slot="' . coldbox_ads_in_feed_slot() . '"></ins>
						<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
					</div>
				';
			} else {
				$content = '
					<div style="width:100%" class="post">
						<ins class="adsbygoogle"
							 style="display:block"
							 data-ad-format="fluid"
							' . $layout . '
							 data-ad-client="' . coldbox_ads_pub_id() . '"
							 data-ad-slot="' . coldbox_ads_in_feed_slot() . '">
						</ins>
						<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
					</div>
				';
				// phpcs:enable
			}
			echo '<article class="post-ad post">' . $content . '</article>'; // WPCS: XSS OK.
		}
	}
);

/**
 * Single - Middle of content ad 1.
 *
 * @since 1.0.0
 */
add_action(
	'cd_single_middle_of_content', function () {

		if ( ! coldbox_ads_is_ads_enabled() || ! coldbox_ads_single_mid1_slot() ) {
			return;
		}

		// phpcs:disable
		$ad =
			coldbox_ads_label() . '
			<div class="resp-unit">
				<ins class="adsbygoogle"
					 style="display:block; text-align:center;"
					 data-ad-layout="in-article"
					 data-ad-format="fluid"
					 data-ad-client="' . coldbox_ads_pub_id() . '"
					 data-ad-slot="' . coldbox_ads_single_mid1_slot() . '"></ins>
				<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
			</div>
		';

		if ( cd_is_amp() ) {
			$ad = '<amp-ad
				width="100vw" height=320
				type="adsense"
				data-ad-client="' . coldbox_ads_pub_id() . '"
				data-ad-slot="' . coldbox_ads_single_mid1_slot() . '"
				data-auto-format="rspv"
				data-full-width>
		  	<div overflow></div>
	  		</amp-ad>';
		}
		// phpcs:enable
		echo $ad; // WPCS: XSS OK.
	}
);

/**
 * Single - Middle of content ad 2.
 *
 * @since 1.0.0
 */
add_action(
	'cd_single_last_of_content', function () {

		if ( ! coldbox_ads_is_ads_enabled() || ! coldbox_ads_single_mid2_slot() ) {
			return;
		}

		// phpcs:disable
		$ad = coldbox_ads_label() . '
			<div class="resp-unit">
				<ins class="adsbygoogle"
					 style="display:block; text-align:center;"
					 data-ad-layout="in-article"
					 data-ad-format="fluid"
					 data-ad-client="' . coldbox_ads_pub_id() . '"
					 data-ad-slot="' . coldbox_ads_single_mid2_slot() . '">
				</ins>
				<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
			</div>
		';
		if ( cd_is_amp() ) {
			$ad = '<amp-ad
					width="100vw" height=320
					type="adsense"
					data-ad-client="' . coldbox_ads_pub_id() . '"
					data-ad-slot="' . coldbox_ads_single_mid2_slot() . '"
					data-auto-format="rspv"
					data-full-width>
			        <div overflow></div>
	  			</amp-ad>';
		// phpcs:enable
		}
		echo $ad; // WPCS: XSS OK.
	}
);

/**
 * Single - Bottom ad.
 *
 * @since 1.0.0
 */
add_action(
	'cd_single_after', function () {

		if ( ! coldbox_ads_is_ads_enabled() ) {
			return;
		}

		if ( ! wp_is_mobile() && coldbox_ads_single_bottom_desktop_slot() ) {
			// phpcs:disable
			$ad = '
				<div class="content-box">
				' . coldbox_ads_label() . '
					<div class="ad-single-bottom">
						<table class="ads-double">
							<tr>
								<td>
									<ins class="adsbygoogle"
								         style="display:inline-block;width:336px;height:280px"
								         data-ad-client="' . coldbox_ads_pub_id() . '"
								         data-ad-slot="' . coldbox_ads_single_bottom_desktop_slot() . '">
									</ins>
							        <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
								</td>
								<td>
									<ins class="adsbygoogle"
								         style="display:inline-block;width:336px;height:280px"
								         data-ad-client="' . coldbox_ads_pub_id() . '"
								         data-ad-slot="' . coldbox_ads_single_bottom_desktop_slot() . '">
									</ins>
							        <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
								</td>
							</tr>
						</table>
					</div>
				</div>
			';
		} elseif ( coldbox_ads_is_amp() && coldbox_ads_single_bottom_mobile_slot() ) {
			$ad = '
			<div class="content-box">
				' . coldbox_ads_label() . '
				<amp-ad
					width="100vw" height=320
					type="adsense"
					data-ad-client="' . coldbox_ads_pub_id() . '"
					data-ad-slot="' . coldbox_ads_single_bottom_mobile_slot() . '"
					data-auto-format="rspv"
					data-full-width>
					<div overflow></div>
		 	 </amp-ad>
		  </div>
		  ';
		} elseif ( coldbox_ads_single_bottom_mobile_slot() ) {
			$ad = '
				<div class="content-box">
				' . coldbox_ads_label() . '
					<div class="ad-single-bottom"> 
						<div class="resp-unit"><ins class="adsbygoogle"
						     style="display:block; text-align:center;"
							 data-ad-format="auto"
							 data-ad-client="' . coldbox_ads_pub_id() . '"
							 data-ad-slot="' . coldbox_ads_single_bottom_mobile_slot() . '"></ins></div>
						<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
					</div>
				</div>
			';
			// phpcs:enable
		} else {
			$ad = false;
		}
		if ( $ad ) {
			echo $ad; // WPCS: XSS OK.
		}
	}
);

/**
 * Archive - Top ad.
 *
 * @since 1.0.0
 */
add_action(
	'cd_archive_top', function() {

		if ( ! coldbox_ads_is_ads_enabled() || ! coldbox_ads_archive_top_slot() ) {
			return;
		}
		if ( ! wp_is_mobile() ) {
			// phpcs:disable
			$ad = '
			<div class="ad-archive-top">
				' . coldbox_ads_label() . '
				<div class="resp-unit">
				    <ins class="adsbygoogle"
					     style="display:block"
					     data-ad-client="' . coldbox_ads_pub_id() . '"
					     data-ad-slot="' . coldbox_ads_archive_bottom_desktop_slot() . '"
					     data-ad-format="auto"></ins>
				    <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
			    </div>
		    </div>
			';
		} else {
			$ad = '
			<div class="ad-archive-top">
				' . coldbox_ads_label() . '
				<div class="resp-unit">
			    	<ins class="adsbygoogle"
			    	style="display:block"
			    	data-ad-client="' . coldbox_ads_pub_id() . '"
			    	data-ad-slot="' . coldbox_ads_archive_bottom_mobile_slot() . '"
			    	data-ad-format="auto"></ins>
			    	<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
		        </div>
	        </div>
			';
			// phpcs:enable
		}
		echo $ad; // WPCS: XSS OK.

	}
);

/**
 * Archive - Bottom ad.
 *
 * @since 1.0.0
 */
add_action(
	'cd_archive_bottom', function() {

		if ( ! coldbox_ads_is_ads_enabled() ) {
			return;
		}

		if ( ! wp_is_mobile() && coldbox_ads_archive_bottom_desktop_slot() ) {
			// phpcs:disable
			$ad = '
				<div class="ad-archive-bottom">'
					. coldbox_ads_label() . '
					<table class="ads-double">
						<tr>
							<td>
								<ins class="adsbygoogle"
							         style="display:inline-block;width:336px;height:280px"
							         data-ad-client="' . coldbox_ads_pub_id() . '"
							         data-ad-slot="' . coldbox_ads_archive_bottom_desktop_slot() . '">
								</ins>
						        <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
							</td>
							<td>
								<ins class="adsbygoogle"
							         style="display:inline-block;width:336px;height:280px"
							         data-ad-client="' . coldbox_ads_pub_id() . '"
							         data-ad-slot="' . coldbox_ads_archive_bottom_desktop_slot() . '">
								</ins>
						        <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
							</td>
						</tr>
					</table>
				</div>
			';
		} elseif ( coldbox_ads_archive_bottom_mobile_slot() ) {
			$ad = '
			<div class="ad-archive-bottom"> '
			      . coldbox_ads_label() . '
				<div class="resp-unit">
					<ins class="adsbygoogle"
					     style="display:block; text-align:center;"
						 data-ad-format="auto"
						 data-ad-client="' . coldbox_ads_pub_id() . '"
						 data-ad-slot="' . coldbox_ads_archive_bottom_mobile_slot() . '"></ins></div>
					<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
				</div>
			</div>';
			// phpcs:enable
		} else {
			$ad = false;
		}
		if ( $ad ) {
			echo $ad; // WPCS: XSS OK.
		}
	}
);
