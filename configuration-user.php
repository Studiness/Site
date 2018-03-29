<?php
// Cette page va enregistrer ce qui a été saisie dans le formulaire de première connexion.

require_once('config.php');

// Intiaalisation des variables de session
session_start();

function erreur(){
  echo('Quelque-chose s\'est mal passé, peut-être avez-vous tenté l\'impossible ?');
}

if (!isset($_SESSION['userLogin']) || !isset($_POST['inputNom']) || !isset($_POST['inputPrenom']) || !isset($_POST['sexe'])) {
  erreur();
}else if (empty($_SESSION['userLogin']) || empty($_POST['inputNom']) || empty($_POST['inputPrenom']) || empty($_POST['sexe'])) {
  erreur();
}else if ($_SESSION['userLogin']=='' || $_POST['inputNom']=='' || $_POST['inputPrenom']=='' || $_POST['sexe']=='') {
  erreur();
}else if ($_POST['sexe']!='f' && $_POST['sexe']!='h') {
  erreur();
}else {
  $connect=mysqli_connect(SERVEUR, USER, MDP, BDD) or die(mysqli_connect_error($connect));
  $requete="INSERT INTO `studi_users` (`login_user`, `nom_user`, `prenom_user`, `sexe_user`) VALUES ('" . $_SESSION['userLogin'] . "', '" . $_POST['inputNom'] . "', '" . $_POST['inputPrenom'] . "', '" . $_POST['sexe'] . "')";
  $resSQL=mysqli_query($connect, $requete) or die(mysqli_connect_error($connect));
  $ok=mysqli_close($connect);

  echo('
  Opération réussie
  <script type="text/javascript">
    window.onload=function redirect()
    {
      document.location.href="accueil.php";
    }
  </script>
  ');
}

?>
