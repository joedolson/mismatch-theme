<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package mismatch
 */

get_header(); ?>

	<main id="primary" class="site-main">

	<?php
	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/content', get_post_type() );

		if ( is_singular( 'post' ) ) {
			$cats = get_the_category( get_the_ID() );
			$cat  = $cats[0];
			$q = array(
				'post_type'      => 'post',
				'cat'            => $cat->term_id,
				'posts_per_page' => 4,
				'no_found_rows'  => true,
				'post__not_in'   => array( get_the_ID() ),
			);
			$name      = $cat->name;
			$cat_query = new WP_Query( $q );
			/* Start the Loop */
			?>
			<div class="posts">
				<div class='mismatch-posts-block four clear'>
				<?php
				echo $category['svg']
				?>
				<h2 class="category-title">
				<?php
				echo esc_html( sprintf( __( 'More &ldquo;%s&rdquo;', 'mismatch' ), $name ) );
				?>
				</h2>
					<div class="mismatch-group clear">
					<?php
					while ( $cat_query->have_posts() ) : $cat_query->the_post();

						/*
							* Include the Post-Format-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Format name) and that will be used instead.
							*/
						get_template_part( 'template-parts/content-home', get_post_format() );

					endwhile;
					?>
					</div>
				</div>
			</div>
		<?php
		}

		the_post_navigation( array(
			'prev_text' => '<div>Previous</div>%title',
			'next_text' => '<div>Next</div>%title',
		) );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	endwhile; // End of the loop.

	?>
	</main><!-- #primary -->

<?php
get_footer();
