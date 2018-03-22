<?php
require_once('redirect.php');
require_once('config.php');

// Script pour ajouter topic et afficher une alerte si erreur

private function error_entry()
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

if (!isset($_POST['nmessage']) || !isset($_POST['idtopic']) || !isset($_POST['submit']))
{
  error_entry();
}
if (empty($_POST['nmessage']) || empty($_POST['idtopic']) || empty($_POST['submit']))
{
  error_entry();
}
if ($_POST['submit']!='real_submit')
{
  error_entry();
}else {

  //===========================================================================================
  // Première étape : récupération de l'id qui correspond au login
  //===========================================================================================

    $requete="SELECT `id_user` FROM `studi_users` WHERE `login_user`='" . $_SESSION['userLogin'] . "'";
    $resSQL=mysqli_query($connect, $requete);
    $tab=mysqli_fetch_array($resSQL);
    // Enregistrement de l'ID dans une variable
    $iduser=$tab['id_user'];
    $ok=mysqli_free_result($resSQL);

  //==========================================================================================
  // Deuxième étape : enregistrement du message dans la base de données
  //==========================================================================================

    $requete="INSERT INTO `studi_mess` (`message`, `date_mess`, `id_user_mess`, `id_mess_topic`) VALUES ('" . $_POST['message'] . "', " . now() . ", " . $iduser . ", " . $idtopic;
    $resSQL=mysqli_query($connect, $requete);

  //=============================
  // Fin
  //=============================

    $ok=mysqli_close($connect);

  echo ('
  <script type="text/javascript">
    window.onload=function redirect()
    {
      document.location.href="topic.php?topic=' . $idtopic . '"&alert="upsuccess";
    }
  </script>
  ');
}

?>
