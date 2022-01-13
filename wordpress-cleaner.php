<?php
/*
Plugin Name: Wordpress Cleaner
Description: Supprime les articles ainsi que les commentaires de base du wordpress + widgets inutiles du dashboard
Author: Léo DEMET
Version: 1.0
Author URI: https://www.demet.fr/
*/


use Khaldalim\WordpressCleaner\WordpressCleaner;

if (!defined('ABSPATH'))
    exit;

define('WORDPRESS_CLEANER_DIR', plugin_dir_path(__FILE__));

require WORDPRESS_CLEANER_DIR . 'vendor/autoload.php';

$plugin = new WordpressCleaner(__FILE__);
$options = get_option('wordpress_cleaner_general');


if ($options['remove_comments'] == 1) {
    require_once plugin_dir_path(__FILE__) . 'includes/comments.php';
}

if ($options['remove_posts'] == 1) {
    require_once plugin_dir_path(__FILE__) . 'includes/posts.php';
}


if ($options['remove_widgets'] == 1) {
    require_once plugin_dir_path(__FILE__) . 'includes/dashboards_widgets.php';
}



add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'add_action_links' );

function add_action_links ( $actions ) {
    $mylinks = array(
        '<a href="' . admin_url( 'options-general.php?page=wordpress_cleaner' ) . '">Réglages</a>',
    );
    $actions = array_merge( $actions, $mylinks );
    return $actions;
}
