# Reboot Core

A plugin for WordPress Projects.

It could be used with any theme for general features but we use it with The7 theme and we recommend it.

It also extends WP Bakery Visual Composer plugin and provide some useful helpers for it so you could use another themes that have WP Bakery Visual Composer.

## Features

We have cool stuff like these:

- Easy Visual Composer element buildings
- Easy assets usage by just creating them

.. and so on.

## Preparing

First tasks to begin real work.

- Install fresh WordPress with changing `$table_prefix` in `wp-config.php` file. It is important for security.
- Remove following plugins:
  - Akismet Anti-Spam (Because most clients don't need comments functionality)
  - Hello Dolly
- Remove "Hello World" post from posts list and empty trash.
- If there is an update for WordPress, upgrade it.
- Install `this` plugin (reboot-core) to the plugins directory and activate it.
- Download all The7 files includes the `Developer Tools` to your computer and extract it.
- Upload The7 theme to the themes directory _without_ activating and _without_ changing folder name (keep it as `dt-the7`).
- Upload The7 child theme to the themes directory and rename it based on the end user name like `my-client` or `john-doe`. Not agency or your name. It should be based on the end user name.
- Edit child theme's `style.css` file like `plugins/reboot-core/_sample/child-theme/style.css`.
- Copy sample config folder from `plugins/reboot-core/_sample/reboot` to under `themes/{my-client}` folder.
- Modify `themes/{my-client}/reboot/config.php` and set `REBOOT_AGENCY`, `REBOOT_AGENCY_URL`, `REBOOT_AGENCY_EMAIL`, `REBOOT_CLIENT`, `REBOOT_CLIENT_URL` and then all admin strings, permalinks and settings will be depends on these settings. So, be careful!
- Activate the child theme.
- Register theme by entering the Purchase Code. You could buy it or ask your partner agency for it.
- Visit `WP Admin >  The7 > Plugins` page and install following plugins:
  - Contact Form 7
  - The7 Slider Revolution
  - The7 Ultimate Addons for Visual Composer
  - The7 WPBakery Page Builder
- Install other premium plugins by following the instructions inside `plugins/reboot-core/tgmpa/plugins/premium-plugins.md` file.
- Visit `WP Admin > {REBOOT_AGENCY} > Install Plugins` page and install and activate following plugins:
  - ACF PRO
  - ACF Repeater
  - Clean Image Filenames
  - Contact Form 7
  - Contact Form 7 Database Addon – CFDB7
  - Disable Comments
  - Duplicate Post
  - Resize Image After Upload
  - WP Fastest Cache
  - WP Fastest Cache Premium
  - WP Mail SMTP by WPForms
  - WP Migrate DB
  - WPBakery Page Builder (Visual Composer) Clipboard
  - Yoast SEO
- You could install other plugins on the list too but we recommend that to use them only if you need them. For example, you don't need to install the `Classic Editor` plugin because of that the WP Bakery Visual Composer plugin already can take care of that under its general settings.
- Set following settings:
  - Visit `WP Admin > Settings > Disable Comments` and select `Everywhere` then save.
  - Visit `WP Admin > Settings > Resize Image Upload` and set followings:
    - Max width: 1500
    - Max height: 0 (it means infinite)
    - JPEG compression level: 90
    - Force JPEG re-compression: yes
    - Convert PNG to JPEG: YES - convert all uploaded png images not having a transparency layer to jpeg
  - Visit `WP Admin > Settings > Duplicate Post > Permitions` and check specifications then save.
  - Visit `WP Admin > Settings > Permalinks` and select `Psot name` then save.
  - Visit `WP Admin > Settings > Media` and set followings:
    - Large size
      - Max Width: 1200
      - Max Height: 9999
    - Clean Image Filenames
      - File types: All file types
  - Visit `WP Admin > Settings > Reading` and set followings:
    - Your homepage displays: A static page (Sample page)
    - Search Engine Visibility: Checked
  - Visit `WP Admin > Settings > General` and set tagline to proper one or delete it then save.
  - Visit `WP Admin > The7 WPBakery Page Builder Settings > General Settings` and set followings:
    - Google fonts subsets: Check `latin-ext` if you need
    - Disable Gutenberg Editor: Check
  - Visit `WP Admin > The7 WPBakery Page Builder Settings > Role Manager` and set followings:
    - Frontend editor: Disable

## Demo Import

We do not recommend to use `Demo Import`. Because we want to prevent unwanted content in our project and learn how to use The7 well.

But you could use demo import at another dummy installation to look what is the right way to achieve that look for settings and/or page content.

Also The7 provides single page import which is very cool. You should look at that.

## Development

Create `themes/{my-client}/classes` folder and replace `themes/{my-client}/function.php` wit this:

```php
<?php

/**
 * Include classes
 */

if(function_exists('reboot_include_folder')) {
    reboot_include_folder(REBOOT_CHILD_PATH . 'classes');
}
```

After this, when you create a php file in `classes` folder, that file automatically included to project.

We recommend that you can create one small file for each specific task. This helps you to organize things.

## Styles & Scripts

We recommend that you should use `themes/{my-client}/style.css` for project specific styles.

### Dynamic Assets

In addition, Reboot Core makes it easy to add more styles, fonts and scripts by just creating them like that:

```
themes/{my-client}/reboot/assets/{frontend|backend|bothend}/{css|font|js}/{name}/{style.css|script.js}`
```

`frontend` means that file only wil be enqueued on frontend and so on. You could imagine what does the `bothend` folder ;)

You can look at `plugins/reboot-core/assets` directory for sample usage of this feature.

Samples:

  - themes/{my-client}/reboot/assets/frontend/css/my-frontend-fixes/style.css`
  - themes/{my-client}/reboot/assets/bothend/font/my-icomoon-font/style.css`
  - themes/{my-client}/reboot/assets/backend/font/my-admin-scripts/script.js`
  
TODO:

  - [ ] We need to add complex styles and scripts like vendors without changing their file names.

#### Fonts

You should use [icomoon](https://icomoon.io/app) for generating icon fonts.

We recommend that you should prevent your custom font with `dashicons-` (like font name `dashicons-my-client` and font prefix `dashicons-my-client-`) so you can use that font icons as admin menu icon and The7 shows your icons correctly.

But be aware that! We recommend to use dynamic font icons when you build some custom component (like Visual Composer element) depends on to your code because if you want to use the new icons in The7 elements, you should use The7 Icons Manager.

### The7 Icons Manager

You should use The7 Icons Manager for your custom icon packages so you can use them in the The7 elements where has icons.

You should generate this icon packages by [icomoon](https://icomoon.io/app) as well.

## Change Admin Icons

If you want to use your custom icon or an [official wordpress dashicons](https://developer.wordpress.org/resource/dashicons/) icon as agency admin menu icon you can override it from your child theme's config file with this:

```php
<?php

if (!defined('REBOOT_AGENCY_MENU_ICON')) {
    define('REBOOT_AGENCY_MENU_ICON', 'dashicons-my-client-emblem');
}

```

This code already inside your config function but commented. You can uncomment and modify it.

## Custom Visual Composer Elements

Reboot Core makes it easy to add custom VC elements by just creating them like that:

```
themes/{my-client}/reboot/shortcodes/
└── my-client-vc-element/
    ├── params.php
    ├── view.php
    ├── style.css (optional)
    ├── script.js (optional)
    └── hooks.php (optional)
```

The `params.php` is an array of the element settings and the `view.php` is the output generator by using the element settings.

You should look at `plugins/reboot-core/shortcodes` directory for the usage examples. Actually those are real shortcodes so you can use all of those in the VC editor right now :)

## Custom Post Types and Taxonomies

Reboot Core makes it easy to add custom post types and taxonomies by simple filters like these:

```php
<?php

function my_client_custom_post_types($post_types)
{
    /**
     * Trip
     */

    $post_types['trip'] = [
        'name' => 'trip',
        'remove_meta_boxes' => [
            'wpseo_meta' => 'normal',
            'mymetabox_revslider_0' => 'normal',
            'airportdiv' => 'side',
            'locationdiv' => 'side',
        ],
        'args' => [
            'supports' => ['title', 'page-attributes'],
            'labels' => reboot_custom_post_types_and_taxonomies::get_post_type_labels(
                __('Trip', REBOOT_CHILD_TEXT_DOMAIN),
                __('Trips', REBOOT_CHILD_TEXT_DOMAIN)
            ),
        ]
    ];

    return $post_types;
}
add_filter('reboot_custom_post_types', 'my_client_custom_post_types');

function my_client_custom_taxonomies($post_types)
{    
    /**
     * Location
     */

    $post_types['location'] = [
        'name' => 'location',
        'post_types' => ['trip'],
        'args' => array(
            "labels" => reboot_custom_post_types_and_taxonomies::get_taxonomy_labels(
                __('Location', REBOOT_CHILD_TEXT_DOMAIN),
                __('Locations', REBOOT_CHILD_TEXT_DOMAIN)
            ),
        ),
    ];

    return $post_types;
}
add_filter('reboot_custom_taxonomies', 'my_client_custom_taxonomies');
```

Tip: We don't need to check `reboot_custom_post_types_and_taxonomies` class before use because we already use a Reboot Core filter.

In default, all post types are available only for admin (not public). If we add `rewrite` attribute to `args` with true or a [valid array](https://codex.wordpress.org/Function_Reference/register_post_type#rewrite) then that post type become public.

Or you can override all settings defined in [official documentation](https://codex.wordpress.org/Function_Reference/register_post_type) under `args`.

## Tips

- You can use `Pages > Sample page` for home page. We think that is a cute detail :)
- If you have WP Bakery Visual Composer, you don't have to install the [Classic Editor](https://wordpress.org/plugins/classic-editor/) plugin because VC has a setting for that under the global settings: `Disable Gutenberg Editor`;
