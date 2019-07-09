<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package mismatch
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php mismatch_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; 
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
			echo apply_filters( 'mismatch_after_title', '', get_the_ID() );
			if ( has_post_thumbnail() ) :
				?>
				<figure class="wp-caption alignnone">
				<?php
				the_post_thumbnail();
				if ( get_the_post_thumbnail_caption() ) {
					?>
					<figcaption class="wp-caption-text">
					<?php
					the_post_thumbnail_caption();
					?>
					</figcaption>
					<?php
				}
				?>
				</figure>
				<?php
			endif;
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			if ( has_post_thumbnail() ) :
				the_post_thumbnail();
			endif;
		endif;
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'mismatch' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mismatch' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php mismatch_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
