<?php
require('redirect.php');
require('header.php');

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
?>

<h1>Les dernières news</h1>

<div class="row">
  <?php
  // Etablissement de la connection avec le serveur (voir détail sur forum.php).
  $connect=mysqli_connect(SERVEUR, USER, MDP, BDD) or die(mysqli_connect_error($connect));
  $okcharset=mysqli_set_charset($connect, 'utf8');
  $requete="SELECT `id_news`, `media_news`, `title_news`, `short_news` FROM `studi_news`";
  $resSQL=mysqli_query($connect, $requete) or die(mysqli_connect_error($connect));
  $nbEnr=mysqli_num_rows($resSQL);

  for ($i=0; $i < $nbEnr; $i++) {
    $tab=mysqli_fetch_array($resSQL);
    echo('
    <div class="col-md-4">
      <a href="news-view.php?news=' . $tab['id_news'] . '">
        <img src="' . $tab['media_news'] . '" alt="' . $tab['title_news'] . '"/>
        <h2>' . $tab['title_news'] . '</h2>
        ' . $tab['short_news'] . '
      </a>
    </div>
  ');
  }

echo ('</div>');
require('footer.php')
?>
