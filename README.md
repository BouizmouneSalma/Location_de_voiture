## 🚗 Description du Projet

Ce projet est une application de gestion de location de voitures intégrant un système d'authentification sécurisé basé sur des **sessions** et des **cookies**. Il est développé en **PHP** avec une approche orientée objet (**OOP**). Les utilisateurs peuvent s'inscrire, se connecter et gérer leurs informations personnelles de manière sécurisée.

## 🛠 Fonctionnalités Principales

### 🔐 Authentification et Gestion des Utilisateurs

- **Inscription** : Crée un compte utilisateur avec un e-mail unique et un mot de passe fort.
- **Connexion** : Permet aux utilisateurs de se connecter en toute sécurité.
- **Déconnexion** : Les utilisateurs peuvent se déconnecter à tout moment.
- **Session Active** : Reste authentifié tant que l'utilisateur est actif.
- **Expiration Automatique** : L'utilisateur est déconnecté après 30 minutes d'inactivité.
- **Se souvenir de moi** : Option de rester connecté entre les sessions grâce à un cookie sécurisé.

### 🚗 Gestion des Voitures et des Contrats

- Affichage des **voitures disponibles**.
- Création et gestion des **contrats de location**.
- Liaison des **utilisateurs** aux contrats.
  🛠 Développement Backend
🧑‍💻 Classes PHP
Auth.php : Gère les sessions et l'authentification par cookies.
UserManager.php : Permet de gérer les utilisateurs (CRUD).
Validator.php : Assure la validation des données des formulaires (email, mot de passe, etc.).
🔒 Sécurité
🖥 Le hachage des mots de passe est effectué avec password_hash.
Des tests de sécurité sont effectués, notamment contre les attaques XSS et CSRF.
Interface Utilisateur
L'interface utilisateur a été conçue pour être simple, intuitive et moderne, avec l'intégration d'icônes et d'images pour améliorer l'expérience utilisateur.
![image](https://github.com/user-attachments/assets/2eb6ed48-66d1-45a8-a52b-4d42a65eae8b)
🎨 Design et Icônes
Les icônes sont utilisées pour améliorer la lisibilité et l'esthétique de l'application. Voici quelques exemples :

Icône utilisateur :
Icône voiture :
Icône déconnexion :
Les icônes sont au format SVG pour une meilleure qualité visuelle et une flexibilité d'intégration.
🚀 Lancer le Projet
Configurez votre base de données comme mentionné ci-dessus.
Démarrez votre serveur PHP.
Accédez à l'application via votre navigateur en utilisant localhost/index.php.
🔒 Sécurité
Les mots de passe sont hachés avec password_hash().
La session est protégée contre les attaques CSRF et XSS.
Les cookies sont sécurisés avec les attributs HttpOnly et Secure.
## 💻 Installation

### . Clonez le Repository

```bash
git clone https://github.com/BouizmouneSalma/Location_de_voiture.git
cd location_voiture

