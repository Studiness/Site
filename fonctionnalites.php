<?php
require('header.php');
?>

<div class="jumbotron">
  <h1>Fonctionnalités</h1>

  <div id="accordion" role="tablist">
    <div class="card">
      <div class="card-header" role="tab" id="headingOne">
        <h5 class="mb-0">
          <a data-toggle="collapse" href="#collapseOne" role="button" aria-expanded="false" aria-controls="collapseOne" class="studivert">
            Forum
          </a>
        </h5>
      </div>

      <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
          <p>Partagez vos impressions, vos connaissances et vos problèmes sur notre Forum Studiness.</p>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header" role="tab" id="headingTwo">
        <h5 class="mb-0">
          <a data-toggle="collapse" href="#collapseTwo" role="button" aria-expanded="false" aria-controls="collapseTwo" class="studivert">
            News
          </a>
        </h5>
      </div>

      <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
        <div class="card-body">
          <p>Tenez-vous informés de l'actualité high-tech !</p>
        </div>
      </div>
    </div>
  </div>

</div>

<?php
require('footer.php')
?>
