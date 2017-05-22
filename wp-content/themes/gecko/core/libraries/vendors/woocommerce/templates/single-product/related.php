<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$limit = cs_get_option( 'wc-other-product-show' ) ? cs_get_option( 'wc-other-product-show' ) : 3;

if ( version_compare( WC_VERSION, '3.0.0', '<' ) ) {
	global $product;

	if ( empty( $product ) || ! $product->exists() ) {
		return;
	}

	$related = $product->get_related( $posts_per_page );

	if ( sizeof( $related ) === 0 ) return;

	$args = apply_filters( 'woocommerce_related_products_args', array(
		'post_type'            => 'product',
		'ignore_sticky_posts'  => 1,
		'no_found_rows'        => 1,
		'posts_per_page'       => $posts_per_page,
		'orderby'              => $orderby,
		'post__in'             => $related,
		'post__not_in'         => array( $product->id )
	) );

	$products = new WP_Query( $args );

	if ( $products->have_posts() ) : ?>

		<div class="related product-extra mt__60 jas-container">

			<h2 class="tu tc mg__0"><?php esc_html_e( 'Related product(s)', 'gecko' ); ?></h2>
		
			<div class="jas-carousel" data-slick='{"slidesToShow": <?php echo (int) $limit; ?>,"slidesToScroll": 1,"responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 3}},{"breakpoint": 480,"settings":{"slidesToShow": 1}}]}'>
				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>
			</div>

		</div>

	<?php endif;
} else {
	if ( $related_products ) : ?>
	

		<div class="related product-extra mt__60 jas-container">

			<h2 class="tu tc mg__0"><?php esc_html_e( 'Related product(s)', 'gecko' ); ?></h2>

			<div class="jas-carousel" data-slick='{"slidesToShow": <?php echo (int) $limit; ?>,"slidesToScroll": 1,"responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 3}},{"breakpoint": 480,"settings":{"slidesToShow": 1}}]}'>

				<?php foreach ( $related_products as $related_product ) : ?>

					<?php
					 	$post_object = get_post( $related_product->get_id() );

						setup_postdata( $GLOBALS['post'] =& $post_object );

						wc_get_template_part( 'content', 'product' );
					?>

				<?php endforeach; ?>

			</div>

		</div>

	<?php endif;
}

wp_reset_postdata();
