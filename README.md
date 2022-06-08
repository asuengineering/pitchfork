# Pitchfork - A WordPress theme for Arizona State University

Pitchfork is a theme for WordPress which contains an implementation of the ASU Unity Bootstrap 4 UI kit for the creation of on-brand ASU websites. The theme utilizes the default block editor for WordPress for content creation. It contains styles applied to the native WordPress "core" blocks in order to produce a constent result for use within ASU's web ecosystem.

This theme can (and probably should) be used with an additional plugin called Pitchfork Blocks to add a set of non-native blocks to the block editor. This additiion allows an end user to build virtually any design pattern that can be found within the Unity Design System (UDS).

A plugin for use with the [Pitchfork theme](https://github.com/asuengineering/pitchfork) for WordPress. 

This plugin adds blocks and block patterns for the block editor consistent with the ASU Unity Design system for web standards. 

Requires at least: WP 6.0
Tested up to: 6.0
Requires PHP: 7.3
Stable tag: 1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

**Contributors**

- Steve Ryan (ASU Engineering)
- Walt McConnell, Zainab Alsidiki, Nathan Rollins (ASU Knowledge Enterprise)

## Usage Requirements

- Download the lastest release from Github.
- Install in the normal WP location for plugins which is typically `/wp-content/plugins`.

**Recommended / Required Additional Plugins**

This plugin contains blocks that are constructed with the use of Advanced Custom Fields Pro. 
- The ACF Pro plugin is also required by the Pitchfork theme.
- The theme contains a script which will prompt the user to install this plugin upon theme activation.
- ASU Engineering provides a licensed copy of this plugin within its standard disstribution of WordPress on the Pantheon hosting platform.

Plugin updates can optionally be managed from the admin dashboard through the use of [Git Updater](https://git-updater.com/). 


## Includes

This plugin leverages the following libraries for functionality delivered within certain blocks.

- This plugin loads a copy of the SASS files from the [Bootstrap 4 library](https://github.com/ASU/asu-unity-stack/tree/dev/packages/bootstrap4-theme) within the ASU Unity design kit. It includes only the design tokens for easier SASS references and expects that the theme will load the remainder of the required BS4 files.  

- The breadcrumb block is an ACF wrapper for the [Hybrid Breadcrumbs](https://github.com/themehybrid/hybrid-breadcrumbs) composer-based assset for including breadcrumbs.

- The sidebar block makes use of a custom ACF field group for menu selection which can be found within the [ASU Engineering's GitHub organization](https://github.com/asuengineering/ACF-Menu-Select). 

## Development

- Run `npm install` and `composer install` prior to local development.
- SASS and JS compile & watch tasks are triggered via WP-Gulp and `npm start` from the project root.

<hr>

## Release Notes

### Version 1.0

- Initial deployment of the plugin. v1.0.
- Includes working versions of the following blocks:
  - `accordion` / `card-foldable` 
  - `alert` and `banner` for eassy inclusion on a page. Works as repeatable blocks within the block editor.
  - `background-section` for easy inclusion of the background patterns from the unity design kit.
  - `blockquote` which also includes vertical styles corresponding to the "testimonial" element from the design kit.
  - `breadcrumb` via Hybrid Brreadcrumbs
  - `card` which can produce UDS cards of arbitrary content in any of the approved formats.
  - `grid-links` 
  - `hero` version 2.0 from the design kit. 
  - `sidebar` 
  - `subtitle` for use within the hero. 