<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package pitchfork
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Get theme mods from the Customizer.
$image_404 = get_theme_mod( 'image_404' );
$page_type = get_theme_mod( '404_page_type' );
$custom_page_name = get_the_title( get_theme_mod( '404_page_id' ) );

if ( empty ($image_404)) {
	$image_404 = get_template_directory_uri() . '/src/img/theme/ashkan-forouzani-broken-phone-unsplash-hero_lg.jpg';
} else {
	$image_404 = wp_kses( $image_404, wp_kses_allowed_html( 'post' ) );
}

get_header();

?>
<main id="skip-to-content" <?php post_class(); ?>>
		<?php
		// if we have chosen a custom page type.
		if ( 'custom' === $page_type ) {

			// get the 404 page name from the customizer.
			$not_found_page = get_page_by_title( $custom_page_name );

			// get the blocks for the 404 page.
			$blocks = parse_blocks( $not_found_page->post_content );

			// create a var for the markup.
			$content = '';

			// loop through block.
			foreach ( $blocks as $block ) {

				// render this block into the content.
				$content .= render_block( $block );

			}

			// output the 404 page content - the blocks!
			echo $content;

		} else {
			// If we have chosen 'default' from the customizer.
			?>
			<div class="uds-hero-lg alignfull">
				<img class="hero" src="<?php echo $image_404; ?>" alt="404 - Not Found" />
				<h1 class="text-white">404 - <span class="highlight-gold">Not Found</span></h1>
				<div class="content text-white">
					<p>It looks like nothing was found at this location. Maybe try a search?</p>
					<!-- Universal search from top nav -->
					<form  class="search-form-inline" action="https://search.asu.edu/search" method="get" name="gs">
						<input class="form-control" type="search" name="q" aria-labelledby="search-404" required="">
						<label id="search-404">Search ASU</label>
						<input name="site" value="default_collection" type="hidden">
						<input name="sort" value="date:D:L:d1" type="hidden">
						<input name="output" value="xml_no_dtd" type="hidden">
						<input name="ie" value="UTF-8" type="hidden">
						<input name="oe" value="UTF-8" type="hidden">
						<input name="client" value="asu_frontend" type="hidden">
						<input name="proxystylesheet" value="asu_frontend" type="hidden">
					</form>
				</div>
			</div>
			<?php
		}
		?>

</main>
<?php
get_footer();
