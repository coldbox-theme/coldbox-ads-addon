<?php
/**
 * Customizer settings for the Coldbox Ads Addon Extension
 *
 * @since Coldbox_Ads_Extension
 * @package Coldbox_Ads_Extension
 */

/**
 * Adding sections for the ads addon settings.
 *
 * @since 1.0.0
 * @param WP_Customize_Manager $wp_customize Hook for the customizer contents.
 */
add_action(
	'customize_register', function( $wp_customize ) {

		require_once 'class-coldbox-ads-custom-content.php';
		require_once 'customizer-validators.php';

		/**
		 * Returns recommended unit label for customizer description.
		 *
		 * @since 1.0.0
		 * @param boolean $br If it breaks line before or not.
		 * @param string  $unit Unit name.
		 * @return string
		 */
		function coldbox_ads_recommended_unit_label( $br = false, $unit ) {
			if ( $br ) {
				$br = '<br>';
			} else {
				$br = '';
			}
			if ( 'responsive' === $unit ) {
				$unit = esc_html__( 'Responsive', 'coldbox-ads-extension' );
			} elseif ( 'in-feed' === $unit ) {
				$unit = esc_html__( 'In-feed', 'coldbox-ads-extension' );
			} elseif ( 'matched_content' === $unit ) {
				$unit = esc_html__( 'Matched Content', 'coldbox-ads-extension' );
			} elseif ( 'in-article' === $unit ) {
				$unit = esc_html__( 'In-article', 'coldbox-ads-extension' );
			} elseif ( 'large_rectangle' === $unit ) {
				$unit = esc_html__( 'Large Rectangle', 'coldbox-ads-extension' );
			}
			/* translators: 1: Unit name. */
			return $br . sprintf( esc_html__( 'RECOMMENDED UNIT: %s.', 'coldbox-ads-extension' ), '<strong>' . $unit . '</strong>' );
		}

		// Register 'ads_addon' section.
		$wp_customize->add_section(
			'ads_addon', array(
				'title'    => __( 'ADS EXTENSION: Google AdSense', 'coldbox-ads-extension' ),
				'priority' => 12,
			)
		);

		// Switch AdSense settings ON OFF.
		$wp_customize->add_setting(
			'ads_global_switcher', array(
				'default'           => true,
				'sanitize_callback' => 'wp_validate_boolean',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'ads_global_switcher', array(
					'label'    => __( 'Use Google AdSense', 'coldbox-ads-extension' ),
					'section'  => 'ads_addon',
					'type'     => 'checkbox',
					'priority' => 1,
				)
			)
		);

		// AdSense Publisher ID.
		$wp_customize->add_setting(
			'ads_pub_id', array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
				'validate_callback' => 'coldbox_ads_validate_pub_id',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'ads_pub_id', array(
					'label'       => __( 'AdSense Publisher ID', 'coldbox-ads-extension' ),
					'description' => sprintf(
						/* translators: 1: opening a tag, 2: closing a tag. */
						esc_html__( 'Publisher ID is the identifier of your AdSense account and its format is something like this: "ca-pub-XXXXXXXXXXXXX". %1$sGo here%2$s to learn how to find your publisher ID.', 'coldbox-ads-extension' ),
						'<a href="' . esc_url( __( 'https://support.google.com/adsense/answer/105516', 'coldbox_ads_addon' ) ) . '">',
						'</a>'
					),
					'section'     => 'ads_addon',
					'type'        => 'text',
					'priority'    => 5,
				)
			)
		);

		// Ad Label.
		$wp_customize->add_setting(
			'ads_label', array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'ads_label', array(
					'label'       => __( 'Ad Label', 'coldbox-ads-extension' ),
					'description' => esc_html__( 'This label will be shown before every single ad, except auto-ads, in-feed ads and matched content ads.', 'coldbox-ads-extension' ),
					'section'     => 'ads_addon',
					'type'        => 'text',
					'priority'    => 7,
				)
			)
		);

		// AdSense Auto-Ads.
		$wp_customize->add_setting(
			'ads_auto_ads', array(
				'default'           => false,
				'sanitize_callback' => 'wp_validate_boolean',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'ads_auto_ads', array(
					'label'       => esc_html__( 'Enable Auto Ads', 'coldbox-ads-extension' ),
					'description' => esc_html__( 'Before using this, you need to enable and configure your auto-ads setting from your AdSense dashboard.', 'coldbox-ads-extension' ),
					'section'     => 'ads_addon',
					'type'        => 'checkbox',
					'priority'    => 10,
				)
			)
		);
		// AdSense Auto-Ads select where to use.
		$wp_customize->add_setting(
			'ads_auto_ads_heading', array(
				'sanitize_callback' => 'cd_sanitize_text',
			)
		);
		$wp_customize->add_control(
			new Coldbox_Ads_Custom_Content(
				$wp_customize, 'ads_auto_ads_heading', array(
					'content'  => '<h4 class="czr-heading ads-heading">' . __( 'Use auto ads on...', 'coldbox' ) . '</h4>',
					'section'  => 'ads_addon',
					'priority' => 15,
				)
			)
		);
		// Selective auto-ads for the top page.
		$wp_customize->add_setting(
			'ads_auto_on_front_page', array(
				'default'           => true,
				'sanitize_callback' => 'wp_validate_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'ads_auto_on_front_page', array(
					'label'    => __( 'Front Page', 'coldbox-ads-extension' ),
					'section'  => 'ads_addon',
					'type'     => 'checkbox',
					'priority' => 20,
				)
			)
		);
		// Selective auto-ads for the archive.
		$wp_customize->add_setting(
			'ads_auto_on_archive', array(
				'default'           => true,
				'sanitize_callback' => 'wp_validate_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'ads_auto_on_archive', array(
					'label'    => __( 'Archive Pages', 'coldbox-ads-extension' ),
					'section'  => 'ads_addon',
					'type'     => 'checkbox',
					'priority' => 25,
				)
			)
		);
		// Selective auto-ads for the single pages.
		$wp_customize->add_setting(
			'ads_auto_on_single', array(
				'default'           => true,
				'sanitize_callback' => 'wp_validate_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'ads_auto_on_single', array(
					'label'    => __( 'Single Pages', 'coldbox-ads-extension' ),
					'section'  => 'ads_addon',
					'type'     => 'checkbox',
					'priority' => 30,
				)
			)
		);
		// Selective auto-ads for the pages.
		$wp_customize->add_setting(
			'ads_auto_on_pages', array(
				'default'           => true,
				'sanitize_callback' => 'wp_validate_checkbox',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'ads_auto_on_pages', array(
					'label'    => __( 'Pages', 'coldbox-ads-extension' ),
					'section'  => 'ads_addon',
					'type'     => 'checkbox',
					'priority' => 35,
				)
			)
		);

		// Heading - ad slot setting.
		$wp_customize->add_setting(
			'ads_slot_tags_heading', array(
				'sanitize_callback' => 'cd_sanitize_text',
			)
		);
		$wp_customize->add_control(
			new Coldbox_Ads_Custom_Content(
				$wp_customize, 'ads_slot_tags_heading', array(
					'content'     => '<h4 class="czr-heading ads-heading">' . __( 'Ads Slot Settings', 'coldbox' ) . '</h4>',
					'description' => esc_html__(
						'These are settings of AdSense ads. In order to use these ads, you should create a corresponding type of ad for the slot
					(e.g. if it\'s matched content ad slot, you should have a matched content).
					Then, copy and paste the slot ID to enable the ad slot. If you do not wish to show ad in certain place, then just keep it blank.  While it is possible to use different type of ad from the recommended one, I don\'t guarantee that will work and it might make your ads performance lower.', 'coldbox-ads-extension'
					),
					'section'     => 'ads_addon',
					'priority'    => 50,
				)
			)
		);

		// SINGLE : Middle ad 1 - Just before the second heading.
		$wp_customize->add_setting(
			'ad_single_mid1', array(
				'default'           => '',
				'sanitize_callback' => 'absint',
				'validate_callback' => 'coldbox_ads_validate_slot_id',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'ad_single_mid1', array(
					'label'       => __( 'Single In-article Ad Slot 1', 'coldbox-ads-extension' ),
					'description' => esc_html__( 'This ad will be shown just before the second h2 heading in an article.', 'coldbox-ads-extension' ) .
									coldbox_ads_recommended_unit_label( 1, 'in-article' ),
					'section'     => 'ads_addon',
					'type'        => 'text',
					'priority'    => 80,
				)
			)
		);
		// SINGLE : Middle ad 2 - Just before the last heading.
		$wp_customize->add_setting(
			'ad_single_mid2', array(
				'default'           => '',
				'sanitize_callback' => 'absint',
				'validate_callback' => 'coldbox_ads_validate_slot_id',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'ad_single_mid2', array(
					'label'       => __( 'Single In-article Ad Slot 2', 'coldbox-ads-extension' ),
					'description' => esc_html__( 'This ad will be shown just before the last h2 heading in an article.', 'coldbox-ads-extension' ) .
									coldbox_ads_recommended_unit_label( 1, 'in-article' ),
					'section'     => 'ads_addon',
					'type'        => 'text',
					'priority'    => 85,
				)
			)
		);

		// SINGLE : Bottom Ad for desktop.
		$wp_customize->add_setting(
			'ad_single_bottom_desktop', array(
				'default'           => '',
				'sanitize_callback' => 'absint',
				'validate_callback' => 'coldbox_ads_validate_slot_id',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'ad_single_bottom_desktop', array(
					'label'       => __( 'Single Bottom Ad Slot for Desktop', 'coldbox-ads-extension' ),
					'description' => esc_html__( 'This ad will be shown just after the content of an article.', 'coldbox-ads-extension' ) .
									coldbox_ads_recommended_unit_label( 1, 'large_rectangle' ),
					'section'     => 'ads_addon',
					'type'        => 'text',
					'priority'    => 90,
				)
			)
		);
		// SINGLE : Bottom Ad for mobile.
		$wp_customize->add_setting(
			'ad_single_bottom_mobile', array(
				'default'           => '',
				'sanitize_callback' => 'absint',
				'validate_callback' => 'coldbox_ads_validate_slot_id',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'ad_single_bottom_mobile', array(
					'label'       => __( 'Single Bottom Ad Slot for Mobile', 'coldbox-ads-extension' ),
					'description' => coldbox_ads_recommended_unit_label( 0, 'responsive' ),
					'section'     => 'ads_addon',
					'type'        => 'text',
					'priority'    => 95,
				)
			)
		);

		// Matched content ads.
		$wp_customize->add_setting(
			'ads_matched_content', array(
				'default'           => '',
				'sanitize_callback' => 'absint',
				'validate_callback' => 'coldbox_ads_validate_slot_id',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'ads_matched_content', array(
					'label'       => __( 'Matched Content Ad Slot', 'coldbox-ads-extension' ),
					'description' => __(
						'This will be shown just after your related posts.', 'coldbox-ads-extension'
					) . coldbox_ads_recommended_unit_label( 1, 'matched_content' ),
					'section'     => 'ads_addon',
					'type'        => 'text',
					'priority'    => 100,
				)
			)
		);

		// In-feed ad slot.
		$wp_customize->add_setting(
			'ads_in_feed', array(
				'default'           => '',
				'sanitize_callback' => 'absint',
				'validate_callback' => 'coldbox_ads_validate_slot_id',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'ads_in_feed', array(
					'label'       => __( 'In-feed Ad Slot', 'coldbox-ads-extension' ),
					'description' => __( 'In-feed ads are native-like ads which will be shown between articles on front and archive pages. To use this ad, create an in-feed ad from your AdSense dashboard and copy/paste slot ID and layout key.', 'coldbox-ads-extension' ) .
									coldbox_ads_recommended_unit_label( 1, 'in-feed' ),
					'section'     => 'ads_addon',
					'type'        => 'text',
					'priority'    => 110,
				)
			)
		);
		// In-feed ad layout key.
		$wp_customize->add_setting(
			'ads_in_feed_layout', array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'ads_in_feed_layout', array(
					'label'       => __( 'In-feed Ad Layout', 'coldbox-ads-extension' ),
					'description' => __( 'If you want to customize the layout of ad layout, paste its ad-layout-key here.', 'coldbox-ads-extension' ),
					'section'     => 'ads_addon',
					'type'        => 'text',
					'priority'    => 113,
				)
			)
		);
		// In-feed ad per X posts.
		$wp_customize->add_setting(
			'ads_in_feed_num', array(
				'default'           => 4,
				'sanitize_callback' => 'absint',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'ads_in_feed_num', array(
					'label'    => __( 'Show in-feed ads per X articles', 'coldbox-ads-extension' ),
					'section'  => 'ads_addon',
					'type'     => 'number',
					'priority' => 116,
				)
			)
		);

		// ARCHIVE : Page top Ad.
		$wp_customize->add_setting(
			'ad_archive_top', array(
				'default'           => '',
				'sanitize_callback' => 'absint',
				'validate_callback' => 'coldbox_ads_validate_slot_id',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'ad_archive_top', array(
					'label'       => __( 'Archive Top Ad Slot', 'coldbox-ads-extension' ),
					'description' => coldbox_ads_recommended_unit_label( 0, 'responsive' ),
					'section'     => 'ads_addon',
					'type'        => 'text',
					'priority'    => 120,
				)
			)
		);

		// ARCHIVE : Page Bottom Ad for desktop.
		$wp_customize->add_setting(
			'ad_archive_bottom_desktop', array(
				'default'           => '',
				'sanitize_callback' => 'absint',
				'validate_callback' => 'coldbox_ads_validate_slot_id',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'ad_archive_bottom_desktop', array(
					'label'       => __( 'Archive Bottom Ad Slot for Desktop', 'coldbox-ads-extension' ),
					'description' => coldbox_ads_recommended_unit_label( 0, 'large_rectangle' ),
					'section'     => 'ads_addon',
					'type'        => 'text',
					'priority'    => 125,
				)
			)
		);

		// ARCHIVE : Page Bottom Ad for mobile.
		$wp_customize->add_setting(
			'ad_archive_bottom_mobile', array(
				'default'           => '',
				'sanitize_callback' => 'absint',
				'validate_callback' => 'coldbox_ads_validate_slot_id',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'ad_archive_bottom_mobile', array(
					'label'       => __( 'Archive Bottom Ad Slot for Mobile', 'coldbox-ads-extension' ),
					'description' => coldbox_ads_recommended_unit_label( 0, 'responsive' ),
					'section'     => 'ads_addon',
					'type'        => 'text',
					'priority'    => 130,
				)
			)
		);

	}
);
