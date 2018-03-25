# Studiness 🎓
Site de partage de cours en ligne entre étudiants

## Instructions
Ce document sert à expliquer le fonctionnement de site pour qui souhaite l’améliorer (les pages de la partie vitrine ne sont pas expliquées).

---

## Pages
Fichiers qui affichent du contenu

### index
* **Rôle** : Présenter le site WEB, le projet
* **Fichiers requis** : `header.php`, `footer.php`
* **Fonctionnement** : Le fichier commence par afficher le contenu du fichier header, à savoir la partie “head” de la page ainsi que la nav avec les liens qui permettent de naviguer sur les différentes pages du site WEB.

### header
* **Rôle** : Créer la partie “head” de chaque page et d’y ajouter la nav de haut de page avec les liens pour naviguer sur les différentes pages (les liens ne sont pas les même suivant que l’utilisateur se soit authentifié ou non).
* **Fichiers requis** : `config.php`
* **Fonctionnement** : Le fichier récupère le fichier `config.php` afin qu’il soit accessible depuis n’importe quelle page sans avoir à l’importer à chaque fois que c’est nécessaire. Il écrit l’entête de la page. Il va ensuite tester si l’utilisateur est identifié ou anonyme en testant les variables de session (si elle est déclaré et contient un login, alors on considère que l’utilisateur est identifié).

Si l’utilisateur est authentifié, il aura une nav avec des liens personnels (navpers).

Si l’utilisateur est anonyme, il aura une nav avec des liens de présentation (navgen).

### footer
* **Rôle** : Il permet d’afficher le bas de page de chaque page
* **Fichiers requis** : aucun
* **Fonctionnement** : Il affiche le bas de page et importe les scripts de bootstrap. Il y a également une petite fonction qui permet de changer la couleur du lien de la page active dans la nav du header.
> **ATTENTION** : En cas d’oubli de ce fichier, il manquera des éléments de bootstrap et le lien de la page active sera dans la même couleur que les autres.

### Redirect
* **Rôle** : Ce fichier est appelé sur chaque page ou l’utilisateur est sensé être connecté.
Si ce dernier n’est pas authentifié, il va se retrouver sur le système d’authentification UL.
* **Fichiers requis** : `CAS.php`, `config.php`
* **Fonctionnement** : Le fichier test si l’utilisateur est authentifié :

Si l’utilisateur est authentifié et qu’il est répertorié dans la base de données STUIDNESS, le fichier ne fera rien, il ne se passera rien.

Si l’utilisateur n’est pas authentifié, le fichier fera apparaitre le système authentification UL (`phpCAS`).

Si l’utilisateur est authentifié mais qu’il n’est pas répertorié dans la base de données STUDINESS, il sera redirigé vers le fichier `premiere-co.php`.
> **ATTENTION** : Ce fichier représente le principal système de sécurité. Il est doit être importé dans toutes les pages affichants des données personnelles.

### Première-co
* **Rôle** : Ce fichier permet à l’utilisateur effectuant sa première connexion de rajouter quelques informations à son sujet.
* **Fichiers requis** : `header.php`
* **Fonctionnement** : On affiche simplement un formulaire qui pointe vers `configuration-user.php`

### Accueil
* **Rôle** : Afficher les dernières informations qu’il s’agisse de news, de discussions, ou des cours en ligne.
* **Fichiers requis** : `header.php`, `redirect.php`, `footer.php`
* **Fonctionnement** : Après avoir affiché la nav et avoir vérifié que l’utilisateur est bien authentifié, il va venir afficher les dernières news, discussions et cours depuis la base de données de STUDINESS
> **ATTENTION** : le fichier config est importé dans `header.php`, inutile de le réimporter dans chaque page. Idem pour le fichier `CAS.php`

### Forum
* **Rôle** : Afficher la liste des sujets existants sur la base de données avec quelques informations et création d’un nouveau sujet.
* **Fichiers requis** : `header.php`, `redirect.php`, `footer.php`
* **Fonctionnement** : Le fichier propose un bouton qui ouvre une modale pour créer un nouveau sujet. Il affiche tous les sujets de la base de données de STUDINESS dans l’ordre chronologique inversé (les plus récents en premiers). Pour chaque sujet trouvé, on y ajoute le dernier message avec la date et l’utilisateur qui a écrit.

### topic
* **Rôle** : Affiche le contenu d’un sujet du forum et permet d’y ajouter un message
* **Fichiers requis** : `header.php`, `redirect.php`, `footer.php`
* **Fonctionnement** : Le fichier doit contenir l’identifiant d’un sujet dans la querystring, s’il n’y en a pas l’utilisateur est redirigé sur `forum.php`. Donc grâce à l’identifiant contenu dans la querystring, le fichier affiche tous les messages qui correspondent au sujet. Puis en bas se trouve un petit formulaire permettant de répondre rapidement.
Mon espace

### News
* **Rôle** : Afficher les news STUDINEWS contenues dans la base de donnée STUDINESS
* **Fichiers requis** : `header.php`, `redirect.php`, `footer.php`
* **Fonctionnement** : La page récupère les news dans l’ordre chronologique inversé avec uniquement un résumé du contenu. (Semblable à `forum.php`).

### News-view
* **Rôle** : Afficher le contenu complet d’une news.
* **Fichiers requis** : `header.php`, `redirect.php`, `footer.php`
* **Fonctionnement** : La page vérifie le contenu de la QueryString, s’il y a une erreur, l’utilisateur est renvoyé sur `news.php`, sinon le contenu de la news correspondant à l’ID fourni s’affiche.

