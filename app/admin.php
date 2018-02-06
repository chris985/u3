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
				'settings'   => 'logo'
			])
	);

	// Site Layout Tab
	$wp_customize->add_section('layout', [
		'title' => 'Site Layout',
		'description' => '',
		'priority' => 20,
	]);

// Site layout Option
	$wp_customize->add_setting('siteLayout', [
		'default'    => 'uk-container',
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
				'choices'    => [
					'uk-container' => __( 'Standard (Default)' ),
					'uk-container uk-container-small' => __( 'Small' ),
					'uk-container uk-container-large' => __( 'Widescreen' ),
					'uk-container uk-container-expand' => __( 'Fluid' )
				]
			])
	);

	// Header layout Option
	$wp_customize->add_setting('headerLayout', [
		'default'    => '1',
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
				'choices'    => [
					'0'	=> __( 'Nav Top' ),
					'1' => __( 'Nav Right (Default)' ),
					'2' => __( 'Nav Bottom' ),
					'3' => __( 'Nav Left' ),
					'4' => __( 'Nav Only' ),
					'5' => __( 'Logo Only' ),
					'6' => __( 'None' )
				]
			])
	);

	// Search Layout Option
	$wp_customize->add_setting('searchLayout', [
		'default'    => '0',
	]);
	$wp_customize->add_control(
		new \WP_Customize_Control(
			$wp_customize,
			'searchLayout',
			[
				'label'      => __( 'Search Layout', 'u3' ),
				'section'    => 'layout',
				'settings'   => 'searchLayout',
				'type'       => 'select',
				'choices'    => [
					'0'	=> __( 'Box (Default)' ),
					'1' => __( 'Dropdown' ),
					'2' => __( 'Icon Fullscreen' ),
					'3' => __( 'None' )
				]
			])
	);

	// Content Layout Option
	$wp_customize->add_setting('mainLayout', [
		'default'    => '0',
	]);
	$wp_customize->add_control(
		new \WP_Customize_Control(
			$wp_customize,
			'mainLayout',
			[
				'label'      => __( 'Content Layout', 'u3' ),
				'section'    => 'layout',
				'settings'   => 'mainLayout',
				'type'       => 'select',
				'choices'    => [
					'0'	=> __( 'Secondary, Content, Primary, Tertiary (Default)' ),
					'1' => __( 'Primary, Secondary, Content, Tertiary' ),
					'2' => __( 'Content, Primary, Secondary, Tertiary' ),
					'3' => __( 'Primary, Secondary, Tertiary, Content' )
				]
			])
	);
	$wp_customize->add_control( 'button_id', array(
    'type' => 'button',
    'settings' => array(), // 👈
    'priority' => 10,
    'section' => 'layout',
    'input_attrs' => array(
        'value' => __( 'Edit Pages', 'textdomain' ), // 👈
        'class' => 'button button-primary', // 👈
    ),
) );
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
				'section'    => 'layout',
				'settings'   => 'footerBranding',
				'type'       => 'select',
				'choices'    => [
					'0'	=> __( 'No' ),
					'1' => __( 'Yes (Default)' ),
				]
			])
	);

/*
	// Site Style
	$wp_customize->add_section('themestyle', [
		'title' => 'Site Style',
		'description' => '',
		'priority' => 30,
	]);

	// Style Options 
	$wp_customize->add_setting('logo2');
	$wp_customize->add_control(
		new \WP_Customize_Image_Control(
			$wp_customize,
			'logo2',
			[
				'label'      => __( 'Site Logo', 'starcresc' ),
				'section'    => 'themestyle',
				'settings'   => 'logo2'
			])
		); */

	// Header layout Option
		$wp_customize->add_setting('sectionsList', [
			'default'    => 'header,top,bottom,footer',
		]);
		$wp_customize->add_control(
			new \WP_Customize_Control(
				$wp_customize,
				'sectionsList',
				[
					'label'      => __( 'Sections List', 'u3' ),
					'section'    => 'layout',
					'settings'   => 'sectionsList',
					'description' => 'Note, when adding or removing widget positions, you will need to save and then exit the customizer completely for them to take effect.',
					'type'       => 'textarea',
					'transport' => 'refresh',
				])
		);
// NEW
		$sections = explode( ',', get_theme_mod('sectionsList') );

		foreach ($sections as $value) {
			$wp_customize->add_setting('sectionLayout-' . $value, [
				'default'    => 'uk-section',
			]);
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'sectionLayout-' . $value,
					[
						'label'      => __( $value. ' Layout', 'u3' ),
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
			$wp_customize->add_setting('sectionContainer-' . $value, [
				'default'    => 'uk-container',
			]);
			$wp_customize->add_control(
				new \WP_Customize_Control(
					$wp_customize,
					'sectionContainer-' . $value,
					[
						'label'      => __( $value. ' Container', 'u3' ),
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
		}




//









	});


/**
 * Customizer JS
 */
add_action('customize_preview_init', function () {
	wp_enqueue_script('sage/customizer.js', asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
});
