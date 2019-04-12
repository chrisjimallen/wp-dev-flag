# WP Dev Flag

![banner-1544x500](https://user-images.githubusercontent.com/1681063/56038858-dd0ae880-5d2a-11e9-9d70-f423c0f63b3d.png)

- Contributors: chrisjallen
- Donate link: https://paypal.me/chrisjimallen
- Tags: banner, badge, flag, banner, development, production, dev, localhost
- Requires at least: 3.0.1
- Requires PHP: 5.6
- Tested up to: 5.1.1 
- Stable tag: 1.0.0
- License: GPLv2 or later
- License URI: http://www.gnu.org/licenses/gpl-2.0.html

Shows a floating `badge` on the front end, to visually distinguish your development site from production.

## Description

This plugin makes it easy to distinguish between your local development site, and your live site.
I created this because I often use a local duplicate of my live site, for development, with the same DB, and the same URL.

I use a hosts switcher for example [Gasmask](https://github.com/2ndalpha/gasmask) to switch between Local & Live versions of the same website, and needed a quick & easy way of identifying them. This plugin acheives that in the simplest way possible.

There are settings for colour, positioning and the text displayed on the badge.

## Installation

#### From your WordPress dashboard

1. Visit 'Plugins > Add New'
2. Search for 'WP Dev Flag'
3. Activate 'WP Dev Flag' from your Plugins page.
4. Visit 'WP Dev Flag Options' in the 'Plugins' submenu to access the settings.

#### From WordPress.org

1. Download 'WP Dev Flag'.
2. Upload the 'wp-dev-flag' directory to your '/wp-content/plugins/' directory, using your favorite method (ftp, sftp, scp, etc...)
3. Activate 'WP Dev Flag' from your Plugins page.
4. Visit 'WP Dev Flag Options' in the 'Plugins' submenu to access the settings.

## Frequently Asked Questions

**_Can I create my own CSS for the badge?_**

Currently, you can customise the colour, text and position of the badge. The ability to add a custom class is coming in the next release.

I will also explore additonal options such as custom fonts & href functionality.

**_Will the badge display on my live site if I duplicate the entire database as is?_**

No, it detects the current server environment and if it doesn't match the environment that was set originally, the plugin will not display the badge. You can simply click update to set the new environment if required.

## Screenshots

#### This is what the default badge looks like.
![screenshot-1](https://user-images.githubusercontent.com/1681063/56038982-278c6500-5d2b-11e9-9cbc-b43355c6e323.png)
#### This is the Trigger Options tab.
![screenshot-2](https://user-images.githubusercontent.com/1681063/56039222-b13c3280-5d2b-11e9-8bac-c274fa461761.png)
#### This is the Display Options tab.
![screenshot-3](https://user-images.githubusercontent.com/1681063/56039256-c1eca880-5d2b-11e9-8d08-eda86a81d66e.png)


## Changelog

#### 1.0.0
* First Version.

## Upgrade Notice

#### 1.0.0
This is the first version.
