<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package mismatch
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function mismatch_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'mismatch_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function mismatch_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'mismatch_pingback_header' );

/**
 * Adjust number of posts displayed per page in search.
 */
function mismatch_set_search_per_page( $query ) {
	if ( ( ! is_admin() ) && ( $query->is_main_query() ) && ( $query->is_search() || $query->is_archive() ) ) {
		$query->set( 'posts_per_page', 9 );
	}
}
add_action( 'pre_get_posts', 'mismatch_set_search_per_page' );
