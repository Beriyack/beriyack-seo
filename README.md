# beriyack-seo

🇫🇷 [Voir la version en français](./README.fr.md)

**Beriyack SEO** is a simple, lightweight, and effective WordPress plugin designed to optimize the essential technical aspects of your search engine optimization (SEO) without overloading your site.

## Features

This plugin focuses on three fundamental pillars of technical SEO:

*   **🚀 Meta Tag Management**: Automatically adds `meta description` tags, Open Graph tags (for Facebook, LinkedIn, etc.), and Twitter Cards to improve the appearance of your shares on social media.
*   **🗺️ Sitemap Integration**: Automatically declares the location of your native WordPress sitemap in the virtual `robots.txt` file, helping search engines discover your content more efficiently.
*   **🚦 Indexing Directives**: Prevents the indexing of search result pages and 404 pages by adding `noindex, nofollow` directives, which avoids duplicate or low-quality content.

## Installation

### From the WordPress.org directory (recommended method)

1.  In your WordPress dashboard, go to `Plugins > Add New`.
2.  Search for "Beriyack SEO".
3.  Click `Install Now` and then `Activate`.

### Manually

1.  Download the latest version from the Releases page of this repository.
2.  In your WordPress dashboard, go to `Plugins > Add New` and click `Upload Plugin`. Choose the `.zip` file you just downloaded and activate the plugin.

## Configuration

After activation, it is highly recommended to configure a default image.

1.  Go to `Settings > Beriyack SEO`.
2.  Upload an image that will be used as the default sharing image on social media. This image is used for your homepage, archives, and for any post or page that does not have a "Featured Image".

### Open Graph Image Logic

The plugin uses a hierarchical approach to choose the best image:
1.  **Featured Image**: If a post/page has one, it will be used first.
2.  **Default Image**: Otherwise, the image you have set in the plugin's settings will be used.

## Support

For any questions regarding the use of the plugin, please use the support forum on WordPress.org.

If you think you have found a bug or have a suggestion for improvement, feel free to open an issue on GitHub.

## Data Privacy (GDPR)

**Beriyack SEO** is privacy-friendly.

*   This plugin does not collect, track, or store any personal data from your site's visitors.
*   It does not place any cookies on users' browsers.
