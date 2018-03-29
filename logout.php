<?php

// Ce fichier permet de se déconnecter du service phpCas aisni que la suppression des variables de

require_once('CAS/CAS.php');

// Initialisation des variables de sessions
session_start();

phpCAS::setDebug();
phpCAS::client(CAS_VERSION_2_0,"auth.univ-lorraine.fr",443,'');

// Appel de la fonction de logout de la session phpCas
phpCAS::logout();

// Désactivation de la variable de session
unset($_SESSION);

// Destruction de la session
session_destroy();

// Redirection vers l'index en javascript
echo('
<script type="text/javascript">
  window.onload=function redirect()
  {
    document.location.href="index.php";
  }
</script>
');

?>
