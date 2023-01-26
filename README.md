# Pitchfork - A WordPress theme for Arizona State University

Pitchfork is a theme for WordPress which contains an implementation of the ASU Unity Bootstrap 4 UI kit for the creation of on-brand ASU websites. The theme utilizes the default block editor for WordPress for content creation. It contains styles applied to the native WordPress "core" blocks in order to produce a consistent result for use within ASU's web ecosystem.

This theme can (and probably should) be used with an additional plugin called [Pitchfork Blocks](https://github.com/asuengineering/pitchfork-blocks) to add a set of non-native blocks to the block editor. This addition allows an end user to build virtually any design pattern that can be found within the Unity Design System (UDS).

Requires at least: WP 6.0
Tested up to: 6.0
Requires PHP: 7.3
Stable tag: 1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

**Contributors**

- Steve Ryan (ASU Engineering)
- Walt McConnell, Zainab Alsidiki, John Cox, Nathan Rollins (ASU Knowledge Enterprise)

## Usage Requirements

- Download the lastest release from Github.
- Install in the normal WP location for plugins which is typically `/wp-content/themes`.

**Recommended / Required Additional Plugins**

This theme contains options within the header and footer which require the use of Advanced Custom Fields Pro.
- The ACF Pro plugin is also required by the Pitchfork plugin that delivers additional blocks found within the Unity kit.
- The theme contains a script which will prompt the user to install this plugin upon theme activation.
- ASU Engineering provides a licensed copy of this plugin within its standard distribution of WordPress on the Pantheon hosting platform.

Theme updates can optionally be managed from the admin dashboard through the use of [WP Pusher](https://wppusher.com/).

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

### Version 1.7.1 (Bug fix)
A previous attempt to prevent site content from scrolling under the header inadvertantly caused click events mapped to the navbar to stop firing. The result was that all dropdown menus stopped functioning.

- FIX: Added JS event monitor to attach `.scrolled` class to header and rewrote CSS appropriately for proper top margin on the `<main>` element. Removed previous attempt to `unwrap()` #asuHeader to restore mapped click events for dropdowns.

### Version 1.7
- ADD: Support for `acf/profiles` block added to `theme.json`
- ADD: Created block pattern categories for **Pitchfork: Directory** and **Pitchfork: Cards**
- ADD: Created 5 new directory patterns and two new card patterns for the pattern library.
- FIX: Prevented empty paragraph tag produced by the Edit Page link from displaying above the footer.
- FIX: Home icon in nav bar always pointed to the root domain due to a hard coded `/` in nav walker script. Changed to reference `get_home_URL()` to allow the home icon in subsites within a multisite to point to their individual home pages.

**Documentation:**

- ADD: https://wordpress.asu.edu/pitchfork/docs/profiles-block/
- ADD: https://wordpress.asu.edu/pitchfork/docs/profile-block-manual/
- ADD: https://wordpress.asu.edu/pitchfork/docs/block-patterns/

### Version 1.6.1
- FIXED: A CSS selector using `:has()` was being used to set the margin top for the new global header. That CSS rule is unsupported by Firefox and older versions of Safari. Used JS to remove wrapper around header element and rewrote the rule to use CSS adjacent siblings again to handle scrolled state.
- ADDED: Support for incoming `acf/profile-manual` block was added to `theme.json`
- REMOVED: Removed references to Query Monitor plugin intended for debugging the new header.

### Version 1.6

A fast-follower release from the previous milestone, Pitchfork v1.6 now incorporates the `component-header` elements from the Unity Design system.

- ADDED: Support for blockGap and spacingSizes within `theme.json`. Default sizes are consistent with Unity Design system standards for spacing and margins.

- ADDED: Global header now supports several new configurations and options.
  - "Empty" navigation and CTA only navigation options now supported.
  - Option provided for overriding the breakpoint at which the mobile menu is displayed. Default is still the `lg` breakpoint at ~ 960px.
  - Option provided to animate the site title when switching between ASU domains. Enabled by default.
  - Option provided to expand the menu links on a mouse hover when viewing the site on a desktop resolution. Feature disabled by default.

- CHANGED: Separated panels in the customizer related to the global footer "endorsed logo" and "site links" areas.

- REMOVED: Removed panels and options from the customizer which are no longer necessary to configure the site properly.


### Version 1.5

The previous version of the Pitchfork theme (v1.4) introduced a bug into the mobile version of the header in which the links from the main navigation would not scroll correctly within the dropdown menu. This important update addresses this issue and adds improvements to the remainder of the controls for the header.

- UPDATE: Updated ASU Bootstrap UI kit to v7.19.4 (latest).
- CHANGE: Removes end user ability to enable/disable ASU global analytics. Instead, theme automatically submits data to ASU's "global" GA container anytime the assigned domain for the site ends in `asu.edu`
- FIX: Corrected markup for the global header.
  - Mobile menu now expands to the height of the device in all circumstances.
  - Mobile menu scrolls normally when the navigation links exceed the height of the dropdown window.
- ADD: Introduced a new theme options menu specifically for multisite installations.
  - Relocated controls for inheriting root site main navigation and other properties to new theme options panel.
  - Multisite enhancement controls (above) are now only visible for users with `super-admin` privileges.
  - Relocated controls for adding additional tracking codes to theme options panel instead of customizer.
  - New URL is within the settings menu at  `/wp-admin/options-general.php?page=pitchfork-settings`
- ADD: Global header now includes ASU GA data-layer attributes.

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
- FIX: core/columns block now supports a limited color palette for background colors.
- FIX: The drop-shadow style of the core/image block no longer exceeds the margin of the block.
- FIX: page.php and single.php now support for acf/hero-video as a replacement for the page/post title.

### Version 1.1

- Includes `theme.json` rules for new `content-media-overlap` block.
- Filters out default labels for archive page titles.
- Limits scope of a CSS rule only intended for `single.php`

### Version 1.0

- Initial stable deployment of the theme.
- Includes `theme.json` support for all blocks from the accompanying Pitchfork Blocks plugin.
- Contains native support for color from the ASU palette wherever appropriate.
- Allows customization of margin/padding around each block as appropriate.
- Includes improvements to the following core blocks to support elements of the brand standard:
  - `paragraph` supports the lead paragraph class.
  - `headings` include options to highlight an individual word within the text.
  - `buttons` include options for all supported button sizes and colors.
  - `list` block allows for the uds-steplist styles for ordered lists.
  - `image` allows for captions to be displayed with/without the optional drop shadow.
  - `separator` allows for a gold bar as an additional `<hr>` style.
  - `table` now have native ASU styles applied to all table elements by default.
