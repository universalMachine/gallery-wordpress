<?php
/*adding header options panel*/
$wp_customize->add_panel( 'infinite-photography-header-panel', array(
    'priority'       => 30,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Header Options', 'infinite-photography' ),
    'description'    => __( 'Customize your awesome site header ', 'infinite-photography' )
) );

/*
* file for header logo options
*/
require_once infinite_photography_file_directory('acmethemes/customizer/header-options/header-logo.php');

require_once infinite_photography_file_directory('acmethemes/customizer/header-options/search-option.php');