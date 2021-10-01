<header id="masthead" class="site-header bg-primary shadow" role="banner">
	<nav class="container navbar navbar-dark navbar-expand-md">

		<a class="navbar-brand fw-bold m-0 p-0 text-truncate" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
			<?php if ( get_header_image() ) : ?>
				<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
			<?php endif; ?>
			<?php if ( ! get_header_image() ) : ?>
				<?php bloginfo( 'name' ); ?>
			<?php endif; ?>
		</a>

		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'depth' => 2,
				'container' => 'div',
				'container_id' => 'mainNav',
				'container_class' => 'collapse navbar-collapse',
				'menu_id' => false,
				'menu_class' => 'nav navbar-nav ms-auto',
				'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
				'walker' => new Bootstrap_Walker_Nav_Menu(),
			)
		);
		?>

	</nav>
</header>
