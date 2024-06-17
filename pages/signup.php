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
  <title>College Registration</title>
</head>

<body>
  <div class="container">
    <form id="signup-form" method="post" class="card card--login">
      <div class="card__content">
        <h1 class="card__heading">Sign Up</h1>
        <!-- Username -->
        <div class="card__input-field">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="Enter your username" />
          <p class="field__error-msg"></p>
        </div>
        <!-- Password -->
        <div class="card__input-field">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter your password" />
          <p class="field__error-msg"></p>
        </div>
        <!-- Confirm Password -->
        <div class="card__input-field">
          <label for="confirm-password">Confirm Password</label>
          <input type="password" id="confirm-password" name="confirm-password" placeholder="Re-enter your password" />
          <p class="field__error-msg"></p>
        </div>
        <button type="submit" class="card__btn card__btn--center card__btn--login">
          Sign Up
        </button>
        <p>
          Already have an account?
          <a href="../index.php">Sign in</a>
        </p>
      </div>
    </form>
  </div>
  <script src="../js/script.js"></script>
  <script src="../js/signup_controller/index.js"></script>
</body>

</html>