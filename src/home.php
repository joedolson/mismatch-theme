<?php
/**
 * The home template file
 *
 * Displays posts on the front page of the theme when posts is the front page display option
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package mismatch
 */

get_header(); ?>

	<main id="primary" class="site-main">
		<?php mismatch_featured_post(); ?>
		<div class="posts">
	<?php
	if ( have_posts() ) :

		$primary_category    = get_theme_mod( 'mismatch_primary_category' );
		$secondary_category  = get_theme_mod( 'mismatch_secondary_category' );
		$tertiary_category   = get_theme_mod( 'mismatch_tertiary_category' );
		$quaternary_category = get_theme_mod( 'mismatch_quaternary_category' );
		$queries             = array();
		$featured            = array();
		if ( $primary_category || $secondary_category || $tertiary_category || $quaternary_category ) {
			if ( $primary_category ) {
				$primary_category_query = array(
					'post_type'      => 'post',
					'cat'            => $primary_category,
					'posts_per_page' => 6,
					'no_found_rows'  => true,
				);
				$cat_name  = get_cat_name( $primary_category );
				$queries[] = array(
					'svg'   => '<svg width="40px" height="40px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 40 40" style="enable-background:new 0 0 40 40;" xml:space="preserve">
					<g>
						<rect y="33.3" width="6.7" height="6.7"/>
						<rect x="6.7" y="26.7" width="6.7" height="6.7"/>
					</g>
					<circle cx="10" cy="10" r="10"/>
					<polygon points="40,20 40,40 20,40 "/>
					<g>
						<rect x="20" y="0" transform="matrix(-1.836970e-16 1 -1 -1.836970e-16 40 -20)" width="20" height="20"/>
					</g>
					<g>
						<rect x="13.3" y="20" width="6.7" height="6.7"/>
					</g>
					<g>
						<rect x="13.3" y="33.3" transform="matrix(-1.836970e-16 1 -1 -1.836970e-16 53.3268 20.008)" width="6.7" height="6.7"/>
					</g>
					<g>
						<rect x="0" y="20" transform="matrix(-1.836970e-16 1 -1 -1.836970e-16 26.6718 20.008)" width="6.7" height="6.7"/>
					</g>
				</svg>',
					'name'  => $cat_name,
					'query' => $primary_category_query,
				);
			}
			if ( $secondary_category ) {
				$secondary_category_query = array(
					'post_type'      => 'post',
					'cat'            => $secondary_category,
					'posts_per_page' => 4,
					'no_found_rows'  => true,
				);
				$cat_name  = get_cat_name( $secondary_category );
				$queries[] = array(
					'svg'   => '<svg width="40px" height="40px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 40 40" style="enable-background:new 0 0 40 40;" xml:space="preserve">
<g>
	<rect x="0" y="0" transform="matrix(-1.836970e-16 1 -1 -1.836970e-16 20.0104 1.039941e-02)" width="20" height="20"/>
</g>
<circle cx="30" cy="10" r="10"/>
<polygon points="20,40 0,40 0,20 "/>
<rect x="20" y="20" width="20" height="4"/>
<rect x="20" y="28" width="20" height="4"/>
<rect x="20" y="36" width="20" height="4"/>
</svg>',
					'name'  => $cat_name,
					'query' => $secondary_category_query,
				);
			}
			if ( $tertiary_category ) {
				$tertiary_category_query = array(
					'post_type'      => 'post',
					'cat'            => $tertiary_category,
					'posts_per_page' => 4,
					'no_found_rows'  => true,
				);
				$cat_name  = get_cat_name( $tertiary_category );
				$queries[] = array(
					'svg'   => '<svg width="40px" height="40px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 40 40" style="enable-background:new 0 0 40 40;" xml:space="preserve">
<path d="M40,10c0,0-4.5,0-10,0c0,0,0,0,0,0c0-5.5,0-10,0-10C35.5,0,40,4.5,40,10z"/>
<path d="M40,20c0,0-4.5,0-10,0c0,0,0,0,0,0c0-5.5,0-10,0-10C35.5,10,40,14.5,40,20z"/>
<path d="M30,10c0,0-4.5,0-10,0c0,0,0,0,0,0c0-5.5,0-10,0-10C25.5,0,30,4.5,30,10z"/>
<path d="M30,20c0,0-4.5,0-10,0c0,0,0,0,0,0c0-5.5,0-10,0-10C25.5,10,30,14.5,30,20z"/>
<g>
	<rect x="0" y="20" transform="matrix(-1 -1.224647e-16 1.224647e-16 -1 19.9793 60)" width="20" height="20"/>
</g>
<circle cx="30" cy="30" r="10"/>
<polygon points="0,20 0,0 20,0 "/>
</svg>',
					'name'  => $cat_name,
					'query' => $tertiary_category_query,
				);
			}
			if ( $quaternary_category ) {
				$quaternary_category_query = array(
					'post_type'      => 'post',
					'cat'            => $quaternary_category,
					'posts_per_page' => 4,
					'no_found_rows'  => true,
				);
				$cat_name  = get_cat_name( $quaternary_category );
				$queries[] = array(
					'svg'   => '<svg width="40px" height="40px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 40 40" style="enable-background:new 0 0 40 40;" xml:space="preserve">
<polygon points="0,0 10,0 10,10 "/>
<polygon points="0,10 10,10 10,20 "/>
<polygon points="10,0 20,0 20,10 "/>
<polygon points="10,10 20,10 20,20 "/>
<g>
	<rect x="20" y="20" transform="matrix(-1.836970e-16 1 -1 -1.836970e-16 60 9.166001e-13)" width="20" height="20"/>
</g>
<circle cx="10" cy="30" r="10"/>
<polygon points="20,0 40,0 40,20 "/>
</svg>',
					'name'  => $cat_name,
					'query' => $quaternary_category_query,
				);
			}
			foreach( $queries as $category ) {
				$q         = $category['query'];
				$name      = $category['name'];
				$cat_query = new WP_Query( $q );
				/* Start the Loop */
				?>
				<div class='mismatch-posts-block clear'>
				<?php
				echo $category['svg']
				?>
				<h2 class="category-title">
				<?php
				echo esc_html( $name );
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
				<?php
			}
		} else {
			/* Start the Loop */
				?>
				<svg width="40px" height="40px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 40 40" style="enable-background:new 0 0 40 40;" xml:space="preserve">
					<g>
						<rect y="33.3" width="6.7" height="6.7"/>
						<rect x="6.7" y="26.7" width="6.7" height="6.7"/>
					</g>
					<circle cx="10" cy="10" r="10"/>
					<polygon points="40,20 40,40 20,40 "/>
					<g>
						<rect x="20" y="0" transform="matrix(-1.836970e-16 1 -1 -1.836970e-16 40 -20)" width="20" height="20"/>
					</g>
					<g>
						<rect x="13.3" y="20" width="6.7" height="6.7"/>
					</g>
					<g>
						<rect x="13.3" y="33.3" transform="matrix(-1.836970e-16 1 -1 -1.836970e-16 53.3268 20.008)" width="6.7" height="6.7"/>
					</g>
					<g>
						<rect x="0" y="20" transform="matrix(-1.836970e-16 1 -1 -1.836970e-16 26.6718 20.008)" width="6.7" height="6.7"/>
					</g>
				</svg>
				<h2 class="category-title"><?php _e( 'Posts', 'mismatch' ); ?></h2>
				<?php
			while ( have_posts() ) : the_post();

				/*
					* Include the Post-Format-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Format name) and that will be used instead.
					*/
				get_template_part( 'template-parts/content-home', get_post_format() );

			endwhile;

			the_posts_navigation();
		}

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif; ?>
		</div>
	</main><!-- #primary -->

<?php
get_footer();
