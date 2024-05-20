<?php
/**
 * Title: Card Layout: 2 Across
 * Slug: pitchfork/cards-two-across
 * Categories: pitchfork-card-layouts
 * Block Types: core
 */
?>

<!-- wp:heading {"style":{"spacing":{"margin":{"top":"var:preset|spacing|uds-size-4","bottom":"var:preset|spacing|uds-size-2"}}}} -->
<h2 class="wp-block-heading" style="margin-top:var(--wp--preset--spacing--uds-size-4);margin-bottom:var(--wp--preset--spacing--uds-size-2)"><span class="highlight-gold">Two cards</span> in columns</h2>
<!-- /wp:heading -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:acf/card-v2 {"name":"acf/card-v2","data":{"field_6605e470e79dc":"vertical"},"mode":"preview"} -->
<!-- wp:acf/card-v2-image {"name":"acf/card-v2-image","data":{"field_6622a98c9a652":""},"mode":"preview","lock":{"move":true,"remove":false}} /-->

<!-- wp:acf/card-v2-header {"name":"acf/card-v2-header","mode":"preview","lock":{"move":true,"remove":true}} -->
<!-- wp:heading {"level":3,"placeholder":"Card title"} -->
<h3 class="wp-block-heading">First card title</h3>
<!-- /wp:heading -->
<!-- /wp:acf/card-v2-header -->

<!-- wp:group {"lock":{"move":true,"remove":true},"metadata":{"name":"Card Content"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"placeholder":"Card body copy goes here."} -->
<p>Standard cards might include buttons instead of a card link. But the single CTA button at the end of the layout takes card of that for us.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:acf/card-v2-links {"name":"acf/card-v2-links","data":{},"mode":"preview"} -->
<!-- wp:acf/card-v2-link {"name":"acf/card-v2-link","data":{"field_66196d5510128":{"title":"Search for something","url":"https://google.com","target":""}},"mode":"preview"} /-->
<!-- /wp:acf/card-v2-links -->
<!-- /wp:acf/card-v2 --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:acf/card-v2 {"name":"acf/card-v2","data":{"field_6605e470e79dc":"vertical"},"mode":"preview"} -->
<!-- wp:acf/card-v2-image {"name":"acf/card-v2-image","data":{"field_6622a98c9a652":""},"mode":"preview","lock":{"move":true,"remove":false}} /-->

<!-- wp:acf/card-v2-header {"name":"acf/card-v2-header","mode":"preview","lock":{"move":true,"remove":true}} -->
<!-- wp:heading {"level":3,"placeholder":"Card title"} -->
<h3 class="wp-block-heading">Second card title</h3>
<!-- /wp:heading -->
<!-- /wp:acf/card-v2-header -->

<!-- wp:group {"lock":{"move":true,"remove":true},"metadata":{"name":"Card Content"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"placeholder":"Card body copy goes here."} -->
<p>Standard cards might include buttons instead of a card link. But the single CTA button at the end of the layout takes card of that for us.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:acf/card-v2-links {"name":"acf/card-v2-links","data":{},"mode":"preview"} -->
<!-- wp:acf/card-v2-link {"name":"acf/card-v2-link","data":{"field_66196d5510128":{"title":"Search for something","url":"https://google.com","target":""}},"mode":"preview"} /-->
<!-- /wp:acf/card-v2-links -->
<!-- /wp:acf/card-v2 --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"right"},"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|uds-size-6"}}}} -->
<div class="wp-block-buttons" style="margin-bottom:var(--wp--preset--spacing--uds-size-6)"><!-- wp:button {"backgroundColor":"asu-maroon","metadata":{"name":"CTA: Card Section"},"className":"is-style-"} -->
<div class="wp-block-button is-style-"><a class="wp-block-button__link has-asu-maroon-background-color has-background wp-element-button">Call to action</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
