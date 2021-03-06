<?php

namespace App;

/**
 * Theme customizer
 */
add_action('customize_register', function (\WP_Customize_Manager $wp_customize) {

    // Add postMessage support
	$wp_customize->get_setting('blogname')->transport = 'postMessage';
	$wp_customize->selective_refresh->add_partial('blogname', [
		'selector' => '.brand',
		'render_callback' => function () {
			bloginfo('name');
		}
	]);

	// Site Identity
	$wp_customize->add_setting('logo');
	$wp_customize->add_control(
		new \WP_Customize_Image_Control(
			$wp_customize,
			'logo',
			[
				'label'      => __( 'Logo', 'u3' ),
				'section'    => 'title_tagline',
				'settings'   => 'logo',
				'description' => 'Select an image to display as the logo. Or, leave blank to print out the site title.'
			])
	);

	// Footer Branding Option
	$wp_customize->add_setting( 'footerBranding', [
		'default' => '1'
	]);
	$wp_customize->add_control(
		new \WP_Customize_Control(
			$wp_customize,
			'footerBranding',
			[
				'label'      => __( 'Footer Branding', 'u3' ),
				'section'    => 'title_tagline',
				'settings'   => 'footerBranding',
				'type'       => 'select',
				'description' => 'The footer branding helps support the template development. But you are free to disable it.',
				'choices'    => [
					'0'	=> __( 'No' ),
					'1' => __( 'Yes (Default)' ),
				]
			])
	);

	// Site Layout Tab
	$wp_customize->add_section('layout', [
		'title' => 'Site Layout',
		'description' => 'On this tab you will customize how the site layout appears including margins and containers and widget positions.',
		'priority' => 20,
	]);

	// Header layout Option
	$wp_customize->add_setting('headerLayout', [
		'default'    => '2',
	]);
	$wp_customize->add_control(
		new \WP_Customize_Control(
			$wp_customize,
			'headerLayout',
			[
				'label'      => __( 'Header Layout', 'u3' ),
				'section'    => 'layout',
				'settings'   => 'headerLayout',
				'type'       => 'select',
				'description' => 'Choose how the header and navigation menu should be displayed.',
				'choices'    => [
					'0' => __( 'None' ),
					'1'	=> __( 'Nav Top' ),
					'2' => __( 'Nav Right (Default)' ),
					'3' => __( 'Nav Bottom' ),
					'4' => __( 'Nav Left' ),
					'5' => __( 'Nav Only' ),
					'6' => __( 'Logo Only' )
				]
			])
	);

	// Content Layout Option
	$wp_customize->add_setting('contentLayout', [
		'default'    => '0',
	]);
	$wp_customize->add_control(
		new \WP_Customize_Control(
			$wp_customize,
			'mainLayout',
			[
				'label'      => __( 'Content Layout', 'u3' ),
				'section'    => 'layout',
				'settings'   => 'contentLayout',
				'type'       => 'select',
				'description' => 'Choose the layout for the main content area and sidebars. Unused sidebars will collapse.',
				'choices'    => [
					'0'	=> __( 'Secondary, Content, Primary, Tertiary (Default)' ),
					'1' => __( 'Primary, Secondary, Content, Tertiary' ),
					'2' => __( 'Content, Primary, Secondary, Tertiary' ),
					'3' => __( 'Primary, Secondary, Tertiary, Content' )
				]
			])
	);

	// Sidebar Widths
	$wp_customize->add_setting('primaryWidth', [
		'default'    => 'uk-width-1-3@m',
	]);
	$wp_customize->add_control(
		new \WP_Customize_Control(
			$wp_customize,
			'primaryWidth',
			[
				'label'      => __( 'Primary Width', 'u3' ),
				'section'    => 'layout',
				'settings'   => 'primaryWidth',
				'type'       => 'select',
				'description' => 'Width of the Primary Sidebar.',
				'choices'    => [
					'uk-width-3-4@m'	=> __( 'Three Quarters' ),
					'uk-width-2-3@m'	=> __( 'Two Thirds' ),
					'uk-width-1-2@m'	=> __( 'One Half' ),
					'uk-width-1-3@m'	=> __( 'One Third (Default)' ),
					'uk-width-1-4@m' => __( 'One Fourth' ),
					'uk-width-1-5@m' => __( 'One Fifth' ),
					'uk-width-1-6@m' => __( 'One Sixth' )
				]
			])
	);
	$wp_customize->add_setting('secondaryWidth', [
		'default'    => 'uk-width-1-3@m',
	]);
	$wp_customize->add_control(
		new \WP_Customize_Control(
			$wp_customize,
			'secondaryWidth',
			[
				'label'      => __( 'Secondary Width', 'u3' ),
				'section'    => 'layout',
				'settings'   => 'secondaryWidth',
				'type'       => 'select',
				'description' => 'Width of the Secondary Sidebar.',
				'choices'    => [
					'uk-width-3-4@m'	=> __( 'Three Quarters' ),
					'uk-width-2-3@m'	=> __( 'Two Thirds' ),
					'uk-width-1-2@m'	=> __( 'One Half' ),
					'uk-width-1-3@m'	=> __( 'One Third (Default)' ),
					'uk-width-1-4@m' => __( 'One Fourth' ),
					'uk-width-1-5@m' => __( 'One Fifth' ),
					'uk-width-1-6@m' => __( 'One Sixth' )
				]
			])
	);
	$wp_customize->add_setting('tertiaryWidth', [
		'default'    => 'uk-width-1-3@m',
	]);
	$wp_customize->add_control(
		new \WP_Customize_Control(
			$wp_customize,
			'tertiaryWidth',
			[
				'label'      => __( 'Tertiary Width', 'u3' ),
				'section'    => 'layout',
				'settings'   => 'tertiaryWidth',
				'type'       => 'select',
				'description' => 'Width of the Tertiary Sidebar.',
				'choices'    => [
					'uk-width-3-4@m'	=> __( 'Three Quarters' ),
					'uk-width-2-3@m'	=> __( 'Two Thirds' ),
					'uk-width-1-2@m'	=> __( 'One Half' ),
					'uk-width-1-3@m'	=> __( 'One Third (Default)' ),
					'uk-width-1-4@m' => __( 'One Fourth' ),
					'uk-width-1-5@m' => __( 'One Fifth' ),
					'uk-width-1-6@m' => __( 'One Sixth' )
				]
			])
	);

	// Site layout Option
	$wp_customize->add_setting('siteLayout', [
		'default'    => 'custom'
	]);
	$wp_customize->add_control(
		new \WP_Customize_Control(
			$wp_customize,
			'siteLayout',
			[
				'label'      => __( 'Site Layout', 'u3' ),
				'section'    => 'layout',
				'settings'   => 'siteLayout',
				'type'       => 'select',
				'description' => 'Choose the layout of the site, or choose "Custom..." to be able to add your own custom widgets.',
				'choices'    => [
					'u3' => __( 'U3' ),
					'yt' => __( 'YooTheme' ),
					'rt' => __( 'Gantry' ),
					'custom' => __( 'Custom (Default)' )
				]
			])
	);

	// Custom Widgets
	$wp_customize->add_setting('sections', [
		'default' => 'Header,Top,Main,Footer,Copyright',
		'sanitize_callback' => 'u3_validate_sections'
	]);
	$wp_customize->add_control(
		new \WP_Customize_Control(
			$wp_customize,
			'sections',
			[
				'label'      => __( 'Sections List', 'u3' ),
				'section'    => 'layout',
				'settings'   => 'sections',
				'description' => 'Note, when adding or removing widget positions, you will need to Publish and then Refresh the customizer completely for layout options.<br /><br />Default: header,top,main,footer,copyright<br />YooTheme Copy: toolbar,header,top-a,top-b,main-top,main,main-bottom,bottom-a,bottom-b,copyright',
				'type'       => 'textarea',
				'transport' => 'refresh',
			])
	);

	// Container
	$sections = explode( ',', get_theme_mod('sections') );
	foreach ($sections as $value) {
		$wp_customize->add_setting('sectionContainer-' . $value, [
			'default'    => 'uk-container',
		]);
		$wp_customize->add_control(
			new \WP_Customize_Control(
				$wp_customize,
				'sectionContainer-' . $value,
				[
					'label'      => __( ucfirst($value). ' Container', 'u3' ),
					'section'    => 'layout',
					'settings'   => 'sectionContainer-' .$value,
					'type'       => 'select',
					'choices'    => [
						'uk-container uk-container-expand uk-padding-remove' => __( 'None' ),
						'uk-container uk-container-small' => __( 'Small' ),
						'uk-container' => __( 'Standard (Default)' ),
						'uk-container uk-container-large' => __( 'Widescreen' ),
						'uk-container uk-container-expand' => __( 'Fluid' ),
					]
				])
		);

		// Layout
		$wp_customize->add_setting('sectionLayout-' . $value, [
			'default'    => 'uk-section',
		]);
		$wp_customize->add_control(
			new \WP_Customize_Control(
				$wp_customize,
				'sectionLayout-' . $value,
				[
					'label'      => __( ucfirst($value). ' Layout', 'u3' ),
					'section'    => 'layout',
					'settings'   => 'sectionLayout-' .$value,
					'type'       => 'select',
					'choices'    => [
						'uk-section uk-padding-remove'	=> __( 'None' ),
						'uk-section uk-section-small' => __( 'Small' ),
						'uk-section' => __( 'Normal (Default)' ),
						'uk-section uk-section-large' => __( 'Large' )
					]
				])
		);
	}
	// Site Style Tab
	$wp_customize->add_section('siteStyle', [
		'title' => 'Site Style',
		'description' => 'On this tab you will customize how individual site elements stylings will appear.',
		'priority' => 30,
	]);

	// Search Layout Option
	$wp_customize->add_setting('searchStyle', [
		'default'    => '3',
	]);
	$wp_customize->add_control(
		new \WP_Customize_Control(
			$wp_customize,
			'searchStyle',
			[
				'label'      => __( 'Search Style', 'u3' ),
				'section'    => 'siteStyle',
				'settings'   => 'searchStyle',
				'type'       => 'select',
				'description' => 'Choose the style of Search',
				'choices'    => [
					'0'	=> __( 'Box' ),
					'1' => __( 'Dropdown' ),
					'2' => __( 'Icon Fullscreen' ),
					'3' => __( 'None (Default)' )
				]
			])
	);

	// Sidebar Styles
	$wp_customize->add_setting('primaryStyle', [
		'default'    => '',
	]);
	$wp_customize->add_control(
		new \WP_Customize_Control(
			$wp_customize,
			'primaryStyle',
			[
				'label'      => __( 'Primary Sidebar', 'u3' ),
				'section'    => 'siteStyle',
				'settings'   => 'primaryStyle',
				'type'       => 'select',
				'description' => 'Choose the style of Search',
				'choices'    => [
					'' => __( 'None' ),
					' uk-section-muted' => __( 'Muted' ),
					' uk-section-default' => __( 'Default' ),
					' uk-section-primary' => __( 'Primary' ),
					' uk-section-secondary' => __( 'Secondary' ),
					' uk-section-tertiary' => __( 'Tertiary' ),
				]
			])
	);

	$wp_customize->add_setting('secondaryStyle', [
		'default'    => '',
	]);
	$wp_customize->add_control(
		new \WP_Customize_Control(
			$wp_customize,
			'secondaryStyle',
			[
				'label'      => __( 'Secondary Sidebar', 'u3' ),
				'section'    => 'siteStyle',
				'settings'   => 'secondaryStyle',
				'type'       => 'select',
				'description' => 'Choose the style of Search',
				'choices'    => [
					'' => __( 'None' ),
					' uk-section-muted' => __( 'Muted' ),
					' uk-section-default' => __( 'Default' ),
					' uk-section-primary' => __( 'Primary' ),
					' uk-section-secondary' => __( 'Secondary' ),
					' uk-section-tertiary' => __( 'Tertiary' ),
				]
			])
	);

	$wp_customize->add_setting('tertiaryStyle', [
		'default'    => '',
	]);
	$wp_customize->add_control(
		new \WP_Customize_Control(
			$wp_customize,
			'tertiaryStyle',
			[
				'label'      => __( 'Tertiary Sidebar', 'u3' ),
				'section'    => 'siteStyle',
				'settings'   => 'tertiaryStyle',
				'type'       => 'select',
				'description' => 'Choose the style of Search',
				'choices'    => [
					'' => __( 'None' ),
					' uk-section-muted' => __( 'Muted' ),
					' uk-section-default' => __( 'Default' ),
					' uk-section-primary' => __( 'Primary' ),
					' uk-section-secondary' => __( 'Secondary' ),
					' uk-section-tertiary' => __( 'Tertiary' ),
				]
			])
	);

	// Widget Settings Styles
	$sections = explode( ',', get_theme_mod('sections') );
	foreach ($sections as $value) {
		$wp_customize->add_setting('sectionStyle-' . $value, [
			'default'    => ' uk-section-default',
		]);
		$wp_customize->add_control(
			new \WP_Customize_Control(
				$wp_customize,
				'sectionStyle-' . $value,
				[
					'label'      => __( ucfirst($value). ' Style', 'u3' ),
					'section'    => 'siteStyle',
					'settings'   => 'sectionStyle-' .$value,
					'type'       => 'select',
					'choices'    => [
						'' => __( 'None' ),
						' uk-section-muted' => __( 'Muted' ),
						' uk-section-default' => __( 'Default' ),
						' uk-section-primary' => __( 'Primary' ),
						' uk-section-secondary' => __( 'Secondary' ),
						' uk-section-tertiary' => __( 'Tertiary' ),
					]
				])
		);
	}
});

/**
 * Customizer JS
 */
add_action('customize_preview_init', function () {
	wp_enqueue_script('sage/customizer.js', asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
});
