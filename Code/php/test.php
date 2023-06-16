<?php
require_once '../includes/dbh.inc.php';
session_start();
error_reporting(E_ERROR | E_PARSE);


if ($_POST['submit']) {
  $score = 0;
  $num_questions = 10;
  $answered_questions = 0;

  for ($i = 1; $i <= $num_questions; $i++) {
    if (isset($_POST['q' . $i])) {
      $score += $_POST['q' . $i];
      $answered_questions++;
    }
  }

  if ($answered_questions == $num_questions) {
    echo "Your final score is: " . $score;
    $_SESSION["score"] = $score;

    header("Location: ./Signup.php");
  } else {
    echo "Please answer all questions before signing up.";
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="../styles/test.css?v=<?php echo time(); ?>">
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

  <div class="test d-flex ">
  <img src="../assets/Log In.svg" alt="Your Image">
    <div class="container">
      <div class="welcome mb-5">
        <h1 class="welcome-text">Start the test</h1>
        <h4>Answer all the quetion so we can give a plan </h2>
      </div>
      <form class="" method="POST">
        <div class="question" id="q1">
          <h3 class="">Question 1: Have you been feeling sad or down recently?</h3>
          <label><input type="radio" name="q1" value="10" <?php if (isset($_POST['q1']) == '10') echo 'checked'; ?>> Yes</label><br>
          <label><input type="radio" name="q1" value="6" <?php if (isset($_POST['q1']) == '6') echo 'checked'; ?>> Sometimes</label><br>
          <label><input type="radio" name="q1" value="2" <?php if (isset($_POST['q1']) == '2') echo 'checked'; ?>> No</label><br>

          <button class="next" type="button" onclick="nextQuestion()">Next</button>
        </div>

        <div class="question" id="q2" style="display: none;">
          <h3>Question 2: Have you lost interest in things you used to enjoy?</h3>
          <label><input type="radio" name="q2" value="10" <?php if (isset($_POST['q2']) == '10') echo 'checked'; ?>> Yes</label><br>
          <label><input type="radio" name="q2" value="6" <?php if (isset($_POST['q2']) == '6') echo 'checked'; ?>> Sometimes</label><br>
          <label><input type="radio" name="q2" value="2" <?php if (isset($_POST['q2']) == '2') echo 'checked'; ?>> No </label><br>
          <button class="back" type="button" onclick="prevQuestion()">Back</button>
          <button class="next" type="button" onclick="nextQuestion()">Next</button>
        </div>

        <div class="question" id="q3" style="display: none;">
          <h3>Question 3: Have you been using alcohol or drugs more than usual as a way to cope with your feelings?</h3>
          <label><input type="radio" name="q3" value="10" <?php if (isset($_POST['q3']) == '10') echo 'checked'; ?>> Yes</label><br>
          <label><input type="radio" name="q3" value="6" <?php if (isset($_POST['q3']) == '6') echo 'checked'; ?>>Sometimes </label><br>
          <label><input type="radio" name="q3" value="2" <?php if (isset($_POST['q3']) == '2') echo 'checked'; ?>>No</label><br>
          <button class="back" type="button" onclick="prevQuestion()">Back</button>
          <button class="next" type="button" onclick="nextQuestion()">Next</button>
        </div>

        <div class="question" id="q4" style="display: none;">
          <h3>Question 4: Have you been having trouble sleeping?</h3>
          <label><input type="radio" name="q4" value="10" <?php if (isset($_POST['q4']) == '10') echo 'checked'; ?>> Yes</label><br>
          <label><input type="radio" name="q4" value="6" <?php if (isset($_POST['q4']) == '6') echo 'checked'; ?>>Sometimes </label><br>
          <label><input type="radio" name="q4" value="2" <?php if (isset($_POST['q4']) == '2') echo 'checked'; ?>>No</label><br>
          <button class="back" type="button" onclick="prevQuestion()">Back</button>
          <button class="next" type="button" onclick="nextQuestion()">Next</button>
        </div>

        <div class="question" id="q5" style="display: none;">
          <h3>Question 5: Do you find it hard to concentrate or make decisions?</h3>
          <label><input type="radio" name="q5" value="10" <?php if (isset($_POST['q5']) == '10') echo 'checked'; ?>> Yes</label><br>
          <label><input type="radio" name="q5" value="6" <?php if (isset($_POST['q5']) == '6') echo 'checked'; ?>>Sometimes </label><br>
          <label><input type="radio" name="q5" value="2" <?php if (isset($_POST['q5']) == '2') echo 'checked'; ?>>No</label><br>
          <button class="back" type="button" onclick="prevQuestion()">Back</button>
          <button class="next" type="button" onclick="nextQuestion()">Next</button>
        </div>

        <div class="question" id="q6" style="display: none;">
          <h3>Question 6: Have you been feeling tired or fatigued a lot lately?</h3>
          <label><input type="radio" name="q6" value="10" <?php if (isset($_POST['q6']) == '10') echo 'checked'; ?>> Yes</label><br>
          <label><input type="radio" name="q6" value="6" <?php if (isset($_POST['q6']) == '6') echo 'checked'; ?>>Sometimes </label><br>
          <label><input type="radio" name="q6" value="2" <?php if (isset($_POST['q6']) == '2') echo 'checked'; ?>>No</label><br>
          <button class="back" type="button" onclick="prevQuestion()">Back</button>
          <button class="next" type="button" onclick="nextQuestion()">Next</button>
        </div>

        <div class="question" id="q7" style="display: none;">
          <h3>Question 7: Do you find yourself worrying or feeling anxious frequently?</h3>
          <label><input type="radio" name="q7" value="10" <?php if (isset($_POST['q7']) == '10') echo 'checked'; ?>> Yes</label><br>
          <label><input type="radio" name="q7" value="6" <?php if (isset($_POST['q7']) == '6') echo 'checked'; ?>>Sometimes </label><br>
          <label><input type="radio" name="q7" value="2" <?php if (isset($_POST['q7']) == '2') echo 'checked'; ?>>No</label><br>
          <button class="back" type="button" onclick="prevQuestion()">Back</button>
          <button class="next" type="button" onclick="nextQuestion()">Next</button>
        </div>
        <div class="question" id="q8" style="display: none;">
          <h3>Question 8: Have you had any thoughts of hurting yourself or ending your life?</h3>
          <label><input type="radio" name="q8" value="10" <?php if (isset($_POST['q8']) == '10') echo 'checked'; ?>> Yes</label><br>
          <label><input type="radio" name="q8" value="6" <?php if (isset($_POST['q8']) == '6') echo 'checked'; ?>>Sometimes </label><br>
          <label><input type="radio" name="q8" value="2" <?php if (isset($_POST['q8']) == '2') echo 'checked'; ?>>No</label><br>
          <button class="back" type="button" onclick="prevQuestion()">Back</button>
          <button class="next" type="button" onclick="nextQuestion()">Next</button>
        </div>

        <div class="question" id="q9" style="display: none;">
          <h3>Question 9: Have you been experiencing any physical symptoms like headaches, stomachaches, or body aches?</h3>
          <label><input type="radio" name="q9" value="10" <?php if (isset($_POST['q9']) == '10') echo 'checked'; ?>> Yes</label><br>
          <label><input type="radio" name="q9" value="6" <?php if (isset($_POST['q9']) == '6') echo 'checked'; ?>>Sometimes </label><br>
          <label><input type="radio" name="q9" value="2" <?php if (isset($_POST['q9']) == '2') echo 'checked'; ?>>No</label><br>
          <button class="back" type="button" onclick="prevQuestion()">Back</button>
          <button class="next" type="button" onclick="nextQuestion()">Next</button>
        </div>


        <div class="question" id="q10" style="display: none;">
          <h3>Question 10:Have you been avoiding social situations or isolating yourself from others?</h3>
          <label><input type="radio" name="q10" value="10" <?php if (isset($_POST['q10']) == '10') echo 'checked'; ?>> Yes</label><br>
          <label><input type="radio" name="q10" value="6" <?php if (isset($_POST['q10']) == '6') echo 'checked'; ?>>Sometimes </label><br>
          <label><input type="radio" name="q10" value="2" <?php if (isset($_POST['q10']) == '2') echo 'checked'; ?>>No</label><br>
          <button class="back" type="button" onclick="prevQuestion()">Back</button>
          <input class="submit"  type="submit" name="submit">
        </div>

        <br>

      </form>

    </div>
  </div>


  <script>
    var currentQuestion = 1;
    var totalQuestions = 10;

    function nextQuestion() {
      if (currentQuestion < totalQuestions) {
        document.getElementById("q" + currentQuestion).style.display = "none";
        currentQuestion++;
        document.getElementById("q" + currentQuestion).style.display = "block";
      }
    }

    function prevQuestion() {
      if (currentQuestion > 1) {
        document.getElementById("q" + currentQuestion).style.display = "none";
        currentQuestion--;
        document.getElementById("q" + currentQuestion).style.display = "block";
      }
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/62ff79fbfd.js" crossorigin="anonymous"></script>


</body>

</html>