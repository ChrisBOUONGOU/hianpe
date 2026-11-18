# Configuration Stripe pour Hianpe

## Produits et prix

Dans Stripe, en mode test, crée trois prix récurrents distincts :
- StageFlow : 10 CAD, facturation mensuelle.
- AfriHospital : 10 CAD, facturation mensuelle.
- StockFlow : 10 CAD, facturation mensuelle.

Copie chaque identifiant de prix (il commence par `price_`). Les trois abonnements sont indépendants.

## Variables d'environnement

Ajoute ces variables dans le fichier local `.env.local` ou dans les variables d'environnement de l'hébergement. Ne les ajoute jamais à Git et ne les partage pas dans une conversation.

```dotenv
STRIPE_SECRET_KEY=sk_test_...
STRIPE_WEBHOOK_SECRET=whsec_...
STRIPE_PRICE_STAGEFLOW=price_...
STRIPE_PRICE_AFRIHOSPITAL=price_...
STRIPE_PRICE_STOCKFLOW=price_...
```

Utilise les clés et prix du même mode Stripe (test avec test, production avec production). Le code utilise les identifiants de prix du serveur et n'accepte aucun montant transmis par le navigateur.

## Webhook

Dans Stripe Developers > Webhooks, ajoute l'endpoint :

`https://hianpe.com/stripe/webhook`

Abonne-le aux événements :
- `checkout.session.completed`
- `customer.subscription.created`
- `customer.subscription.updated`
- `customer.subscription.deleted`

Copie la clé de signature du endpoint (préfixe `whsec_`) dans `STRIPE_WEBHOOK_SECRET`.

## Essai gratuit

Checkout demande une carte bancaire dès le début, applique un essai de 7 jours, puis Stripe facture automatiquement le prix mensuel configuré, sauf annulation avant la fin de l'essai. Les cartes de test Stripe peuvent être utilisées en mode test.

## Mise en place locale

Après avoir récupéré la branche :
1. Installe les dépendances : `composer install`.
2. Configure les variables dans `.env.local`.
3. Exécute `php bin/console doctrine:migrations:migrate`.
4. Vérifie les routes : `php bin/console debug:router`.
5. Teste inscription, connexion, démarrage d'un essai et portail de facturation.

Avant toute activation réelle, configure les prix et clés du mode Live, l'endpoint webhook Live et teste les scénarios de paiement, d'échec et d'annulation. Ne bascule pas en production sans validation complète.
