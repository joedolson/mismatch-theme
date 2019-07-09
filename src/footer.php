<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mismatch
 */

?>

<footer id="colophon" class="site-footer">
	<div class="footer-widgets">
	<?php 
	dynamic_sidebar( 'Footer' );
	?>
	</div>
	<div class="footer-menu">
		<nav class="footer-menu" aria-label="<?php echo esc_attr( __( 'Footer Navigation', 'mismatch' ) ); ?>">
		<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-3',
				'menu_id'        => 'footer-menu',
				'fallback_cb'    => false,
			) );
		?>
		</nav>
	</div>
	<div class="site-info">
		<p>
		<?php
			printf( '<strong>%s</strong> &mdash; %s', get_bloginfo( 'name' ), get_bloginfo( 'description' ) );
		?>
		</p>
		<p>
			&copy; <?php echo date( 'Y' ); ?>
		</p>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
