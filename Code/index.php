<?php
require_once './includes/dbh.inc.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/d12613abfd.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./styles/index.css?v=<?php echo time(); ?>">
  <title>mywellnes</title>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
      <div class="navbar-logo">
        <img src="./assets/logoMb.svg" alt="Logo">
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end d-flex flex-column justify-content-between" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h3 class="offcanvas-title" id="offcanvasNavbarLabel">Mywellness</h3>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body ">
          <ul class="navbar-nav custom-navbar-nav ">
            <li class="nav-item">
              <a class="nav-link" href="#home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#features">Features</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#testimonial">Testimonial</a>
            </li>
          </ul>

          <div class="login">
            <a href="./php/Login.php" class="btn">Log In</a>
          </div>
        </div>
      </div>

    </div>
  </nav>



  <!-- Banner -->
  <section class="banner">
    <div class="container-fluid mt-5">
      <div class="row align-items-center">
        <div class="col-lg-6 mx-1">
          <div class="banner-image">
            <img src="./assets/head 1.svg" alt="Banner Image">
          </div>
        </div>
        <div class="col-lg-5 mx-1">
          <div class="banner-content">
            <h1 class="banner-title">Enhance Your Well-being with MyWellnes</h1>
            <h3 class="banner-subtitle">Unlock Your Full Potential and Embrace a Healthier Life</h3>
            <p class="banner-description">Embark on a transformative journey with MyWellnes. Discover
              personalized well-being plans tailored to your needs and goals. Take control of your physical and
              mental health, and experience a profound positive change.</p>
            <a href="./php/test.php" class="btn">Sign Up</a>
          </div>
        </div>
      </div>
    </div>
  </section>



  <!--Card section -->
  <h2 class="section-title  my-5">Features</h2>
  <section class="features">
    <div class="container">

      <div class="row">
        <div class="col-md-3 col-sm-6">
          <div class="feature">
            <i class="fa-solid fa-heart-circle-check"></i>
            <h3>Community & Sharing</h3>
            <p>Connect with a caring community. Share experiences, offer support, and inspire others on their well-being journey.</p>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="feature">
            <i class="fas fa-brain"></i>
            <h3>Personalized Plan</h3>
            <p>Access a tailored plan to improve mental health. Receive activities and articles for your specific needs.</p>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="feature">
            <i class="fas fa-user-friends"></i>
            <h3>Therapist Network</h3>
            <p>Search for local therapists. Connect, get guidance, and schedule appointments with professionals who understand your needs.</p>
          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="feature">
            <i class="fa-solid fa-newspaper"></i>
            <h3>Journaling & Publishing</h3>
            <p>Express thoughts and track progress through digital journaling. Publish and explore shared journals for inspiration.</p>
          </div>
        </div>
      </div>

    </div>
  </section>



  <!-- About -->
  <section class="about">
    <div class="container-fluid">
      <div class="d-flex justify-content-around">

        <div class="col-md-5 ">
          <div class="about-content">
            <h2 class="section-title">Discover a World of Wellness</h2>
            <h3 class="section-subtitle">Elevate Your Well-being and Embrace a Balanced Life</h3>
            <p>Welcome to MyWellnes, a place dedicated to improving your well-being and supporting your mental health journey. We prioritize self-care and offer personalized plans, a supportive community, trusted therapists, and empowering journaling.</p>
            <p>Connect with like-minded individuals, access tailored recommendations and articles, find professional guidance, and engage in self-reflection through our digital journaling feature.</p>
          </div>
        </div>
        <div class="">
          <img src="./assets/about.svg" alt="About Image">
        </div>
      </div>
  </section>





  <!-- Tetimonials section -->
  <section class="testimonials my-5">
    <div class="container-fluid">
      <h2>Ce que disent nos Membres</h2>
      <div class="row">
        <div class="col-md-4">
          <div class="testimonial">
            <div class="quote">
              <i class="fas fa-quote-left" aria-hidden="true"></i>
            </div>
            <p>"MyWellness has transformed my well-being journey. With its personalized programs and supportive community, I've achieved remarkable improvements in my physical and mental health."</p>
            <div class="author">
              <img class="user-image" src="./assets/profile.jpg" alt="User 1">
              <div class="name">John Doe</div>
              <i class="fas fa-star icon" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="testimonial">
            <div class="quote">
              <i class="fas fa-quote-left" aria-hidden="true"></i>
            </div>
            <p>"I'm so grateful for MyWellness. The range of resources and features available have made it easy for me to prioritize my well-being. It's user-friendly and effective. Highly recommend!"</p>
            <div class="author">
              <img class="user-image" src="./assets/profile.jpg" alt="User 1">
              <div class="name">John Doe</div>
              <i class="fas fa-star icon" aria-hidden="true"></i>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="testimonial">
            <div class="quote">
              <i class="fas fa-quote-left" aria-hidden="true"></i>
            </div>
            <p>"Thanks to MyWellness, I'm on a path to long-term well-being. The interactive challenges and supportive community have made my journey enjoyable and motivating. It's a game-changer!"</p>
            <div class="author">
              <img class="user-image" src="./assets/profile.jpg" alt="User 2">
              <div class="name">Jane Smith</div>
              <i class="fas fa-star icon" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>




  <!-- footer -->
  <footer class="text-center text-white">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
      <!-- Section: Social media -->
      <section class="mb-4">

        <!-- Instagram -->
        <a class="btn text-white btn-floating m-1" style="background-color: #ac2bac;" href="#!" role="button"><i class="fab fa-instagram"></i></a>

        <!-- Linkedin -->
        <a class="btn text-white btn-floating m-1" style="background-color: #0082ca;" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>
        <!-- Github -->
        <a class="btn text-white btn-floating m-1" style="background-color: #333333;" href="#!" role="button"><i class="fab fa-github"></i></a>
      </section>
    </div>

    <!-- Copyright -->
    <div class="text-center p-3">
      © Trifi Hiba Copyright:
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/62ff79fbfd.js" crossorigin="anonymous"></script>


</body>

</html>