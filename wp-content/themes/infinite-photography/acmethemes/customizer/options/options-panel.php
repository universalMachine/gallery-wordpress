<?php
/*adding theme options panel*/
$wp_customize->add_panel( 'infinite-photography-options', array(
    'priority'       => 210,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Theme Options', 'infinite-photography' ),
    'description'    => __( 'Customize your awesome site with theme options ', 'infinite-photography' )
) );

/*
* file for header breadcrumb options
*/
require_once infinite_photography_file_directory('acmethemes/customizer/options/breadcrumb.php');

/*
* file for header search options
*/
require_once infinite_photography_file_directory('acmethemes/customizer/options/search.php');