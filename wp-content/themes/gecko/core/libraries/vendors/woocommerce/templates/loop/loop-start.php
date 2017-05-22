<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

global $jassc;

// Get product list style
$class = $data = $sizer = $slider = '';
$attr = array();
$style = $jassc ? $jassc['style'] : apply_filters( 'jas_gecko_wc_style', cs_get_option( 'wc-style' ) );

$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
if ( $term ) {
	$term_options = get_term_meta( $term->term_id, '_custom_product_cat_options', true );
}

if ( is_product_category() && isset( $term_options ) && $term_options && $term_options['product-cat-layout'] ) {
	$layout = $term_options['product-cat-layout'];
} else {
	$layout = cs_get_option( 'wc-layout' );
}

// Get pagination style
$pagination = $jassc ? '' : cs_get_option( 'wc-pagination' );

// Get product filter
$filter  = $jassc ? $jassc['filter'] : cs_get_option( 'wc-filter' );
$exclude = $jassc ? $jassc['exclude_child'] : cs_get_option( 'wc-filter-non-child' );

if ( $style == 'masonry' ) {
	$class = ' jas-masonry';
	$data  = 'data-masonry=\'{"selector":".product","layoutMode":"masonry"}\'';
} else {
	// Slider setting for shortcode products
	if ( $jassc['slider'] && $jassc['issc'] ) {
		if ( ! empty( $jassc['items'] ) ) {
			$attr_slider[] = '"slidesToShow": "' . ( int ) $jassc['items'] . '"';
		}
		if ( ! empty( $jassc['autoplay'] ) ) {
			$attr_slider[] = '"autoplay": true';
		}
		if ( ! empty( $jassc['arrows'] ) ) {
			$attr_slider[] = '"arrows": true';
		}
		if ( ! empty( $jassc['dots'] ) ) {
			$attr_slider[] = '"dots": true';
		}

		if ( ! empty( $attr_slider ) ) {
			$attr[] = 'data-slick=\'{' . esc_attr( implode( ', ', $attr_slider ) ) . ',"responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 3}},{"breakpoint": 480,"settings":{"slidesToShow": 1}}]' . '}\'';
		}
		$slider = 'jas-carousel';
	}
}

// Layout fitRows for pagination is loadmore
if ( $style == 'grid' && $pagination == 'loadmore' ) {
	$class = ' jas-masonry';
	$data  = 'data-masonry=\'{"selector":".product","layoutMode":"fitRows"}\'';
}
?>
<?php if ( ! $jassc ) echo '<div class="jas-container">'; ?>
	<?php
		if ( $layout != 'no-sidebar' && ! $jassc ) {
			echo '<div class="jas-row"><div class="jas-col-md-9 jas-col-sm-9 jas-col-xs-12">';
		}
		if ( $style == 'masonry' && $filter && $jassc['display'] != 'cat' ) {
			// Retrieve all the categories
			$categories = get_terms( 'product_cat' );

			echo '<div class="product-filter jas-filter fwb tc tu mt__30">';
				echo '<a data-filter="*" class="selected dib cg chp" href="javascript:void(0);">' . esc_html__( 'All', 'gecko' ) . '</a>';
				foreach ( $categories as $cat ) :
					if ( isset( $exclude ) && $exclude ) {
						if ( ! $cat->parent ) {
							echo '<a data-filter=".product_cat-' . esc_attr( $cat->slug ) . '" class="dib cg chp" href="javascript:void(0);">' . esc_html( $cat->name ) . '</a>';
						}
					} else {
						echo '<a data-filter=".product_cat-' . esc_attr( $cat->slug ) . '" class="dib cg chp" href="javascript:void(0);">' . esc_html( $cat->name ) . '</a>';
					}
				endforeach;
			echo '</div>';
		}
	?>
	<div class="products jas-row <?php echo esc_attr( $class ); ?> <?php echo esc_attr( $slider ); ?>" <?php echo wp_kses_post( $data ); ?> <?php echo implode( ' ', $attr ); ?>>
