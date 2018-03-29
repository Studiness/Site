<?php
require_once('redirect.php');
require_once('header.php');

// Script pour ajouter topic et rediriger vers topic

function error_entry()
{
  echo('
  <script type="text/javascript">
    window.onload=function redirect()
    {
      document.location.href="forum.php?error=error_entry";
    }
  </script>
  ');
}

if (!isset($_GET['topictitle']) || !isset($_GET['message']))
{
  error_entry();
}
if (empty($_GET['topictitle']) || empty($_GET['message']))
{
  error_entry();
}else{
  //===========================================================================================
  // Première étape : enregistrement du nom du topictitle
  //===========================================================================================

  // Etablissement de la connexion avec la base de données de STUDINESS
    $connect=mysqli_connect(SERVEUR, USER, MDP, BDD) or die(mysqli_connect_error($connect));
    $okcharset=mysqli_set_charset($connect, 'utf8');
  // Préparation de la requete qui va capturer les topic existants
    $requete="INSERT INTO `studi_topics` (`nom_topic`, `date_topic`) VALUES ('" . $_GET['topictitle'] . "', '" . date('Y-m-d H:m:s') . "')";
  // Récupération des valeurs résultantes de la requete
    $resSQL=mysqli_query($connect, $requete) or die(mysqli_connect_error($connect));

  //===========================================================================================
  // Deuxième étape : récupération de l'ID du topictitle
  //===========================================================================================

    $requete="SELECT `id_topic` FROM `studi_topics` WHERE `nom_topic`='" . $_GET['topictitle'] . "'";
    $resSQL=mysqli_query($connect, $requete) or die(mysqli_connect_error($connect));
    $tab=mysqli_fetch_array($resSQL);
    // Enregistrement de l'ID dans une variable
    $idtopic=$tab['id_topic'];
    $ok=mysqli_free_result($resSQL);

  //===========================================================================================
  // Troisème étape : récupération de l'id qui correspond au login
  //===========================================================================================

    $requete="SELECT `id_user` FROM `studi_users` WHERE `login_user`='" . $_SESSION['userLogin'] . "'";
    $resSQL=mysqli_query($connect, $requete);
    $tab=mysqli_fetch_array($resSQL);
    // Enregistrement de l'ID dans une variable
    $iduser=$tab['id_user'];
    $ok=mysqli_free_result($resSQL);

  //==========================================================================================
  // Quatrième étape : enregistrement du message dans la base de données
  //==========================================================================================

    $requete="INSERT INTO `studi_mess` (`message`, `date_mess`, `id_user_mess`, `id_mess_topic`) VALUES ('" . $_GET['message'] . "', '" . date('Y-m-d H:m:s') . "', " . $iduser . ", " . $idtopic . ")";
    $resSQL=mysqli_query($connect, $requete);

  //=============================
  // Fin
  //=============================

    $ok=mysqli_close($connect);

  echo ('
  <script type="text/javascript">
    window.onload=function redirect()
    {
      document.location.href="topic.php?topic=' . $_GET['idtopic'] . '&alert=upsuccess";
    }
  </script>
  ');
}

?>
