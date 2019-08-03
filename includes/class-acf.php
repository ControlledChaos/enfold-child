<?php
/**
 * Advanced Custom Fields functionality
 *
 * @package    WordPress/Enfold
 * @subpackage Enfold_Child
 *
 * @author     Greg Sweet <greg@ccdzine.com>
 * @link       https://github.com/ControlledChaos/enfold-child
 * @license    http://www.gnu.org/licenses/gpl-3.0.html
 * @since      1.0.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Bail if Advanced Custom Fields is not active.
if ( ! enfoldchild_acf() ) {
	return;
}