# Pitchfork - A WordPress theme for Arizona State University

Pitchfork is a theme for WordPress which contains an implementation of the ASU Unity Bootstrap 4 UI kit for the creation of on-brand ASU websites. The theme utilizes the default block editor for WordPress for content creation. It contains styles applied to the native WordPress "core" blocks in order to produce a constent result for use within ASU's web ecosystem.

This theme can (and probably should) be used with an additional plugin called [Pitchfork Blocks](https://github.com/asuengineering/pitchfork-blocks) to add a set of non-native blocks to the block editor. This additiion allows an end user to build virtually any design pattern that can be found within the Unity Design System (UDS).

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
- Install in the normal WP location for plugins which is typically `/wp-content/themes`.

**Recommended / Required Additional Plugins**

This theme contains options within the header and footer which require the use of Advanced Custom Fields Pro. 
- The ACF Pro plugin is also required by the Pitchfork plugin that delivers additional blocks found within the Unity kit.
- The theme contains a script which will prompt the user to install this plugin upon theme activation.
- ASU Engineering provides a licensed copy of this plugin within its standard distribution of WordPress on the Pantheon hosting platform.

Theme updates can optionally be managed from the admin dashboard through the use of [Git Updater](https://git-updater.com/). 

## Includes

This theme leverages the following libraries for functionality delivered within certain blocks.

- This theme loads a copy of the distributed CSS, JS and image files from the [Bootstrap 4 library](https://github.com/ASU/asu-unity-stack/tree/dev/packages/bootstrap4-theme) within the ASU Unity design kit. 
- The header and footer for the theme are the Bootstrap 4 versions of each of those components. 
- The customizer provides options for enabling the ASU Global Analytics tags required for any site under the `asu.edu` umbrella. 
- The customizer also provides options for uploading an endorsed logo for inclusion in the global footer area.

## Development

- Run `npm install` and `composer install` prior to local development.
- SASS and JS compile & watch tasks are triggered via WP-Gulp and `npm start` from the project root.

<hr>

## Release Notes

### Version 1.4

- ADDED: Global footer now includes the 2023 innovation lockup graphic.
- ADDED: Updated ASU Bootstrap UI kit to v7.17.12 (latest).
- ADDED: Added support for Github Updater plugin.

### Version 1.3

- FIX: Add support for `.alignleft`, `.alignright` and `.aligncenter` classes.
- FIX: Remove extra bullet point from nested `<ul>` elements in `.uds-list`.
- FIX: Remove Lavidge tracking code from header. Causes unpredictable results when not enqueued properly.

### Version 1.2

- FIX: Resolve PHP notice for missing array value within the global header. 
- FIX: core/columns block now supports a limited color pallette for background colors.
- FIX: The drop-shadow style of the core/image block no longer exceeds the margin of the block.
- FIX: page.php and single.php now support for acf/hero-video as a replacement for the page/post title.

### Version 1.1

- Includes `theme.json` rules for new `content-media-overlap` block.
- Filters out default labels for archive page titles.
- Limits scope of a CSS rule only intended for `single.php` 

### Version 1.0

- Initial stable deployment of the theme.
- Includes `theme.json` support of all blocks from accompanying Pitchfork Blocks plugin.
- Contains native support for color from the ASU palette wherever appropriate.
- Allows customization of margin/padding around each block as appropriate. 
- Includes improvments to the following core blocks to support elements of the brand standard:
  - `paragraph` supports the lead paragraph class.
  - `headings` include options to highlight an individual word within the text.
  - `buttons` include options for all supported button sizes and colors.
  - `list` block allows for the uds-steplist styles for ordered lists. 
  - `image` allows for captions to be displayed with/without the optional drop shadow.
  - `separator` allows for a gold bar as an additional `<hr>` style.
  - `table` now have native ASU styles applied to all table elements by default.
