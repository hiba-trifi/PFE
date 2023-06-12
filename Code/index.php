<?php
require_once './includes/dbh.inc.php';
session_start();
if (isset($_SESSION["Id"])) {
  header('location:./php/plan.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="./styles/index.css">
  <title>mywellnes</title>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
    <div class="container-fluid">
      <div class="navbar-logo">
        <img src="logo.png" alt="Logo">
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Mywellness</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body  ">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link " href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Positive</a>
            </li>
          </ul>
          <div>
            <a href="./php/Login.php" class="btn">Login</a>
          </div>
        </div>
      </div>
    </div>
  </nav>


  <!-- Banner -->
  <section class="banner">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="banner-image">
            <img src="./assets/head 1.svg" alt="Banner Image">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="banner-content">
            <h2 class="banner-title">Make Your Life Better</h2>
            <h3 class="banner-subtitle">Improve Your Well-being and Keep Track of It</h3>
            <p class="banner-description">Take the test to see what plan you got based on your score. Follow the plan instructions and complete the tasks to overcome the challenges.</p>
            <a href="./php/test.php" class="btn">Sign Up</a>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- About -->
  <section class="about">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="about-content">
            <h2 class="section-title">Welcome to Our World</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rhoncus suscipit arcu, at accumsan lorem congue vel. Nulla facilisi.</p>
            <p>Phasellus fermentum ullamcorper leo, eu varius magna sagittis eu. In hac habitasse platea dictumst. Sed posuere, sem ut bibendum laoreet, purus turpis venenatis dui, a iaculis magna enim a nibh.</p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="about-image">
            <img src="./assets/about.svg" alt="About Image">
          </div>
        </div>
      </div>
    </div>
  </section>



  <!--Card section -->
  <section class="features">
    <div class="container">
      <h2 class="section-title">Features</h2>
      <div class="row">
        <div class="col-md-3 col-sm-6">
          <div class="feature">
            <i class="fas fa-heart"></i>
            <h3>Emotional Support</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="feature">
            <i class="fas fa-brain"></i>
            <h3>Mental Health Education</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="feature">
            <i class="fas fa-user-friends"></i>
            <h3>Therapist Network</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="feature">
            <i class="fas fa-book"></i>
            <h3>Journaling</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
          </div>
        </div>
      </div>
    </div>
  </section>



  <!-- Tetimonials section -->
  <section class="testimonials ">
    <div class="container">
      <h2>Ce que disent nos Membres</h2>
      <div class="row">
        <div class="col-md-6">
          <div class="testimonial">
            <div class="quote">
              <i class="fas fa-quote-left" aria-hidden="true"></i>
            </div>
            <p>"J'adore utiliser ce site de réservation de bibliothèque. Il est si facile de réserver des livres en
              ligne et de les récupérer sur
              la bibliothèque. Le processus est fluide et me fait gagner beaucoup de temps !"</p>
            <div class="author">
              <i class="fas fa-user" aria-hidden="true"></i>
              <div class="name">John Doe</div>
              <div class="location">San Francisco, CA</div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="testimonial">
            <div class="quote">
              <i class="fas fa-quote-left" aria-hidden="true"></i>
            </div>
            <p>"Ce site Web m'a rendu la vie tellement plus facile. J'avais l'habitude d'aller physiquement à la
              bibliothèque pour réserver
              livres, mais maintenant je peux tout faire dans le confort de ma propre maison."</p>
            <div class="author">
              <i class="fas fa-user" aria-hidden="true"></i>
              <div class="name">Jane Smith</div>
              <div class="location">New York, NY</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- footer -->
  <!-- <footer class="footer  ">
    <div class="footer_content  ">
      <div>
        <img class="mb-4  " src="../logo/logo.png" alt="">
        <div class="end_footer ">

          <ul class="list-unstyled d-flex mt-3 ">
            <li><a href="#" class="social-icon"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a href="#" class="social-icon"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            <li><a href="#" class="social-icon"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="d-block  mt-5 ">



        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3238.184323766385!2d-5.827633185087737!3d35.74627403401008!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd0b87c216892bc7%3A0x48bdf85995e9c186!2sSolicode%20Tanger!5e0!3m2!1sen!2sma!4v1678563249970!5m2!1sen!2sma"
          width="1000px" height="300" style="border:0;border-radius:10px;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>



        <p class="mt-4">© 2023 My Company</p>

      </div>





      <div class="mb-3">
        <h3>Contact Us :</h3>
        <form class="mb-3">
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name">
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email">
          </div>
          <div class="form-group">
            <label for="message">Message:</label>
            <textarea class="form-control" id="message" rows="1"></textarea>
          </div>
          <button type="submit" class="button btn bt-lg mt-3">Submit</button>
        </form>

      </div>
    </div>
  </footer> -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/62ff79fbfd.js" crossorigin="anonymous"></script>


</body>

</html>