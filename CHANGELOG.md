# Change Log

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## Version 2.4.1

ASU Enterprise Technology announced on February 20, 2025 that it will [deploy a new cookie consent banner](https://engineering-marcomm.slack.com/archives/C02FD95N2F9/p1740072364003159) to all websites via the ASU GTM container. That change necessitated the following minor release.

- REMOVE: The cookie consent package from the Unity Design System was removed from the theme.

| Package                   | Old version | Updated Version |
| ------------------------- | ----------- | --------------- |
| `unity-bootstrap-package` | 2.1.0       | removed         |

## Version 2.4

This release updates packages from the Unity Design System to reflect current styles and options available for the blocks within [Pitchfork People](https://github.com/asuengineering/pitchfork-people). It also incorporates a change to the size of the innovation image within the global footer.

- ADD: New patterns added to the pattern library include the **Story + Thumb (Row)** pattern and the **Icon + Heading** pattern.
- CHANGE: Several patterns were recategorized to allow for easier access to the complete set of patterns which use the `core/query-loop` block. The full pattern library can be viewed at `/wp-admin/site-editor.php?path=/patterns`
- ADD: A new page template called **No title** was added to the theme. Unlike the default template, the No title template does not automatically echo a page title prior to the output of `the_content()`. Use the `core/title` block to include that content elsewhere within the page design.
- ADD: A new theme option allows for the direct inclusion of a tracking code from Microsoft Clarity.

**Package Versions**

The global header and global footer packages were updated to the last release point prior to the Unity component consolidation effort that took place in February 2025.

| Package                   | Old version | Updated Version |
| ------------------------- | ----------- | --------------- |
| `unity-bootstrap-package` | 1.15.3      | 1.20.2          |
| `component-header`        | 2.2.0       | 2.3.3           |
| `component-footer`        | 2.2.0       | 2.2.2           |

## Version 2.3

This release contains a critical fix to address a PHP error that can occur when updating to WordPress core v6.7.0.

This theme update should be applied concurrently with the v2.2.0 [Pitchfork Blocks](https://github.com/asuengineering/pitchfork-blocks) plugin release before attempting to update to WP core files to the latest version.

- FIX: Removed unnecessary HTML Tag processor call to problematic `set_bookmark` method. This prevents critial PHP errors from appearing when rendering pages that use the `archive.php` template or any included pagination functions. See Trac ticket [#62290](https://core.trac.wordpress.org/ticket/62290) for more details.
- CHANGE: Updated Unity Design kit assets to latest from ASU package library. Package changes include an update to the "repeatedly ranked" graphic in the global footer.

**Package Versions**

| Package                   | Old version | Updated Version |
| ------------------------- | ----------- | --------------- |
| `unity-bootstrap-package` | 1.9.15      | 1.15.3          |
| `component-header`        | 2.2.5       | 2.3.3           |
| `component-footer`        | 2.2.0       | 2.2.2           |

## Version 2.2.1

**Concurrent Release**

This release is being made with a concurrent release to the accompanying [Pitchfork Blocks plugin](https://github.com/asuengineering/pitchfork-blocks).

If you are using the Pitchfork Blocks plugin with this theme, please ensure that you upgrade the plugin to at least v2.1.1 PRIOR to updating the theme to v2.2.1. Updating the theme before the plugin will result in a fatal PHP error for redeclaring a pair of classes that were moved from the plugin to the theme for this release.

The following changes were made:

- CHANGE: Two custom field definitions for ACF were moved from the Pitchfork Blocks plugin to this theme. This allows the fields to be reused in multiple plugins without needing to be redefined in each application. The fields that now available include a menu selection control a unique ID field.
- ADD: A new pattern for the "degree card" layout was added to the pattern library.

**Package Versions**

| Package                   | Old version | Updated Version |
| ------------------------- | ----------- | --------------- |
| `unity-bootstrap-package` | 1.9.15      | unchanged       |
| `component-header`        | 2.2.5       | unchanged       |
| `component-footer`        | 2.2.0       | unchanged       |

## Version 2.2

This release supports work done within Pitchfork Blocks to add a new set of blocks that redefine how cards work within the editor.

**Patterns**

- ADD: New patterns make it easy to to deploy single cards with various features. The following card patterns were added: icon and text link card, story card, event card, degree card.
- ADD: A new pattern using a query loop and the new `acf/card-v2` block was added to the library.
- ADD: A new pattern was also included to make a "post column" layout using core blocks only. As originally seen within the home pages of In The Loop and Inner Circle.
- UPDATE: Existing card patterns which utilized the older card blocks were updated to use the new card blocks.
- ADD: A pattern representing a whole page with a two column layout was added to the library.

**Data Layer**

- ADD: The process of giving a `core/button`​ block a custom name in the editor will automatically add all needed data layer tags to properly track any desired call to action.
- CHANGE: Example block patterns for video and regular heroes + the content overlap block now include renamed buttons by default.
- CHANGE: Patterns that include a layout of three cards and a button now include a renamed button by default.

**Package Versions**

| Package                   | Old version | Updated Version |
| ------------------------- | ----------- | --------------- |
| `unity-bootstrap-package` | 1.9.4       | 1.9.15 (latest) |
| `component-header`        | 2.2.3       | 2.2.5 (latest)  |

## Version 2.1

This release provides a new and improved format for blog posts within a site using the Pitchfork theme.

- FIX: Posts will now be formatted by default in a compact design that allows for a larger featured image and a visible post excerpt. Design and usability details will follow in a blog post within the [ASU Engineering Marketing/Communication](https://comm.engineering.asu.edu) site.
- ADD: Support for a post format called an "aside" is also now available in the post editor. The intent for an aside post is to deliver a short-form news update visible in a feed elsewhere on your site. Individual posts given this format will appear without a post title, and without a featured image.
- ADD: Direct support for the social sharing service called [AddtoAny](https://www.addtoany.com/) is provided within the new single.php template. Activate [the official AddtoAny plugin](https://wordpress.org/plugins/add-to-any/) within your site to see social sharing icons appear within the sidebar of your post.

Additional actions taken:

- ADD: Featured images will now be added to site RSS feeds by default.
- ADD: Added data layer tracking to pagination elements when visible in a template.
- ADD: Support added for the `core/file` block to allow for PDF embeds to happen via native WordPress function.
- FIX: Removed the zero character that appeared when there was no menu assigned to the primary navigation area of the site.
- FIX: Corrected expected path for favicons for the theme.

## Version 2.0.1

- ADD: Package updates from `@asu` to include the "repeatedly #1" innovation footer graphic.
- FIX: Replaced the icon for the service formerly known as Twitter in the endorsed footer section with the new brand logo. (Bye bye birdie.)
- FIX: Footer menu now uses markup for BS5 accordions in mobile presentation. When paired with the Pitchfork Blocks plugin, these accordions will now also emit events tracked by the ASU GA4 data layer.
- FIX: Author archive pages are now redirected to the home page of the site by default. Function can be easily overridden by a child theme if desired for an individual application.

## Version 2.0

This version updates its references to the Unity Design system from the deprecated `@asu/bootstrap-4-theme` package to the current `@asu/unity-bootstrap-theme` package. Plugins that still rely on markup from the older package will need to be updated correspondingly with this release.

**Unity Design Kit**

- CHANGE: Unity Bootstrap package references are updated.
- FIX: Address formatting issue with gold divider style of `core/divider` block.
- FIX: Altered markup for the UDS List style of the `core/lists` blocks. Markup recommended by Unity project still focuses its styling and formatting on the `:before` element instead of the more current `:marker` element for both unordered and ordered lists. Added styles within the theme to support `:marker` while Unity project catches up.
- FIX: Support for the `start` and `type` properties of lists which are now a part of the WordPress UI are also now supported by the UDS List style of the `core/lists` block.

**Data Layer**

- ADD: Added support for logging user interactions to the ASU GA4 data layer object.
  - UI elements with the appropriate markup will be logged automatically
  - Events and clicks associated with the global header are also captured automatically.
- UNRELEASED: Staged additional script within `inc/data-layer-filters` which would add `data-ga` tags to all button blocks within the context of the page. Pending evaluation of approach and possible addition of a UI layer to allow these elements to be named individually.

**Additional technical changes**

- CHANGE: A new build process was incorporated into the theme. Developers should see [Gulp WP](https://github.com/BlackbirdDigital/gulp-wp) for additional details. Build and compilation process still begins with `npm start`.
- FIX: Removed the possibility of fatal PHP errors which occur when the theme is activated without the Advanced Custom Fields plugin. The root cause of most of those errors is a call to the missing `get_field` function provided by the plugin. All references to `get_field` were replaced with other native WordPress functions (`get_option`, `get_post_meta`) to prevent the error from occuring.
- ADD: The theme now defines an explicit save and load point for any ACF-JSON configuration files in use by the theme.

## Version 1.9.2

- ADD: Support for the new `acf/profile-data` block within [Pitchfork People](https://github.com/asuengineering/pitchfork-people) was added to `theme.json`.

## Version 1.9.1 (Bug Fix)

FIX: Previous release used a reference to `get_stylesheet_directory_uri()` to enqueue assets from the theme. This function works correctly for when there is no child theme active. But, this results in assets not being loaded correctly when a child theme is present. Changed references to `get_template_directory_uri()` to force the assets to enqueue from the parent theme instead.

## Version 1.9

This release was a maintenance update of the theme, primarily to update all package references to the old `@asu-design-system` with new references to `@asu` (https://github.com/orgs/ASU/packages).

- ADD: Added back the temporarily disabled cookie consent banner. Functioning normally based on new code provided within `@asu/component-cookie-consent`
- ADD: Added partial support for `@asu/component-footer`. Specifically, the gold and gray bars at the bottom of the page are now updated via the React component.
- FIX: Site search via the "universal" grey bar in the header wasn't working correctly. Addressed by supplying the correct props to an updated component from `@asu/component-header`.
- CHANGE: Parent site will no longer appear unless both the parent name and parent URL are specified in the customizer. The `@asu/component-header` doesn't support an option for providing only a parent site name.
- CHANGE: The option to link/unlink the site title in the header was also removed from the customizer. This configuration is also not supported by `@asu/component-header`.
- FIX: The focus outline for a linked image was not displaying correctly. Added additional CSS rules to address the issue.

## Version 1.8

- FIX: The gold underline in the header was not applied to the current page if it was a listed element in the navigation. Also, the gold underline for the home icon was always present no matter what page was viewed. Both errors addressed.
- FIX: The background color picker was visible but empty for blocks which explicitly disabled support for that feature. Fixed with additional declarations in `theme.json`
- FIX: Added better support for `core/image` and captioning with the UDS Figure style applied. Captions for resized images now conform to the size of the image when the image is floated or centered.
- FIX: Base URL for the site header was set to `'/'` instead of `site_url()` which made site title links for subsites (site.asu.edu/sitename) incorrectly link to the parent URL instead of the current site URL.
- ADD: Added support for `core/post-title` as a way to replace the page title included in `page.php` if no title replacement block is present.

## Version 1.7.1 (Bug fix)

A previous attempt to prevent site content from scrolling under the header inadvertantly caused click events mapped to the navbar to stop firing. The result was that all dropdown menus stopped functioning.

- FIX: Added JS event monitor to attach `.scrolled` class to header and rewrote CSS appropriately for proper top margin on the `<main>` element. Removed previous attempt to `unwrap()` #asuHeader to restore mapped click events for dropdowns.

## Version 1.7

- ADD: Support for `acf/profiles` block added to `theme.json`
- ADD: Created block pattern categories for **Pitchfork: Directory** and **Pitchfork: Cards**
- ADD: Created 5 new directory patterns and two new card patterns for the pattern library.
- FIX: Prevented empty paragraph tag produced by the Edit Page link from displaying above the footer.
- FIX: Home icon in nav bar always pointed to the root domain due to a hard coded `/` in nav walker script. Changed to reference `get_home_URL()` to allow the home icon in subsites within a multisite to point to their individual home pages.

**Documentation:**

- ADD: https://wordpress.asu.edu/pitchfork/docs/profiles-block/
- ADD: https://wordpress.asu.edu/pitchfork/docs/profile-block-manual/
- ADD: https://wordpress.asu.edu/pitchfork/docs/block-patterns/

## Version 1.6.1

- FIXED: A CSS selector using `:has()` was being used to set the margin top for the new global header. That CSS rule is unsupported by Firefox and older versions of Safari. Used JS to remove wrapper around header element and rewrote the rule to use CSS adjacent siblings again to handle scrolled state.
- ADDED: Support for incoming `acf/profile-manual` block was added to `theme.json`
- REMOVED: Removed references to Query Monitor plugin intended for debugging the new header.

## Version 1.6

A fast-follower release from the previous milestone, Pitchfork v1.6 now incorporates the `component-header` elements from the Unity Design system.

- ADDED: Support for blockGap and spacingSizes within `theme.json`. Default sizes are consistent with Unity Design system standards for spacing and margins.

- ADDED: Global header now supports several new configurations and options.

  - "Empty" navigation and CTA only navigation options now supported.
  - Option provided for overriding the breakpoint at which the mobile menu is displayed. Default is still the `lg` breakpoint at ~ 960px.
  - Option provided to animate the site title when switching between ASU domains. Enabled by default.
  - Option provided to expand the menu links on a mouse hover when viewing the site on a desktop resolution. Feature disabled by default.

- CHANGED: Separated panels in the customizer related to the global footer "endorsed logo" and "site links" areas.

- REMOVED: Removed panels and options from the customizer which are no longer necessary to configure the site properly.

## Version 1.5

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
  - New URL is within the settings menu at `/wp-admin/options-general.php?page=pitchfork-settings`
- ADD: Global header now includes ASU GA data-layer attributes.

## Version 1.4

- ADDED: Global footer now includes the 2023 innovation lockup graphic.
- ADDED: Updated ASU Bootstrap UI kit to v7.17.12 (latest).
- ADDED: Added support for Github Updater plugin.

## Version 1.3

- FIX: Add support for `.alignleft`, `.alignright` and `.aligncenter` classes.
- FIX: Remove extra bullet point from nested `<ul>` elements in `.uds-list`.
- FIX: Remove Lavidge tracking code from header. Causes unpredictable results when not enqueued properly.

## Version 1.2

- FIX: Resolve PHP notice for missing array value within the global header.
- FIX: core/columns block now supports a limited color palette for background colors.
- FIX: The drop-shadow style of the core/image block no longer exceeds the margin of the block.
- FIX: page.php and single.php now support for acf/hero-video as a replacement for the page/post title.

## Version 1.1

- Includes `theme.json` rules for new `content-media-overlap` block.
- Filters out default labels for archive page titles.
- Limits scope of a CSS rule only intended for `single.php`

## Version 1.0

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
