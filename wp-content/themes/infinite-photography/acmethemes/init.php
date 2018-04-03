<?php
/**
 * Main include functions ( to support child theme )
 *
 * @since Infinite Photography 1.0.0
 *
 * @param string $file_path, path from the theme
 * @return string full path of file inside theme
 *
 */
if( !function_exists('infinite_photography_file_directory') ){

    function infinite_photography_file_directory( $file_path ){
        if( file_exists( trailingslashit( get_stylesheet_directory() ) . $file_path) ){
            return trailingslashit( get_stylesheet_directory() ) . $file_path;
        }
        else{
            return trailingslashit( get_template_directory() ) . $file_path;
        }
    }
}

/**
 * Check empty or null
 *
 * @since Infinite Photography  1.0.0
 *
 * @param string $str, string
 * @return boolean
 *
 */
if( !function_exists('infinite_photography_is_null_or_empty') ){
	function infinite_photography_is_null_or_empty( $str ){
		return ( !isset($str) || trim($str)==='' );
	}
}

/*file for library*/
require_once infinite_photography_file_directory('acmethemes/library/tgm/class-tgm-plugin-activation.php');

/*
* file for customizer theme options
*/
require_once infinite_photography_file_directory('acmethemes/customizer/customizer.php');

/*
* file for additional functions files
*/
require_once infinite_photography_file_directory('acmethemes/functions.php');

/*
* files for hooks
*/
require_once infinite_photography_file_directory('acmethemes/hooks/tgm.php');

require_once infinite_photography_file_directory('acmethemes/hooks/slider-selection.php');

require_once infinite_photography_file_directory('acmethemes/hooks/header.php');

require_once infinite_photography_file_directory('acmethemes/hooks/dynamic-css.php');

require_once infinite_photography_file_directory('acmethemes/hooks/footer.php');

require_once infinite_photography_file_directory('acmethemes/hooks/social-links.php');

require_once infinite_photography_file_directory('acmethemes/hooks/comment-forms.php');

require_once infinite_photography_file_directory('acmethemes/hooks/excerpts.php');

require_once infinite_photography_file_directory('acmethemes/hooks/photography.php');

require_once infinite_photography_file_directory('acmethemes/hooks/related-posts.php');

require_once infinite_photography_file_directory('acmethemes/hooks/acme-demo-setup.php');

/*
* file for sidebar and widgets
*/
require_once infinite_photography_file_directory('acmethemes/sidebar-widget/author-widget.php');

require_once infinite_photography_file_directory('acmethemes/sidebar-widget/sidebar.php');

/*
* file for core functions imported from functions.php while downloading Underscores
*/
require_once infinite_photography_file_directory('acmethemes/core.php');

/**
 * Implement Custom Metaboxes
 */
require_once infinite_photography_file_directory('acmethemes/metabox/metabox.php');

/*themes info*/
require_once infinite_photography_file_directory('acmethemes/at-theme-info/class-at-theme-info.php');