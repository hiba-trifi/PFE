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
  <link rel="stylesheet" href="../styles/journals.css">
  <script src="https://kit.fontawesome.com/d12613abfd.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="jquery-3.6.4.min.js"></script>

  <title>Mental Health Website</title>
</head>

<body>
  <!-- sidebar -->
  <?php include './sidebar.php' ?>

  <main>
    <?php
    if (isset($_POST['create'])) {
      if (strlen($_POST['content']) < 100) {
    ?>
        <div class="alert alert-danger  mt-5" role="alert">
          <h4 class="alert-heading">Erreur!</h4>
          <?php echo "Error: Content must be at least 100 characters long."; ?>
        </div>

    <?php
      } else {
        $content = $_POST['content'];
        $journalName = $_POST['journalName'];
        if (isset($_SESSION['Id'])) {
          $memberId = $_SESSION['Id'];
          $publish_journal = "INSERT INTO `journal` (`jr_name`, `jr_date`, `jr_content`, `jr_state`, `is_prooved`, `id_mb`) VALUES (:journalName, NOW(), :content, :state, :prooved, :id_mb)";
          $stmt = $pdo->prepare($publish_journal);
          $stmt->execute([
            'journalName' => $journalName,
            'content' => $content,
            'state' => "unpublished",
            'prooved' => 1,
            'id_mb' => $memberId,
          ]);
          echo "Journal created successfully.";
        } else {
          echo "Error: User session not found.";
        }
      }
    }
    ?>
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
    <!-- create journal -->
    <button type="button" class="fixed-button" data-bs-toggle="modal" data-bs-target="#createjournal">
      <i class="fas fa-plus"></i>
      Create
    </button>


    <section class="filters-section">
      <button name="filter" id="allBtn">All</button>
      <button name="filter" id="publishedBtn">Published</button>
      <button name="filter" id="unpublishedBtn">Unpublished</button>
    </section>

    <!-- journal dislay -->
    <section class="journals">
      <?php
      if (isset($_POST['filter'])) {
        $filter = $_POST['filter'];
        $memberId = $_SESSION['Id'];

        if ($filter === 'all') {
          $query = "SELECT * FROM journal  WHERE id_mb = :memberId";
        } elseif ($filter === 'published') {
          $query = "SELECT * FROM journal  WHERE id_mb = :memberId AND jr_state='published' ";
        } elseif ($filter === 'unpublished') {
          $query = "SELECT * FROM journal WHERE id_mb = :memberId AND jr_state='unpublished' ";
        }

        $stmt = $pdo->prepare($query);
        $stmt->execute([':memberId' => $memberId]);
        $journals = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($journals as $journal) {
          $memberId = $_SESSION['Id'];
          $journalName = $journal['jr_name'];
          $journalDate = $journal['jr_date'];
          $journalContent = $journal['jr_content'];
          $journalLikes = $journal['jr_likes'];
          $journalState = $journal['jr_state'];
      ?>
          <div class="journal">
            <div class="journal-header d-flex justify-content-between">
              <span class="journal-name"><?php echo $journalName; ?></span>
              <div class="user-info">
                <span class="username">user</span>
                <img src="../assets/profile.jpg" alt="">
              </div>
            </div>
            <hr>
            <div class="journal-content">
              <q> <?php echo $journalContent; ?></q>
            </div>
            <hr>
            <div class="journal-footer">
              <div class="buttons d-flex justify-content-between">
                <div>
                  <span>Liked by : <?php echo $journalLikes; ?> </span>
                </div>
                <div class="btn-group dropup">
                  <button type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <?php
                    if ($journalState === 'published') {
                      echo '<li type="button"  data-bs-toggle="modal" data-bs-target="#unpublishmodal'. $journal['id_jr'].'" >unpublish</li>';
                    } else {
                      echo '<li type="button"  data-bs-toggle="modal" data-bs-target="#publishmodal'. $journal['id_jr'].' ">publish</li>';
                    };
                    ?>
                    <li>
                      <hr class="dropdown-divider">
                    </li>
                    <li type="button" data-bs-toggle="modal" data-bs-target="#deletemodal<?php echo $journal['id_jr']; ?>">Delete</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <!-- modals -->
          <!-- publish modal -->
          <div class="modal fade" id="publishmodal<?php echo $journal['id_jr']; ?>" data-bs-backdrop="static" tabindex="-1" aria-labelledby="publishmodalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="publishmodalLabel">Publish Journal <?php echo $journal['id_jr']; ?></h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to publish this journal? It will be visible to the world and users will be able to interact with it by liking or saving.<?php echo $journal['id_jr']; ?></p>
                </div>
                <div class="modal-footer">
                  <form method="POST">
                    <input type="hidden" name="journalId" value="<?php echo $journal['id_jr']; ?>">
                    <button type="submit" name="published" class="btn btn-secondary" data-bs-dismiss="modal">publish <?php echo $journal['id_jr']; ?></button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- unpublish modal -->
          <div class="modal fade" id="unpublishmodal<?php echo $journal['id_jr']; ?>" data-bs-backdrop="static" tabindex="-1" aria-labelledby="unpublishmodalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="unpublishmodalLabel">Unpublish journal <?php echo $journal['id_jr']; ?></h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to unpublish this journal? It will not be deleted and can be found with your unpublished journals. The likes record will not be deleted.<?php echo $journal['id_jr']; ?></p>
                </div>
                <div class="modal-footer">
                  <form method="POST">
                    <input type="hidden" name="journalId" value="<?php echo $journal['id_jr']; ?>">
                    <button type="submit" name="unpublished" class="btn btn-secondary" data-bs-dismiss="modal">Unpublish <?php echo $journal['id_jr']; ?></button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- delete modal -->
          <div class="modal fade" id="deletemodal<?php echo $journal['id_jr']; ?>" data-bs-backdrop="static" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="deletemodalLabel">Delete Journal <?php echo $journal['id_jr']; ?></h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to delete this journal? This action cannot be undone. The associated likes and saves will also be deleted.<?php echo $journal['id_jr']; ?></p>
                </div>
                <form  method="POST">
                  <div class="modal-footer">
                    <input type="hidden" name="journalId" value="<?php echo $journal['id_jr']; ?>">
                    <button type="submit" name="delete" class="btn btn-secondary" data-bs-dismiss="modal">Delete<?php echo $journal['id_jr']; ?></button>
                </form>
              </div>
            </div>
          </div>
          </div>


      <?php



      
      }}
          if (isset($_POST['published'])) {
            $journalId = $_POST['journalId'];

            $query = "UPDATE journal SET jr_state = 'published' WHERE id_jr = :journalId";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':journalId', $journalId);
            $stmt->execute();
            echo'hiba pu';
          }

          if (isset($_POST['unpublished'])) {
            $journalId = $_POST['journalId'];

            $query = "UPDATE journal SET jr_state = 'unpublished' WHERE id_jr = :journalId";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':journalId', $journalId);
            $stmt->execute();
            echo'hiba unpu';
          }
      
        if (isset($_POST['delete'])) {
          $journalId = $_POST['journalId'];

          $query = "DELETE FROM journal  WHERE id_jr = :journalId";
          $stmt = $pdo->prepare($query);
          $stmt->bindParam(':journalId', $journalId);
          $stmt->execute();
           echo'hiba pu';
        } 
       
      ?>
    </section>



    <!-- create journal modal -->
    <div class="modal fade" id="createjournal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createjournalLabel" aria-hidden="true">
      <div class="modal-dialog  modal-dialog-centered  modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <div class="user-info">
              <img src="../assets/profile.jpg" alt="">
              <span class="username">Anonymous User</span>
            </div>
            <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <section class="publish-section">
              <div class="publish-content">
                <form method="post">
                  <textarea class="publish-textarea" required name="content" placeholder="Write something..."></textarea>
                  <div class="journal-info">
                    <input type="text" required class="journal-name-input" name="journalName" placeholder="Enter Journal Name">
                  </div>
                  <div class="publish-actions">
                    <button type="submit" name="create" class="publish-button">create</button>
                  </div>
                </form>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>



  </main>
  <script src="../js/myjournals.js"></script>
</body>

</html>