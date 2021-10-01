<?php

/**
 * The template for displaying comments
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @package pitchfork
 */

if (post_password_required()) :
	return;
endif;

$byvex_comment_count = get_comments_number();
?>

<div id="comments" class="comments-area">

	<?php
	if (have_comments()) :;
	?>
		<h3 class="comments-title">
			<?php if ('1' === $byvex_comment_count) : ?>
				<?php esc_html_e('1 comment', 'byvex'); ?>
			<?php else : ?>
				<?php
				printf(
					/* translators: %s: Comment count number. */
					esc_html(_nx('%s comment', '%s comments', $byvex_comment_count, 'Comments title', 'byvex')),
					esc_html(number_format_i18n($byvex_comment_count))
				);
				?>
			<?php endif; ?>
		</h3><!-- .comments-title -->

		<ol class="comment-list list-unstyled">
			<?php
			wp_list_comments(
				array(
					'avatar_size' => 45,
					'style'       => 'ol',
					'short_ping'  => true,
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		if (!comments_open()) : ?>
			<div class="alert alert-danger">
				<p class="no-comments fw-bold"><?php esc_html_e('Comments are closed.', 'byvex'); ?></p>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<div class="row">
		<div class="col-md-6">
			<?php
			comment_form(
				array(
					'logged_in_as'       => null,
					'title_reply'        => esc_html__('Leave a comment', 'byvex'),
					'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
					'title_reply_after'  => '</h2>',
				)
			);
			?>
		</div>
	</div>

</div><!-- #comments -->
