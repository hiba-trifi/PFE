<?php
require_once '../includes/dbh.inc.php';
// error_reporting(E_ERROR | E_PARSE);
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="../styles/profile.css?v=<?php echo time(); ?>">
  <script src="https://kit.fontawesome.com/d12613abfd.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="jquery-3.6.4.min.js"></script>

  <title>Mental Health Website</title>
</head>

<body>
  <!-- sidebar -->
  <?php include './sidebar.php' ?>
  <header>
<div class="decription">
 <h1>User Profile</h1>
    </div>
    <img src="../assets/plan.svg" alt="">

</header>

  <main>


    <section class="profile">


      <div class="statistics  d-flex justify-content-around">

        <!-- Total journals -->
        <?php
        $memberId = $_SESSION['Id'];
        $JournalsQuery = "SELECT COUNT(*) AS JournalsCount FROM journal WHERE id_mb = :memberId";
        $stmt = $pdo->prepare($JournalsQuery);
        $stmt->execute(['memberId' => $memberId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $JournalsCount = $result['JournalsCount'];
        ?>
        <div class="card statistic-card col-lg-4 mb-4">
          <div class="card-body text-center">


            <h3 class="my-3">Totale Journals <i class="fa-solid fa-newspaper fa-lg" style="color: #ffffff;"></i> </h3>
            <h5 class="my-3"><?php echo $JournalsCount; ?> </h5>
          </div>
        </div>


        <!-- Total likes -->
        <?php
        $memberId = $_SESSION['Id'];
        $likesQuery = "SELECT SUM(jr_likes) AS likesCount FROM journal WHERE id_mb = :memberId";
        $stmt = $pdo->prepare($likesQuery);
        $stmt->execute(['memberId' => $memberId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $likesCount = $result['likesCount'];
        ?>


        <div class="card statistic-card col-lg-4 mb-4">
          <div class="card-body text-center">

            <h3 class="my-3">Totale Likes <i class="fa-solid fa-heart fa-lg" style="color: #ffffff;"></i> </h3>
            <h5 class="my-3"><?php echo $likesCount; ?> </h5>
          </div>
        </div>

        <!-- totale completed tasks -->
        <?php
        $memberId = $_SESSION['Id'];
        $completedTasksQuery = "SELECT COUNT(*) AS completedTasksCount FROM completed_tasks WHERE id_mb = :memberId";
        $stmt = $pdo->prepare($completedTasksQuery);
        $stmt->execute(['memberId' => $memberId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $completedTasksCount = $result['completedTasksCount'];

        ?>
        <div class="card statistic-card col-lg-4 mb-4">
          <div class="card-body text-center">
            <h3 class="my-3"> Tasks <i class="fa-solid fa-list-check fa-lg" style="color: #ffffff;"></i> </h3>
            <h5 class="my-3"><?php echo $completedTasksCount; ?> / 10</h5>

          </div>
        </div>
      </div>

      <div class="card d-flex ">
      



        <?php
        $memberId = $_SESSION['Id'];
        $query = "SELECT * FROM members WHERE id_mb = :memberId";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['memberId' => $memberId]);
        $member = $stmt->fetch();

        $memberName = $member['mb_name'];
        $memberLastName = $member['mb_last_name'];
        $memberDate = $member['mb_birth'];
        $memberemail = $member['mb_email'];
        $memberpswrd = $member['mb_pswrd'];

        if (isset($_POST['save'])) {
          $memberId = $_SESSION['Id'];
          $memberName = $_POST['memberName'];
          $memberLastName = $_POST['memberLastName'];
          $memberEmail = $_POST['memberEmail'];
          $memberNewPassword = $_POST['newPassword'];
          $memberOldPassword = $_POST['oldPassword'];


        
          $query = "UPDATE members SET mb_name = :memberName, mb_last_name = :memberLastName, mb_email = :memberEmail WHERE id_mb = :memberId";
          $stmt = $pdo->prepare($query);
          $stmt->bindParam(':memberName', $memberName);
          $stmt->bindParam(':memberLastName', $memberLastName);
          $stmt->bindParam(':memberEmail', $memberEmail);
          $stmt->bindParam(':memberId', $memberId);
          $stmt->execute();   

        if (password_verify($memberOldPassword, $memberpswrd)) {
          $memberNewPassword = password_hash($memberNewPassword, PASSWORD_DEFAULT);
          $paswrdQuery = "UPDATE members SET mb_pswrd = :newPassword WHERE id_mb = :memberId";
          $stmt = $pdo->prepare($paswrdQuery);
          $stmt->bindParam(':newPassword', $memberNewPassword);
          $stmt->bindParam(':memberId', $memberId);
          $stmt->execute();
      }
      else{
          echo 'the pssrod is inccorect ';
          
        }

        }
        
        ?>


<div class="profile-section col-lg-3">
          <div class="mb-4">
            <div class="card-body text-center">
              <img src="../assets/profile.jpg" alt="profile" class="rounded-circle img-fluid" style="width: 150px;">
              <h5 class="my-3"><?php echo "$memberName $memberLastName " ?></h5>
              <form method="POST">
                <div class="d-flex justify-content-center">
                <button type="button" onclick="edit()" class="btn edit-btn">Edit profile</button>
                <button type="submit" onclick="save()" name="save" class="btn save-btn " style="display: none;">Save profile</button>
              </div>
            </div>
          </div>
        </div>
        <div class="edit-section col-lg-9 col-md-9  col-sm-12">
          <div class="mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">First Name</p>
                </div>
                <div class="col-sm-9">
                  <input name="memberName" disabled class="mb-0 edit-input"  value="<?php echo "$memberName" ?>">
                </div>
              </div>
              <hr>

              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Last name</p>
                </div>
                <div class="col-sm-9">
                  <input name="memberLastName" disabled class="mb-0 edit-input"  value="<?php echo "$memberLastName" ?>">
                </div>
              </div>
              <hr>

              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                  <input name="memberEmail" disabled class="mb-0 edit-input"  value="<?php echo "$memberemail" ?>">
                </div>
              </div>
              <hr>

              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Old Password : </p>
                </div>
                <div class="col-sm-9">
                  <input placeholder="********"  disabled class="mb-0 edit-input" name="oldPassword" value="">
                </div>
              </div>
              <hr>

              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">New Password : </p>
                </div>
                <div class="col-sm-9">
                  <input  disabled class="mb-0 edit-input" name="newPassword" value="">
                </div>
              </div>
              <hr>

              <div class="row delete">
                <a data-bs-toggle="modal" data-bs-target="#deleteaccount"> Delete account </a>
              </div>

            </div>
          </div>
        </div>

        <?php
      
        ?>

      </div>
      </form>
    </section>

    
<!-- Delete account Modal -->
<div class="modal fade" id="deleteaccount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteaccountLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteaccountLabel">Delete User Account</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p>Are you sure you want to delete your account? This action cannot be undone. We would be sorry to see you go!</p>

      </div>
      <div class="modal-footer">
        <a  href="delete-account.php"><button type="button" class="btn btn-danger">Delete</button></a>
      </div>
    </div>
  </div>
</div>
  </main>

  
  <script src="../js/profile.js"></script>
</body>

</html>