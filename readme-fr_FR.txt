=== Beriyack SEO ===
Contributors: beriyack
Tags: seo, meta, open graph, sitemap, robots
Requires at least: 5.0
Tested up to: 6.8
Stable tag: 1.1.2
Requires PHP: 7.4
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Plugin SEO léger pour gérer les balises meta, l'intégration du sitemap et les directives d'indexation pour un meilleur référencement.

== Description ==

**Beriyack SEO** est un plugin WordPress simple et efficace conçu pour optimiser les aspects techniques essentiels de votre référencement naturel (SEO). Il se concentre sur trois piliers fondamentaux sans surcharger votre site :

*   **Gestion des balises Meta** : Ajoute automatiquement les balises `meta description`, les balises Open Graph (pour Facebook, LinkedIn...) et les Twitter Cards pour améliorer l'apparence de vos partages sur les réseaux sociaux.
*   **Intégration du Sitemap** : Déclare automatiquement l'emplacement de votre sitemap natif WordPress dans le fichier `robots.txt` virtuel, aidant les moteurs de recherche à découvrir votre contenu plus efficacement.
*   **Directives d'indexation** : Empêche l'indexation des pages de résultats de recherche et des pages 404, qui sont considérées comme du contenu de faible qualité par les moteurs de recherche, en ajoutant les directives `noindex, nofollow`.

Ce plugin est idéal pour les propriétaires de sites qui souhaitent une solution légère pour couvrir les bases du SEO technique sans avoir besoin des fonctionnalités complexes des plus grosses suites SEO.

== Installation ==

1.  Dans votre tableau de bord WordPress, allez dans `Extensions > Ajouter`.
2.  Recherchez "Beriyack SEO".
3.  Cliquez sur `Installer maintenant` puis sur `Activer`.
4.  (Optionnel mais recommandé) Allez dans `Réglages > Beriyack SEO` pour définir une image par défaut.

Vous pouvez également installer le plugin manuellement en téléversant le dossier du plugin dans le répertoire `/wp-content/plugins/`.

== Frequently Asked Questions ==

= Comment fonctionne la gestion de l'image pour les réseaux sociaux ? =

Le plugin suit une logique simple : pour un article ou une page, il utilise l'**image mise en avant**. Si aucune image mise en avant n'est définie, ou pour toute autre page (accueil, archives...), il utilisera l'**image par défaut** que vous pouvez configurer dans la page de réglages du plugin (`Réglages > Beriyack SEO`).

= Ce plugin remplace-t-il Yoast SEO ou Rank Math ? =

Non. Beriyack SEO est conçu pour être une solution très légère qui gère quelques optimisations techniques spécifiques. Il ne propose pas d'analyse de contenu, de gestion de mots-clés ou d'autres fonctionnalités avancées présentes dans les suites SEO complètes.

= Comment le plugin gère-t-il le nom de l'auteur et le pseudo Twitter ? =

La balise `meta name="author"` utilise le nom d'affichage de l'auteur de l'article. Sur les autres pages, elle utilise le nom du site. La balise `twitter:site` utilise le pseudo que vous pouvez renseigner dans la page de réglages du plugin. Si le champ est laissé vide, la balise n'est pas ajoutée.

= Puis-je personnaliser l'image Open Graph par défaut ? =

Oui. Vous pouvez téléverser une image par défaut directement depuis l'administration de WordPress, en allant dans le menu `Réglages > Beriyack SEO`. Cette approche rend le plugin indépendant de votre thème.

== Confidentialité ==

Ce plugin ne collecte et ne stocke aucune donnée personnelle des visiteurs de votre site. Toutes les informations gérées par ce plugin sont récupérées depuis votre base de données WordPress existante ou configurées par l'administrateur du site.

== Screenshots ==

1. La page de réglages simple et claire du plugin.

== Changelog ==

= 1.1.2 =
* Ajout d'un lien "Réglages" sur la page des plugins pour un accès plus facile.

= 1.1.0 =
* Amélioration : La logique de génération de la description est maintenant plus robuste et couvre tous les cas (pages vides, archives sans description, etc.).
* Amélioration : Simplification du code en utilisant `get_the_excerpt()` pour la description des articles.
* Correction : Le bouton de téléversement d'image dans les réglages fonctionne désormais correctement.
* Correction : Les balises meta s'affichent maintenant de manière fiable, même si certaines informations (comme le slogan) sont manquantes.
* Correction : La balise `author` est maintenant indépendante de la balise `description`.
* Correction : Le HTML est correctement retiré des descriptions de catégories.
* Correction : Utilisation de la syntaxe moderne pour `term_description()` afin de supprimer l'avertissement de paramètre déprécié.

= 1.0.2 =
* Sécurité : Renforcement de la sanitization de `$_SERVER['REQUEST_URI']` pour satisfaire l'analyse statique.

= 1.0.1 =
* Correction : Résolution des avertissements et erreurs du Plugin Check de WordPress.org (sécurité, standards de code, nombre de tags).

= 1.0.0 =
* Lancement initial du plugin.
* Ajout des balises meta (description, Open Graph, Twitter Cards).
* Ajout du sitemap au fichier robots.txt.
* Ajout des directives noindex/nofollow pour les pages de recherche et 404.

== Upgrade Notice ==

= 1.0.0 =
Ceci est la première version du plugin. Aucune mise à jour nécessaire.
