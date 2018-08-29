<?php
/**
 * The ads content for the Coldbox Ads Extension.
 *
 * @since 1.0.3
 * @package Coldbox_Ads_Extension
 */

/**
 * Class Coldbox_Ads_Content
 */
class Coldbox_Ads_Content {

	/**
	 * Construct
	 */
	public function __construct() {
		add_action( 'cd_related_posts_bottom', array( $this, 'matched_content' ) );
		add_action( 'cd_single_middle_of_content', array( $this, 'single_in_article_one' ) );
		add_action( 'cd_single_last_of_content', array( $this, 'single_in_article_two' ) );
		add_action( 'cd_single_after', array( $this, 'single_bottom' ) );
		add_action( 'cd_archive_midst_content', array( $this, 'in_feed' ) );
		add_action( 'cd_archive_top', array( $this, 'archive_top' ) );
		add_action( 'cd_archive_bottom', array( $this, 'archive_bottom' ) );
	}

	/**
	 * Matched content ad.
	 *
	 * @return void
	 */
	public function matched_content() {
		if ( ! coldbox_ads_is_ads_enabled() || ! coldbox_ads_matched_content_slot() ) {
			return;
		}
		// phpcs:ignore
		$ad = '
		<ins class="adsbygoogle"
			 style="display:block"
			 data-ad-format="autorelaxed"
			 data-ad-client="' . coldbox_ads_pub_id() . '"
			 data-ad-slot="' . coldbox_ads_matched_content_slot() . '">
		</ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>';

		if ( coldbox_ads_is_amp() ) {
			$ad = '<amp-ad
					layout="fixed-height"
					height="500"
					type="adsense"
					data-ad-client="' . coldbox_ads_pub_id() . '"
					data-ad-slot="' . coldbox_ads_matched_content_slot() . '">
				</amp-ad>';
		}
		$ad = apply_filters( 'coldbox_ads_matched_content', $ad );
		echo $ad; // WPCS: XSS OK.
	}

	/**
	 * Single - Middle of content ad 1.
	 *
	 * @since 1.0.0
	 */
	public function single_in_article_one() {
		if ( ! coldbox_ads_is_ads_enabled() || ! coldbox_ads_single_mid1_slot() ) {
			return;
		}

		$ad =
			coldbox_ads_label() . '
				<div class="resp-unit">
					<ins class="adsbygoogle"
						 style="display:block; text-align:center;"
						 data-ad-layout="in-article"
						 data-ad-format="fluid"
						 data-ad-client="' . coldbox_ads_pub_id() . '"
						 data-ad-slot="' . coldbox_ads_single_mid1_slot() . '">
					</ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
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
		$ad = apply_filters( 'coldbox_ads_in_article_one', $ad );
		echo $ad; // WPCS: XSS OK.
	}

	/**
	 * Single - Middle of content ad 1.
	 *
	 * @since 1.0.0
	 */
	public function single_in_article_two() {
		if ( ! coldbox_ads_is_ads_enabled() || ! coldbox_ads_single_mid2_slot() ) {
			return;
		}

		$ad = coldbox_ads_label() . '
			<div class="resp-unit">
				<ins class="adsbygoogle"
					 style="display:block; text-align:center;"
					 data-ad-layout="in-article"
					 data-ad-format="fluid"
					 data-ad-client="' . coldbox_ads_pub_id() . '"
					 data-ad-slot="' . coldbox_ads_single_mid2_slot() . '">
				</ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
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
		}
		$ad = apply_filters( 'coldbox_ads_in_article_two', $ad );
		echo $ad; // WPCS: XSS OK.
	}

	/**
	 * Single - Bottom rectangles
	 */
	public function single_bottom() {

		if ( ! coldbox_ads_is_ads_enabled() ) {
			return;
		}

		if ( ! wp_is_mobile() && coldbox_ads_single_bottom_desktop_slot() ) {
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
						<div class="resp-unit">
							<ins class="adsbygoogle"
							     style="display:block; text-align:center;"
								 data-ad-format="auto"
								 data-ad-client="' . coldbox_ads_pub_id() . '"
								 data-ad-slot="' . coldbox_ads_single_bottom_mobile_slot() . '">
							</ins>
						</div><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
					</div>
				</div>
			';
		} else {
			$ad = false;
		}
		if ( $ad ) {
			$ad = apply_filters( 'coldbox_ads_single_bottom', $ad );
			echo $ad; // WPCS: XSS OK.
		}
	}

	/**
	 * Archive - Native in-feed.
	 *
	 * @param int $count Number of posts to an ad be inserted.
	 * @return void
	 */
	public function in_feed( $count ) {
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
				$ad = '
					<div style="width:100%" class="post">
						<ins class="adsbygoogle"
							style="display:block"
							data-ad-format="fluid"
							' . $layout . '
							data-ad-client="' . coldbox_ads_pub_id() . '"
							data-ad-slot="' . coldbox_ads_in_feed_slot() . '">
						</ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
					</div>
				';
			} else {
				$ad = '
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
			}
			$ad = apply_filters( 'coldbox_ads_in_feed', $ad );
			$ad = apply_filters( 'coldbox_ads_in_feed_' . $count, $ad );
			echo '<article class="post-ad post">' . $ad . '</article>'; // WPCS: XSS OK.
		}
	}

	/**
	 * Archive - Top respontive.
	 */
	public function archive_top() {
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
		$ad = apply_filters( 'coldbox_ads_archive_top', $ad );
		echo $ad; // WPCS: XSS OK.
	}

	/**
	 * Archive - bottom rectangles.
	 */
	public function archive_bottom() {
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
						 data-ad-slot="' . coldbox_ads_archive_bottom_mobile_slot() . '">
					</ins>
				</div><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
			</div>';
			// phpcs:enable
		} else {
			$ad = false;
		}
		if ( $ad ) {
			$ad = apply_filters( 'coldbox_ads_archive_bottom', $ad );
			echo $ad; // WPCS: XSS OK.
		}
	}
}
