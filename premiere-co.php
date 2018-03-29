<?php
// Cette page permet à l'utilisateur faisant sa première connection d'ajouter quelques renseignement dans la base de données.

require_once('header.php');

?>

<div class="jumbotron">

  <h1>Bienvenue sur STUDINESS !</h1>
  <h2>Il s'agit de votre première connexion, nous allons configurer votre compte !</h2>

</div>

<form action="configuration-user.php" method="post">
  <div class="form-group row">
    <label for="inputNom" class="col-sm-2 col-form-label">Nom</label>
    <div class="col-sm-10">
      <input required="required" type="text" class="form-control" name="inputNom" id="inputNom" placeholder="Nom">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPrenom" class="col-sm-2 col-form-label">Prénom</label>
    <div class="col-sm-10">
      <input required="required" type="prenom" class="form-control" name="inputPrenom" id="inputPrenom" placeholder="Prénom">
    </div>
  </div>
  <div class="form-group row">
      <label for="sexe">Sexe</label>
      <select class="form-control" name="sexe" id="sexe">
        <option value="h">Homme</option>
        <option value="f">Femme</option>
      </select>
    </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Continuer</button>
    </div>
  </div>
</form>
