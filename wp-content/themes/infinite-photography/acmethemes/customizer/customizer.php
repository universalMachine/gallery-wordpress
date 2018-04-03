<?php
/**
 * Infinite Photography Theme Customizer.
 *
 * @package Acme Themes
 * @subpackage Infinite Photography
 */

/*
* file for upgrade to pro
*/
require_once infinite_photography_file_directory('acmethemes/customizer/customizer-pro/class-customize.php');

/*
* file for customizer core functions
*/
require_once infinite_photography_file_directory('acmethemes/customizer/customizer-core.php');

/*
* file for customizer sanitization functions
*/
require_once infinite_photography_file_directory('acmethemes/customizer/sanitize-functions.php');

/**
 * Adding different options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function infinite_photography_customize_register( $wp_customize ) {

    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

    /*saved options*/
    $options  = infinite_photography_get_theme_options();

    /*defaults options*/
    $defaults = infinite_photography_get_default_theme_options();

    /*
    * file for customizer custom controls classes
    */
	require_once infinite_photography_file_directory('acmethemes/customizer/custom-controls.php');

    /*
     * file for feature panel of home page
     */
	require_once infinite_photography_file_directory('acmethemes/customizer/feature-section/feature-panel.php');

    /*
    * file for header panel
    */
	require_once infinite_photography_file_directory('acmethemes/customizer/header-options/header-panel.php');

    /*
    * file for customizer footer panel
    */
	require_once infinite_photography_file_directory('acmethemes/customizer/footer-section/footer-panel.php');

    /*
    * file for design/layout panel
    */
	require_once infinite_photography_file_directory('acmethemes/customizer/design-options/design-panel.php');

	/*
   * file for single post sections
   */
	require_once infinite_photography_file_directory('acmethemes/customizer/single-posts/single-post-section.php');

    /*
     * file for options panel
     */
	require_once infinite_photography_file_directory('acmethemes/customizer/options/options-panel.php');

    /*
  * file for options reset
  */
	require_once infinite_photography_file_directory('acmethemes/customizer/options/options-reset.php');

    /*removing*/
    $wp_customize->remove_panel('header_image');
    $wp_customize->remove_control('header_textcolor');
}
add_action( 'customize_register', 'infinite_photography_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function infinite_photography_customize_preview_js() {
    wp_enqueue_script( 'infinite-photography-customizer', get_template_directory_uri() . '/acmethemes/core/js/customizer.js', array( 'customize-preview' ), '1.1.0', true );
}
add_action( 'customize_preview_init', 'infinite_photography_customize_preview_js' );