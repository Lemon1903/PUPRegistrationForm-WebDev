<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <link rel="shortcut icon" href="assets/pup-logo.png" type="image/x-icon" />
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
    <form id="signin-form" class="card card--login">
      <div class="card__content">
        <h1 class="card__heading">Sign In</h1>
        <!-- Username -->
        <div class="card__input-field">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="e.g. John Doe" />
          <p class="field__error-msg"></p>
        </div>
        <!-- Password -->
        <div class="card__input-field">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="••••••••" />
          <p class="field__error-msg"></p>
        </div>
        <button type="submit" class="card__btn card__btn--center card__btn--login">
          Sign In
        </button>
        <p>
          Don't have an account?
          <a href="pages/signup.php">Sign up</a>
        </p>
      </div>
    </form>
  </div>
  <script src="js/script.js"></script>
  <script src="js/signin_controller/index.js"></script>
</body>

</html>