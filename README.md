# Projet SIMPLE-MVC

> Vous utiliserez ce repository comme projet de base pour votre examen.

## Installation

1. Cliquez sur "clone or download" puis "download Zip" pour télécharger le projet.
2. Ouvrez le dossier du projet et installez les dépendances avec  `composer install`.

## Utilisation du projet

### Configuration

L'intégralité des variables de configuration du projet se trouvent dans `/config/config.php`.

### Routeur

Les routes seront situées dans `config/routes.php`

### Controllers

- Les controllers devront hériter de la classe `AbstractController` existante
- Ils devront faire partie du namespace `App\Controller`

### Models

- Les models devront hériter de la classe `AbstractModel` existante
- Ils devront faire partie du namespace `App\Model`


### Views

- Les views seront générées avec Twig.
- Les vues sont situées dans le dossier `/views`.
- Les vues du projet peuvent hériter du fichier `base.html` fourni en exemple grâce à `{{ extends 'base.html' }}`.
- Le chemin de base du projet est accessible grâce à la variable Twig `base_path`
- Le chemin du dossier des assets (css, js, img) est accessible grâce àla variable Twig  `assets`

Exemples d'utilisation de ces variables :

```html
<script src="{{ assets ~ '/js/app.js' }}"></script>
<link href="{{ assets ~ '/css/app.css' }}">
<img src="{{ assets ~ '/img/image.png' }}">
<a href="{{ base_path ~ '/route' }}"></a>
```
