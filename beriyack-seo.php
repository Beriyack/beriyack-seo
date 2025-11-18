<?php
/**
 * Plugin Name:       Beriyack SEO
 * Description:       Plugin SEO de base pour le site Beriyack. Gère les optimisations techniques : balises meta, intégration du sitemap et directives d'indexation.
 * Version:           1.0.2
 * Plugin URI:        https://github.com/Beriyack/beriyack-seo
 * Author:            Beriyack
 * Author URI:        https://x.com/Beriyack
 * License:           GPLv3 or later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       beriyack-seo
 * Requires at least: 5.0
 * Tested up to:      6.8
 * Requires PHP:      7.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Initialise les réglages du plugin.
require_once plugin_dir_path( __FILE__ ) . 'includes/settings.php';


/**
 * Ajoute les balises meta (description, Open Graph, Twitter Cards) dynamiquement.
 */
function beriyack_seo_add_meta_tags() {
	// Utilise la méthode moderne de WordPress pour récupérer le titre final de la page.
	// Cela garantit la cohérence avec la balise <title> et les autres plugins SEO.
	$title       = wp_get_document_title();
	$description = '';
	$url         = '';

	// Logique d'image hiérarchique : Image mise en avant > Image par défaut du plugin.
	$default_image_id  = get_option( 'beriyack_seo_default_og_image_id' );
	$image_url         = $default_image_id ? wp_get_attachment_image_url( $default_image_id, 'full' ) : '';
	$image_alt   = '';
	$author_name = get_bloginfo( 'name' ); // Auteur par défaut : le nom du site.
	$type        = 'website';

	if ( is_front_page() ) {
		$description = get_bloginfo( 'description', 'display' );
		$url         = home_url( '/' );
	} elseif ( is_home() ) {
		/* translators: %s: Site name. */
		$description = sprintf( esc_html__( 'Retrouvez les derniers articles et actualités de %s.', 'beriyack-seo' ), get_bloginfo( 'name' ) );
		$url         = get_post_type_archive_link( 'post' );
	} elseif ( is_singular() ) {
		$post        = get_queried_object();
		$type        = 'article';
		$url         = get_permalink( $post );
		$description = wp_strip_all_tags( get_the_excerpt( $post ) );
		$author_name = get_the_author_meta( 'display_name', $post->post_author ); // Auteur de l'article.
		if ( has_post_thumbnail( $post->ID ) ) {
			$image_url = get_the_post_thumbnail_url( $post->ID, 'large' ); // 'large' est souvent un meilleur compromis que 'full'.
			$image_alt = get_post_meta( get_post_thumbnail_id( $post->ID ), '_wp_attachment_image_alt', true );
		} elseif ( ! $image_url ) {
			// Si aucune image mise en avant et aucune image par défaut, on ne met pas de balise image.
		}
	} elseif ( is_category() || is_tag() || is_tax() ) {
		$term        = get_queried_object();
		$url         = get_term_link( $term );
		$description = term_description( $term->term_id );
		// Ajoute un lien vers le sitemap des taxonomies pour un meilleur SEO
		if ( function_exists( 'wp_get_sitemap_providers' ) ) {
			$sitemap_url = get_sitemap_url( $term->taxonomy );
			if ( $sitemap_url ) {
				echo '<link rel="sitemap" type="application/xml" title="' . esc_attr( 'Sitemap ' . $term->taxonomy ) . '" href="' . esc_url( $sitemap_url ) . '" />' . "\n";
			}
		}
	} elseif ( is_post_type_archive( 'post' ) ) {
		$description = get_bloginfo( 'description' );
		$url         = get_post_type_archive_link( 'post' );
		$type        = 'website';
	} elseif ( is_author() ) {
		$author      = get_queried_object();
		$description = get_the_author_meta( 'description', $author->ID );
		$url         = get_author_posts_url( $author->ID );
	} elseif ( is_search() ) {
		$search_query = get_search_query();
		/* translators: 1: search query, 2: site name */
		$description = sprintf( esc_html__( 'Résultats de la recherche pour "%1$s" sur le blog de %2$s.', 'beriyack-seo' ), $search_query, get_bloginfo( 'name' ) );
		$url         = get_search_link( $search_query );
	} elseif ( is_404() ) {
		$description = esc_html__( 'La page que vous recherchez semble introuvable.', 'beriyack-seo' );
		$url         = home_url( isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '' );
		$type        = 'website';
	}

	// Nettoyage de la description
	$description = trim( preg_replace( '/\s+/', ' ', $description ) );

	if ( ! empty( $description ) ) {
		// Balises standard
		echo '<meta name="author" content="' . esc_attr( $author_name ) . '" />' . "\n";
		echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";

		// Balises Open Graph (Facebook, LinkedIn, etc.)
		echo '<meta property="og:title" content="' . esc_attr( $title ) . '" />' . "\n";
		echo '<meta property="og:description" content="' . esc_attr( $description ) . '" />' . "\n";
		echo '<meta property="og:url" content="' . esc_url( $url ) . '" />' . "\n";
		echo '<meta property="og:locale" content="' . esc_attr( get_locale() ) . '" />' . "\n";
		echo '<meta property="og:type" content="' . esc_attr( $type ) . '" />' . "\n";
		echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '" />' . "\n";
		if ( ! empty( $image_url ) ) {
			echo '<meta property="og:image" content="' . esc_url( $image_url ) . '" />' . "\n";
		}

		// Balises Twitter Card
		$twitter_handle = get_option( 'beriyack_seo_twitter_handle' );
		echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
		if ( ! empty( $twitter_handle ) ) {
			echo '<meta name="twitter:site" content="' . esc_attr( $twitter_handle ) . '" />' . "\n";
		}
		echo '<meta name="twitter:title" content="' . esc_attr( $title ) . '" />' . "\n";
		echo '<meta name="twitter:description" content="' . esc_attr( $description ) . '" />' . "\n";
		if ( ! empty( $image_url ) ) {
			echo '<meta name="twitter:image" content="' . esc_url( $image_url ) . '" />' . "\n";
		}
		if ( ! empty( $image_alt ) ) {
			echo '<meta name="twitter:image:alt" content="' . esc_attr( $image_alt ) . '" />' . "\n";
		}
	}
}
add_action( 'wp_head', 'beriyack_seo_add_meta_tags' );

