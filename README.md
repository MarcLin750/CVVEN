# CVVEN

## Description du Projet
CVVEN est une application conçue pour faciliter la gestion et la réservation d'hébergements. Elle permet aux utilisateurs de rechercher, réserver et gérer des logements facilement à travers une interface simple et intuitive.

## Fonctionnalités Principales
- **Recherche de logements:** Permet aux utilisateurs de trouver des hébergements selon différents critères (localisation, prix, équipement, etc.).
- **Gestion des réservations:** Interface pour gérer les réservations existantes, modifier les dates, ou annuler.
- **Interface utilisateur:** Design épuré et responsive pour une expérience utilisateur optimale sur tous les appareils.

## Technologies Utilisées
- PHP
- JavaScript
- Autres technologies spécifiques au projet.

## Installation
Suivez ces étapes pour configurer et lancer le projet CVVEN localement.

\```bash
# Cloner le dépôt
git clone https://github.com/MarcLin750/CVVEN.git
# Naviguer dans le répertoire du projet
cd CVVEN

# Installer les dépendances (exemple avec npm, adaptez selon votre gestionnaire de paquets)
npm install

# Configurer la base de données
# Créer une copie de votre fichier de configuration exemple pour l'environnement de développement
cp .env.example .env
# Ouvrir le fichier .env et mettre à jour les variables d'environnement pour la base de données

# Exécuter les migrations pour créer les tables de la base de données (adaptez la commande à votre outil de migrations)
php artisan migrate

# (Optionnel) Exécuter les seeders pour remplir la base de données avec des données initiales
php artisan db:seed

# Lancer le serveur de développement local (exemple avec PHP, adaptez selon votre environnement)
php -S localhost:8000
\```

## Contributeurs
- Kevin Giang
- Senthooran Thayaparan
- Loïc Mahadzere
- Marc Lin

## Contact
...
