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
    <link rel="stylesheet" href="./styles/admin-dashboard.css">
    <script src="https://kit.fontawesome.com/d12613abfd.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="jquery-3.6.4.min.js"></script>

    <title>Mental Health Website</title>
</head>

<body>
    <!-- sidebar -->
    <?php
    include './admin-sidebar.php'
    ?>
<header>
        <div class="decription">
            <h1>Administration Dashboard</h1> 
          
        </div>
        <img src="./assets/dashboard.svg" alt=""> 
      

    </header>

    <main>
<div class="form-card">
<form method="post">
<h2>Add new Admin</h2> 

  <div class="row mb-4">
    <div class="col">
      <div class="form-outline">
        <label for="adm_name">First name :</label>
        <input type="text" name="adm_name" id="adm_name" class="form-control form_input">
      </div>
    </div>
    <div class="col">
      <div class="form-outline">
        <label for="adm_last_name">Last name :</label>
        <input type="text" name="adm_last_name" id="adm_last_name" class="form-control form_input">
      </div>
    </div>
  </div>

  <div class="row mb-4">
  <div class="col">

  <div class="form-outline mb-4">
    <label for="adm_email">Email :</label>
    <input type="email" name="adm_email" id="adm_email" class="form-control form_input  ">
  </div>
  </div>

  <div class="col">

  <div class="form-outline mb-4">
    <label for="adm_pswrd">Password :</label>
    <input type="password" name="adm_pswrd" id="adm_pswrd" class="form-control form_input  ">
  </div>
</div>
</div>


  <button type="submit" name="add" class="btn  add ">
  <i class="fas fa-plus"></i>
    Add admin</button>
</form>
</div>
<?php
        if (isset($_POST["add"])) {
            $adm_name = $_POST["adm_name"];
            $adm_last_name = $_POST["adm_last_name"];
            $adm_email = $_POST["adm_email"];
            $adm_pswrd = $_POST["adm_pswrd"];
            $errors = [];

            if (!preg_match("/^[a-zA-Z-' ]*$/", $adm_last_name) || strlen($adm_last_name) < 3) {
                $errors["last_name"] = "Last name must contain more than 3 letters";
            }

            if (!preg_match("/^[a-zA-Z-' ]*$/", $adm_name) || strlen($adm_name) < 3) {
                $errors["name"] = "Name must contain more than 3 letters";
            }

            if (!filter_var($adm_email, FILTER_VALIDATE_EMAIL)) {
                $errors["email"] = "Enter a correct email format";
            }

            if (empty($errors)) {
                $adm_pswrd = password_hash($adm_pswrd, PASSWORD_DEFAULT);
                $query = "INSERT INTO `admin` (`adm_name`, `adm_last_name`,`adm_email`, `adm_pswrd` ) VALUES (:adm_name, :adm_last_name, :adm_email, :adm_pswrd)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':adm_name', $adm_name);
                $stmt->bindParam(':adm_last_name', $adm_last_name);
                $stmt->bindParam(':adm_email', $adm_email);
                $stmt->bindParam(':adm_pswrd', $adm_pswrd);
                $stmt->execute();
            }
        }


        if (!empty($errors)) {
            echo "<div class='d-flex justify-content-center align-items-center '>";
            echo "<div class='alert mt-5 w-75 alert-danger'>";
            echo "<ul>";
            foreach ($errors as $error) {
                echo "<li>$error</li>";
            }
            echo "</ul>";
            echo "</div>";
            echo "</div>";
        }

        ?>




        <div class="table-card">
        <h2>Admin list </h2> 


            <table class="table align-middle my-5 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th class="sortable">Full name</th>
                        <th class="sortable">Email</th>
                        <th>Delete admin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch users from the members table
                    $query = "SELECT * FROM admin ";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();
                    $admins = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Iterate through each admin
                    foreach ($admins as $admin) {
                        $adminId = $admin['id_adm'];
                        $name = $admin['adm_name'];
                        $last_name = $admin['adm_last_name'];
                        $email = $admin['adm_email'];
                    ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="./assets/admin-profile.png" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1"><?php echo " $name $last_name " ?> </p>

                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-muted mb-0"><?php echo "$email " ?></p>
                            </td>

                            <td>

                                <form method="POST">
                                    <button type="button" class="btn btn-danger btn-sm btn-rounded" data-bs-toggle="modal" data-bs-target="#deleteadmin<?php echo $adminId; ?>">
                                        Delete admin
                                    </button>

                                    <!-- delete admin Modal -->
                                    <div class="modal fade" id="deleteadmin<?php echo $adminId; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteadminLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="deleteadminLabel">Delete admin</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this admin? They will no longer have access to the dashboard.
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="POST">
                                                        <input type="hidden" value="<?php echo $adminId; ?>" name="adminId">
                                                        <button type="submit" name="delete" class="btn   modal-btn">Delete admin</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if (isset($_POST['delete'])) {
                                        $adminId = $_POST['adminId'];
                                        $query = "DELETE FROM admin WHERE id_adm = :adminId";
                                        $stmt = $pdo->prepare($query);
                                        $stmt->bindParam(':adminId', $adminId);
                                        $stmt->execute();
                                    }
                                    ?>
                                </form>

                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>


        </div>



    </main>

    <script src="./js/admin-dashboard.js"></script>

</body>

</html>