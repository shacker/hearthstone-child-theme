<?php
/**
 * Child override of the homepage "Category Group" row.
 *
 * The parent theme's templates/archive.php includes this file once per
 * category (Customizer > Home Page > Narrow Category). We use the first call
 * to print the Featured Events row above the category rows, then hand off
 * to the parent's unmodified template for the category itself.
 *
 * @var WP_Category $category Set by g5plus_get_template() in archive.php.
 */
// did_action() counts calls per request; a `static` flag would reset on
// every include, since this file is re-included for each category.
if ( ! did_action( 'gms_featured_events_row' ) ) {
	do_action( 'gms_featured_events_row' );
	g5plus_get_template( 'archive/content-event-group' );
}

include get_template_directory() . '/templates/archive/content-category-group.php';
