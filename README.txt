=== WP Dev Flag ===
Contributors: chrisjallen
Donate link: https://paypal.me/chrisjimallen
Tags: banner, badge, flag, banner, development, production, dev, localhost
Requires at least: 3.0.1
Requires PHP: 5.6
Tested up to: 5.2.1
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Shows a floating badge on the front end, to visually distinguish your development site from production.

== Description ==

This plugin makes it easy to distinguish between your local development site, and your live site.
I created this because I often use a local duplicate of my live site, for development, with the same DB, and the same URL.

I use a hosts switcher for example [Gasmask](https://github.com/2ndalpha/gasmask) to switch between Local & Live versions of the same website, and needed a quick & easy way of identifying them. This plugin acheives that in the simplest way possible.

There are settings for colour, positioning and the text displayed on the badge.

== Installation ==

= From your WordPress dashboard =

1. Visit 'Plugins > Add New'
2. Search for 'WP Dev Flag'
3. Activate 'WP Dev Flag' from your Plugins page.
4. Visit 'WP Dev Flag Options' in the 'Plugins' submenu to access the settings.

= From WordPress.org =

1. Download 'WP Dev Flag'.
2. Upload the 'wp-dev-flag' directory to your '/wp-content/plugins/' directory, using your favorite method (ftp, sftp, scp, etc...)
3. Activate 'WP Dev Flag' from your Plugins page.
4. Visit 'WP Dev Flag Options' in the 'Plugins' submenu to access the settings.

== Frequently Asked Questions ==

= Can I create my own CSS for the badge? =

Currently, you can customise the colour, text and position of the badge. The ability to add a custom class is coming in the next release.

Feel free to just style `.wp-dev-flag` yourself though.

I will also explore additonal options such as custom fonts & href functionality.

= Will the badge display on my live site if I duplicate the entire database as is? =

No, it detects the current server environment and if it doesn't match the environment that was set originally, the plugin will not display the badge. You can simply click update to set the new environment if required.

== Screenshots ==

1. This is what the default badge looks like.
2. This is the Trigger Options tab.
3. This is the Display Options tab.

== Changelog ==

= 1.0.0 =
* First Version.

== Upgrade Notice ==

= 1.0.0 =
This is the first version.
