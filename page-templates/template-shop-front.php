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
 * @package 8Store Lite Child
 */

get_header(); 

function eightstore_lite_child_print_product()
{
	echo $product->get_image();
	?>
	<li class="item-prod-wrap wow flipInY" data-wow-delay="0.5s">
		<?php do_action('woocommerce_before_shop_loop_item'); ?>
		<div class="collection_combine item-img">
			<a href="<?php the_permalink(); ?>" class="full-outer">
			<?php
				/**
				 * woocommerce_before_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				do_action('woocommerce_before_shop_loop_item_title');
            ?>
			</a>

		</div>
	</li>
<?php
}
?>

<div id="primary" class="content-area">
	<div class="store-wrapper">
		<main id="main" class="site-main" role="main">
<?php
		//load slider
		do_action('eightstore_lite_homepage_slider'); 
		global $product, $woocommerce_loop;
		
		$atts = shortcode_atts( array(
			'per_page' => '1',
			'columns'  => '3',
			'orderby'  => 'rand',
			'order'    => 'asc'
		), null);

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

		$sale_products               = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $query_args, $atts, 'sale_products' ) );
		$recent_products              = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $query_args, $atts, 'recent_products' ) );
		$columns                     = absint( $atts['columns'] );
		$woocommerce_loop['columns'] = $columns;
		
		ob_start();

		if ( $sale_products->have_posts() )
		{
?>
			<div class="woocommerce columns-4">
				<ul class="products columns-4">
					<li class="first item-prod-wrap wow flipInY post-43 product type-product status-publish has-post-thumbnail product_cat-herre sale shipping-taxable purchasable product-type-simple product-cat-herre instock" data-wow-delay="0.5s">
						<a href="http://medion/wordpress/index.php/product/roed/">
							<div class="collection_desc clearfix">
								<div class="title-cart" style="margin: 0 auto; text-align: left;">
									<a href="http://medion/wordpress/index.php/product/roed/" class="collection_title">
										<h3><?php _e( 'News', 'eightstore-lite-child' ); ?></h3>
									</a>
								</div>
							</div>
							<div class="collection_combine item-img">
								<a href="http://medion/wordpress/index.php/product/roed/" class="full-outer">
									<?php $recent_products->the_post(); ?>
									<?php echo $product->get_image(); ?>
								</a>
							</div>
						</a>
					</li>
					<li class="item-prod-wrap wow flipInY post-43 product type-product status-publish has-post-thumbnail product_cat-herre sale shipping-taxable purchasable product-type-simple product-cat-herre instock" data-wow-delay="0.5s">
						<a href="http://medion/wordpress/index.php/product/roed/">
							<div class="collection_desc clearfix">
								<div class="title-cart" style="margin: 0 auto; text-align: left;">
									<a href="http://medion/wordpress/index.php/product/roed/" class="collection_title">
										<h3><?php _e( 'On sale', 'eightstore-lite-child' ); ?></h3>
									</a>
								</div>
							</div>
							<div class="collection_combine item-img">
								<a href="http://medion/wordpress/index.php/product/roed/" class="full-outer">
									<?php $sale_products->the_post(); ?>
									<?php echo $product->get_image(); ?>
								</a>
							</div>
						</a>
					</li>
					<li class="item-prod-wrap wow flipInY post-43 product type-product status-publish has-post-thumbnail product_cat-herre sale shipping-taxable purchasable product-type-simple product-cat-herre instock" data-wow-delay="0.5s">
						<a href="http://medion/wordpress/index.php/product/roed/">
							<div class="collection_desc clearfix">
								<div class="title-cart" style="margin: 0 auto; text-align: left;">
									<a href="http://medion/wordpress/index.php/product/roed/" class="collection_title">
										<h3><?php _e( 'Accessories', 'eightstore-lite-child' ); ?></h3>
									</a>
								</div>
							</div>
							<div class="collection_combine item-img">
								<a href="http://medion/wordpress/index.php/product/roed/" class="full-outer">
									<?php /* $sale_products->the_post(); */?>
									<?php echo $product->get_image(); ?>
								</a>
							</div>
						</a>
					</li>		
				</ul>
			</div>
<?php 
			do_action( "woocommerce_shortcode_after_sale_products_loop" );
		}

		woocommerce_reset_loop();
		wp_reset_postdata();

		echo ob_get_clean();	
?>	
		</main><!-- #main -->
	</div>
</div><!-- #primary -->

<?php get_footer(); ?>
