# Free-Ads
Site de petites annonces avec messagerie. Réalisée en utilisant le framework PHP Laravel

## Prérequis*
- PHP >= 7.3
- Composer
- Serveur Apache ou Nginx
- Mysql

## Installation

1. Cloner le repos et aller dans le dossier freeads

2. Installer les dépendances

    ```bash
    composer install
    ```

3. Configurer l'environnement

    Modifier le fichier .env.enxemple en .env

4. Configurer la base de données

    Créer votre base de donnée my_sql et renseigner ses information dans le fichier .env

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nom_de_la_base_de_donnees
    DB_USERNAME=utilisateur
    DB_PASSWORD=mot_de_passe
    ```
5. Migrer la base de données

    ```bash
    php artisan migrate
    ```

6. Démarrer le serveur

    ```bash
    php artisan serve
    ```

7. Créer un compte Mailtrap pour gérer l'envoi de mail d'activation


