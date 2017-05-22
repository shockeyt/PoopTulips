<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
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

if ( version_compare( WC_VERSION, '3.0.0', '<' ) ) {
	global $product;

	$crosssells = WC()->cart->get_cross_sells();

	if ( 0 === sizeof( $crosssells ) ) return;

	$meta_query = WC()->query->get_meta_query();

	$args = array(
		'post_type'           => 'product',
		'ignore_sticky_posts' => 1,
		'no_found_rows'       => 1,
		'posts_per_page'      => apply_filters( 'woocommerce_cross_sells_total', $posts_per_page ),
		'orderby'             => $orderby,
		'post__in'            => $crosssells,
		'meta_query'          => $meta_query
	);

	$products = new WP_Query( $args );

	if ( $products->have_posts() ) : ?>

		<div class="cross-sells product-extra">

			<h2><?php esc_html_e( 'You may be interested in&hellip;', 'gecko' ) ?></h2>

			<div class="jas-carousel" data-slick='{"slidesToShow": 2,"slidesToScroll": 1,"responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 2}},{"breakpoint": 480,"settings":{"slidesToShow": 1}}]}'>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			</div>

		</div>

	<?php endif;
} else {
	if ( $cross_sells ) : ?>

		<div class="cross-sells product-extra">

			<h2><?php esc_html_e( 'You may be interested in&hellip;', 'gecko' ) ?></h2>

			<div class="jas-carousel" data-slick='{"slidesToShow": 2,"slidesToScroll": 1,"responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 2}},{"breakpoint": 480,"settings":{"slidesToShow": 1}}]}'>

				<?php foreach ( $cross_sells as $cross_sell ) : ?>

					<?php
					 	$post_object = get_post( $cross_sell->get_id() );

						setup_postdata( $GLOBALS['post'] =& $post_object );

						wc_get_template_part( 'content', 'product' );
					?>

				<?php endforeach; ?>

			</div>

		</div>

	<?php endif;
}

wp_reset_postdata();
