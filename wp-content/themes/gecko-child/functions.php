<?php
/**
 * Gecko child theme functions.
 *
 * @since   1.0.0
 * @package Gecko
 */

/**
 * Enqueue style of child theme
 */
function jas_gecko_enqueue_script() {
	wp_enqueue_style( 'jas-gecko-parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'jas_gecko_enqueue_script' );