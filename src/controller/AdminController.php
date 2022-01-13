<?php

namespace Khaldalim\WordpressCleaner\Controller;

use Khaldalim\WordpressCleaner\WordpressCleaner;

class AdminController
{


    public function __construct()
    {
        $this->init_hooks();
    }

    public function init_hooks()
    {
        add_action('admin_menu', [$this, 'admin_menu']);
        add_action('admin_init', [$this, 'admin_init']);

    }

    //affiche un sous menu dans les reglages
    public function admin_menu()
    {
        add_options_page('Wordpress Cleaner', "Wordpress Cleaner", "manage_options", "wordpress_cleaner", [$this, "config_page"]);
    }




    public function config_page()
    {
        WordpressCleaner::render("config");
    }

    public function admin_init()
    {
        register_setting("wordpress_cleaner_general", "wordpress_cleaner_general");
        add_settings_section("wordpress_cleaner_main", null, null, "wordpress_cleaner");
        add_settings_field("remove_comments", "Supprimer les commentaires", [$this, "remove_comments"], 'wordpress_cleaner', "wordpress_cleaner_main");
        add_settings_field("remove_posts", "Supprimer les articles de base du wordpress", [$this, "remove_posts"], 'wordpress_cleaner', "wordpress_cleaner_main");
        add_settings_field("remove_widgets", "Supprimer les widgets inutiles", [$this, "remove_widgets"], 'wordpress_cleaner', "wordpress_cleaner_main");
    }

    public function remove_comments()
    {
        $general_options = get_option('wordpress_cleaner_general');
        $selectedValue = $general_options['remove_comments'];

        echo '<input type="checkbox" name="wordpress_cleaner_general[remove_comments]"  value="1" ' . checked('1', $selectedValue, false) . '>';

    }


    public function remove_posts()
    {
        $general_options = get_option('wordpress_cleaner_general');
        $selectedValue = $general_options['remove_posts'];
        echo '<input type="checkbox" name="wordpress_cleaner_general[remove_posts]"  value="1" ' . checked('1', $selectedValue, false) . '>';
    }


    public function remove_widgets()
    {
        $general_options = get_option('wordpress_cleaner_general');
        $selectedValue = $general_options['remove_widgets'];
        echo '<input type="checkbox" name="wordpress_cleaner_general[remove_widgets]"  value="1" ' . checked('1', $selectedValue, false) . '>';
    }





}
