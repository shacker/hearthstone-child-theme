# HearthStone Child Theme

A WordPress child theme for the commercial **HearthStone** parent theme by G5Plus
(tested against parent version 1.8). It powers the Gallery at Marina Square site
in Morro Bay, California.

The child theme holds all site-specific changes. The parent theme stays
unmodified, so you can update it without loss of customizations.

## Contents

| File             | Purpose                                                        |
| ---------------- | -------------------------------------------------------------- |
| `style.css`      | Theme header (WordPress needs this) and custom CSS              |
| `functions.php`  | Custom PHP: style enqueue, translations, comment control        |
| `screenshot.png` | Theme thumbnail shown in Appearance > Themes (1200x900)        |
| `.htaccess`      | Stops Apache serving dot files if the theme is a git clone      |

## Requirements

- PHP 7.0 or later (`functions.php` uses scalar type declarations)
- WordPress 4.7 or later
- The HearthStone parent theme, installed in `wp-content/themes/hearthstone/`

The child theme does not operate alone. If the parent theme is absent,
WordPress shows a "broken theme" notice.

## Installation

1. Install and activate the HearthStone parent theme first.
2. Copy this repository into `wp-content/themes/hearthstone-child/`.
   The directory name must be `hearthstone-child`.
3. In the WordPress admin, go to **Appearance > Themes** and activate
   **HearthStone Child Theme**.

To install with git:

```bash
cd wp-content/themes
git clone https://github.com/shacker/hearthstone-child-theme.git hearthstone-child
```

## What the code does

### Stylesheet load order (`functions.php`)

The child stylesheet is enqueued with a dependency on the parent handle
`g5plus_style`, at priority 1000. This makes sure the child CSS loads after
the parent CSS, so child rules win.

Add your custom CSS below the comment block at the end of `style.css`.

### Translations

If a `languages/` directory is present in the child theme, the code loads
translation files from it for the `g5plus-hearthstone` text domain. This lets
you override parent-theme strings.

### Automatic plugin updates

`add_filter( 'auto_update_plugin', '__return_true' )` turns on automatic
updates for **all** plugins. Remove this line if you want manual control of
plugin updates.

### Comments closed on static pages

`gms_close_comments_on_pages()` returns `false` from the `comments_open`
filter for all posts of type `page`. Blog posts are not changed.

Why: the parent theme shows its blog comment area on any page with open
comments. On static pages (for example, profile pages), that adds a "Leave a
Reply" form, a log-in prompt and an Akismet notice, which have no purpose
there. The filter makes the guard in the parent's
`templates/content-page.php` skip `comments_template()` completely, so the
full comment area disappears. WordPress also calls `comments_open()` when a
comment is submitted, so the filter blocks direct POSTs to
`wp-comments-post.php` as well.

To keep comments on pages, delete the function and its `add_filter()` call.

## Deployment

The theme runs in three places: a local Docker WordPress install, a staging
site and a production site. Deploy with git, or copy the files to
`wp-content/themes/hearthstone-child/` on the server. No build step is
necessary.

If you deploy by clone, the `.git` directory sits inside the web root. The
included `.htaccess` file stops Apache from serving it. On a server that does
not read `.htaccess` files (nginx, for example), add an equivalent rule to the
server configuration.

## License

GPL-2.0-or-later. See [LICENSE](LICENSE).

The parent theme is commercial software from G5Plus and is not included here.
