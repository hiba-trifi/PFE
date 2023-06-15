<?php
require_once '../includes/dbh.inc.php';
session_start();
error_reporting(E_ERROR | E_PARSE);

if (isset($_POST["signUp"])) {
    $name = $_POST["name"];
    $last_name = $_POST["last_name"];
    $date_birth = $_POST["date_birth"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cnf_password = $_POST["cnf_password"];

    $score = $_SESSION["score"];
    if ($score <= 30) {
        $plan = 3;
    } else if ($score > 30 && $score <= 60) {
        $plan = 2;
    } else {
        $plan = 3;
    }
    $errors = array();
    if (!preg_match("/^[a-zA-Z-' ]*$/", $name) || strlen($name) < 3) {
        $errors["name"] = "The name must contain more than three letters.";
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $last_name) || strlen($last_name) < 3) {
        $errors["last_name"] = "The last name must contain more than three letters.";
    } elseif (!isset($date_birth) || empty($date_birth)) {
        $errors["date_birth"] = "Please enter the date of birth.";
    } elseif (!isset($gender) || empty($gender)) {
        $errors["gender"] = "Please enter a gender.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Please enter a valid email address.";
    } else {
        $check_email_query = "SELECT COUNT(*) FROM members WHERE mb_email = :email";
        $stmt = $pdo->prepare($check_email_query);
        $stmt->execute(['email' => $email]);
        $count = $stmt->fetchColumn();
        if ($count > 0) {
            $errors["exist_mail"] = "This email already exists. Please enter another email.";
        } elseif ($password != $cnf_password) {
            $errors["confirm_password"] = "You did not enter the same password.";
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);

            $add_member = "INSERT INTO `members` (`mb_name`, `mb_last_name`, `mb_birth`, `mb_gender`, `mb_email`, `mb_pswrd`, `mb_score`, `is_blocked`, `is_blocked`, `cmp_date`, `id_plan`) VALUES (:name, :last_name, :date_birth, :gender, :email, :password, :score, :is_blocked, NOW(), :plan)";
            $stmt = $pdo->prepare($add_member);
            $stmt->execute([
                'name' => $name,
                'last_name' => $last_name,
                'date_birth' => $date_birth,
                'gender' => $gender,
                'email' => $email,
                'password' => $password,
                'score' => $score,
                'is_blocked' => 0,
                'plan' => $plan,
            ]);
            $_SESSION["Id"] = $pdo->lastInsertId();

            header("Location:./planTasks.php");
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
    <link rel="stylesheet" href="../styles/signup.css">
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


    <div class="page">
        <form class="login-form" action="" method="POST">
            <div class="welcome mt-5">
                <h1 class="welcome-text">Register Yourself</h1>
                <h4>Begin your journey with us today</h2>
            </div>
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
            <div class="sighup">
                <div class="d-flex justify-content-between">
                    <div>
                        <label class="mt-2 " for="name"> First Name : </label>
                        <input type="text" name="name" id="name" class="form_input-1 mt-4 ">
                    </div>
                    <div>
                        <label class="mt-2 " for="last_name"> Last Name : </label>
                        <input type="text" name="last_name" id="last_name" class="form_input-1 mt-4 ">
                    </div>
                </div>

                <div class="d-flex justify-content-between ">
                    <div>
                        <label class="mt-2 " for="date_birth"> Birth Date : </label>
                        <input type="date" name="date_birth" id="date_birth" class="form_input-1 mt-4 ">
                    </div>
                    <div>
                        <label class=" mt-2 " name="gender" for="gender"> gender : </label>
                        <select class="form_input-1 mt-4" name="gender" aria-label="Default select example">
                            <option value="none">Choose your gender : </option>
                            <option value="male">male</option>
                            <option value="female">female</option>
                            <option value="prefer_not_to_say">prefer not to say</option>
                        </select>
                    </div>
                </div>


                <label class="mt-2 " for="email"> Email : </label>
                <input type="email" name="email" id="email" class="form_input mt-4 ">


                <label class="mt-2  " for="psw"> Password : </label>
                <input type="password" name="password" id="psw" class="form_input mt-4 ">


                <label class="mt-2  " for="psw">Confirme Password : </label>
                <input type="password" name="cnf_password" id="psw" class="form_input mt-4 ">


            </div>
            <div class=" d-flex flex-column justify-content-center align-items-center mt-5 ">
                <input type="submit" name="signUp" value="S'inscrire" class="button  btn  btn-lg  my-5  rounded-pill ">
                <div class="d-flex">
                    <p class="form_info">Already have an account?</p>
                    <a class="form_toogle mx-2" href="./Login.php">Log in here</a>
                </div>
            </div>
        </form>
        <img  src="../assets/sign up.svg" alt="">
    </div>
    <script src="https://kit.fontawesome.com/62ff79fbfd.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>