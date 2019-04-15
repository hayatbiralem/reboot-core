<?php

global $reboot_tgmpa_plugins;

//if (!function_exists('is_plugin_active')) {
//    include_once(ABSPATH . 'wp-admin/includes/plugin.php');
//}

/*
 * Array of plugin arrays. Required keys are name and slug.
 * If the source is NOT from the .org repo, then source is also required.
 */

$reboot_tgmpa_plugins = array(

//    [
//        'plugin_file'        => 'clean-image-filenames/clean-image-filenames.php',
//        'is_plugin_active'   => is_plugin_active('clean-image-filenames/clean-image-filenames.php'),
//    ],

    [
        'name' => '404page – your smart custom 404 error page',
        'slug' => '404page',
        'is_callable' => '',
        'required' => false,
        'force_activation' => false,
    ],

    [
        'name' => 'Classic Editor',
        'slug' => 'classic-editor',
        'is_callable' => '',
        'required' => false,
        'force_activation' => false,
    ],

    [
        'name' => 'Clean Image Filenames',
        'slug' => 'clean-image-filenames',
        'is_callable' => '',
        'required' => false,
        'force_activation' => false,
    ],

    [
        'name' => 'Contact Form 7',
        'slug' => 'contact-form-7',
        'is_callable' => '',
        'required' => false,
        'force_activation' => false,
    ],

    [
        'name' => 'Contact Form 7 Database Addon – CFDB7',
        'slug' => 'contact-form-cfdb7',
        'is_callable' => '',
        'required' => false,
        'force_activation' => false,
    ],

    [
        'name' => 'Disable All WordPress Updates',
        'slug' => 'disable-wordpress-updates',
        'is_callable' => '',
        'required' => false,
        'force_activation' => false,
    ],

    [
        'name' => 'Disable Comments',
        'slug' => 'disable-comments',
        'is_callable' => '',
        'required' => false,
        'force_activation' => false,
    ],

    [
        'name' => 'Duplicate Menu',
        'slug' => 'duplicate-menu',
        'is_callable' => '',
        'required' => false,
        'force_activation' => false,
    ],

    [
        'name' => 'Duplicate Post',
        'slug' => 'duplicate-post',
        'is_callable' => '',
        'required' => false,
        'force_activation' => false,
    ],

    [
        'name' => 'Easy Updates Manager',
        'slug' => 'stops-core-theme-and-plugin-updates',
        'is_callable' => '',
        'required' => false,
        'force_activation' => false,
    ],

    [
        'name' => 'Rearrange Woocommerce Products',
        'slug' => 'rearrange-woocommerce-products',
        'is_callable' => '',
        'required' => false,
        'force_activation' => false,
    ],

    [
        'name' => 'Resize Image After Upload',
        'slug' => 'resize-image-after-upload',
        'is_callable' => '',
        'required' => false,
        'force_activation' => false,
    ],

    [
        'name' => 'WP Fastest Cache',
        'slug' => 'wp-fastest-cache',
        'is_callable' => '',
        'required' => false,
        'force_activation' => false,
    ],

    [
        'name' => 'WP Mail SMTP by WPForms',
        'slug' => 'wp-mail-smtp',
        'is_callable' => '',
        'required' => false,
        'force_activation' => false,
    ],

    [
        'name' => 'WP Migrate DB',
        'slug' => 'wp-migrate-db',
        'is_callable' => '',
        'required' => false,
        'force_activation' => false,
    ],

    [
        'name' => 'Yoast SEO',
        'slug' => 'wordpress-seo',
        'is_callable' => '',
        'required' => false,
        'force_activation' => false,
    ],
    
);

if (!function_exists('reboot_tgmpa_plugins_filter')) {
    function reboot_tgmpa_plugins_filter($tgmpa_plugins)
    {
        $file = REBOOT_DIRECTORY_NAME . '/tgmpa/config.php';

        $paths = [];

        if (REBOOT_IS_CHILD) {
            $paths[] = REBOOT_CHILD_PATH . $file;
        }

        $paths[] = REBOOT_TEMPLATE_PATH . $file;

        foreach ($paths as $path) {
            if (!is_file($path)) {
                continue;
            }

            $addition_plugins = include $path;

            if (is_array($addition_plugins)) {
                $tgmpa_plugins = array_merge($tgmpa_plugins, $addition_plugins);
            }
        }

        return $tgmpa_plugins;
    }

    add_filter('reboot_tgmpa_plugins', 'reboot_tgmpa_plugins_filter', 10, 1);
}

$reboot_tgmpa_plugins = apply_filters('reboot_tgmpa_plugins', $reboot_tgmpa_plugins);

if (!function_exists('reboot_plugin_action_links')) {
    function reboot_plugin_action_links($links, $file)
    {
        global $reboot_tgmpa_plugins;

        if (empty($reboot_tgmpa_plugins)) {
            return $links;
        }

        foreach ($reboot_tgmpa_plugins as $reboot_tgmpa_plugin) {
            if (
                strpos($file, $reboot_tgmpa_plugin['plugin_file']) !== false
                && isset($reboot_tgmpa_plugin['force_activation'])
                && $reboot_tgmpa_plugin['force_activation']
                && isset($reboot_tgmpa_plugin['is_plugin_active'])
                && $reboot_tgmpa_plugin['is_plugin_active']
            ) {
                $new_links = array(
                    'reboot_forced_plugin_notice' => '<span>Required plugins cannot be disabled until theme switch</span>',
                );

                $links = array_merge($links, $new_links);
            }
        }

        return $links;
    }

    add_filter('plugin_action_links', 'reboot_plugin_action_links', 10, 2);
}

