<?php
require_once '../includes/dbh.inc.php';
session_start();
error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="../styles/planTasks.css">
  <script src="https://kit.fontawesome.com/d12613abfd.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="jquery-3.6.4.min.js"></script>

  <title>Mental Health Website</title>
</head>

<body>
  <!-- sidebar -->
  <?php include './sidebar.php' ?>
    <!-- tasks -->
<header>
<div class="decription">
  <?php
  $memberId = $_SESSION["Id"];
  $query = "SELECT  * FROM members AS m
            INNER JOIN plan AS p ON m.id_plan = p.id_plan
            INNER JOIN tasks AS t ON p.id_plan = t.id_plan
            WHERE m.id_mb = :memberId";
  $stmt = $pdo->prepare($query);
  $stmt->execute(['memberId' => $memberId]);
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  if (count($result) > 0) {
    echo "<h1>" . $result[0]['pl_name'] . "</h1> </br>";
    echo "<p> " . $result[0]['pl_introduction'] . "</p>";
    $memberProgress = $result[0]['mb_progresse'];
    ?>
    </div>
    <img src="../assets/plan.svg" alt="">

</header>
    <!-- tasks -->
    <div class='plan'>
    <?php
echo "<h2>Tasks</h2>";
echo "<div class='task-container'>";
foreach ($result as $row) {
  $taskId = $row['id_tsk'];
  echo '<div class="task-card">';
  echo "<h5>" . $row['tsk_task'] . "</h5>";
  echo "<p>" . $row['tsk_description'] . "</p>";

  $query = "SELECT * FROM completed_tasks WHERE id_mb = :memberId AND id_tsk = :taskId";
  $stmt = $pdo->prepare($query);
  $stmt->execute(['memberId' => $memberId, 'taskId' => $taskId]);
  $completedTask = $stmt->fetch();

  if ($completedTask) {
    echo '<button name="done" class="done" data-task-id="' . $taskId . '">Unfinished</button>';
  } else {
    echo '<button name="done" class="done" data-task-id="' . $taskId . '">Finished</button>';
  }
  echo '</div>';
}
}
echo "</div>";
?>

</div>

<?php
$taskId = $_POST['taskId'];
$memberId = $_SESSION["Id"];
if (isset($_POST['done'])) {
  $query = "SELECT * FROM completed_tasks WHERE id_mb = :memberId AND id_tsk = :taskId";
  $stmt = $pdo->prepare($query);
  $stmt->execute(['memberId' => $memberId, 'taskId' => $taskId]);
  $result = $stmt->fetch();

  if (!$result) {
    $query = "INSERT INTO completed_tasks (id_mb, id_tsk) VALUES (:memberId, :taskId)";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['memberId' => $memberId, 'taskId' => $taskId]);
    echo 'Task marked as done';
  } else {
    $query = "DELETE FROM completed_tasks WHERE id_mb = :memberId AND id_tsk = :taskId";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['memberId' => $memberId, 'taskId' => $taskId]);
    // echo 'Task marked as undone';
  }
}
?>


  <script src="../js/planTasks.js"></script>
</body>

</html>
