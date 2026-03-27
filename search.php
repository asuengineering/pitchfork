<?php
/**
 * The template for displaying search results pages
 *
 * @package pitchfork
 */

get_header();
global $wp_query;

$query       = get_search_query();
$found_posts = (int) $wp_query->found_posts;
?>

<main id="skip-to-content" class="search-results-page" aria-labelledby="search-results-title">

	<header class="page-header">
		<h1 id="search-results-title">Search results</h1>
		<p class="search-summary default-max-width lead fw-normal">
			<?php if ( have_posts() ) : ?>

				<?php
				printf(
					wp_kses(
						/* translators: 1: search query, 2: number of results */
						_n(
							'%2$d result found for %1$s.',
							'%2$d results found for %1$s.',
							$found_posts,
							'pitchfork'
						),
						array(
							'mark' => array(),
						)
					),
					'<mark>' . esc_html( $query ) . '</mark>',
					$found_posts
				);
				?>

			<?php else : ?>

				<?php
				printf(
					wp_kses(
						__( 'Sorry, but nothing matched your search terms for %1$s. Please try again with some different keywords.', 'pitchfork' ),
						array(
							'mark' => array(),
						)
					),
					'<mark>' . esc_html( $query ) . '</mark>'
				);
				?>

			<?php endif; ?>
		</p>
	</header>

	<div class="wrapper-results">
		<section class="search-results-main" aria-label="<?php esc_attr_e( 'Search results', 'pitchfork' ); ?>">
			<?php if ( have_posts() ) : ?>

				<?php
				while ( have_posts() ) {
					the_post();

					$post_type       = get_post_type();
					$post_type_obj   = get_post_type_object( $post_type );
					$post_type_label = $post_type_obj ? $post_type_obj->labels->singular_name : $post_type;

					$excerpt_source = has_excerpt() ? get_the_excerpt() : wp_strip_all_tags( get_the_content( null, false ) );
					$excerpt        = wp_trim_words( $excerpt_source, 42, '…' );
					?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( 'search-result' ); ?>>
						<header class="search-result-header">
							<h2 class="search-result-title h3">
								<a class="search-result-link" href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</h2>
							<p class="search-result-meta small">
								<?php echo esc_html( $post_type_label ); ?>
								<span aria-hidden="true"> &bull; </span>
								<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
									<?php echo esc_html( get_the_date() ); ?>
								</time>
							</p>
						</header>

						<div class="search-result-excerpt">
							<p><?php echo esc_html( $excerpt ); ?></p>
						</div>
					</article>

					<?php
				}
				?>

				<footer class="results-footer">
					<?php pitchfork_pagination(); ?>
				</footer>

			<?php else : ?>

				<?php get_search_form(); ?>

			<?php endif; ?>
		</section>

		<aside class="search-results-sidebar" aria-label="<?php esc_attr_e( 'Search sidebar', 'pitchfork' ); ?>">
			<section class="search-sidebar-section">
				<h3 class="search-sidebar-title">Page list</h3>
				<p>Still searching? Browse this alphabetical page list:</p>

				<nav aria-label="<?php esc_attr_e( 'Page sitemap', 'pitchfork' ); ?>">
					<ul class="page-sitemap">
						<?php
						wp_list_pages(
							array(
								'title_li'    => '',
								'echo'        => true,
								'depth'       => 0,
								'sort_column' => 'menu_order,post_title',
							)
						);
						?>
					</ul>
				</nav>
			</section>
		</aside>
	</div>

</main>

<?php
get_footer();
