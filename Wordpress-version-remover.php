<?php
/*
Plugin Name:  Wordpress version remover
Description:  Removes Wordpress version number from view of page source for website security reasons
Plugin URI:   drakauskas.lt
Author:       drakauskas
Version:      1.0
Text Domain:  wp_version_remover
License:      GPL v2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.txt
*/


// Disable direct file access
if ( ! defined( 'ABSPATH' ) ) {

    exit;

}

// Remove version from head
remove_action('wp_head', 'wp_generator');

// Remove version from RSS
add_filter('the_generator', '__return_empty_string');

// Remove version from scripts and styles
function shapeSpace_remove_version_scripts_styles($src) {
  if (strpos($src, 'ver=')) {
    $src = remove_query_arg('ver', $src);
  }
  return $src;
}
add_filter('style_loader_src', 'shapeSpace_remove_version_scripts_styles', 9999);
add_filter('script_loader_src', 'shapeSpace_remove_version_scripts_styles', 9999);
