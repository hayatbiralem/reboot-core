# Reboot Core

A plugin for WordPress Projects.

It could be used with any theme for general features but we use it with The7 theme and WP Bakery Visual Composer plugin (which should be installed by The7 already).

## Features

We have cool stuff like these:

- Easy Visual Composer element buildings
- Easy assets usage by just creating them

.. and so on.

## Workflow

- Install fresh WordPress with changing `$table_prefix` in `wp-config.php` file. It is important for security.
- Remove following plugins:
  - Akismet Anti-Spam (Because most clients don't need comments functionality)
  - Hello Dolly
- Remove "Hello World" post from posts list and empty trash.
- If there is an update for WordPress, upgrade it.
- Install this plugin to the plugins directory and activate it.
- Download all The7 files includes the `Developer Tools` to your computer and extract it.
- Upload The7 theme to the themes directory _without_ activating and _without_ changing folder name (keep it as `dt-the7`).
- Upload The7 child theme to the themes directory and rename it based on the end user name like `my-client`. Not agency or your name. It should be based on the end user name.
- Edit child theme's `style.css` file like `plugins/reboot-core/_sample/child-theme/style.css`.
- Copy sample config folder from `plugins/reboot-core/_sample/reboot` to under `themes/{my-client}` folder.
- Modify `themes/{my-client}/reboot/config.php` and set `REBOOT_AGENCY`, `REBOOT_AGENCY_URL`, `REBOOT_AGENCY_EMAIL`, `REBOOT_CLIENT`, `REBOOT_CLIENT_URL`.
- Install premium plugins by following the instructions inside `plugins/reboot-core/tgmpa/plugins/premium-plugins.md` file.
- Activate the child theme.
- Visit `Wp Admin > The 7 > Plugins` and install following plugins:
  - Contact Form 7
  - The7 Slider Revolution
  - The7 WPBakery Page Builder
  - The7 Ultimate Addons for Visual Composer
- Visit `Wp Admin > {REBOOT_AGENCY_NAME} > Install Plugins` and install following plugins

## Tips

- If you have WP Bakery Visual Composer, you don't have to install the [Classic Editor](https://wordpress.org/plugins/classic-editor/) plugin because VC has a setting for that under the settings: `Disable Gutenberg Editor`;
