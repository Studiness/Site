<?php
require('redirect.php');
require('header.php');

if (isset($_GET['alert'])){
  if ($_GET['alert']=='error') {
    echo ('
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Attention !</strong> N\'essayez pas de bricoler dans la QueryString !
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  ');
  }
}
?>

<h1>Les dernières news</h1>

<div class="row">
  <?php
  // Etablissement de la connection avec le serveur (voir détail sur forum.php).
  $connect=mysqli_connect(SERVEUR, USER, MDP, BDD) or die(mysqli_connect_error($connect));
  $okcharset=mysqli_set_charset($connect, 'utf8');
  $requete="SELECT * FROM `studi_news` ORDER BY `date_news` DESC";
  $resSQL=mysqli_query($connect, $requete) or die(mysqli_connect_error($connect));
  $nbEnr=mysqli_num_rows($resSQL);

  for ($i=0; $i < $nbEnr; $i++) {
    $tab=mysqli_fetch_array($resSQL);
    echo('
    <div class="card col-md-4">
      <div class="card-body">
        <p class="card-text"><small class="text-muted">' . $tab['date_news'] . '</small></p>
        <img class="self-center" src="media/news/' . $tab['media_news'] . '" alt="' . $tab['title_news'] . '" width="100%"/>
        <h6 class="card-title mt-1">' . $tab['title_news'] . '</h5>
        <p class="card-text">' . $tab['short_news'] . '</p>
        <a href="news-view.php?news=' . $tab['id_news'] . '" class="card-link self-align-end studiorange">Lire la suite</a>
      </div>
    </div>
    ');
  }

echo ('</div>');
require('footer.php')
?>
