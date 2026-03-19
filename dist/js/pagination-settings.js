/******/ (() => { // webpackBootstrap
/*!********************************************!*\
  !*** ./src/scripts/pagination-settings.js ***!
  \********************************************/
/**
 * Modify settings within core/pagination block.
 *
 * Strategy:
 *
 * This script customizes the editor UI for the core/query-pagination block
 * to better align with UDS design constraints. Specifically, it removes the
 * "Arrow" option from the ToggleGroupControl so that only "None" and "Chevron"
 * remain available to content editors.
 *
 * Approach:
 *
 * - Uses the `editor.BlockEdit` filter to wrap the block edit component with
 *   a Higher Order Component (HOC).
 *
 * - Runs DOM manipulation inside a `useEffect` hook so it executes after the
 *   block inspector UI has rendered.
 *
 * - Targets the specific ToggleGroupControl via semantic selectors:
 *     [role="radiogroup"][aria-label="Arrow"]
 *   rather than relying on unstable generated class names.
 *
 * - Locates the "Arrow" option using:
 *     button[data-value="arrow"]
 *   and removes its parent wrapper node to eliminate both the control and
 *   its layout footprint (avoiding empty gaps in the UI).
 *
 * - Uses a MutationObserver to re-run the cleanup whenever the editor UI updates,
 *   ensuring the modification persists across block selection changes and re-renders.
 *
 * Notes:
 *
 * - This is a UI-layer modification only; it does not alter block attributes
 *   or saved content.
 *
 * - Direct DOM manipulation is used because WordPress does not provide a
 *   granular API to remove individual options from core inspector controls.
 *
 * - Selectors are intentionally based on roles and attributes for resilience
 *   against future changes to internal component class names.
 */

(function (wp) {
  const {
    addFilter
  } = wp.hooks;
  const {
    createHigherOrderComponent
  } = wp.compose;
  const {
    createElement,
    Fragment,
    useEffect
  } = wp.element;
  const {
    select
  } = wp.data;
  const TARGET_BLOCK = 'core/query-pagination';
  function removePaginationUiBits() {
    const selected = select('core/block-editor').getSelectedBlock();
    if (!selected || selected.name !== TARGET_BLOCK) {
      return;
    }

    // Remove the "Arrow" option from the Arrow/Chevron/None control.
    const arrowGroup = document.querySelector('[role="radiogroup"][aria-label="Arrow"]');
    if (arrowGroup) {
      const arrowButton = arrowGroup.querySelector('button[role="radio"][data-value="arrow"], button[aria-label="Arrow"]');
      if (arrowButton) {
        const optionWrapper = arrowButton.closest('div');
        if (optionWrapper && optionWrapper.parentNode) {
          optionWrapper.parentNode.removeChild(optionWrapper);
        }
      }
    }

    // Remove the label visibility control entirely.
    // This is intentionally broad so it works even if core tweaks the wording.
    const possibleLabelGroups = Array.from(document.querySelectorAll('[role="radiogroup"]')).filter(group => {
      const label = (group.getAttribute('aria-label') || '').toLowerCase();
      const text = (group.textContent || '').toLowerCase();
      return label.includes('label') || label.includes('text') || text.includes('show label') || text.includes('hide label') || text.includes('display label') || text.includes('show text') || text.includes('hide text');
    });
    possibleLabelGroups.forEach(group => {
      const wrapper = group.closest('.components-base-control') || group.parentElement;
      if (wrapper && wrapper.parentNode) {
        wrapper.parentNode.removeChild(wrapper);
      }
    });
  }
  const withPaginationUiSimplified = createHigherOrderComponent(BlockEdit => props => {
    useEffect(() => {
      removePaginationUiBits();
      const observer = new MutationObserver(removePaginationUiBits);
      observer.observe(document.body, {
        childList: true,
        subtree: true
      });
      return () => observer.disconnect();
    }, []);
    return createElement(Fragment, null, createElement(BlockEdit, props));
  }, 'withPaginationUiSimplified');
  addFilter('editor.BlockEdit', 'pitchfork/query-pagination-simplify-ui', withPaginationUiSimplified);
})(window.wp);
/******/ })()
;
//# sourceMappingURL=pagination-settings.js.map