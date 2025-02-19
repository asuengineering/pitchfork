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

- ACF Pro is also required by the Pitchfork Blocks plugin that delivers additional blocks found within the Unity kit.
- The theme contains a script which will prompt the user to install this plugin upon theme activation.
- ASU Engineering can provide a licensed copy of this plugin to users of this theme upon request.

Theme updates can optionally be managed from the admin dashboard through the use of [WP Pusher](https://wppusher.com/) or [Git Updater](https://git-updater.com/).

## Includes

This theme leverages the following libraries for functionality delivered within certain blocks.

- This theme loads a copy of the distributed CSS, JS and image files from the [Unity Boostrap library](https://github.com/orgs/ASU/packages/npm/package/unity-bootstrap-theme) within the ASU Unity design kit.
- The header included with the current version of the theme is the `@asu/component-header` package from the Unity project.
- The footer for the theme uses a combination of local markup for the dark sections of the footer along with the `@asu/component-footer` package for the gray and gold sections at the bottom.
- The global analytics tags (GA4) tags required for any site within ASU are loaded automatically if the domain includes `asu.edu`.
- The customizer provides options for uploading an endorsed logo for inclusion in the global footer area.

## Development

- Run `npm install` and `composer install` prior to local development.
- SASS and JS compile & watch tasks are triggered via [Gulp WP](https://github.com/cr0ybot/gulp-wp) and `npx gulp-wp` from the project root.

## Release Notes

See [CHANGELOG.md](CHANGELOG.md) for the a list of all improvements made to the theme.

We also keep similar notes in the [releases section](https://github.com/asuengineering/pitchfork/releases) of our project for an overview of what changed with each release.
