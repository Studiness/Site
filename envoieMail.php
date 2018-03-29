<!DOCTYPE html>
<html lang="fr">

	<head>
		<title>STUDINESS</title>
        <meta charset="utf-8" />
		<meta name="author" content="Valentin ABT" />
		<meta name="keywords" content="mail, php, query string" />
		<meta name="description" content="Envoi d'un mail avec la fonction mail de php" />
    </head>

    <body>


<?php

	// Récupération des champs qui sont censés être transmis
	// en fait on récupère les valeurs associés aux noms des champs et
	// on les stocke dans des variables PHP (commencent par un $).

	// Si les champs avaient été transmis en POST, il aurait fallu écrire $_POST
	// à la place de $_GET.

	$destinataire = $_GET ['dest'] ;
	$expediteur = $_GET ['exped'] ;
	$sujet = $_GET ['sujet'] ;
	$message = $_GET ['message'] ;

	// Ici on ne fait aucun contrôle, on espère que tous les champs sont bien remplis
	// à la soumission du formulaire

	// Puis on appelle simplement la fonction mail() prédéfinie en php en lui transmettant
	// les paramètres qu'elle attend

	$headers = 'From: ' . $expediteur ;

	mail ( $destinataire , $sujet , $message , $headers ) ;

	echo ('
	<script type="text/javascript">
		window.onload=function redirect()
		{
			document.location.href="index.php";
		}
	</script>
	');

?>

	</body>

</html>
