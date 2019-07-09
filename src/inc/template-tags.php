<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package mismatch
 */

if ( ! function_exists( 'mismatch_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function mismatch_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		if ( is_home() || is_archive() ) {
			echo '<span class="posted-on"><span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span></span>';
		} else {
			$posted_on = sprintf(
				/* translators: %s: post date. */
				esc_html_x( 'Posted on %s', 'post date', 'mismatch' ),
				'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
			);

			$byline = sprintf(
				/* translators: %s: post author. */
				esc_html_x( 'by %s', 'post author', 'mismatch' ),
				'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
			);

			echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
		}

	}
endif;

if ( ! function_exists( 'mismatch_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function mismatch_entry_footer() {
		// Author Bio
		if ( 'post' === get_post_type() && 1 !== get_the_author_id() ) {
			$author = get_the_author();
			$bio    = wpautop( get_the_author_meta( 'description' ) );
			$photo  = get_avatar( get_the_author_id(), 256 );
			printf( '<div class="author-card"><div class="author-card-contents"><div class="author-photo">%s</div><div class="author-bio"><h2>About the Author: %s</h2>%s</div></div></div>', $photo, $author, $bio );
		}
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'mismatch' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'mismatch' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'mismatch' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'mismatch' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'mismatch' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'mismatch' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;


if ( ! function_exists( 'mismatch_featured_post' ) ) {
	function mismatch_featured_post() {
		$primary_category    = get_theme_mod( 'mismatch_primary_category' );
		if ( $primary_category ) {
			$featured_post_query = array(
				'post_type'      => 'post',
				'cat'            => $primary_category,
				'posts_per_page' => 1,
			);
			$featured = get_posts( $featured_post_query );
			if ( ! empty( $featured ) ) {
				$featured_post = $featured[0];
				$title         = esc_html( get_the_title( $featured_post ) );
				$image         = get_the_post_thumbnail_url( $featured_post, 'large' );
				$author        = sprintf( __( 'By %s', 'mismatch' ), get_the_author_meta( 'display_name', $featured_post->post_author ) );
				$link          = esc_url( get_permalink( $featured_post ) );
				$output        = "
				<div class='featured-post' style='background-image: url($image)'>
					<div class='featured-post-mask'>
						<div class='posts'>
							<div class='featured-post-header clear'>
								<div class='mismatch-header'><img src='" . get_stylesheet_directory_uri() . '/assets/images/Mismatch_Home_Header.png' . "' alt='' /></div>
							</div>
							<p class='featured-byline'>$author</p>
							<p class='featured-post-title' id='featured-post'>$title</p>
							<p class='featured-link'><a href='$link' aria-labelledby='featured-post' class='block-button'>" . __( 'Read More', 'mismatch' ) . "</a></p>
						</div>
					</div>
				</div>";
				echo $output;
			}
		}
	}
}

if ( ! function_exists( 'mismatch_paging_nav' ) ) {
	/**
	 * Display navigation to next/previous set of posts when applicable.
	 * Based on paging nav function from Twenty Fourteen
	 */
	function mismatch_paging_nav() {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $GLOBALS['wp_query']->max_num_pages,
			'current'  => $paged,
			'mid_size' => 3,
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => __( '&larr; Previous', 'mismatch' ),
			'next_text' => __( 'Next &rarr;', 'mismatch' ),
			'type'      => 'list',
		) );

		if ( $links ) :

		?>
		<nav class="navigation posts-navigation" aria-label="<?php __( 'Posts Navigation', 'mismatch' ); ?>">
			<?php echo $links; ?>
		</nav><!-- .navigation -->
		<?php
		endif;
	}
}