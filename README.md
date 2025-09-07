# 📝 Mon Blog PHP

Un blog moderne et responsive développé en PHP avec une interface utilisateur élégante et des fonctionnalités complètes de gestion de contenu.

## ✨ Fonctionnalités

- 🔐 **Authentification sécurisée** - Système de connexion/inscription avec hashage des mots de passe
- 📱 **Design responsive** - Interface adaptative avec menu burger CSS-only
- ✍️ **Gestion d'articles** - Création, édition et publication d'articles
- 👤 **Profils utilisateur** - Gestion des comptes utilisateurs
- 🎨 **Interface moderne** - Design épuré avec CSS personnalisé
- 🔒 **Sécurité** - Protection contre les injections SQL avec PDO

## 🛠️ Technologies utilisées

- **Backend** : PHP 8.2.12
- **Base de données** : MySQL
- **Frontend** : HTML5, CSS3 (avec variables CSS)
- **Serveur** : Apache (XAMPP)
- **Outils** : Git, GitHub

## 📋 Prérequis

- PHP 8.2 ou supérieur
- MySQL 5.7 ou supérieur
- Apache (ou serveur web compatible)
- XAMPP recommandé pour le développement local

## 🚀 Installation

### 1. Cloner le repository

```bash
git clone https://github.com/Constantin-D/mon-blog-php.git
cd mon-blog-php
```

### 2. Configuration de la base de données

```sql
CREATE DATABASE blog;
USE blog;

-- Créer la table users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Créer la table posts
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    published TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

### 3. Configuration du fichier de base de données

```bash
cp includes/db.example.php includes/db.php
```

Puis éditez `includes/db.php` avec vos paramètres :

```php
$host = 'localhost';
$dbname = 'blog';
$username = 'votre_utilisateur';
$password = 'votre_mot_de_passe';
```

### 4. Démarrer le serveur

```bash
# Avec XAMPP
# Démarrer Apache et MySQL via le panneau de contrôle XAMPP

# Ou avec le serveur PHP intégré
php -S localhost:8000
```

## 📁 Structure du projet

```
mon_blog_php/
├── css/
│   ├── reset.css              # Reset CSS
│   ├── style.css              # Styles principaux + nouvelles fonctionnalités
│   └── responsive.css         # Styles responsive + menu burger
├── images/                    # Assets images
├── includes/
│   ├── db.example.php         # Template de configuration DB
│   ├── db.php                # Configuration base de données
│   ├── functions.php         # Fonctions utilitaires
│   ├── header.php            # En-tête commun avec navigation
│   ├── footer.php            # Pied de page commun
│   └── markdown.php          # Parser Markdown complet
├── index.php                 # Page d'accueil
├── login.php                 # Connexion (avec toggle mot de passe)
├── register.php              # Inscription (avec toggle mot de passe)
├── dashboard.php             # Tableau de bord utilisateur
├── create_post.php           # Création d'articles + support Markdown
├── article.php               # Affichage d'un article
├── about.php                 # À propos
├── contact.php               # Contact
├── privacy.php               # Politique de confidentialité
├── unsubscribe.php           # Désinscription sécurisée
├── logout.php                # Déconnexion
├── post.php                  # Gestion des posts
├── check_php_version.php     # Diagnostic version PHP
├── check_db_structure.php    # Diagnostic structure base de données
├── add_created_at_column.php # Migration ajout colonne created_at
└── README.md
```

## 🎯 Utilisation

### Pour les visiteurs

1. Consulter les articles sur la page d'accueil
2. Lire les articles complets
3. S'inscrire pour devenir auteur

### Pour les auteurs

1. S'inscrire via `/register.php`
2. Se connecter via `/login.php`
3. Accéder au tableau de bord `/dashboard.php`
4. Créer des articles via `/create_post.php`

## 🔧 Fonctionnalités techniques

### 📝 Système Markdown avancé

- Parser Markdown complet (titres, listes, liens, code, citations)
- Aide interactive CSS-only avec toggle
- Support blocs de code avec coloration syntaxique
- Interface utilisateur intuitive

### 👁️ Toggle mot de passe CSS-only

- Affichage/masquage des mots de passe sur login/register
- Animation avec pseudo-éléments et icônes
- Cohérent avec l'approche sans JavaScript du projet

### 🗑️ Système de désinscription sécurisé

- Page dédiée avec confirmation par texte exact
- Suppression en cascade (compte + tous les articles)
- Interface d'avertissement claire avec zone de danger
- Accessible depuis le tableau de bord

### 📱 Menu responsive

- Menu burger CSS-only (sans JavaScript)
- Animations avec pseudo-éléments
- Overlay pour fermeture au clic extérieur
- Breakpoints optimisés : 768px, 480px, 320px

### 🔐 Sécurité

- Requêtes préparées PDO
- Hashage des mots de passe avec `password_hash()`
- Validation et échappement des données
- Protection contre les injections SQL
- Confirmation obligatoire pour actions critiques

### 🎨 Design

- Variables CSS pour une maintenance facile
- Architecture CSS modulaire
- Design mobile-first
- Animations fluides

### 🛠️ Outils de diagnostic

- `check_php_version.php` : Diagnostic version PHP et extensions
- `check_db_structure.php` : Analyse structure des tables MySQL
- `add_created_at_column.php` : Migration pour ajouter colonne created_at
- Gestion des erreurs de colonnes manquantes

## 🤝 Contribution

1. Fork le projet
2. Créer une branche feature (`git checkout -b feature/nouvelle-fonctionnalite`)
3. Commit vos changements (`git commit -m 'Ajout nouvelle fonctionnalité'`)
4. Push vers la branche (`git push origin feature/nouvelle-fonctionnalite`)
5. Ouvrir une Pull Request

## 📝 License

Ce projet est sous licence MIT. Voir le fichier [LICENSE](LICENSE) pour plus de détails.

## 👨‍💻 Auteur

**Constantin-D**

- GitHub: [@Constantin-D](https://github.com/Constantin-D)

## 📞 Support

Si vous rencontrez des problèmes :

1. Vérifiez les [Issues](https://github.com/Constantin-D/mon-blog-php/issues) existantes
2. Créez une nouvelle issue si nécessaire
3. Consultez la documentation PHP et MySQL

---

⭐ Si ce projet vous aide, n'hésitez pas à lui donner une étoile !