if (!function_exists('reboot_required_tgmpa_plugins_installed')) {
    function reboot_required_tgmpa_plugins_installed()
    {
        global $reboot_tgmpa_plugins;
        $status = true;
        foreach ($reboot_tgmpa_plugins as $reboot_tgmpa_plugin) {
            if (isset($reboot_tgmpa_plugin['required']) && $reboot_tgmpa_plugin['required'] && isset($reboot_tgmpa_plugin['is_plugin_active']) && !$reboot_tgmpa_plugin['is_plugin_active']) {
                $status = false;
                break;
            }
        }
        return $status;
    }
}

if (!is_admin() && $GLOBALS['pagenow'] != 'wp-login.php') {
    if (!reboot_required_tgmpa_plugins_installed()) {
        die(__('You have to install all required plugins!', REBOOT_TEXT_DOMAIN));
    }
}

/**
 * Include the TGM_Plugin_Activation class.
 */

require_once REBOOT_TGMPA_PATH . 'class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'reboot_register_required_plugins');

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function reboot_register_required_plugins()
{
    global $reboot_tgmpa_plugins;

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id' => REBOOT_TEXT_DOMAIN,                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu' => sprintf('%s-install-plugins', REBOOT_AGENCY_SLUG), // Menu slug.
        'parent_slug' => REBOOT_AGENCY_SLUG,            // Parent menu slug.
        'capability' => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices' => false,                    // Show admin notices or not.
        'dismissable' => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => sprintf('<span style="color: red;">%s</span>', __('If you want to hide this message constantly you have to install all <u>required</u> plugins!')),                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message' => '',                      // Message to output right before the plugins table.

        'strings' => [
            'page_title' => sprintf(__('Install Recomenned %s Plugins', REBOOT_TEXT_DOMAIN), REBOOT_AGENCY),
            'menu_title' => __('Install Plugins', REBOOT_TEXT_DOMAIN),
        ]

        /*
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', REBOOT_TEXT_DOMAIN ),
            'menu_title'                      => __( 'Install Plugins', REBOOT_TEXT_DOMAIN ),
            /* translators: %s: plugin name. * /
            'installing'                      => __( 'Installing Plugin: %s', REBOOT_TEXT_DOMAIN ),
            /* translators: %s: plugin name. * /
            'updating'                        => __( 'Updating Plugin: %s', REBOOT_TEXT_DOMAIN ),
            'oops'                            => __( 'Something went wrong with the plugin API.', REBOOT_TEXT_DOMAIN ),
            'notice_can_install_required'     => _n_noop(
                /* translators: 1: plugin name(s). * /
                'This theme requires the following plugin: %1$s.',
                'This theme requires the following plugins: %1$s.',
                REBOOT_TEXT_DOMAIN
            ),
            'notice_can_install_recommended'  => _n_noop(
                /* translators: 1: plugin name(s). * /
                'This theme recommends the following plugin: %1$s.',
                'This theme recommends the following plugins: %1$s.',
                REBOOT_TEXT_DOMAIN
            ),
            'notice_ask_to_update'            => _n_noop(
                /* translators: 1: plugin name(s). * /
                'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                REBOOT_TEXT_DOMAIN
            ),
            'notice_ask_to_update_maybe'      => _n_noop(
                /* translators: 1: plugin name(s). * /
                'There is an update available for: %1$s.',
                'There are updates available for the following plugins: %1$s.',
                REBOOT_TEXT_DOMAIN
            ),
            'notice_can_activate_required'    => _n_noop(
                /* translators: 1: plugin name(s). * /
                'The following required plugin is currently inactive: %1$s.',
                'The following required plugins are currently inactive: %1$s.',
                REBOOT_TEXT_DOMAIN
            ),
            'notice_can_activate_recommended' => _n_noop(
                /* translators: 1: plugin name(s). * /
                'The following recommended plugin is currently inactive: %1$s.',
                'The following recommended plugins are currently inactive: %1$s.',
                REBOOT_TEXT_DOMAIN
            ),
            'install_link'                    => _n_noop(
                'Begin installing plugin',
                'Begin installing plugins',
                REBOOT_TEXT_DOMAIN
            ),
            'update_link' 					  => _n_noop(
                'Begin updating plugin',
                'Begin updating plugins',
                REBOOT_TEXT_DOMAIN
            ),
            'activate_link'                   => _n_noop(
                'Begin activating plugin',
                'Begin activating plugins',
                REBOOT_TEXT_DOMAIN
            ),
            'return'                          => __( 'Return to Required Plugins Installer', REBOOT_TEXT_DOMAIN ),
            'plugin_activated'                => __( 'Plugin activated successfully.', REBOOT_TEXT_DOMAIN ),
            'activated_successfully'          => __( 'The following plugin was activated successfully:', REBOOT_TEXT_DOMAIN ),
            /* translators: 1: plugin name. * /
            'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', REBOOT_TEXT_DOMAIN ),
            /* translators: 1: plugin name. * /
            'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', REBOOT_TEXT_DOMAIN ),
            /* translators: 1: dashboard link. * /
            'complete'                        => __( 'All plugins installed and activated successfully. %1$s', REBOOT_TEXT_DOMAIN ),
            'dismiss'                         => __( 'Dismiss this notice', REBOOT_TEXT_DOMAIN ),
            'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', REBOOT_TEXT_DOMAIN ),
            'contact_admin'                   => __( 'Please contact the administrator of this site for help.', REBOOT_TEXT_DOMAIN ),

            'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
        ),
        */
    );

    tgmpa($reboot_tgmpa_plugins, $config);
}