<?php
require_once('redirect.php');
require_once('header.php');

// Création d'une fonction de redirection anti-hackers
function redirect_news()
{
  echo ('<script type="text/javascript">
    window.onload=function redirect()
    {
      document.location.href="news.php?alert=error";
    }
  </script>');
}

// Récupération de l'id de la news si il y en a un.
if(!isset($_GET['news']) || empty($_GET['news']) || !is_numeric($_GET['news']))
{
  redirect_news();
}else {

  // Etablissement de la connection avec le serveur (voir détail sur forum.php).
  $connect=mysqli_connect(SERVEUR, USER, MDP, BDD) or die(mysqli_connect_error($connect));
  $okcharset=mysqli_set_charset($connect, 'utf8');
  $requete="SELECT * FROM `studi_news` WHERE `id_news`=" . $_GET['news'];
  $resSQL=mysqli_query($connect, $requete) or die(mysqli_connect_error($connect));
  $tab=mysqli_fetch_array($resSQL);

  if (empty($tab['title_news']) || $tab['title_news']=='') {
    redirect_news();
  }
  // Affichage du titre
  echo('
  <div class="jumbotron">
    <h1>' . $tab['title_news'] . '</h1>
    <!-- Contenu -->
  </div>
  ');
  // Affichage du contenu
  echo ('

  <div class="card">
    <img class="card-img-top" src="media/news/' . $tab['media_news'] . '" alt="' . $tab['title_news'] . '">
    <div class="card-body">
      <h5 class="card-title">' . $tab['title_news'] . '</h5>
      <p class="card-text">' . $tab['text_news'] . '</p>
      <p class="card-text"><small class="text-muted">' . $tab['date_news'] . '</small></p>
    </div>
  </div>

  ');

  $ok=mysqli_free_result($resSQL);
  $ok=mysqli_close($connect);

require_once('footer.php');
}
?>
