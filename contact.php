<?php
require('header.php');
?>

<div class="jumbotron">
  <h1 mb-5>Contact</h1>
  <form class="form" action="envoieMail.php" method="get">
    <input type="hidden" name="dest" value="studiness@gmail.com"/>
    <label for="exped">E-Mail</label>
    <input class="form-control mb-3" type="email" name="exped" placeholder="Votre adresse mail" required="required"/>
    <label for="sujet">Sujet du mail</label>
    <input class="form-control mb-3" type="text" name="sujet" placeholder="Sujet de votre Mail" required="required"/>
    <label for="message">Message</label>
    <textarea class="form-control mb-3 dp-block" name="message" rows="8" cols="80"></textarea>
    <button class="btn btn-primary" type="submit">Envoyer</button>
  </form>
</div>

<div class="row">
  <div class="col-md-12">
    <a href="mail-to:studiness@gmail.com">Envoyer nous un mail</a>
    <p>11 rue de l'Université, 88100 Saint-Dié-des-Vosges</p>
  </div>
</div>

<?php
require('footer.php')
?>
