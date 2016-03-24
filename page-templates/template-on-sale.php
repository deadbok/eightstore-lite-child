<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Template Name: On sale
 * @package 8Store Lite
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		//load slider
		do_action('eightstore_lite_homepage_slider'); 
		global $woocommerce_loop;
		
		$atts = shortcode_atts( array(
			'per_page' => '12',
			'columns'  => '4',
			'orderby'  => 'title',
			'order'    => 'asc'
		), $atts );

		$query_args = array(
			'posts_per_page' => $atts['per_page'],
			'orderby'        => $atts['orderby'],
			'order'          => $atts['order'],
			'no_found_rows'  => 1,
			'post_status'    => 'publish',
			'post_type'      => 'product',
			'meta_query'     => WC()->query->get_meta_query(),
			'post__in'       => array_merge( array( 0 ), wc_get_product_ids_on_sale() )
		);

		$products                    = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $query_args, $atts, 'sale_products' ) );
		$columns                     = absint( $atts['columns'] );
		$woocommerce_loop['columns'] = $columns;

		ob_start();

		if ( $products->have_posts() ) : ?>

			<?php do_action( "woocommerce_shortcode_before_{$loop_name}_loop" ); ?>

			<?php woocommerce_product_loop_start(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php do_action( "woocommerce_shortcode_after_{$loop_name}_loop" ); ?>

		<?php endif;

		woocommerce_reset_loop();
		wp_reset_postdata();

		return '<div class="woocommerce columns-' . $columns . '">' . ob_get_clean() . '</div>';	
		?>		
	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
