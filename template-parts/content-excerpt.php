<?php

/**
 * Template part for displaying post archives and search results
 *
 *  @package pitchfork
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('h-100'); ?>>
	<div class="card h-100 shadow-sm">
		<?php
		if (has_post_thumbnail()) :
		?>
			<a href="<?php the_permalink(); ?>" title="<?php esc_attr(the_title()); ?>">
				<?php
				the_post_thumbnail('thumbnail', array('class' => 'card-img-top h-auto'));
				?>
			</a>
		<?php
		endif;
		?>
		<div class="card-body">
			<small class="d-block text-truncate">
				<?php pitchfork_posted_on(); ?> by
				<?php pitchfork_posted_by(); ?>
			</small>
			<a href="<?php esc_url(the_permalink()); ?>" class="text-decoration-none text-body" title="<?php esc_attr(the_title()); ?>">
				<div class="card-title h5 mb-0"><?php the_title(); ?></div>
				<?php the_excerpt(); ?>
			</a>
			<?php
			pitchfork_entry_footer();
			?>
		</div>
	</div>
</article>
