<?php
/**
 * Gère la page de réglages du plugin Beriyack SEO.
 *
 * @package Beriyack_SEO
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Ajoute la page de réglages au menu d'administration.
 */
function beriyack_seo_add_settings_page() {
	add_options_page(
		'Beriyack SEO Settings',
		'Beriyack SEO',
		'manage_options',
		'beriyack-seo',
		'beriyack_seo_render_settings_page'
	);
}
add_action( 'admin_menu', 'beriyack_seo_add_settings_page' );

/**
 * Enregistre les réglages du plugin.
 */
function beriyack_seo_register_settings() {
	register_setting( 'beriyack_seo_settings_group', 'beriyack_seo_default_og_image_id', 'absint' );
	register_setting( 'beriyack_seo_settings_group', 'beriyack_seo_twitter_handle', 'beriyack_seo_sanitize_twitter_handle' );
}
add_action( 'admin_init', 'beriyack_seo_register_settings' );

/**
 * Nettoie le pseudo Twitter pour s'assurer qu'il est valide.
 *
 * @param string $input Le pseudo Twitter saisi par l'utilisateur.
 * @return string Le pseudo nettoyé.
 */
function beriyack_seo_sanitize_twitter_handle( $input ) {
	// Supprime les espaces et le @ initial pour le nettoyage.
	$input = trim( str_replace( '@', '', $input ) );
	// Ne garde que les caractères alphanumériques et les underscores.
	$input = preg_replace( '/[^a-zA-Z0-9_]/', '', $input );
	// Si après nettoyage, il reste quelque chose, on rajoute le @.
	if ( ! empty( $input ) ) {
		return '@' . $input;
	}
	return '';
}

/**
 * Charge les scripts et styles pour la page d'administration.
 *
 * @param string $hook La page d'administration actuelle.
 */
function beriyack_seo_admin_enqueue_scripts( $hook ) {
	// Ne charge le script que sur notre page de réglages.
	if ( 'settings_page_beriyack-seo' !== $hook ) {
		return;
	}

	// Charge le gestionnaire de médias de WordPress.
	wp_enqueue_media();

	// Enregistre et charge notre script d'administration.
	wp_enqueue_script(
		'beriyack-seo-admin-script',
		plugin_dir_url( dirname( __DIR__ ) ) . 'assets/js/admin.js',
		array( 'jquery' ),
		BERIYACK_SEO_VERSION,
		true     // Charger dans le pied de page.
	);

	// Passe les chaînes de texte traduisibles à notre script.
	wp_localize_script(
		'beriyack-seo-admin-script',
		'beriyack_seo_admin',
		array(
			'media_uploader_title'  => esc_js( __( 'Choisir une image Open Graph', 'beriyack-seo' ) ),
			'media_uploader_button' => esc_js( __( 'Utiliser cette image', 'beriyack-seo' ) ),
		)
	);
}
add_action( 'admin_enqueue_scripts', 'beriyack_seo_admin_enqueue_scripts' );

/**
 * Affiche le contenu de la page de réglages.
 */
function beriyack_seo_render_settings_page() {
	?>
	<div class="wrap">
		<h2><?php esc_html_e( 'Statut du système', 'beriyack-seo' ); ?></h2>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><?php esc_html_e( 'Support du thème pour la balise de titre', 'beriyack-seo' ); ?></th>
					<td>
						<?php if ( current_theme_supports( 'title-tag' ) ) : ?>
							<span style="color: #46b450; font-weight: bold;">✅ <?php esc_html_e( 'Activé', 'beriyack-seo' ); ?></span>
							<p class="description"><?php esc_html_e( 'Votre thème est compatible. La gestion des titres fonctionnera correctement.', 'beriyack-seo' ); ?></p>
						<?php else : ?>
							<span style="color: #dc3232; font-weight: bold;">❌ <?php esc_html_e( 'Désactivé', 'beriyack-seo' ); ?></span>
							<p class="description"><?php esc_html_e( 'Votre thème ne semble pas supporter la gestion des titres par WordPress. Les balises de titre pourraient ne pas être générées correctement par le plugin.', 'beriyack-seo' ); ?></p>
						<?php endif; ?>
					</td>
				</tr>
			</tbody>
		</table>
		<h1><?php esc_html_e( 'Réglages de Beriyack SEO', 'beriyack-seo' ); ?></h1>
		<form method="post" action="options.php">
			<?php settings_fields( 'beriyack_seo_settings_group' ); ?>
			<?php do_settings_sections( 'beriyack-seo' ); ?>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><?php esc_html_e( 'Image Open Graph par défaut', 'beriyack-seo' ); ?></th>
					<td>
						<div class='image-preview-wrapper'>
							<?php
							$image_id = get_option( 'beriyack_seo_default_og_image_id' );
							if ( $image_id ) {
								echo wp_get_attachment_image( $image_id, 'medium', false, array( 'id' => 'og-image-preview' ) );
							} else {
								echo '<img id="og-image-preview" src="" style="display:none; max-width: 200px; height: auto;">';
							}
							?>
						</div>
						<input type="hidden" name="beriyack_seo_default_og_image_id" id="og_image_id" value="<?php echo esc_attr( $image_id ); ?>">
						<input type="button" class="button-primary" value="<?php esc_attr_e( 'Téléverser/Choisir une image', 'beriyack-seo' ); ?>" id="upload_image_button"/>
						<input type="button" class="button" value="<?php esc_attr_e( 'Retirer l\'image', 'beriyack-seo' ); ?>" id="remove_image_button" style="<?php echo ( ! $image_id ? 'display:none;' : '' ); ?>"/>
						<p class="description"><?php esc_html_e( 'Cette image sera utilisée pour les partages sur les réseaux sociaux lorsque la page n\'a pas d\'image mise en avant. Recommandé : 1200x630 pixels.', 'beriyack-seo' ); ?></p>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="twitter_handle"><?php esc_html_e( 'Pseudo Twitter du site', 'beriyack-seo' ); ?></label></th>
					<td>
						<input type="text" id="twitter_handle" name="beriyack_seo_twitter_handle" value="<?php echo esc_attr( get_option( 'beriyack_seo_twitter_handle' ) ); ?>" class="regular-text" placeholder="@votrepseudo" />
						<p class="description"><?php esc_html_e( 'Sera utilisé pour la balise "twitter:site". Laissez vide pour ne pas l\'inclure.', 'beriyack-seo' ); ?></p>
					</td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
	<?php
}
