<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package mismatch
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
		<?php
		if ( has_post_thumbnail() ) :
			the_post_thumbnail();
		endif;
		the_title( '<h2 class="entry-title">', '</h2>' );
		?>
		</a>
		<?php
		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php mismatch_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif;
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_excerpt();
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
