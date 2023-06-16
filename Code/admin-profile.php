<?php
require_once './includes/dbh.inc.php';
error_reporting(E_ERROR | E_PARSE);
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="./styles/admin-dashboard.css?v=<?php echo time(); ?>">
  <script src="https://kit.fontawesome.com/d12613abfd.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="jquery-3.6.4.min.js"></script>

  <title>Mental Health Website</title>
</head>

<body>
  <!-- sidebar -->
  <?php include './admin-sidebar.php' ?>

  <header>
    <div class="decription">
      <h1>Administration Dashboard</h1>

    </div>
    <img src="./assets/dashboard.svg" alt="">


  </header>

  <main>


    <section class="profile">

      <div class="card d-flex mt-5 ">

        <?php
        $adminId = $_SESSION['Id-adm'];
        $query = "SELECT * FROM admin WHERE id_adm = :adminId";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['adminId' => $adminId]);
        $admin = $stmt->fetch();

        $adminName = $admin['adm_name'];
        $adminLastName = $admin['adm_last_name'];
        $adminemail = $admin['adm_email'];
        $adminpswrd = $admin['adm_pswrd'];

        if (isset($_POST['save'])) {
          $adminId = $_SESSION['Id-adm'];
          $adminName = $_POST['adminName'];
          $adminLastName = $_POST['adminLastName'];
          $adminEmail = $_POST['adminEmail'];
          $adminNewPassword = $_POST['newPassword'];
          $adminOldPassword = $_POST['oldPassword'];



          $query = "UPDATE admin SET adm_name = :adminName, adm_last_name = :adminLastName, adm_email = :adminEmail WHERE id_adm = :adminId";
          $stmt = $pdo->prepare($query);
          $stmt->bindParam(':adminName', $adminName);
          $stmt->bindParam(':adminLastName', $adminLastName);
          $stmt->bindParam(':adminEmail', $adminEmail);
          $stmt->bindParam(':adminId', $adminId);
          $stmt->execute();

          if (!empty($_POST['oldPassword'])) {


            if (password_verify($adminOldPassword, $adminpswrd)) {
              $adminNewPassword = password_hash($adminNewPassword, PASSWORD_DEFAULT);
              $paswrdQuery = "UPDATE admin SET adm_pswrd = :newPassword WHERE id_adm = :adminId";
              $stmt = $pdo->prepare($paswrdQuery);
              $stmt->bindParam(':newPassword', $adminNewPassword);
              $stmt->bindParam(':adminId', $adminId);
              $stmt->execute();
            } else {
              $error = "The old Password is inccorect";
            }
          }
        }

        ?>


        <div class="profile-section col-lg-3">
          <div class="mb-4">
            <div class="card-body text-center">
              <img src="./assets/admin-profile.png" alt="profile" class="rounded-circle img-fluid" style="width: 150px;">
              <h5 class="my-3"><?php echo "$adminName $adminLastName " ?></h5>

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
              <?php if ($error) : ?>
                <div class="alert alert-danger p-0 mt-5" role="alert">
                  <h4 class="alert-heading">Erreur!</h4>
                  <ul>
                    <li><?php echo $error; ?></li>
                  </ul>
                </div>
              <?php endif; ?>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">First Name</p>
                </div>
                <div class="col-sm-9">
                  <input name="adminName" disabled class="mb-0 edit-input" value="<?php echo "$adminName" ?>">
                </div>
              </div>
              <hr>

              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Last name</p>
                </div>
                <div class="col-sm-9">
                  <input name="adminLastName" disabled class="mb-0 edit-input" value="<?php echo "$adminLastName" ?>">
                </div>
              </div>
              <hr>

              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                  <input name="adminEmail" disabled class="mb-0 edit-input" value="<?php echo "$adminemail" ?>">
                </div>
              </div>
              <hr>

              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Old Password : </p>
                </div>
                <div class="col-sm-9">
                  <input placeholder="********" disabled class="mb-0 edit-input" name="oldPassword" value="">
                </div>
              </div>
              <hr>

              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">New Password : </p>
                </div>
                <div class="col-sm-9">
                  <input disabled class="mb-0 edit-input" name="newPassword" value="">
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
            <a href="admin-delete-account.php"><button type="button" class="btn btn-danger">Delete</button></a>
          </div>
        </div>
      </div>
    </div>
  </main>


  <script src="./js/admin-dashboard.js"></script>
</body>

</html>