/**
 * Ajoute le sitemap natif de WordPress au fichier robots.txt virtuel.
 *
 * @param string $output Le contenu du fichier robots.txt.
 * @return string Le contenu modifié du fichier robots.txt.
 */
function beriyack_seo_add_sitemap_to_robots( $output ) {
	$output .= 'Sitemap: ' . esc_url( get_sitemap_url() ) . "\n";
	return $output;
}
add_filter( 'robots_txt', 'beriyack_seo_add_sitemap_to_robots', 10, 1 );

/**
 * Gère les directives de la balise meta robots via le filtre natif de WordPress.
 *
 * @param array $robots Les directives robots existantes.
 * @return array Les directives robots modifiées.
 */
function beriyack_seo_manage_robots_tag( $robots ) {
	// Pour les pages de recherche et les pages 404, on s'assure qu'elles ne sont pas indexées.
	if ( is_search() || is_404() ) {
		$robots['noindex']  = true;
		$robots['nofollow'] = true;
	}
	return $robots;
}
add_filter( 'wp_robots', 'beriyack_seo_manage_robots_tag' );

/**
 * Ajoute un lien vers la page de réglages directement sur la page des plugins.
 *
 * @param array $links Les liens d'action existants.
 * @return array Les liens d'action modifiés.
 */
function beriyack_seo_add_settings_link( $links ) {
	$settings_link = '<a href="' . admin_url( 'options-general.php?page=beriyack-seo' ) . '">' . __( 'Réglages', 'beriyack-seo' ) . '</a>';
	array_unshift( $links, $settings_link );
	return $links;
}

// On s'assure que le nom du fichier est correct pour le hook.
$beriyack_seo_plugin_basename = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_{$beriyack_seo_plugin_basename}", 'beriyack_seo_add_settings_link' );
