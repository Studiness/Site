<?php
require_once('redirect.php');
require_once('header.php');


// Création d'une fonction de redirection anti-hackers
function redirect_forum()
{
  echo ('<script type="text/javascript">
    window.onload=function redirect()
    {
      document.location.href="forum.php";
    }
  </script>');
}

// Récupération de l'id du topic si il y en a un.
if(!isset($_GET['topic']) || empty($_GET['topic']) || !is_numeric($_GET['topic']))
{
  redirect_forum();
}else {
  // Affichage de l'alerte success si alert="success" dans la query string

  if (isset($_GET['alert']))
  {
    if ($_GET['alert']=='success') {
      echo('
        <div class="alert alert-success" role="alert">
          <h4 class="alert-heading">Le sujet a été créé avec succès</h4>
          <p>Votre message et maintenant visible par tous les membre de STUDINESS</p>
          <hr>
          <p class="mb-0">Ne ratez aucune de leur réponse, restez avec nous !</p>
        </div>
      ');
    }elseif ($_GET['alert']=='upsuccess') {
      echo('
        <div class="alert alert-success" role="alert">
          Votre message a bien été enregistré !
        </div>
      ');
    }elseif ($_GET['alert']=='error_entry') {
      echo ('
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>ATTENTION !</strong> Nous avons detecté une erreur !
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      ');
    }
  }

  // Etablissement de la connection avec le serveur (voir détail sur forum.php).
  $connect=mysqli_connect(SERVEUR, USER, MDP, BDD) or die(mysqli_connect_error($connect));
  $okcharset=mysqli_set_charset($connect, 'utf8');
  $requete="SELECT `nom_topic` FROM `studi_topics` WHERE `id_topic`=" . $_GET['topic'];
  $resSQL=mysqli_query($connect, $requete) or die(mysqli_connect_error($connect));
  $infoTopic=mysqli_fetch_array($resSQL);

  if (empty($infoTopic['nom_topic']) || $infoTopic['nom_topic']=='') {
    redirect_forum();
  }
  // Affichage du titre
  echo('
  <div class="jumbotron">
    <h1>' . $infoTopic['nom_topic'] . '</h1>
    <!-- Contenu -->
  </div>
  ');
  $ok=mysqli_free_result($resSQL);
  $requete2="SELECT * FROM `studi_mess` INNER JOIN `studi_users` ON `studi_mess`.`id_user_mess`=`studi_users`.`id_user` WHERE `studi_mess`.`id_mess_topic`=" . $_GET['topic'] . " ORDER BY `date_mess`";
  $resSQL2=mysqli_query($connect, $requete2) or die(mysqli_connect_error($connect));
  $nbEnr=mysqli_num_rows($resSQL2);
  $tab=mysqli_fetch_array($resSQL2);
  // Affichage du premier message du topic (dans une couleur différente)
  echo ('
  <div class="list-group">
    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
      <div class="d-flex w-100 justify-content-between">
        <small>' . $tab['date_mess'] . '</small>
      </div>
      <p class="mb-1">' . $tab['message'] . '</p>
      <small>Par ' . $tab['prenom_user'] . ' ' . $tab['nom_user'] . '</small>
    </a>');
  // Affichage de tous les autres messages
  for ($i=1; $i < $nbEnr; $i++) {
    $tab=mysqli_fetch_array($resSQL2);
    echo('
    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start mt-2">
      <div class="d-flex w-100 justify-content-between">
        <small>' . $tab['date_mess'] . '</small>
      </div>
      <p class="mb-1">' . $tab['message'] . '</p>
      <small>Par ' . $tab['prenom_user'] . ' ' . $tab['nom_user'] . '</small>
    </a>
    ');
  }
  echo('
  </div>
  ');
  $ok=mysqli_free_result($resSQL2);
  $ok=mysqli_close($connect);
  // Ajout d'un form pour ecrire un message
}
?>
<div class="jumbotron mt-5">
  <form class="form" action="new-mess.php" method="get">
    <div class="form-group">
      <label class="d-block" for="nmessage">Votre message :</label>
      <textarea name="nmessage" id="nmessage" rows="8" cols="80"></textarea>
      <input type="hidden" name="idtopic" value="<?php echo($_GET['topic']); ?>"/>
    </div>
    <button type="submit" name="submit" value="real_submit" class="btn btn-primary" name="button">Envoyer</button>
  </form>
</div>
<?php
require_once('footer.php');
?>
