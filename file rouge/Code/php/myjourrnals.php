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
  <link rel="stylesheet" href="../styles/myjournals.css">
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
          <img src="user-profile-image.jpg" alt="">
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

    <!-- journal dislay -->
    <section class="journals">
      <?php
      $memberId = $_SESSION['Id'];
      $query = "SELECT * FROM journal WHERE id_mb = :memberId";
      $stmt = $pdo->prepare($query);
      $stmt->bindParam(':memberId', $memberId);
      $stmt->execute();
      $journals = $stmt->fetchAll(PDO::FETCH_ASSOC);

      foreach ($journals as $journal) {
        $journalName = $journal['jr_name'];
        $journalDate = $journal['jr_date_pub'];
        $journalContent = $journal['jr_content'];
        $journalLikes = $journal['jr_likes'];
        $journalState = $journal['	jr_state'];
      ?>
        <div class="journal">
          <div class="journal-header d-flex justify-content-between">
            <span class="journal-name"><?php echo $journalName; ?></span>
            <div class="user-info">
              <span class="username">user</span>
              <img src="profile.jpg" alt="">
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
                  if ($journalState = 'published') {
                    echo '<li type="button"  data-bs-toggle="modal" data-bs-target="#unpublishmodal" >unpublish</li>';
                  } else {
                    echo '<li type="button"  data-bs-toggle="modal" data-bs-target="#publishmodal">publish</li>';
                  };
                  ?>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li type="button" data-bs-toggle="modal" data-bs-target="#deletemodal">Delete</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </section>

    <!-- modals -->
    <!-- publish modal -->
    <div class="modal fade" id="publishmodal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="publishmodalLabel" aria-hidden="true">
      <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body">
            Are you sure y want to publish this journal ?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">close </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">publish</button>
          </div>
        </div>
      </div>
    </div>
    <!-- unpublish modal -->
    <div class="modal fade" id="unpublishmodal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="publishmodalLabel" aria-hidden="true">
      <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body">
            Are you sure y want to publish this journal ?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">close </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Unpublish</button>
          </div>
        </div>
      </div>
    </div>
    <!-- delete modal -->
    <div class="modal fade" id="deletemodal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="deletemodalLabel" aria-hidden="true">
      <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body">
            Are you sure y want to Delete this journal ?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">close </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Delete</button>
          </div>
        </div>
      </div>
    </div>

    <!-- create journal modal -->
    <div class="modal fade" id="createjournal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createjournalLabel" aria-hidden="true">
      <div class="modal-dialog  modal-dialog-centered  modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <div class="user-info">
              <img src="profile.jpg" alt="">
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
                    <button type="submit" name="create" class="publish-button">Publish</button>
                  </div>
                </form>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>



  </main>
</body>

</html>