---

## Scripts
Nous verrons, ici, tous les fichiers qui ne font que du traitement et n’affichent rien.

### configuration-user
* **Rôle** : Lors de la première connexion d’un utilisateur, il va être amené à saisir quelques informations, ce fichier va enregistrer ces dernière dans la base de donnée STUDINESS
* **Fichiers requis** : `config.php` (il n’y a pas de header, il faut donc penser à l’importer).
* **Fonctionnement** : On teste toutes les variables saisies pour éviter le piratage et le bidouillage. puis on enregistre les informations dans la base de données. L’utilisateur est ensuite redirigé sur la page `accueil.php`

### create-topic
* **Rôle** : Créer un nouveau sujet dans la base de données STUDINESS à partir des informations saisies dans `forum.php`
* **Fichiers requis** : `config.php`, `redirect.php`
* **Fonctionnement** : On teste d’abord les variables pour éviter les attaques de cowboys 🤠. Le script va ensuite enregistrer le titre dans la base de données, cette dernière va donc générer un id, on va ensuite récupérer cet id afin de stocker le message et de le faire correspondre au sujet. L’utilisateur est ensuite redirigé sur `topic.php` avec l’id de son sujet dans la querystring.
> **ATTENTION** : De par la complexité de ce script toutes les étapes sont détaillées directement dans le fichier.

### new-mess
* **Rôle** : Enregistrer un nouveau message pour un sujet dans la base de données STUDINESS.
* **Fichiers requis** : `config.php`, `redirect.php`
* **Fonctionnement** : Le fichier vérifie d’abord les variables grâce à la technique anti cowboy. Le fichier enregistre ensuite le contenu du message et les informations nécessaires dans la base de données.

### config
* **Rôle** : Il permet le stockage des accès de la base de donnée (adresse serveur, base, identifiant, mot de passe).
* **Fichiers requis** : aucun
* **Fonctionnement** : Ce ne sont que des déclarations de constantes.
> **ATTENTION** : En cas de migration de serveur, ce fichier est à modifier !

### CAS
* **Rôle** : Fichier fourni par l’Université de Lorraine qui permet l’authentification des étudiants sur toutes les plateformes universitaires (arche, ent, mail.etu…).
* **Fichiers requis** : aucun
* **Fonctionnement** : Voir la doc fournis avec le fichier (dossier CAS).

### logout
* **Rôle** : Permet de déconnecter un utilisateur.
* **Fichiers requis** : `CAS.php`
* **Fonctionnement** : Le fichier exécute la fonction “logout” de phpCAS qui déconnecte l’utilisateur du service UL puis détruit les variables de session.

---

## Base de données
Nous verrons ici comment sont agencés les données et comment les utiliser.

La base de Données s’appelle “studiness”. Dans la suite de cette documentation se trouve la liste des tables.

### studi_mess
Cette table contient tous les messages de la partie forum.

### id_mess
Index de la table. Il n’est pas à saisir (auto-incrément).

### message
Contenu du message.

### date_mess
Contient la date de la saisie du message au format datetime (date + heure) (now() en php).

### id_user_mess
Contient l’id de l’utilisateur qui a posté le message, il est contenu dans la variable de session lorsque l’utilisateur est connecté

### id_mess_topic
Contient l’id du topic qu’on retrouve dans la table “studi_topics”. Attention lors de la création d’un nouveau topic, il faut d’abord l’enregistrer dans la table “studi-topics” afin qu’un id lui soit assigné, id que l’on pourra, alors, intégré dans cette colonne.

### studi_news
Cette table contient les news. Elles sont à ajouter directement dans phpmyadmin, il n’y a pas de page permettant d’en ajouter.

### id_news
Index de la table

### title_news
Contient le titre de la news.

### short_news
Contient un résumé de la news (que l’on pourra afficher dans la page news). Cette technique permet de séparer le résumé du texte entier. De cette manière, dans text news, on pourra donner plus d’informations en l’écrivant en html.

### text_news
Contient le contenu de la news. CE CONTENU EST A ECRIRE AU FORMAT HTML (`<p>lorem ipsum</p>`). De cette manière, on peut utiliser un peu de style et de sémantique (strong, cite, img) dans le contenu de la news.

### date_news
Contient la date à laquelle la news a été ajoutée, cette date est au format datetime.

### media_news
Contient le lien vers l’image de l’article, si il y a des images intégrés dans l’article, elles peuvent être intégrés directement dans la colonne “text_news”.

### id_user_news
Contient l’id de l’utilisateur qui a créé la news.

### studi_topics
Cette table permet de stocker les sujet de la partie forum.

### id_topic
Index de la table

### nom_topic
Contient le nom du sujet.

### date_topic
Contient la date de création au format datetime

### studi_users
Cette table permet de stocker les informations sur les utilisateurs. Si un utilisateur authentifié n’est pas répertorié dans cette table, on considère qu’il s’agit de sa première connexion (il accède donc à la page “premiere-co.php”.

### id_user
Index de la table

### login_user
login de l’utilisateur il est obtenu par l’authentification phpCAS univ-lorraine et est stocké dans la variable de session.

### nom_user
Nom de l’utilisateur.

### prenom_user
Prénon de l’utilisateur.

### sexe_user
Contient le sexe de l’utilisateur, dans un premier cela fera varier la photo représentant celui qui a écrit un message.
