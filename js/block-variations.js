/**
 * JS file to add block styles and variations to various core blocks. 
 * - core/paragraph, add lead style.
 * - core/button, add size selection, rework CSS for UDS styles.
 * - core/list, add list styles.
 */

 wp.domReady( () => {
    
    // Add .lead to core/paragraph block.
    wp.blocks.registerBlockStyle(
        'core/paragraph', [{
            name: 'lead',
            label: 'Lead',
            isDefault: false,
        }]
    );
    
    // Remove default block styles for core/button
	wp.blocks.unregisterBlockStyle( 'core/button', 'default' );
	wp.blocks.unregisterBlockStyle( 'core/button', 'outline' );
	wp.blocks.unregisterBlockStyle( 'core/button', 'squared' );
    wp.blocks.unregisterBlockStyle( 'core/button', 'fill' );

    // Add back styles for button sizes.
    wp.blocks.registerBlockStyle(
        'core/button', [{
            name: 'uds-sm',
            label: 'Small',
            isDefault: false,
        }]
    );

    wp.blocks.registerBlockStyle(
        'core/button', [{
            name: 'uds-md',
            label: 'Medium',
            isDefault: true,
        }]
    );

    wp.blocks.registerBlockStyle(
        'core/button', [{
            name: '',
            label: 'Large',
            isDefault: false,
        }]
    );

    // Register block style for core/list blocks
    wp.blocks.registerBlockStyle(
        'core/list', [{
            name: 'uds-list',
            label: 'UDS List (Spaced)',
            isDefault: false,
        }]
    );

    wp.blocks.registerBlockStyle(
        'core/list', [{
            name: 'uds-steplist',
            label: 'UDS Steplist',
            isDefault: false,
        }]
    );

    wp.blocks.registerBlockStyle(
        'core/list', [{
            name: 'uds-steplist-maroon',
            label: 'UDS Steplist, Maroon',
            isDefault: false,
        }]
    );

    wp.blocks.registerBlockStyle(
        'core/list', [{
            name: 'uds-steplist-gold',
            label: 'UDS Steplist, Gold',
            isDefault: false,
        }]
    );

});