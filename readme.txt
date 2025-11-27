=== Beriyack SEO ===
Contributors: beriyack
Donate link: https://www.buymeacoffee.com/beriyack
Tags: seo, meta, open graph, sitemap, robots
Requires at least: 5.0
Tested up to: 6.8
Stable tag: 1.1.0
Requires PHP: 7.4
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

A lightweight SEO plugin to manage meta tags, sitemap integration, and indexing directives for better SEO.

== Description ==

**Beriyack SEO** is a simple and effective WordPress plugin designed to optimize the essential technical aspects of your search engine optimization (SEO). It focuses on three fundamental pillars without overloading your site:

*   **Meta Tag Management**: Automatically adds `meta description` tags, Open Graph tags (for Facebook, LinkedIn, etc.), and Twitter Cards to improve the appearance of your shares on social media.
*   **Sitemap Integration**: Automatically declares the location of your native WordPress sitemap in the virtual `robots.txt` file, helping search engines discover your content more efficiently.
*   **Indexing Directives**: Prevents the indexing of search result pages and 404 pages, which are considered low-quality content by search engines, by adding `noindex, nofollow` directives.

This plugin is ideal for site owners who want a lightweight solution to cover the basics of technical SEO without needing the complex features of larger SEO suites.

== Installation ==

1.  In your WordPress dashboard, go to `Plugins > Add New`.
2.  Search for "Beriyack SEO".
3.  Click `Install Now` and then `Activate`.
4.  (Optional but recommended) Go to `Settings > Beriyack SEO` to set a default image.

You can also install the plugin manually by uploading the plugin folder to the `/wp-content/plugins/` directory.

== Frequently Asked Questions ==

= How does image management for social media work? =

The plugin follows a simple logic: for a post or page, it uses the **featured image**. If no featured image is set, or for any other page (homepage, archives, etc.), it will use the **default image** that you can configure in the plugin's settings page (`Settings > Beriyack SEO`).

= Does this plugin replace Yoast SEO or Rank Math? =

No. Beriyack SEO is designed to be a very lightweight solution that handles a few specific technical optimizations. It does not offer content analysis, keyword management, or other advanced features found in comprehensive SEO suites.

= How does the plugin handle the author's name and Twitter handle? =

The `meta name="author"` tag uses the display name of the post's author. On other pages, it uses the site name. The `twitter:site` tag uses the handle you can enter in the plugin's settings page. If the field is left empty, the tag is not added.

= Can I customize the default Open Graph image? =

Yes. You can upload a default image directly from the WordPress admin, by going to the `Settings > Beriyack SEO` menu. This approach makes the plugin independent of your theme.

== Confidentialité ==

This plugin does not collect or store any personal data from your site's visitors. All information managed by this plugin is retrieved from your existing WordPress database or configured by the site administrator.

== Screenshots ==

1. The simple and clear settings page of the plugin.

== Changelog ==

= 1.1.0 =
* Improvement: The description generation logic is now more robust and covers all cases (empty pages, archives without descriptions, etc.).
* Improvement: Code simplification by using `get_the_excerpt()` for post descriptions.
* Fix: The image upload button in the settings now works correctly.
* Fix: Meta tags are now displayed reliably, even if some information (like the tagline) is missing.
* Fix: The `author` tag is now independent of the `description` tag.
* Fix: HTML is correctly stripped from category descriptions.
* Fix: Use of modern syntax for `term_description()` to remove the deprecated parameter warning.

= 1.0.2 =
* Security: Strengthened sanitization of `$_SERVER['REQUEST_URI']` to satisfy static analysis.

= 1.0.1 =
* Fix: Resolved warnings and errors from the WordPress.org Plugin Check (security, code standards, number of tags).

= 1.0.0 =
* Initial release of the plugin.
* Added meta tags (description, Open Graph, Twitter Cards).
* Added sitemap to robots.txt file.
* Added noindex/nofollow directives for search and 404 pages.

== Upgrade Notice ==

= 1.0.0 =
This is the first version of the plugin. No upgrade is necessary.
