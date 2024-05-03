/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************************!*\
  !*** ./src/scripts/block-variations.js ***!
  \*****************************************/
/**
 * JS file to add block styles and variations to various core blocks.
 * - core/paragraph, add lead style.
 * - core/button, add size selection, rework CSS for UDS styles.
 * - core/list, add list styles.
 * - core/image, remove default styles, add our own.
 * - core/table, remove all styles. Apply uds-table to native class.
 * - core/separator, remove default styles, add back UDS classes.
 */

wp.domReady(() => {
  // Add .lead to core/paragraph block.
  wp.blocks.registerBlockStyle('core/paragraph', [{
    name: 'lead',
    label: 'Lead',
    isDefault: false
  }]);
  /**
   * Remove default block styles for core/button
   */
  wp.blocks.unregisterBlockStyle('core/button', 'default');
  wp.blocks.unregisterBlockStyle('core/button', 'outline');
  wp.blocks.unregisterBlockStyle('core/button', 'squared');
  wp.blocks.unregisterBlockStyle('core/button', 'fill');

  // Add back styles for button sizes.
  wp.blocks.registerBlockStyle('core/button', [{
    name: 'uds-sm',
    label: 'Small',
    isDefault: false
  }]);
  wp.blocks.registerBlockStyle('core/button', [{
    name: 'uds-md',
    label: 'Medium',
    isDefault: true
  }]);
  wp.blocks.registerBlockStyle('core/button', [{
    name: '',
    label: 'Large',
    isDefault: false
  }]);

  // Register block style for core/list blocks
  wp.blocks.registerBlockStyle('core/list', [{
    name: 'uds-list',
    label: 'UDS List (Spaced)',
    isDefault: false
  }]);
  wp.blocks.registerBlockStyle('core/list', [{
    name: 'uds-steplist',
    label: 'UDS Steplist',
    isDefault: false
  }]);
  wp.blocks.registerBlockStyle('core/list', [{
    name: 'uds-steplist-maroon',
    label: 'UDS Steplist, Maroon',
    isDefault: false
  }]);
  wp.blocks.registerBlockStyle('core/list', [{
    name: 'uds-steplist-gold',
    label: 'UDS Steplist, Gold',
    isDefault: false
  }]);

  // Remove default block styles for core/image.
  // Replace with UDS-specific styles.
  wp.blocks.unregisterBlockStyle('core/image', 'default');
  wp.blocks.unregisterBlockStyle('core/image', 'rounded');
  wp.blocks.registerBlockStyle('core/image', [{
    name: 'plain',
    label: 'Plain Image',
    isDefault: true
  }]);
  wp.blocks.registerBlockStyle('core/image', [{
    name: 'uds-figure',
    label: 'Figure',
    isDefault: false
  }]);
  wp.blocks.registerBlockStyle('core/image', [{
    name: 'drop-shadow',
    label: 'Figure w/drop shadow',
    isDefault: false
  }]);
  wp.blocks.registerBlockStyle('core/image', [{
    name: 'circular',
    label: 'Circular',
    isDefault: false
  }]);

  /** Table block. Remove all styles. */
  wp.blocks.unregisterBlockStyle('core/table', 'regular');
  wp.blocks.unregisterBlockStyle('core/table', 'stripes');

  /** Separator (HR) Block. Remove/add styles. */
  wp.blocks.unregisterBlockStyle('core/separator', 'wide');
  wp.blocks.unregisterBlockStyle('core/separator', 'dots');
  wp.blocks.registerBlockStyle('core/separator', {
    name: 'copy-divider',
    label: 'Copy Divider (Gold)'
  });

  /** Post template block (within query loop). Add style for post column */
  wp.blocks.registerBlockStyle('core/post-template', [{
    name: 'post-column',
    label: 'Post Column',
    isDefault: false
  }]);
});
/******/ })()
;
//# sourceMappingURL=block-variations.js.map