<?php
/**
 * Enfold Child theme functions
 *
 * @package    WordPress/Enfold
 * @subpackage Enfold_Child
 *
 * @author     Greg Sweet <greg@ccdzine.com>
 * @link       https://github.com/ControlledChaos/enfold-child
 * @license    http://www.gnu.org/licenses/gpl-3.0.html
 * @since      1.0.0
 */

/**
 * Renaming the theme
 *
 * Following is a list of strings to find and replace in all theme files.
 *
 * 1. Theme subpackage name
 *    Find `Enfold_Child` and replace with your theme name, include
 *    underscores between words.
 *
 * 2. Text domain
 *    Find `enfold-child` and replace with the new text domain name of your theme.
 *
 * 4. General prefix
 *    Find `enfoldchlid` and replace with something unique to your theme name. Use
 *    only lowercase letters. This will change the prefix of all filters and
 *    settings, and the prefix of functions outside of a class.
 *
 * 5. Author
 *    Find `Greg Sweet <greg@ccdzine.com>` and replace with your name and
 *    email address or those of your organization.
 *
 * 6. Theme URL
 *    Find `https://github.com/ControlledChaos/enfold-child` and replace with the URL
 *    associated with your theme.
 *
 * 7. Remove this comment/these instructions to clean thing up.
 */

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get plugins path to check for active plugins.
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Enfold Child functions class
 *
 * @since  1.0.0
 * @access public
 */
final class Functions {

	/**
	 * Class instantiation
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object Returns the instance of the class.
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {

			$instance = new self;

			// Theme dependencies.
			$instance->dependencies();

		}

		return $instance;
	}

	/**
	 * Constructor magic method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Remove needless meta tags.
		add_action( 'init', [ $this, 'enfoldchlid_head_cleanup' ] );

		// Theme setup.
		add_action( 'after_setup_theme', [ $this, 'enfoldchlid_setup' ] );

	}

	/**
	 * Theme setup.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enfoldchlid_setup() {

		// Load domain for translation.
		load_theme_textdomain( 'enfold-child' );

		// Browser title tag support.
		add_theme_support( 'title-tag' );

		// RSS feed links support.
		add_theme_support( 'automatic-feed-links' );

		// HTML 5 tags support.
		add_theme_support( 'html5', [
			'search-form',
			'comment-form',
			'comment-list',
			'gscreenery',
			'caption'
		 ] );

	}

	/**
	 * Clean up meta tags from the <head>
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enfoldchlid_head_cleanup() {

		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'wp_site_icon', 99 );
	}

	/**
	 * Frontend scripts
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enfoldchlid_frontend_scripts() {}

	/**
	 * Frontend styles
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enfoldchlid_frontend_styles() {

		/**
		 * Theme sylesheet
		 *
		 * This enqueues the minified stylesheet compiled from SASS (.scss) files.
		 * The main stylesheet, in the root directory, only contains the theme header but
		 * it is necessary for theme activation. DO NOT delete the main stylesheet!
		 */
		wp_enqueue_style( 'enfoldchlid-min', get_theme_file_uri( '/assets/css/style.min.css' ), [], '', 'screen' );

		// Print styles.
		wp_enqueue_style( 'enfoldchlid-print', get_theme_file_uri( '/assets/css/print.min.css' ), [], '', 'print' );

	}

	/**
	 * Theme dependencies
	 *
	 * Get files with template tags and other theme functionality.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function dependencies() {

		// Advanced Custom Fields functionality.
		require_once get_theme_file_path( '/includes/class-acf.php' );
	}

}

/**
 * Check for Advanced Custom Fields
 *
 * @since  1.0.0
 * @access public
 * @return bool Returns true if the ACF free or Pro plugin is active.
 */
function enfoldchild_acf() {

	if ( class_exists( 'acf' ) ) {
		return true;
	} else {
		return false;
	}

}

/**
 * Check for Advanced Custom Fields Pro
 *
 * @since  1.0.0
 * @access public
 * @return bool Returns true if the ACF Pro plugin is active.
 */
function enfoldchild_acf_pro() {

	if ( class_exists( 'acf_pro' ) ) {
		return true;
	} else {
		return false;
	}

}

/**
 * Get the instance of the Functions class
 *
 * This function is useful for quickly grabbing data
 * used throughout the theme.
 *
 * @since  1.0.0
 * @access public
 * @return object
 */
function enfold_child() {

	$enfold_child = Functions::get_instance();

	return $enfold_child;

}

// Run the Functions class.
enfold_child();