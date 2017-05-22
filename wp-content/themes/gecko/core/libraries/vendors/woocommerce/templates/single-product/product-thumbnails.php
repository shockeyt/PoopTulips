<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
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
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;

if ( version_compare( WC_VERSION, '3.0.0', '<' ) ) {
	$attachment_ids = $product->get_gallery_attachment_ids();
} else {
	$attachment_ids = $product->get_gallery_image_ids();
}
$attachment_count = count( $attachment_ids );

// Get page options
$options = get_post_meta( get_the_ID(), '_custom_wc_options', true );

// Get product single style
$style = ( is_array( $options ) && $options['wc-single-style'] ) ? $options['wc-single-style'] : cs_get_option( 'wc-single-style' );

if ( $style == '1' && $attachment_ids && has_post_thumbnail() ) {
	?>
	<div class="p-nav oh jas-carousel" data-slick='{"slidesToShow": 4,"slidesToScroll": 1,"asNavFor": ".p-thumb","arrows": false, "focusOnSelect": true}'>
		<?php
			$image = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_thumbnail' ), array(
				'title'	=> get_the_title( get_post_thumbnail_id() )
			) );

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div>%s</div>', $image ), $post->ID );

			foreach ( $attachment_ids as $attachment_id ) {
				$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
				$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
				$thumbnail_post  = get_post( $attachment_id );
				$image_title     = $thumbnail_post->post_content;

				$attributes = array(
					'title'                   => $image_title,
					'data-src'                => $full_size_image[0],
					'data-large_image'        => $full_size_image[0],
					'data-large_image_width'  => $full_size_image[1],
					'data-large_image_height' => $full_size_image[2],
				);

				$html = '<div>' . wp_get_attachment_image( $attachment_id, 'shop_thumbnail', false, $attributes ) . '</div>';

				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
			}
		?>
	</div>
	<?php
}
