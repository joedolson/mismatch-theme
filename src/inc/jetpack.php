<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package mismatch
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function mismatch_jetpack_setup() {
	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Content Options.
	add_theme_support( 'jetpack-content-options', array(
		'post-details' => array(
			'stylesheet' => 'mismatch-style',
			'date'       => '.posted-on',
			'categories' => '.cat-links',
			'tags'       => '.tags-links',
			'author'     => '.byline',
			'comment'    => '.comments-link',
		),
	) );
}
add_action( 'after_setup_theme', 'mismatch_jetpack_setup' );

/**
 * Remove sharing filters so that share options can be located in post header.
 *
 * See: https://jetpack.com/2013/06/10/moving-sharing-icons/
 */
function mismatch_tweak_remove_share() {
	remove_filter( 'the_content', 'sharing_display', 19 );
	remove_filter( 'the_excerpt', 'sharing_display', 19 );
	if ( class_exists( 'Jetpack_Likes' ) ) {
		remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
	}
}
add_action( 'loop_start', 'mismatch_tweak_remove_share' );

/**
 * Position JetPack sharing in 'mismatch_after_title' filter.
 *
 * See: https://jetpack.com/2013/06/10/moving-sharing-icons/
 */
function mismatch_show_jetpack_share( $content, $post_ID ) {
	$sharing = '';
	$likes   = '';
	if ( function_exists( 'sharing_display' ) ) {
		$sharing = sharing_display( '' );
	}
	 
	if ( class_exists( 'Jetpack_Likes' ) ) {
		$custom_likes = new Jetpack_Likes;
		$likes = $custom_likes->post_likes( '' );
	}

	return $content . $sharing . $likes;
}
add_filter( 'mismatch_after_title', 'mismatch_show_jetpack_share', 10, 2 );