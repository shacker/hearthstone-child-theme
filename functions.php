<?php
add_action( 'wp_enqueue_scripts', 'g5plus_child_theme_enqueue_styles', 1000 );
function g5plus_child_theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'g5plus_style' ) );
}

add_action( 'after_setup_theme', 'g5plus_child_theme_setup');
function g5plus_child_theme_setup(){
    $language_path = get_stylesheet_directory() .'/languages';
    if(is_dir($language_path)){
        load_child_theme_textdomain('g5plus-hearthstone', $language_path );
    }
}
// if you want to add some custom function
add_filter( 'auto_update_plugin', '__return_true' );

/**
 * Close comments on all static pages.
 *
 * Artist pages (children of "Our Artists") are profile pages, not blog posts,
 * but Hearthstone loads its blog comment area on any page whose comments are
 * open. That shows a "Leave a Reply" form, a log-in prompt and an Akismet
 * notice - clutter with no purpose here.
 *
 * Returning false makes the guard in the parent theme's
 * templates/content-page.php skip comments_template() entirely, so the whole
 * comment area disappears. WordPress also calls comments_open() when a
 * comment is submitted, so this blocks stray POSTs to wp-comments-post.php
 * as well. Blog posts are untouched.
 *
 * @param bool $open    Whether comments are open for this post.
 * @param int  $post_id ID of the post being checked.
 * @return bool False for pages, otherwise the original value.
 */
function gms_close_comments_on_pages( bool $open, int $post_id ): bool {
    return get_post_type( $post_id ) === 'page' ? false : $open;
}
add_filter( 'comments_open', 'gms_close_comments_on_pages', 10, 2 );
