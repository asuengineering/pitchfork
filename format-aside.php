<?php
/**
 *
 * Template partial for 'aside' posts.
 * Removes post title from promenent display, provides an alternate display for short content.
 *
 * @package pitchfork
 */
?>

			<header class="entry-header">
				<?php
				$categories = get_the_category();
				echo '<h3 class="entry-category">Posted in: <span class="highlight-gold">' . $categories[0]->name . '</span></h3>';
				?>

			</header>

			<div class="content-wrap">

				<section class="content">
					<?php the_content(); ?>
				</section>

				<aside class="secondary">
					<div class="sidebar-wrap">

						<div class="post-meta">


							<div class="entry-byline">
								<h4><span class="highlight-black">Posted on</span></h4>
								<p><?php pitchfork_posted_originally(); ?></p>
							</div>


							<?php
							// Echo different footer elements based on post format.
							// Standard posts (long form) get tags.
							// Category list as button-tags from the card spec.
							$tags = get_the_tags();
							$taglist = '';
							if ( ! empty( $tags ) ) {
								$taglist = '<div class="tag-list"><h4><span class="highlight-black">Tags</span></h4>';
								$taglist .= '<ul>';
								foreach( $tags as $tag ) {
									$taglist .= '<li><a class="btn btn-tag btn-tag-alt-white" href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a></li>';
								}
								$taglist .= '</ul></div>';
							}
							echo $taglist;

							?>

							<?php
							/**
							 * Social share intent icons.
							 * @since v2.1 - Provides preferred support for AddToAny in this sidebar location.
							 * AddToAny mirrors service used by ASU News.
							 */

							if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) {
								ADDTOANY_SHARE_SAVE_KIT();
							}
							?>

							<?php
							// Aside posts get post navigation elements as tags are less likely to be used.
							pitchfork_the_post_navigation();
							?>

						</div>
					</div>
				</aside>
			</div>
