# 🛒 TifawinSouk -- Plateforme de Commerce Local

## 📌 Description du projet

**TifawinSouk** est une application web développée avec **Laravel**,
destinée à une PME marocaine spécialisée dans le commerce local.\
L'objectif est de **digitaliser la gestion du catalogue, des
fournisseurs et des commandes**, tout en offrant une interface publique
simple pour les clients.

Le projet se compose de deux parties principales :

-   **Back-Office (Admin)** : gestion interne (produits, catégories,
    fournisseurs, commandes)
-   **Front-Office (Client)** : navigation des produits et passation des
    commandes

------------------------------------------------------------------------

## 🎯 Objectifs

-   Centraliser la gestion du stock et des fournisseurs\
-   Offrir une vitrine en ligne pour les produits\
-   Gérer le cycle de vie des commandes clients\
-   Garantir la cohérence des données via des règles métier strictes

------------------------------------------------------------------------

## 🧩 Fonctionnalités

### 🔐 Back-Office (Administrateur)

-   Authentification sécurisée
-   Gestion des catégories (CRUD)
-   Gestion des produits :
    -   Association obligatoire à une catégorie et un fournisseur
    -   Upload et mise à jour d'images
    -   Gestion manuelle du stock
    -   Soft Delete des produits
-   Tableau de bord :
    -   Produits dont le stock est critique
-   Gestion des commandes :
    -   Visualisation globale
    -   Mise à jour du statut (En attente, Expédiée, Livrée, Annulée)

------------------------------------------------------------------------

### 🛍️ Front-Office (Utilisateur)

-   Création de compte client
-   Gestion du profil (adresse, téléphone)
-   Navigation par catégories
-   Recherche de produits par nom
-   Consultation des détails d'un produit
-   Panier :
    -   Ajout / suppression de produits
    -   Modification des quantités
-   Validation de commande avec :
    -   Figeage du prix unitaire
    -   Calcul automatique du total
-   Historique des commandes et suivi du statut
-   Message d'erreur en cas de stock insuffisant

------------------------------------------------------------------------

## 🧠 Règles Métier

-   Un produit appartient à une seule catégorie
-   Un produit est lié obligatoirement à un fournisseur
-   Un fournisseur peut proposer plusieurs produits
-   Le stock est décrémenté uniquement après validation réussie de la
    commande
-   Les produits supprimés (Soft Delete) restent liés aux commandes
    passées

------------------------------------------------------------------------

## ✅ Contraintes de Validation

-   **Prix** : nombre positif (min: 0)
-   **Unicité** :
    -   Référence produit unique
    -   Email utilisateur et fournisseur unique
-   **Images** :
    -   Formats autorisés : jpg, jpeg, png
    -   Taille maximale : 2 Mo
-   **Champs obligatoires** :
    -   Nom, prix, catégorie, fournisseur
-   **Transactions SQL** :
    -   Commande et mise à jour du stock atomiques
-   **Sécurité** :
    -   Accès `/admin` réservé aux administrateurs

------------------------------------------------------------------------

## 🛠️ Contraintes Techniques

-   **Framework** : Laravel (dernière version stable)
-   **Authentification** : Laravel Breeze / UI
-   **Base de données** : MySQL
-   **ORM** : Eloquent
-   **Relations** :
    -   1:N (Catégories → Produits, Fournisseurs → Produits)
    -   N:N (Commandes ↔ Produits)
-   **Middleware** :
    -   Protection des routes du Back-Office
-   **Validation** :
    -   Validation serveur via Form Requests
-   **Transactions** :
    -   Utilisation des transactions SQL pour la validation des
        commandes

------------------------------------------------------------------------

## 🚀 Installation

``` bash
git clone https://github.com/your-username/tifawin-souk.git
cd tifawin-souk
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

------------------------------------------------------------------------

## 📚 Technologies Utilisées

-   PHP 8+
-   Laravel
-   MySQL
-   Blade
-   Tailwind CSS

------------------------------------------------------------------------

## 👨‍💻 Auteur

Projet réalisé dans un cadre **pédagogique / académique**, visant à
appliquer : - la modélisation relationnelle - les relations Eloquent -
les bonnes pratiques Laravel
