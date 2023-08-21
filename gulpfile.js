const gulp = require('gulp');

// Require GulpWP and pass your local `gulp` instance to it
const gulpWP = require('gulp-wp')(gulp);

/**
 * Copy assets from node_modules.
 * Run: gulp upboot
 *
 * Does the following:
 * 1. Copies files from bootstrap4-theme to various places within /src
 * 2. Copies files from component-cookie-consent to /src
 * 3. Copies files from component-header to /src
 * 4. Copies files from component-footer to /src
 *
 */

gulp.task("upboot", function (done) {

	var paths = {
		"node": "./node_modules",
		"dev": "./src",
	}

	/** ----------------------------------------------------------
	Part 1. Assembling the assets for UDS Bootstrap design kit.
	------------------------------------------------------------- */
	// Copy UDS SCSS files from the node /src folder.
	gulp
		.src(paths.node + "/@asu/unity-bootstrap-theme/src/scss/**/*.scss")
		.pipe(gulp.dest(paths.dev + "/unity-bootstrap-theme"));

	// Compiling the Unity Design kit source requires the orig Bootstrap files to be present at /bootstrap/sass.
	gulp
		.src(paths.node + "/bootstrap/scss/**/*.*")
		.pipe(gulp.dest(paths.dev + "/unity-bootstrap-theme/bootstrap/scss"));

	// Copy UDS image files to /img at root level.
	// Accomodates default setting for image paths from shipped Bootstrap CSS.
	gulp
		.src(paths.node + "/@asu/unity-bootstrap-theme/dist/img/**/*")
		.pipe(gulp.dest(paths.dev + "/unity-bootstrap-theme/img"));

	// Copy distributed JS packages from Bootstrap (co-located within the ASU Bootstrap-4 theme).
	gulp
		.src(paths.node + "/@asu/unity-bootstrap-theme/dist/js/*.js")
		.pipe(gulp.dest(paths.dev + "/unity-bootstrap-theme/js"));


	/** ----------------------------------------------------------
	Part 2. Copy additional asu package assets for use within the theme.
	------------------------------------------------------------- */

	// UDS cookie-consent JS files
	gulp
		.src(paths.node + "/@asu/component-cookie-consent/dist/*.js")
		.pipe(gulp.dest(paths.dev + "/component-cookie-consent/js"));

	// UDS component-header JS files
	gulp
		.src(paths.node + "/@asu/component-header/dist/**/*")
		.pipe(gulp.dest(paths.dev + "/component-header/js"));

	// UDS component-footer JS files
	gulp
		.src(paths.node + "/@asu/component-footer/dist/**/*")
		.pipe(gulp.dest(paths.dev + "/component-footer/js"));

	done();
});
