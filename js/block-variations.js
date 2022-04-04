/**
 * JS file to add block styles and variations to various core blocks. 
 * - core/paragraph, add lead style.
 * - core/button, add size selection, rework CSS for UDS styles.
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
    
    // Remove default block styles for core/block
	wp.blocks.unregisterBlockStyle( 'core/button', 'default' );
	wp.blocks.unregisterBlockStyle( 'core/button', 'outline' );
	wp.blocks.unregisterBlockStyle( 'core/button', 'squared' );
    wp.blocks.unregisterBlockStyle( 'core/button', 'fill' );

    // Add back styles for sizes.
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
            name: 'uds-lg',
            label: 'Large',
            isDefault: false,
        }]
    );

});