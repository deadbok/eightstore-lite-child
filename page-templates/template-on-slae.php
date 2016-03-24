<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Template Name: Shop front 
 * @package 8Store Lite
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		//load slider
		do_action('eightstore_lite_homepage_slider'); 
		?>
		<?php if ( have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</header><!-- .entry-header -->
					<?php if(has_post_thumbnail()): ?>
						<div class="post-thumbnail">
							<?php the_post_thumbnail('full'); ?>
						</div>
					<?php endif; ?>
					<div class="entry-content">
						<?php the_content(); ?>
						<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'eightstore-lite' ),
							'after'  => '</div>',
							) );
							?>
					</div><!-- .entry-content -->

					<footer class="entry-footer">
						<?php edit_post_link( esc_html__( 'Edit', 'eightstore-lite' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-footer -->
				</article><!-- #post-## -->
			<?php endwhile; ?>
		<?php endif; ?>				
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
