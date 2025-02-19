<?php
/**
 * Title: Story + Thumb Query Loop
 * Slug: pitchfork/loop-15-story-thumb-row
 * Categories: pitchfork-loops
 * Block Types: core
 */
?>

<!-- wp:query {"queryId":0,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"taxQuery":{"category":[]},"parents":[],"format":[]}} -->
<div class="wp-block-query"><!-- wp:post-template {"className":"is-style-default"} -->
<!-- wp:group {"metadata":{"name":"Story + Thumb (Row)","categories":["pitchfork-content"],"patternName":"pitchfork/content-story-thumb-row"},"className":"story-thumb","style":{"spacing":{"margin":{"top":"var:preset|spacing|uds-size-4","bottom":"var:preset|spacing|uds-size-4"}}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"}} -->
<div class="wp-block-group story-thumb" style="margin-top:var(--wp--preset--spacing--uds-size-4);margin-bottom:var(--wp--preset--spacing--uds-size-4)"><!-- wp:post-featured-image {"aspectRatio":"16/9","width":"","style":{"layout":{"selfStretch":"fixed","flexSize":"150px"}}} /-->

<!-- wp:group {"metadata":{"name":"Story (Group)"},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:post-title {"level":3,"isLink":true} /-->

<!-- wp:post-excerpt {"showMoreOnNewLine":false,"style":{"spacing":{"margin":{"top":"var:preset|spacing|uds-size-1"}}}} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query -->
