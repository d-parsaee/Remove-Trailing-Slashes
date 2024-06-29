<?php
/**
 * Remove Trailing Slashes
 * Plugin Name: Remove Trailing Slashes
 * Description: Removes trailing slashes from HTML void elements.
 * Version:     1.0
 * Author:      pangash
 * Author URI:  https://www.pangash.com
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Requires at least: 6.5.5
 * Requires PHP: 7.4
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation. You may NOT assume
 * that you can use any other version of the GPL.
 */
function remove_trailing_slashes_from_void_elements($buffer) { 
    $pattern = '/<((?:img|br|hr|input|meta|link|base|area|col|embed|keygen|source|track|wbr)[^>]*?)\s*\/>/';
    $replacement = '<$1>'; 
    return preg_replace($pattern, $replacement, $buffer);
}
function start_output_buffering() {
    ob_start('remove_trailing_slashes_from_void_elements');
}
function end_output_buffering() {
    if (ob_get_level()) {
        ob_end_flush();
    }
}
add_action('template_redirect', 'start_output_buffering');
add_action('shutdown', 'end_output_buffering');