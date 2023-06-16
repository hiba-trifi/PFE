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
    <link rel="stylesheet" href="../styles/therapists.css?v=<?php echo time(); ?>">
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
    <main>
        <section class="search-section">
            <form method="POST" action="">
                <div class="contain">
                    <input type="text" name="location" placeholder="Location">
                    <select name="category" id="category">
                        <option value="therapists">Therapists</option>
                        <option value="psychologist">Psychologists</option>
                        <option value="counselors">Counselors</option>
                        <option value="psychiatrists">Psychiatrists</option>
                        <option value="socialworkers">Social Workers</option>
                        <option value="lifecoaches">Life Coaches</option>
                        <option value="supportgroups">Support Groups</option>
                        <option value="onlinecounseling">Online Counseling</option>
                    </select>
                </div>
                <button type="submit" name="search">Search</button>
            </form>
        </section>

        <div class="card-container">
            <?php
            if (isset($_POST[('search')])) {
                $apiKey = 'AIzaSyAsEhcYf-NZNlL6-FVHfT1GT3XAth8EJk4';
                $category = $_POST['category'];
                $location = $_POST['location'];
                $url = "https://maps.googleapis.com/maps/api/place/textsearch/json?query=" . urlencode($category) . "'s+in+" . urlencode($location) . "&key=" . $apiKey;
                $response = file_get_contents($url);
                $data = json_decode($response, true);

                if ($data && $data['status'] == "OK") {
                    $results = $data['results'];
            ?>

                    <?php
                    foreach ($results as $result) {
                        // Retrieve the necessary information
                        $name = $result['name'];
                        $address = $result['formatted_address'];
                        $rating = $result['rating'];
                        $openNow = $result['opening_hours']['open_now'];
                        $photoReference = $result['photos'][0]['photo_reference'];
                        $photoUrl = 'https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=' . $photoReference . '&key=' . $apiKey;
                    ?>

                        <div class="card">
                            <div class="card-img">
                                <?php
                                $photoReference = $result['photos'][0]['photo_reference'];
                                $photoUrl = 'https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=' . $photoReference . '&key=' . $apiKey;
                                echo '<img src="' . $photoUrl . '" class="rounded-circle" alt="Profile Photo">';
                                ?>
                            </div>
                            <div class="card-content">
                                <h5 class="card-title"><?php echo $result['name']; ?></h5>
                                <p class="card-text"><?php echo $result['formatted_address']; ?></p>
                                <p class="card-text"><?php echo ($result['opening_hours']['open_now'] ? 'Open Now' : 'Closed'); ?></p>
                                <p class="card-text"><?php echo $result['rating']; ?></p>

                            </div>
                        </div>


            <?php

                    }
                } else {
                    echo "Failed to retrieve data from the API.";
                }
            }
            ?>
        </div>
    </main>

    <script src="../js/articals.js"></script>

</body>

</html>