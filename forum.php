<?php
require_once('redirect.php');
require_once('header.php');

if (isset($_GET['error']))
{
  if ($_GET['error']=="error_entry") {
    echo('
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>ATTENTION !</strong> Nous avons detecté une erreur. Ne faites pas de bêtises !
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  ');
  }
}

?>
<div class="jumbotron">
  <h1>Forum <small>Apprenez, partagez, échangez !</small></h1>

  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newTopic"><span class="glyphicon glyphicon-plus"></span>Créer un nouveau sujet</button>

  <div class="modal fade" id="newTopic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">Créer un nouveau sujet</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="create-topic.php" methode="get">
          <div class="modal-body">
              <div class="form-group">
                <label for="topictitle" class="col-form-label">Titre du sujet</label>
                <input type="text" class="form-control" id="topictitle" name="topictitle" required="required"/>
              </div>
              <div class="form-group">
                <label for="message" class="col-form-label">Message</label>
                <textarea class="form-control" id="message" name="message" required="required"></textarea>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            <input type="submit" value="Créer !" class="btn btn-primary"/>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="list-group">
<?php
// Etablissement de la connexion avec la base de données de STUDINESS
  $connect=mysqli_connect(SERVEUR, USER, MDP, BDD) or die(mysqli_connect_error($connect));
  $okcharset=mysqli_set_charset($connect, 'utf8');
// Préparation de la requete qui va capturer les topic existants
  $requete="SELECT * FROM `studi_topics` ORDER BY `date_topic` DESC";
// Récupération des valeurs résultantes de la requete
  $resSQL=mysqli_query($connect, $requete) or die(mysqli_connect_error($connect));
// Calcul du nombre d'occurences
  $nbEnr=mysqli_num_rows($resSQL);
// Boucle qui va permettre d'afficher un a par topic trouvé.
  for ($i=0; $i < $nbEnr; $i++) {
// Enregistrement des infos du Iième topic
  $tab=mysqli_fetch_array($resSQL);
  echo('<a href="topic.php?topic=' . $tab['id_topic'] . '" class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">' . $tab['nom_topic'] . '</h5>');
// Pour chaque topic, il va y avoir affiché le dernier message avec la date et l'utilisateur qui l'a posté.
    $requete2="SELECT * FROM `studi_mess` INNER JOIN `studi_users` ON `studi_mess`.`id_user_mess`=`studi_users`.`id_user` WHERE `studi_mess`.`id_mess_topic`=" . $tab['id_topic'] . " ORDER BY `date_mess` LIMIT 1";
    $resSQL2=mysqli_query($connect, $requete2) or die(mysqli_connect_error($connect));
    $mess=mysqli_fetch_array($resSQL2);
      echo('<small>' . $mess['date_mess'] . '</small>
    </div>
    <p class="mb-1">' . $mess['message'] . '</p>');
    echo('<small>Par ' . $mess['prenom_user'] . ' ' . $mess['nom_user'] . '</small>
  </a>');
// Libération de la mémoire des résultats SQL.
  $ok=mysqli_free_result($resSQL2);
  }
  $ok=mysqli_free_result($resSQL);
  $ok=mysqli_close($connect);
echo ('</div>');
require_once('footer.php')
?>
