<?php
/**
 * mismatch Theme Customizer
 *
 * @package mismatch
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function mismatch_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// remove blog description control
	$wp_customize->remove_control( 'blogdescription' );

	// rename existing section
	$wp_customize->add_section( 'title_tagline' , array(
		'title'    => __( 'Site Title', 'mismatch' ),
		'priority' => 20,
	) );
	
	$wp_customize->add_section( 'mismatch_theme', array(
		'title'      => __( 'Mismatch Settings', 'mismatch' ),
		'priority'   => 10,
		'capability' => 'edit_theme_options',
	) );
	
	$wp_customize->add_setting( 'mismatch_primary_category', array(
		'default' => '',
		'type'    => 'theme_mod',
	) );
	
	$wp_customize->add_setting( 'mismatch_secondary_category', array(
		'default' => '',
		'type'    => 'theme_mod',
	) );
	
	$wp_customize->add_setting( 'mismatch_tertiary_category', array(
		'default' => '',
		'type'    => 'theme_mod',
	) );
	
	$wp_customize->add_setting( 'mismatch_quaternary_category', array(
		'default' => '',
		'type'    => 'theme_mod',
	) );
	
	$wp_customize->add_control( new Mismatch_Dropdown_Category_Control( $wp_customize, 'mismatch_primary_category', array(
		'section'     => 'mismatch_theme',
		'label'       => __( 'Primary Category Section', 'mismatch' ),
		'description' => __( 'Select the category used to pull the first six posts on the home page.', 'mismatch' ),
	) ) );
	
	$wp_customize->add_control( new Mismatch_Dropdown_Category_Control( $wp_customize, 'mismatch_secondary_category', array(
		'section'     => 'mismatch_theme',
		'label'       => __( 'Secondary Category Section', 'mismatch' ),
		'description' => __( 'Select the category used to pull the first section of four posts on the home page.', 'mismatch' ),
	) ) );
	
	$wp_customize->add_control( new Mismatch_Dropdown_Category_Control( $wp_customize, 'mismatch_tertiary_category', array(
		'section'     => 'mismatch_theme',
		'label'       => __( 'Tertiary Category Section', 'mismatch' ),
		'description' => __( 'Select the category used to pull the second section of four posts on the home page.', 'mismatch' ),
	) ) );
	
	$wp_customize->add_control( new Mismatch_Dropdown_Category_Control( $wp_customize, 'mismatch_quaternary_category', array(
		'section'     => 'mismatch_theme',
		'label'       => __( 'Quaternary Category Section', 'mismatch' ),
		'description' => __( 'Select the category used to pull the third section of four posts on the home page.', 'mismatch' ),
	) ) );

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'mismatch_customize_partial_blogname',
		) );
	}
}
add_action( 'customize_register', 'mismatch_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function mismatch_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function mismatch_customize_preview_js() {
	wp_enqueue_script( 'mismatch-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'mismatch_customize_preview_js' );

require_once( ABSPATH . WPINC . '/class-wp-customize-setting.php' );
require_once( ABSPATH . WPINC . '/class-wp-customize-section.php' );
require_once( ABSPATH . WPINC . '/class-wp-customize-control.php' );

class Mismatch_Dropdown_Category_Control extends WP_Customize_Control {

	public $type = 'dropdown-category';

	protected $dropdown_args = false;

	protected function render_content() {
		?><label id="cat"><?php

		if ( ! empty( $this->label ) ) :
			?><span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php
		endif;

		if ( ! empty( $this->description ) ) :
			?><span class="description customize-control-description"><?php echo $this->description; ?></span><?php
		endif;
		?></label><?php

		$dropdown_args = wp_parse_args( $this->dropdown_args, array(
			'taxonomy'          => 'category',
			'show_option_none'  => __( 'None', 'mismatch' ),
			'selected'          => $this->value(),
			'show_option_all'   => '',
			'orderby'           => 'id',
			'order'             => 'ASC',
			'show_count'        => 1,
			'hide_empty'        => 1,
			'child_of'          => 0,
			'exclude'           => '',
			'hierarchical'      => 1,
			'depth'             => 0,
			'tab_index'         => 0,
			'hide_if_empty'     => false,
			'option_none_value' => 0,
			'value_field'       => 'term_id',
		) );

		$dropdown_args['echo'] = false;

		$dropdown = wp_dropdown_categories( $dropdown_args );
		$dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
		echo $dropdown;
	}
}