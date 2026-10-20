# Hianpe

Site vitrine de Hianpe : développement logiciel sur mesure, services C#/.NET et catalogue des applications publiées.

## Technologies du dépôt

Le projet existant est une application **Symfony 8.1 / PHP 8.4**, et non un projet React ou .NET. La page d'accueil est rendue par un contrôleur Symfony.

## Lancer le projet en local

Prérequis : PHP 8.4+, Composer et Symfony CLI (recommandé).

```bash
composer install
symfony serve
```

Puis ouvrir l'adresse locale affichée par Symfony CLI.

## Contenu du site

- Présentation des services de développement C#/.NET, desktop et web.
- Catalogue de logiciels avec liens vers les projets publiés.
- Présentation de la méthode de travail et section contact.
- Mise en page responsive et identité visuelle beige, jaune et noir.
- Logo existant : `public/assets/logo_hianpe.png`.

## À compléter avant la mise en production

- Ajouter une adresse de contact confirmée et/ou un formulaire connecté à un service d'envoi.
- Publier les fichiers d'installation vérifiés et leurs notes de version avant d'afficher des liens de téléchargement.
- Tester la configuration et le rendu sur l'hébergement cible.

Les cartes « Bientôt disponible » sont volontairement informatives : aucun téléchargement d'installation fictif n'est proposé.
