# API REST avec Laravel

Cette API REST a été développée en utilisant le framework Laravel. Elle fournit des fonctionnalités pour la gestion des utilisateurs et des publications (posts).

## Endpoints

### Utilisateurs

#### Enregistrement d'un utilisateur

- **URL:** `/register`
- **Méthode:** `POST`
- **Paramètres de la requête:**
  - `name` (string, requis) : Nom de l'utilisateur
  - `email` (string, requis) : Adresse e-mail de l'utilisateur (doit être unique)
  - `password` (string, requis) : Mot de passe de l'utilisateur
- **Réponse:**
  - `status`: 200 si réussi
  - `message`: Message de succès
  - `user`: Détails de l'utilisateur enregistré

#### Authentification d'un utilisateur

- **URL:** `/login`
- **Méthode:** `POST`
- **Paramètres de la requête:**
  - `email` (string, requis) : Adresse e-mail de l'utilisateur enregistré
  - `password` (string, requis) : Mot de passe de l'utilisateur
- **Réponse:**
  - `status`: 200 si réussi
  - `message`: Message de succès
  - `user`: Détails de l'utilisateur authentifié
  - `token`: Jeton d'authentification

### Publications (Posts)

#### Récupération de toutes les publications

- **URL:** `/posts`
- **Méthode:** `GET`
- **Paramètres de la requête:**
  - `page` (optionnel) : Numéro de page pour la pagination
  - `search` (optionnel) : Terme de recherche pour filtrer les publications par titre
- **Réponse:**
  - `status`: 200 si réussi
  - `message`: Message de succès
  - `current_page`: Page actuelle
  - `last_page`: Dernière page
  - `items`: Liste des publications

#### Création d'une nouvelle publication

- **URL:** `/posts`
- **Méthode:** `POST`
- **Paramètres de la requête:**
  - `title` (string, requis) : Titre de la publication
  - `description` (string, optionnel) : Description de la publication
- **Réponse:**
  - `status`: 200 si réussi
  - `message`: Message de succès
  - `post`: Détails de la publication créée

#### Récupération d'une publication spécifique

- **URL:** `/posts/{post}`
- **Méthode:** `GET`
- **Paramètres de la requête:** Aucun
- **Réponse:**
  - `status`: 200 si réussi
  - `message`: Message de succès
  - `post`: Détails de la publication spécifique

#### Mise à jour d'une publication

- **URL:** `/posts/{post}`
- **Méthode:** `PUT`
- **Paramètres de la requête:**
  - `title` (string, requis) : Nouveau titre de la publication
  - `description` (string, optionnel) : Nouvelle description de la publication
- **Réponse:**
  - `status`: 200 si réussi
  - `message`: Message de succès
  - `post`: Détails de la publication mise à jour

#### Suppression d'une publication

- **URL:** `/posts/{post}`
- **Méthode:** `DELETE`
- **Paramètres de la requête:** Aucun
- **Réponse:**
  - `status`: 200 si réussi
  - `message`: Message de succès

## Authentification

L'API utilise Sanctum pour l'authentification des utilisateurs. Les utilisateurs doivent s'enregistrer et se connecter pour accéder aux fonctionnalités protégées.

## Validation des données

Les données envoyées aux endpoints sont validées à l'aide de classes de demande (Request) pour assurer leur intégrité et leur sécurité.
