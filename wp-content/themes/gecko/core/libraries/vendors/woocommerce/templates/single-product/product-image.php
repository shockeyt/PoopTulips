<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $woocommerce, $product;

// Get page options
$options = get_post_meta( get_the_ID(), '_custom_wc_options', true );

// Get product single style
$style = ( is_array( $options ) && $options['wc-single-style'] ) ? $options['wc-single-style'] : cs_get_option( 'wc-single-style' );

if ( $style == '1' || $style == '3' ) {
	$attr = '{"slidesToShow": 1,"slidesToScroll": 1,"asNavFor": ".p-nav","fade":true}';
} else {
	$attr = '{"slidesToShow": 3,"slidesToScroll": 1,"centerMode":true, "responsive":[{"breakpoint": 960,"settings":{"slidesToShow": 2, "centerMode":false}},{"breakpoint": 480,"settings":{"slidesToShow": 1, "centerMode":false}}]}';
}
?>
<div class="single-product-thumbnail pr woocommerce-product-gallery">
	<div class="p-thumb images jas-carousel" data-slick='<?php echo esc_attr( $attr ); ?>'>
		<?php
			if ( has_post_thumbnail() ) {
				$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
				$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
				$thumbnail_post    = get_post( $post_thumbnail_id );
				$image_title       = $thumbnail_post->post_content;

				$attributes = array(
					'title'                   => $image_title,
					'data-src'                => $full_size_image[0],
					'data-large_image'        => $full_size_image[0],
					'data-large_image_width'  => $full_size_image[1],
					'data-large_image_height' => $full_size_image[2],
				);

				if ( cs_get_option( 'wc-single-elevate' ) ) {
					$attributes['class'] = 'jas-image-zoom';
					$attributes['data-zoom-image'] = $full_size_image[0];
				}

				$html  = '<div class="p-item woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '" class="woocommerce-product-gallery__trigger">';
					$html .= get_the_post_thumbnail( $post->ID, 'shop_single', $attributes );
				$html .= '</a></div>';

			} else {
				$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
					$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'gecko' ) );
				$html .= '</div>';
			}

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );


			if ( version_compare( WC_VERSION, '3.0.0', '<' ) ) {
				$attachment_ids = $product->get_gallery_attachment_ids();
			} else {
				$attachment_ids = $product->get_gallery_image_ids();
			}

			if ( $attachment_ids ) {
				foreach ( $attachment_ids as $attachment_id ) {
					$full_size_image  = wp_get_attachment_image_src( $attachment_id, 'full' );
					$thumbnail        = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
					$thumbnail_post   = get_post( $attachment_id );
					$image_title      = $thumbnail_post->post_content;

					$attributes = array(
						'title'                   => $image_title,
						'data-src'                => $full_size_image[0],
						'data-large_image'        => $full_size_image[0],
						'data-large_image_width'  => $full_size_image[1],
						'data-large_image_height' => $full_size_image[2],
					);
					
					if ( cs_get_option( 'wc-single-elevate' ) ) {
						$attributes['class'] = 'jas-image-zoom';
						$attributes['data-zoom-image'] = $full_size_image[0];
					}

					$html = '<div class="p-item woocommerce-product-gallery__image">';
						$html .= '<a href="' . esc_url( $full_size_image[0] ) . '" class="woocommerce-product-gallery__trigger">';
							$html .= wp_get_attachment_image( $attachment_id, 'shop_single', false, $attributes );
						$html .= '</a>';
					$html .= '</div>';

					echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
				}
			}
		?>
	</div>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>

	<?php if ( isset( $options ) && ! empty( $options['wc-single-video-upload'] ) || ! empty( $options['wc-single-video-url'] ) ) : ?>
		<div class="p-video pa">
			<?php
				if ( $options['wc-single-video'] == 'url' ) {
					echo '<a href="' . esc_url( $options['wc-single-video-url'] ) . '" class="br__50 tc db bghp jas-popup-url"><i class="pe-7s-play pr"></i></a>';
				} else {
					echo '<a href="#jas-vsh" class="br__50 tc db bghp jas-popup-mp4"><i class="pe-7s-play pr"></i></a>';
					echo '<div id="jas-vsh" class="mfp-hide">' . do_shortcode( '[video src="' . esc_url( $options['wc-single-video-upload'] ) . '" width="640" height="320"]' ) . '</div>';
				}
			?>
		</div>
	<?php endif; ?>
</div>