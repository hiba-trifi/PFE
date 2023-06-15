<?php
require_once '../includes/dbh.inc.php';
error_reporting(E_ERROR | E_PARSE);
session_start();
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $errors = array();

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Please enter a valid email address.";
    } elseif (empty($password)) {
        $errors["password"] = "Please enter a password.";
    } else {
        $query = $pdo->prepare("SELECT * FROM members WHERE mb_email = ?");
        $stmt = $query->execute([$email]);
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if (!$row || !password_verify($password, $row["mb_pswrd"])) {
            $errors["password_inc"] = "Password inccorect";
        } elseif($row["is_blocked"] == 0){
            $errors["blocked"] = ' We regret to inform you that your account has been temporarily blocked due 
            to suspicious activity or inappropriate journal posting. As part of our commitment to maintaining a safe
            and respectful environment, this penalty has been imposed. Your account will be automatically unblocked after a period of 7 days. 
            We kindly request that you review our community guidelines and ensure your future interactions align with our policies.
            We take these matters seriously to uphold the integrity of our platform and ensure the best experience for all users.

            Best regards,
            The Administration Team';

        } else {
            $_SESSION["Id"] = $row["id_mb"];
            header("Location: ./planTasks.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/login.css">
    <script src="https://kit.fontawesome.com/d12613abfd.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="jquery-3.6.4.min.js"></script>

    <title>Mental Health Website</title>
</head>

<body>
<a href="../index.php" class="prev-page-button">
  <i class="fas fa-arrow-left"></i>
</a>



    <div class="page d-flex ">

        <img src="../assets/Log In.svg" alt="">

        <div class="container">
            <div class="welcome">
                <h1 class="welcome-text">Welcome back</h1>
                <h4>Sign in to continue your progress</h2>
            </div>
            <form class="login-form mx-5" action="" method="POST">
                <?php if (!empty($errors)) : ?>
                    <div class="alert alert-danger p-0 mt-5" role="alert">
                        <h4 class="alert-heading">Erreur!</h4>
                        <ul>
                            <?php foreach ($errors as $error) : ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <label class="mt-5 fs-4" for="email">Email:</label>
                <input type="email" name="email" id="email" class="form_input my-4">

                <label class="mt-5 fs-4" for="psw">Password:</label>
                <input type="password" name="password" id="psw" class="form_input my-4">


                <div class="d-flex flex-column justify-content-center align-items-center mt-5">
                    <input type="submit" name="login" value="Log in" class="button btn btn-lg my-5 ">
                    <div class="d-flex">
                        <p class="form_info">Don't have an account?</p>
                        <a class="form_toogle mx-2" href="./Signup.php">Sign up here</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <script src="https://kit.fontawesome.com/62ff79fbfd.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>