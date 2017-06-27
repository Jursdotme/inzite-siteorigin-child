<?php

/**
* https://developer.wordpress.org/plugins/administration-menus/sub-menus/
*/

/**
* The first step will be creating a function which will output the HTML.
* In this function we will perform the necessary security checks and render
* the options we’ve registered using the Settings API.
*/

function inz_options_page_html()
{
    // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?= esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            // output security fields for the registered setting "inz_options"
            settings_fields('inz_options');
            // output setting sections and their fields
            // (sections are registered for "inz", each field is registered to a specific section)
            do_settings_sections('inz');
            // output save settings button
            submit_button('Save Settings');
            ?>
        </form>
    </div>
    <?php
}


/**
* The second step will be registering our WPOrg Options Sub-menu.
* The registration needs to occur during the admin_menu action hook.
*/
function inz_options_page()
{
    add_submenu_page(
        'tools.php',
        'Inzite Options',
        'Inzite Options',
        'manage_options',
        'inz',
        'inz_options_page_html'
    );
}
add_action('admin_menu', 'inz_options_page');
