<?php
/**
 * Plugin Name: JanStudio Addons
 * Plugin URI:  http://www.janstudio.net
 * Description: Extra addons for Gecko theme.
 * Version:     1.1.0
 * Author:      JanStudio
 * Author URI:  http://www.janstudio.net
 * License:     GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: jsa
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

// Define url to this plugin file.
if ( ! defined( 'JAS_ADDONS_URL' ) )
	define( 'JAS_ADDONS_URL', plugin_dir_url( __FILE__ ) );

// Define path to this plugin file.
if ( ! defined( 'JAS_ADDONS_PATH' ) )
	define( 'JAS_ADDONS_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Class JASAddons
 *
 * @package  JASAddons
 * @since    1.1.0
 */
class JAS_Addons {
	/**
	 * Construct function.
	 *
	 * @return  void
	 */
	function __construct() {
		add_action( 'init',               array( $this, 'init' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ), 100 );
	}

	/**
	 * Get list addon name.
	 *
	 * @return  array
	 */
	public static function addons( $addons = NULL ) {
		if ( ! class_exists( 'woocommerce_wpml' ) && ! class_exists( 'WC_Product_Price_Based_Country' ) ) {
			$addons = 'currency';
		} else {
			$addons = '';
		}
		return apply_filters( 'jas_addons_filter', $addons );
	}

	/**
	 * Get list shortcode name.
	 *
	 * @return  array
	 */
	public static function shortcodes( $shortcodes = NULL ) {
		$shortcodes = 'service, portfolio, member, blog, products, product, google_maps, wc_categories, instagram, vertical_slide, vertical_slide_left, vertical_slide_right, vertical_slide_section, promotion';
		return $shortcodes;
	}

	/**
	 * Include addon file.
	 *
	 * @since 1.0
	 */
	public static function init() {
		$addons     = array_map( 'trim', explode( ",", self::addons() ) );
		$shortcodes = array_map( 'trim', explode( ",", self::shortcodes() ) );

		// Include addon
		if ( ! class_exists( 'woocommerce_wpml' ) && ! class_exists( 'WC_Product_Price_Based_Country' ) ) {
			foreach ( $addons as $addon ) {
				include_once JAS_ADDONS_PATH . 'includes/' . $addon . '/init.php';
			}
		}

		// Include shortcode
		foreach ( $shortcodes as $shortcode ) {
			include_once JAS_ADDONS_PATH . 'includes/shortcodes/' . $shortcode . '.php';
			add_shortcode( 'jas_' . $shortcode, 'jas_shortcode_' . $shortcode );
		}
	}

	/**
	 * Enqueue stylesheet and scripts to frontend.
	 */
	public static function frontend_scripts() {
		if ( class_exists( 'JAS_Addons_Currency' ) ) {
			wp_enqueue_script( 'jas-vendor-jquery-cookies', JAS_ADDONS_URL . 'assets/js/3rd.js', array(), false, true );
		}

		if ( is_singular() ) {
			global $post;

			if ( has_shortcode( $post->post_content, 'jas_google_maps' ) ) {
				wp_enqueue_script( 'google-map-api', 'https://maps.google.com/maps/api/js?key=AIzaSyBiyBHqKfGcCN1Pw0rzysj-vMSnJ0_GNgU' );
			}

			if ( has_shortcode( $post->post_content, 'jas_vertical_slide' ) ) {
				wp_enqueue_style( 'multiscroll', JAS_ADDONS_URL . '/assets/vendors/multiscroll/jquery.multiscroll.css' );
				wp_enqueue_script( 'easings', JAS_ADDONS_URL . 'assets/vendors/multiscroll/jquery.easings.min.js', array(), false, true );
				wp_enqueue_script( 'multiscroll', JAS_ADDONS_URL . 'assets/vendors/multiscroll/jquery.multiscroll.min.js', array(), false, true );
			}
		}
	}
}

$jasaddons = new JAS_Addons;

// Include custom post type
include JAS_ADDONS_PATH . 'includes/portfolio/init.php';