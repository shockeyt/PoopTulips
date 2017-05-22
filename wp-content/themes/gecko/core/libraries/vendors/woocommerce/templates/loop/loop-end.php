<?php
/**
 * Product Loop End
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-end.php.
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

// Get wc layout
$class = '';

$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
if ( $term ) {
	$term_options = get_term_meta( $term->term_id, '_custom_product_cat_options', true );
}
if ( is_product_category() && isset( $term_options ) && $term_options && $term_options['product-cat-layout'] ) {
	$layout = $term_options['product-cat-layout'];
	$sidebar = $term_options['product-cat-sidebar'];
} else {
	$layout = cs_get_option( 'wc-layout' );
	$sidebar = cs_get_option( 'wc-sidebar' );
}

if ( $layout == 'right-sidebar' ) {
	$class = 'jas-col-md-3 jas-col-sm-3 jas-col-xs-12 mt__30';
} elseif ( $layout == 'left-sidebar' ) {
	$class = 'jas-col-md-3 jas-col-sm-3 jas-col-xs-12 mt__30 first-md first-sm';
}
	if ( $layout != 'no-sidebar' && ! $jassc ) {
		echo '</div><!-- .products -->';

		// Render pagination
		do_action( 'jas_pagination' );
		
		echo '</div><!-- .jas-columns-* -->';

		echo '<div class="' . esc_attr( $class ) . '">';
			if ( is_active_sidebar( $sidebar ) ) {
				dynamic_sidebar( $sidebar );
			}
		echo '</div>';
	}
?>
</div><!-- .jas-row -->
<?php
	if ( $layout == 'no-sidebar' && ! $jassc ) {
		do_action( 'jas_pagination' );
	}
	if ( ! $jassc ) {
		echo '</div><!-- .jas-container -->';
	}
?>