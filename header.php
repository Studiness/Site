<?php
// Fichier d'acces au serveur de base de données
require_once('config.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">

    <head>

        <meta charset="utf-8"/>
        <title>Studiness</title>
        <meta name="description" content="Page d'accueil studiness"/>
        <meta name="author" content="ABT Valentin NEFF Charlène"/>
        <meta name="keywords" content="html css bootstrap studiness ul php sql mysql"/>

        <!-- Logo -->
        <link rel="icon" href="media/miniaturelogobleu.svg"/>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

        <!-- Custom css -->
        <link href="css/custom_css.css" rel="stylesheet"/>

    </head>

    <body>

      <!-- div container qui contient toute la page et se ferme dans footer.php -->
      <div class="container">

<?php

  // Préparation des deux types de nav en fonction de la variable de session

  function navgen ()
  {
    echo('
    <nav class="navbar navbar-expand-md navbar-dark fixed-top justify-content-between bg-studiblue" style="font-size:1rem">
      <a class="nav-link" href="index.php">
        <img src="media/miniaturelogoblanc.svg" alt="logo" width="50" height="50"/>
        <span class="font-weight-bold text-white">STUDINESS</span>
      </a>
     <!-- div alignée à droite avec les liens -->
     <div class="collapse navbar-collapse col-3 align-self-end align-top" style="height:66px" id="navbarCollapse">
       <ul class="navbar-nav mr-auto">
         <li class="nav-item" id="fonctionnalites">
           <a class="nav-link" href="/auth/studiness/fonctionnalites.php">Fonctionnalités</a>
         </li>
         <li class="nav-item" id="equipe">
           <a class="nav-link" href="/auth/studiness/equipe.php">L\'équipe</a>
         </li>
         <li class="nav-item" id="contact">
           <a class="nav-link" href="/auth/studiness/contact.php">Contact</a>
         </li>
       </ul>

     </div>
    ');
  }
  function navpers ()
  {
    echo('
    <nav class="navbar navbar-expand-md navbar-light fixed-top justify-content-between bg-primary">
      <!-- Logo avec mauvaises couleurs : à changer -->
      <a class="nav-link" href="accueil.php">
        <img src="media/miniaturelogo.svg" alt="logo" width="50" height="50"/>
        <span class="font-weight-bold text-white">STUDINESS</span>
      </a>
     <!-- div alignée à droite avec les liens -->
     <div class="collapse navbar-collapse col-4 align-self-center" id="navbarCollapse">
       <ul class="navbar-nav mr-auto">
         <li class="nav-item rounded-0 border border-primary border-top-0 border-bottom-0" id="accueil">
           <a class="nav-link" href="/auth/studiness/accueil.php">ACCUEIL</a>
         </li>
         <li class="nav-item rounded-0 border border-primary border-top-0 border-bottom-0" id="news">
           <a class="nav-link" href="/auth/studiness/news.php">NEWS</a>
         </li>
         <li class="nav-item rounded-0 border border-primary border-top-0 border-bottom-0" id="forum">
           <a class="nav-link" href="/auth/studiness/forum.php">FORUM</a>
         </li>
         <li class="nav-item rounded-0 border border-primary border-top-0 border-bottom-0" id="monespace">
           <a class="nav-link" href="/auth/studiness/monespace.php">MON ESPACE</a>
         </li>
         <li class="nav-item">
          <a class="nav-link" href="/auth/studiness/logout.php=">Se déconnecter</a>
        </li>
       </ul>

     </div>
    ');
  }

  // Vérification de variable de session
  // Si il y en a : nav avec lien pages personnelles
  // Sinon nav générique

  if (!isset($_SESSION) || empty($_SESSION['userLogin'])) {
    navgen();
  }else {
    navpers();
  }

?>
    </nav>
