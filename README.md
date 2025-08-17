# 📝 Mon Blog PHP

Un blog simple et moderne développé en PHP avec MySQL, permettant aux utilisateurs de créer, publier et gérer des articles.

## ✨ Fonctionnalités

- 🔐 **Authentification** : Inscription, connexion et déconnexion sécurisées
- 📄 **Gestion des articles** : Création, publication et affichage d'articles
- 👤 **Tableau de bord** : Interface utilisateur pour gérer ses articles
- 📱 **Design responsive** : Compatible mobile, tablette et desktop
- 🎨 **Interface moderne** : CSS personnalisé avec animations et transitions

## 🛠️ Technologies utilisées

- **Backend** : PHP 8.2.12
- **Base de données** : MySQL
- **Frontend** : HTML5, CSS3, JavaScript
- **Serveur local** : XAMPP
- **Fonts** : Google Fonts (Open Sans)

## 📋 Prérequis

- XAMPP (ou équivalent avec Apache, PHP, MySQL)
- PHP 7.4 ou supérieur
- MySQL 5.7 ou supérieur
- Navigateur web moderne

## 🚀 Installation

### 1. Cloner le projet

```bash
git clone https://github.com/VOTRE-USERNAME/mon-blog-php.git
cd mon-blog-php
```

### 2. Configuration de la base de données

1. Démarrez XAMPP (Apache + MySQL)
2. Accédez à phpMyAdmin : `http://localhost/phpmyadmin`
3. Créez une base de données nommée `blog`
4. Importez le schéma SQL (voir section Structure BDD)

### 3. Configuration de la connexion

1. Copiez le fichier de configuration :
   ```bash
   cp includes/db.example.php includes/db.php
   ```
2. Modifiez `includes/db.php` avec vos paramètres :
   ```php
   $host = 'localhost';
   $dbname = 'blog';
   $username = 'root';
   $password = ''; // Votre mot de passe MySQL
   ```

### 4. Accès au site

Ouvrez votre navigateur et accédez à :

```
http://localhost/mon-blog-php
```

## 🗃️ Structure de la base de données

### Table `users`

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Table `posts`

```sql
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    published BOOLEAN DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

## 📁 Structure du projet

```
mon-blog-php/
├── css/
│   ├── reset.css          # Reset CSS
│   ├── style.css          # Styles principaux
│   └── responsive.css     # Styles responsive
├── includes/
│   ├── db.example.php     # Configuration BDD (exemple)
│   ├── functions.php      # Fonctions utilitaires
│   ├── header.php         # En-tête du site
│   └── footer.php         # Pied de page
├── index.php              # Page d'accueil
├── login.php              # Page de connexion
├── register.php           # Page d'inscription
├── logout.php             # Script de déconnexion
├── dashboard.php          # Tableau de bord utilisateur
├── create_post.php        # Création d'articles
├── post.php               # Affichage d'un article
├── article.php            # Affichage d'un article (alias)
└── README.md              # Ce fichier
```

## 🔧 Fonctionnalités principales

### Authentification

- Inscription avec validation des données
- Connexion sécurisée avec sessions
- Hashage des mots de passe avec `password_hash()`

### Gestion des articles

- Création d'articles avec titre et contenu
- Affichage des articles publiés
- Interface de gestion pour les auteurs

### Sécurité

- Protection contre les injections SQL (PDO prepared statements)
- Échappement des données d'affichage (XSS)
- Validation des données côté serveur
- Sessions sécurisées

## 🎨 Personnalisation

Les styles CSS sont organisés en trois fichiers :

- `reset.css` : Normalisation des styles
- `style.css` : Styles principaux et variables CSS
- `responsive.css` : Adaptations mobile/tablette

Variables CSS personnalisables dans `style.css` :

```css
:root {
  --primary-color: #3498db;
  --secondary-color: #2c3e50;
  --accent-color: #e74c3c;
  /* ... */
}
```

## 🤝 Contribution

Les contributions sont les bienvenues ! N'hésitez pas à :

1. Fork le projet
2. Créer une branche pour votre fonctionnalité
3. Commiter vos changements
4. Pousser vers la branche
5. Ouvrir une Pull Request

## 📝 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## 👨‍💻 Auteur

**Votre Nom** - Développeur débutant en PHP

---

💡 **Note** : Ce projet a été développé dans un cadre d'apprentissage du PHP et des bonnes pratiques de développement web.
