<?php
  ini_set('display errors', '1');
  error_reporting ( E_ALL ) ;
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  require_once('CAS/CAS.php');
  require_once('config.php');


// Cette page vérifie que l'utilisateur est connecté sinon il est renvoyé sur l'index
// Ce fichier est requis pour toute page pouvant copntenir du contenu personnel

phpCAS::setDebug();
phpCAS::client(CAS_VERSION_2_0,"auth.univ-lorraine.fr",443,'');

// Script de redirection
function authent (){
  // Authentification
  phpCAS::setNoCasServerValidation();
  phpCAS::forceAuthentication();
  // Enregistrement du login dans la variable de session
  $_SESSION['userLogin'] = phpCAS::getUser();
  $connect=mysqli_connect(SERVEUR, USER, MDP, BDD) or die(mysqli_connect_error($connect));
  $okcharset=mysqli_set_charset($connect, 'utf8');
  $requete="SELECT * FROM `studi_users` WHERE `login_user`='" . phpCAS::getUser() . "'";
  $resSQL=mysqli_query($connect, $requete) or die(mysqli_connect_error($connect));
  $Enr=mysqli_fetch_array($resSQL);
  $logenr=$Enr['id_user'];
  $ok=mysqli_free_result($resSQL);
  $ok=mysqli_close($connect);
  if (empty($logenr)) {
    echo('
    <script type="text/javascript">
      window.onload=function redirect()
      {
        document.location.href="premiere-co.php";
      }
    </script>
    ');
  }
}
// Vérification de variable de session
// Si il y en a : acces standard à la page
// Sinon authentification

if (!phpCAS::isSessionAuthenticated() || empty($_SESSION['userLogin'])) {
  authent();
}else{
}

?>
