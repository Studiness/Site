<footer class="bd-footer row  mt-5">
  </hr>
  <!-- Nav avec les différents lien des page (voir ci-dessus) : à complèter -->
  <ul class="nav col-md-8 justify-content-start text-center ml-3">
    <li class="nav-item">
      <a class="nav-link text-muted" href="fonctionnalites.php">FONCTIONNALITES</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-muted" href="equipe.php">L'EQUIPE</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-muted" href="contact.php">CONTACT</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-muted" href="mentions.php">MENTIONS LEGALES</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-muted" href="faq.php">FAQ</a>
    </li>
  </ul>
  <ul class="nav col-md-3 justify-content-end">
    <li class="nav-item">
      <a class="nav-link" href="https://www.facebook.com/studiness/" target="_blank"><img src="media/facebook.svg" alt="facebook" height="50"/></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="https://twitter.com/studiness_" target="_blank"><img src="media/twitter.svg" alt="twitter" height="50"/></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="https://www.instagram.com/studiness_/?hl=fr" target="_blank"><img src="media/instagram.svg" alt="instagram" height="50"/></a>
    </li>
  </ul>

</footer>

<!-- Fin de div container ouvert dans header.php pour contenir toute la page -->
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        // get current URL path and assign 'active' class
        var pathname = window.location.pathname;
        $('.navbar-nav > li > a[href="'+pathname+'"]').parent().addClass('active');
        })
    </script>

  </body>

</html>
