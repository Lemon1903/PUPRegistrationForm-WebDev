<?php
require_once '../includes/config_session_inc.php';

if (!isset($_SESSION["user_id"])) {
  header("Location: ../index.php");
  die();
}

if ($_SESSION["role"] === "applicant" && !$_SESSION["submitted"]) {
  header("Location: ./registration_form.php");
  die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../style.css" />
  <link rel="shortcut icon" href="../assets/pup-logo.png" type="image/x-icon" />
  <!-- Roboto Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet" />
  <!-- Box Icons -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>College Registration</title>
</head>

<body>
  <div class="card card--start finish-page">
    <div class="card__content">
      <img class="finish-page__check" src="../assets/check.png" alt="a big check" />
      <h1 class="card__heading">Thank you for registering!</h1>
      <p class="card__description">
        Your application has been successfully submitted. We will review your information and get back to you shortly.
        In the meantime, you can check out our website for more information about our programs and services.
      </p>
      <a href="https://www.pup.edu.ph/" target="_blank" class="card__link">Visit PUP Website</a>
    </div>
    <form action="../includes/signout_model_inc.php" method="post" class="logout__btn">
      <button type="submit" class="card__btn card__btn--center card__btn--next">
        Back to Sign In
        <i class="bx bx-log-out"></i>
      </button>
    </form>
  </div>
  <script src="js/script.js"></script>
</body>

</html>