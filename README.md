# beriyack-seo

**Beriyack SEO** est un plugin WordPress simple, léger et efficace conçu pour optimiser les aspects techniques essentiels de votre référencement naturel (SEO) sans surcharger votre site.

## Fonctionnalités

Ce plugin se concentre sur trois piliers fondamentaux du SEO technique :

*   **🚀 Gestion des balises Meta** : Ajoute automatiquement les balises `meta description`, les balises Open Graph (pour Facebook, LinkedIn...) et les Twitter Cards pour améliorer l'apparence de vos partages sur les réseaux sociaux.
*   **🗺️ Intégration du Sitemap** : Déclare automatiquement l'emplacement de votre sitemap natif WordPress dans le fichier `robots.txt` virtuel, aidant les moteurs de recherche à découvrir votre contenu plus efficacement.
*   **🚦 Directives d'indexation** : Empêche l'indexation des pages de résultats de recherche et des pages 404 en ajoutant les directives `noindex, nofollow`, ce qui évite le contenu dupliqué ou de faible qualité.

## Installation

### Depuis le répertoire WordPress.org (méthode recommandée)

1.  Dans votre tableau de bord WordPress, allez dans `Extensions > Ajouter`.
2.  Recherchez "Beriyack SEO".
3.  Cliquez sur `Installer maintenant` puis sur `Activer`.

### Manuellement

1.  Téléchargez la dernière version depuis la page Releases de ce dépôt.
2.  Dans votre tableau de bord WordPress, allez dans `Extensions > Ajouter` et cliquez sur `Téléverser une extension`. Choisissez le fichier `.zip` que vous venez de télécharger et activez l'extension.

## Configuration

Après l'activation, il est fortement recommandé de configurer une image par défaut.

1.  Allez dans `Réglages > Beriyack SEO`.
2.  Téléversez une image qui sera utilisée comme image de partage par défaut sur les réseaux sociaux. Cette image est utilisée pour votre page d'accueil, vos archives, et pour tout article ou page qui n'a pas d'« Image mise en avant ».

### Logique de l'image Open Graph

Le plugin utilise une approche hiérarchique pour choisir la meilleure image :
1.  **Image mise en avant** : Si un article/page en possède une, elle sera utilisée en priorité.
2.  **Image par défaut** : Sinon, l'image que vous avez définie dans les réglages du plugin sera utilisée.

## Support

Pour toute question relative à l'utilisation du plugin, veuillez utiliser le [forum de support sur WordPress.org](https://wordpress.org/support/plugin/beriyack-seo).

Si vous pensez avoir trouvé un bug ou si vous avez une suggestion d'amélioration, n'hésitez pas à ouvrir une [issue sur GitHub](https://github.com/Beriyack/beriyack-seo/issues).

## Confidentialité des données (RGPD/LPD)

**Beriyack SEO** est respectueux de la vie privée.

*   Ce plugin ne collecte, ne suit et ne stocke aucune donnée personnelle des visiteurs de votre site.
*   Il ne place aucun cookie sur le navigateur des utilisateurs.
