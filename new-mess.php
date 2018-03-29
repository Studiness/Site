<?php
require_once('redirect.php');
require_once('header.php');

// Script pour ajouter topic et afficher une alerte si erreur

function error_entry()
{
  echo('
  <script type="text/javascript">
    window.onload=function redirect()
    {
      document.location.href="topic.php?alert=error_entry";
    }
  </script>
  ');
}

if (!isset($_GET['nmessage']) || !isset($_GET['idtopic']) || !isset($_GET['submit']))
{
  error_entry();
}
if (empty($_GET['nmessage']) || empty($_GET['idtopic']) || empty($_GET['submit']))
{
  error_entry();
}
if ($_GET['submit']!='real_submit')
{
  error_entry();
}else {

  //===========================================================================================
  // Première étape : récupération de l'id qui correspond au login
  //===========================================================================================

    // Etablissement de la connection avec le serveur (voir détail sur forum.php).
    $connect=mysqli_connect(SERVEUR, USER, MDP, BDD) or die(mysqli_connect_error($connect));
    $okcharset=mysqli_set_charset($connect, 'utf8');
    $requete="SELECT `id_user` FROM `studi_users` WHERE `login_user`='" . $_SESSION['userLogin'] . "'";
    $resSQL=mysqli_query($connect, $requete);
    $tab=mysqli_fetch_array($resSQL);
    // Enregistrement de l'ID dans une variable
    $iduser=$tab['id_user'];
    $ok=mysqli_free_result($resSQL);

  //==========================================================================================
  // Deuxième étape : enregistrement du message dans la base de données
  //==========================================================================================

    $requete="INSERT INTO `studi_mess` (`message`, `date_mess`, `id_user_mess`, `id_mess_topic`) VALUES ('" . $_GET['nmessage'] . "', '" . date('Y-m-d H:i:s') . "', " . $iduser . ", " . $_GET['idtopic'] . ")";
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
