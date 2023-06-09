<?php
require_once '../includes/dbh.inc.php';
error_reporting(E_ERROR | E_PARSE);
// error_reporting(E_ALL);
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="../styles/journals.css">
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

  <main class="">
    <!-- menu -->
    <div class="card fixed-right">
      <div class="card-body">
        <div class="user-profile">
          <img src="../assets/profile.jpg" alt="">
          <h5 class="card-title">John Doe</h5>

        </div>
        <hr>
        <div class="card-progress ">
          <h5> Your progress : </h5>
          <?php
          $memberId = $_SESSION['Id'];
          $completedTasksQuery = "SELECT COUNT(*) AS completedTasksCount FROM completed_tasks WHERE id_mb = :memberId";
          $stmt = $pdo->prepare($completedTasksQuery);
          $stmt->execute(['memberId' => $memberId]);
          $result = $stmt->fetch(PDO::FETCH_ASSOC);
          $completedTasksCount = $result['completedTasksCount'];
          $totalTasksCount = 10;
          $progressPercentage = ($completedTasksCount / $totalTasksCount) * 100;
          ?>
          <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: <?php echo $progressPercentage; ?>%;" aria-valuenow="<?php echo $progressPercentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $progressPercentage; ?>%</div>
          </div>
        </div>
        <!-- Published  -->
        <?php
        $memberId = $_SESSION['Id'];
        $publishedJournalsQuery = "SELECT COUNT(*) AS publishedJournalsCount FROM journal WHERE id_mb = :memberId AND jr_state = 'published'";
        $stmt = $pdo->prepare($publishedJournalsQuery);
        $stmt->execute(['memberId' => $memberId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $publishedJournalsCount = $result['publishedJournalsCount'];
        ?>
        <div class="card-text">
          <h5> Published Journals:</h5>
          <span><?php echo $publishedJournalsCount; ?></span>
        </div>
        <!--Unpublished   -->
        <?php
        $memberId = $_SESSION['Id'];
        $unpublishedJournalsQuery = "SELECT COUNT(*) AS unpublishedJournalsCount FROM journal WHERE id_mb = :memberId AND jr_state = 'unpublished'";
        $stmt = $pdo->prepare($unpublishedJournalsQuery);
        $stmt->execute(['memberId' => $memberId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $unpublishedJournalsCount = $result['unpublishedJournalsCount'];
        ?>
        <div class="card-text">
          <h5> Unpublished Journals:</h5>
          <span><?php echo $unpublishedJournalsCount; ?></span>
        </div>
        <!--Like  -->
        <?php
        $memberId = $_SESSION['Id'];
        $likedJournalsQuery = "SELECT COUNT(*) AS likedJournalsCount FROM likes WHERE id_mb = :memberId";
        $stmt = $pdo->prepare($likedJournalsQuery);
        $stmt->execute(['memberId' => $memberId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $likedJournalsCount = $result['likedJournalsCount'];
        ?>
        <div class="card-text">
          <h5> Liked Journals:</h5>
          <span><?php echo $likedJournalsCount; ?></span>
        </div>
        <!-- Save  -->
        <?php
        $memberId = $_SESSION['Id'];
        $savedJournalsQuery = "SELECT COUNT(*) AS savedJournalsCount FROM save  WHERE id_mb = :memberId";
        $stmt = $pdo->prepare($savedJournalsQuery);
        $stmt->execute(['memberId' => $memberId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $savedJournalsCount = $result['savedJournalsCount'];
        ?>
        <div class="card-text">
          <h5> Saved Journals:</h5>
          <span><?php echo $savedJournalsCount; ?></span>
        </div>

      </div>
      <img src="../assets/menu.svg" alt="">
    </div>

    <section class="filters-section">
      <button name="filter" id="allBtn">All</button>
      <button name="filter" id="LikedBtn">Liked</button>
      <button name="filter" id="savedBtn">saved</button>
    </section>


    <section class="journals">
      <?php
      if (isset($_POST['filter'])) {
        $filter = $_POST['filter'];
        $memberId = $_SESSION['Id'];

        if ($filter === 'all') {
          $query = "
          SELECT journal.* 
          FROM likes
          INNER JOIN journal ON likes.id_jr = journal.id_jr
          WHERE likes.id_mb = :memberId
          UNION
          SELECT journal.* 
          FROM save
          INNER JOIN journal ON save.id_jr = journal.id_jr
          WHERE save.id_mb = :memberId";
        } elseif ($filter === 'saved') {
          $query = "SELECT * FROM save JOIN journal ON save.id_jr = journal.id_jr WHERE save.id_mb = :memberId";
        } elseif ($filter === 'liked') {
          $query = "SELECT * FROM likes JOIN journal ON likes.id_jr = journal.id_jr WHERE likes.id_mb = :memberId";
        }


        $stmt = $pdo->prepare($query);
        $stmt->execute([':memberId' => $memberId]);
        $journals = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($journals as $journal) {
          $memberId = $_SESSION['Id'];
          $journalId = $journal['id_jr'];
          $journalName = $journal['jr_name'];
          $journalDate = $journal['jr_date'];
          $journalContent = $journal['jr_content'];
          $journalLikes = $journal['jr_likes'];
          $journalsaves = $journal['jr_saves'];
          $journalstate = $journal['jr_state'];




      ?>

          <div class="journal">
            <div class="journal-header d-flex justify-content-between">
              <span class="journal-name"><?php echo $journalName; ?></span>
              <div class="user-info">
                <span class="username">Anonymous User</span>
                <img src="../assets/profile.jpg" alt="">
              </div>
            </div>
            <hr>
            <div class="journal-content">

              <q><?php
                  echo $journalContent; ?></q>

            </div>
            <hr>
            <div class="journal-footer">
              <div class="buttons d-flex justify-content-between">
                <div class="likes">
                  <?php
                  $query = "SELECT COUNT(*) as likeCount FROM likes WHERE id_jr = :journalId";
                  $stmt = $pdo->prepare($query);
                  $stmt->bindParam(':journalId', $journalId);
                  $stmt->execute();
                  $result = $stmt->fetch();
                  $likeCount = $result['likeCount'];

                  $isLiked = false;

                  $query = "SELECT * FROM likes WHERE id_jr = :journalId AND id_mb = :memberId";
                  $stmt = $pdo->prepare($query);
                  $stmt->bindParam(':journalId', $journalId);
                  $stmt->bindParam(':memberId', $memberId);
                  $stmt->execute();

                  if ($stmt->rowCount() > 0) {
                    $isLiked = true;
                  }
                  ?>

                  <button class="like-button" name="like" data-journal-id="<?php echo $journalId; ?>">
                    <i class="<?php echo ($isLiked) ? 'fa-solid fa-heart' : 'fa-regular fa-heart'; ?>"></i>
                  </button>
                  <span class="like-count"><?php echo $likeCount; ?></span>
                </div>


                <div class="saves">
                  <span class="save-count "><?php echo $journalsaves; ?> </span>
                  <?php
                  $query = "SELECT * FROM save WHERE id_jr = :journalId AND id_mb = :memberId";
                  $stmt = $pdo->prepare($query);
                  $stmt->bindParam(':journalId', $journalId);
                  $stmt->bindParam(':memberId', $memberId);
                  $stmt->execute();
                  if ($stmt->rowCount() > 0) {
                    $isSaved = true;
                  }
                  ?>
                  <button class="save-button" name="save" data-journal-id="<?php echo $journalId; ?>">
                    <i class="<?php echo ($isSaved) ? 'fa-solid fa-bookmark' : 'fa-regular fa-bookmark'; ?>"></i>
                  </button>
                </div>
              </div>
            </div>
            <span class="journal-date "><?php echo $journalDate; ?></span>
          </div>
      <?php
        }
      }
      ?>
    </section>
  </main>


  <?php
  $journalId = $_POST['journalId'];
  $memberId = $_SESSION['Id'];

  if (isset($_POST['like'])) {
    $query = "SELECT * FROM likes WHERE id_mb = :memberId AND id_jr = :journalId";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['memberId' => $memberId, 'journalId' => $journalId]);
    $result = $stmt->fetch();
    if (!$result) {
      $Query = "INSERT INTO likes (id_mb, id_jr) VALUES (:memberId, :journalId)";
      $stmt = $pdo->prepare($Query);
      $stmt->execute(['memberId' => $memberId, 'journalId' => $journalId]);

      $updateQuery = "UPDATE journal SET jr_likes = jr_likes + 1 WHERE id_jr = :journalId";
      $stmt = $pdo->prepare($updateQuery);
      $stmt->execute(['journalId' => $journalId]);
      echo "liked";
    } else {
      $Query = "DELETE FROM likes WHERE id_mb = :memberId AND id_jr = :journalId";
      $stmt = $pdo->prepare($Query);
      $stmt->execute(['memberId' => $memberId, 'journalId' => $journalId]);

      $updateQuery = "UPDATE journal SET jr_likes = jr_likes - 1 WHERE id_jr = :journalId";
      $stmt = $pdo->prepare($updateQuery);
      $stmt->execute(['journalId' => $journalId]);
      echo "unliked";
    }
  } elseif (isset($_POST['save'])) {

    $query = "SELECT * FROM save WHERE id_mb = :memberId AND id_jr = :journalId";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['memberId' => $memberId, 'journalId' => $journalId]);
    $result = $stmt->fetch();

    if (!$result) {
      $Query = "INSERT INTO save (id_mb, id_jr) VALUES (:memberId, :journalId)";
      $stmt = $pdo->prepare($Query);
      $stmt->execute(['memberId' => $memberId, 'journalId' => $journalId]);

      $updateQuery = "UPDATE journal SET jr_saves = jr_saves + 1 WHERE id_jr = :journalId";
      $stmt = $pdo->prepare($updateQuery);
      $stmt->execute(['journalId' => $journalId]);
      echo "saved";
    } else {
      $Query = "DELETE FROM save WHERE id_mb = :memberId AND id_jr = :journalId";
      $stmt = $pdo->prepare($Query);
      $stmt->execute(['memberId' => $memberId, 'journalId' => $journalId]);

      $updateQuery = "UPDATE journal SET jr_saves = jr_saves - 1 WHERE id_jr = :journalId";
      $stmt = $pdo->prepare($updateQuery);
      $stmt->execute(['journalId' => $journalId]);
      echo "unsaved";
    }
  }
  ?>
  <script src="../js/savedJournals.js"></script>

</body>

</html>