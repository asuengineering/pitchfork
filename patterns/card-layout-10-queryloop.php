<?php
/**
 * Title: Card Layout: 3 Across with Query Loop
 * Slug: pitchfork/card-queryloop
 * Categories: pitchfork-card-layouts
 * Block Types: core
 */
?>

<!-- wp:query {"queryId":0,"query":{"perPage":"3","pages":"1","offset":"0","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"layout":{"type":"default"}} -->
<div class="wp-block-query"><!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
<!-- wp:acf/card-v2 {"name":"acf/card-v2","data":{"uds_card2_orientation":"vertical","_uds_card2_orientation":"field_6605e470e79dc"},"mode":"preview","className":"is-style-card-story"} -->
<!-- wp:post-featured-image {"aspectRatio":"3/2"} /-->

<!-- wp:acf/card-v2-header {"name":"acf/card-v2-header","mode":"preview"} -->
<!-- wp:post-title {"level":3} /-->
<!-- /wp:acf/card-v2-header -->

<!-- wp:group {"metadata":{"name":"Card Content"}} -->
<div class="wp-block-group"><!-- wp:post-excerpt {"moreText":"Read more","excerptLength":60} /--></div>
<!-- /wp:group -->

<!-- wp:post-terms {"term":"category","separator":""} /-->
<!-- /wp:acf/card-v2 -->
<!-- /wp:post-template -->

<!-- wp:query-no-results -->
<!-- wp:acf/alert {"name":"acf/alert","data":{"uds_alert_dismissible":"0","_uds_alert_dismissible":"field_62852d5dfca50"},"mode":"preview","className":"is-style-alert-info"} -->
<!-- wp:paragraph -->
<p>No posts were found based on the query provided.</p>
<!-- /wp:paragraph -->
<!-- /wp:acf/alert -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query -->
