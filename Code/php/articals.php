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
    <link rel="stylesheet" href="../styles/articals.css?v=<?php echo time(); ?>">
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
            <button name="filter" id="allBtn">Mentall Health</button>
            <button name="filter" id="latestBtn">Minfulness</button>
            <button name="filter" id="mostLikedBtn">Positifity</button>
            <button name="filter" id="popularBtn">Exercices</button>
            <button name="filter" id="popularBtn">Coaching</button>

        </section>

        <section class="articles mt-5">
    <div class="row">
        <?php
        $apiUrl = "https://newsapi.org/v2/everything?q=mindfullness&apiKey=5c9d524040dc4cb987a6600da8789277";

        $response = file_get_contents($apiUrl);
        $data = json_decode($response, true);

        if ($data && $data['status'] == "ok") {
            $articles = $data['articles'];

            foreach ($articles as $article) {
                echo '<div class="col-md-4 col-lg-9 m-5">';
                echo '<div class="card article-card d-flex flex-fill">';
                echo '<img src="' . $article['urlToImage'] . '" class="card-img-top" alt="Article Image">';
                echo '<div class="card-body">';
                echo '<h3 class="card-title">' . $article['title'] . '</h3>';
                echo '<p class="card-text">' . $article['description'] . '</p>';
                echo '<a href="' . $article['url'] . '" class="btn btn-primary">Lire la suite</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "Impossible de récupérer les données depuis l'API.";
        }
        ?>
    </div>
</section>



    </main>

    <script src="../js/articals.js"></script>

</body>

</html>