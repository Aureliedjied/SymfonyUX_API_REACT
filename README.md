# Projet Symfony Web App

Ce projet Symfony est une application web qui utilise une API distante pour gérer des produits et catégories, dans le but d'apprendre à consommer une API externe.
Merci à https://fakeapi.platzi.com/en/about/introduction/ pour permettre cette utilisation gratuite !

## Étapes d'installation

1. **Créer le projet Symfony avec le template webapp :**
    ```bash
    symfony new my_project_name --webapp
    ```

2. **Créer les entités Category et Product :**
    - Utilisez la console Symfony pour générer les entités Category et Product avec leurs champs respectifs ( cf DOC de l'API ).

3. **Créer le service ApiService :**
    - Créez le service ApiService pour interagir avec l'API distante.
    - Utilisez le composant HttpClient de Symfony pour effectuer des requêtes HTTP.

4. **Créer la commande ImportCommand :**
    - Créez une commande Symfony personnalisée (ImportCommand) pour importer les données de l'API dans la base de données locale.

    ```bash
    php bin/console make:command
    ```

5. **Créer le ProductController :**
    - Créez le ProductController avec son constructeur qui utilise le service ApiService pour récupérer et afficher les produits.

## Exécuter l'application

1. **Installer les dépendances :**
    ```bash
    composer install
    ```

2. **Créer la base de données :**
    ```bash
    php bin/console doctrine:database:create
    ```

3. **Effectuer les migrations :**
    ```bash
    php bin/console doctrine:migrations:migrate
    ```

4. **Importer les données depuis l'API :**
    ```bash
    php bin/console app:import
    ```

5. **Lancer le serveur Symfony :**
    ```bash
    symfony server:start
    ```

6. **Accéder à l'application :**
    - Ouvrez votre navigateur à l'adresse [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

**Note :** Assurez-vous d'avoir PHP, Composer, et Symfony CLI installés sur votre machine avant d'exécuter ces commandes ( ici Symfony 7, PHP 8.2, Symfony CLI 5.7.8 ).
