<?php
require('redirect.php');
require('header.php');
?>

<div class="row">
  <div class="col-md-8">
    <h1 class="border-bottom border-studibleu">Les dernières news</h1>
    <div class="row">
<?php
// Récupération des information pour afficher les deux dernière news.
// Etablissement de la connexion avec la base de données de STUDINESS
  $connect=mysqli_connect(SERVEUR, USER, MDP, BDD) or die(mysqli_connect_error($connect));
  $okcharset=mysqli_set_charset($connect, 'utf8');
// Préparation de la requete qui va capturer les topic existants
  $requete="SELECT `id_news`, `title_news`, `short_news`, `media_news` FROM `studi_news` LIMIT=2 ORDER BY `date_news` DESC";
// Récupération des valeurs résultantes de la requete
  $resSQL=mysqli_query($connect, $requete) or die(mysqli_connect_error($connect));
  for ($i=0; $i < 1; $i++) {
    $tab=mysqli_fetch_array($resSQL);
    echo('
    <div class="card col-md-4">
      <div class="card-body">
        <img src="media/news/' . $tab['media_news'] . '" alt="' . $tab['title_news'] . '" width="80"/>
        <h5 class="card-title">' . $tab['title_news'] . '</h5>
        <p class="card-text">' . $tab['short_news'] . '</p>
        <a href="info-news.php?news=' . $tab['id_news'] . '" class="card-link self-align-end studiorange">Lire la suite</a>
      </div>
    </div>
    ');
  }
  $ok=mysqli_free_result($resSQL);
?>
    </div>
  </div>
  <div class="col-md-8">
    <h1 class="border-bottom border-studibleu">Les discutions récentes</h1>
    <div class="list-group">


    <?php
    // Préparation de la requete qui va capturer les topic existants
      $requete="SELECT * FROM `studi_topics` LIMIT=6 ORDER BY `date_topic` DESC";
    // Récupération des valeurs résultantes de la requete
      $resSQL=mysqli_query($connect, $requete) or die(mysqli_connect_error($connect));
    // Calcul du nombre d'occurences
      $nbEnr=mysqli_num_rows($resSQL);
    // Boucle qui va permettre d'afficher un a par topic trouvé.
      for ($i=0; $i < $nbEnr; $i++) {
    // Enregistrement des infos du Iième topic
      $tab=msqli_fetch_array($resSQL);
      echo('<a href="topic.php?topic=' . $tab['id_topic'] . '" class="list-group-item list-group-item-action">
          <h5 class="mb-1">' . $tab['nom_topic'] . '</h5>');
    // Pour chaque topic, il va y avoir affiché le nombre de messages.
        $requete2="SELECT COUNT(`id_mess`) FROM `studi_mess` WHERE `id_mess_topic`=" . $tab['id_topic'];
        $resSQL2=mysqli_query($connect, $requete2) or die(mysqli_connect_error($connect));
        $mess=mysqli_fetch_array($resSQL2);
          echo('<span class="badge badge-light studiorange"></span>
      </a>');
    // Libération de la mémoire des résultats SQL.
      $ok=mysqli_free_result($resSQL2);
      }
      $ok=mysqli_free_result($resSQL);
      $ok=mysqli_close($connect);
    echo ('</div>');
    ?>
    </div>
  </div>
  <div class="col-md-4">
    <a href="#" class="border border-studiorange">Publier un cours / un tutoriel</a>
    <div>

    </div>
  </div>
</div>

<?php
require('footer.php');
?>
