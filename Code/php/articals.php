<?php
require_once '../includes/dbh.inc.php';
error_reporting(E_ERROR | E_PARSE);
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/articals.css">
    <script src="https://kit.fontawesome.com/d12613abfd.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="jquery-3.6.4.min.js"></script>

    <title>Mental Health Website</title>
</head>

<body>
    <!-- sidebar -->
    <?php
    include './sidebar.php'
    ?>

<header>
        <div class="decription">
            <h1>Therapist Finder</h1>
            <p>The therapist finder feature on our website allows you to search for therapists in your area. Simply enter your desired location,
                and you'll find a list of therapists practicing in that specific region. This convenient tool makes it easy to find the right
                therapist near you, ensuring that you can access the support you need within your local community.</p>
        </div>
        <img src="../assets/search.svg" alt="">

    </header>

    <main class="">


        <section class="filters-section">
            <button name="filter" id="allBtn">All</button>
            <button name="filter" id="latestBtn">Latest</button>
            <button name="filter" id="mostLikedBtn">Most liked</button>
            <button name="filter" id="popularBtn">Popular</button>
        </section>

        <section class="articals">
            <?php
      $apiUrl = "https://newsapi.org/v2/everything?q=health&apiKey=5c9d524040dc4cb987a6600da8789277";
      
      $response = file_get_contents($apiUrl);
      $data = json_decode($response, true);
      
      if ($data && $data['status'] == "ok") {
          $articles = $data['articles'];
      
          foreach ($articles as $article) {
              echo '<div class="article-card">';
              echo '<img src="' . $article['urlToImage'] . '" alt="Article Image">';
              echo '<h3>' . $article['title'] . '</h3>';
              echo '<p>' . $article['description'] . '</p>';
              echo '<a href="' . $article['url'] . '">Read more</a>';
              echo '</div>';
          }
      } else {
          echo "Failed to fetch data from the API.";
      }
            ?>
         
       
            

            

        </section>

    </main>

    <script src="../js/articals.js"></script>

</body>

</html>