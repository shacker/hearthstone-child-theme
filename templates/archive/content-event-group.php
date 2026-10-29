<?php
/**
 * Homepage "Featured Events" row: the next four events from
 * The Events Calendar that haven't ended yet, soonest first.
 *
 * Mirrors the markup of the parent's content-category-group.php (first item
 * large, the rest small grid) so the theme CSS styles it identically, but
 * shows each event's date rather than its publish date. The extra "post" class
 * lets the site's Additional CSS (.home article.post) style the cards too.
 *
 * Prints nothing if the plugin is inactive or there are no upcoming events.
 */
if ( ! function_exists( 'tribe_get_events' ) ) {
	return;
}

$gms_events = tribe_get_events( array(
	'posts_per_page' => 4,
	'ends_after'     => 'now', // Include events already in progress.
	'orderby'        => 'event_date',
	'order'          => 'ASC',
) );

if ( empty( $gms_events ) ) {
	return;
}
?>
<div class="post-category-wrap post-category-events">
	<h4 class="p-font">
		<a href="<?php echo esc_url( tribe_get_events_link() ); ?>"><?php esc_html_e( 'Featured Events', 'hearthstone' ); ?></a>
	</h4>
	<div class="post-category-inner clearfix">
		<?php foreach ( $gms_events as $index => $post ) :
			setup_postdata( $GLOBALS['post'] = $post ); ?>
			<?php if ( 0 === $index ) : ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'post post-default post-large-image clearfix' ); ?>>
					<div class="entry-top text-center">
						<a href="<?php the_permalink(); ?>" class="entry-meta-date s-font s-color"><?php echo wp_strip_all_tags( tribe_events_event_schedule_details( $post ) ); ?></a>
						<h3 class="entry-post-title p-font"><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					</div>
					<?php g5plus_get_post_thumbnail( 'large-image', 1 ); ?>
					<div class="entry-content-wrap">
						<div class="entry-excerpt"><?php the_excerpt(); ?></div>
					</div>
				</article>
			<?php else : ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'post post-default post-s-grid clearfix' ); ?>>
					<?php g5plus_get_post_thumbnail( 's-grid', 0 ); ?>
					<div class="entry-content-wrap">
						<h3 class="entry-post-title p-font"><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="entry-post-meta layout-5">
							<div class="entry-meta-date"><a href="<?php the_permalink(); ?>" class="s-font s-color"><?php echo esc_html( tribe_get_start_date( $post, false ) ); ?></a></div>
						</div>
					</div>
				</article>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>
<?php wp_reset_postdata(); ?>
