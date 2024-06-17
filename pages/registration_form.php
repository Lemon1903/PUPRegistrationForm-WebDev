<?php
require_once '../includes/config_session_inc.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: ../index.php");
  die();
}

if ($_SESSION["role"] === "applicant" && $_SESSION["submitted"]) {
  header("Location: ./finish_page.php");
  die();
}

if (isset($_GET['user_id']) && is_numeric($_GET['user_id'])) {
  if ($_SESSION["role"] !== "admin") {
    header("Location: ./registration_form.php");
    die();
  }

  // hardcoded ID checking only too bad...
  if ($_GET["user_id"] === "28") {
    header("Location: ./admin_dashboard.php");
    die();
  }

  require_once '../includes/dbh_inc.php';
  require_once '../includes/execute_query_inc.php';

  $query = "SELECT * FROM users WHERE id = ?;";
  $queryResult = executeQuery($mysqli, $query, "i", [$_GET['user_id']]);
  $user = $queryResult["result"] ? $queryResult["result"]->fetch_assoc() : null;

  // if query is not successful or no matching result
  if (!isset($user)) {
    header("Location: ./admin_dashboard.php");
    die();
  }
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
  <title>College Registration</title>
</head>

<body>
  <div class="container">
    <!-- starting card -->
    <div class="card card--start">
      <div class="card__content">
        <h1 class="card__heading">College Registration Form</h1>
        <p class="card__description">
          <span class="card__title"> Welcome to the Gateway of Possibilities!</span><br />
          Embark on your educational journey with Polytechnic University of the Philippines (PUP). This card-style
          form will guide you step by step through the registration process. Let’s start building your future
          together, one field at a time. Are you ready to dive in?
        </p>
        <p class="card__questions">8 Questions</p>
      </div>
      <button id="start-btn" class="card__btn card__btn--center card__btn--next">
        NEXT
        <i class="fa-solid fa-arrow-right-long card__icon"></i>
      </button>
    </div>
    <!-- form carousel mobile -->
    <form id="carousel-form" class="carousel" novalidate>
      <div class="carousel__track-container">
        <ul class="carousel__track">
          <li class="carousel__empty"></li>
          <!-- School Information -->
          <li class="carousel__slide current-slide">
            <div class="card card--skip">
              <div class="card__content card__content--center">
                <img class="card__image" src="../assets/pup-logo.png" alt="pup logo" />
                <h1 class="card__heading">Polytechnic University of the Philippines</h1>
                <div class="card__info">
                  <p class="card__address">Anonas Street 1016 628 Sta Mesa Metro Manila</p>
                  <p class="card__description">inquire@pup.edu.ph</p>
                  <p class="card__description">(02) 8713 9304</p>
                </div>
              </div>
              <div class="carousel__nav--desktop">
                <button type="button" class="card__btn card__btn--next">
                  NEXT
                  <i class="fa-solid fa-arrow-right-long card__icon"></i>
                </button>
              </div>
            </div>
          </li>
          <!-- Document Requirements -->
          <li class="carousel__slide">
            <div class="card card--skip">
              <div class="card__content">
                <p class="card__address">
                  Additional documents for registration<br /><br />

                  Bring this registration form and the following documentation to the school office.<br /><br />

                  • 2 x 2 inch colored photo with name tag<br />
                  • Grade 11 and 12 Report Card showing complete name, LRN, and GWA for the first and second
                  semesters<br />
                  • Original Certified Birth Certificate<br />
                  • Certificate of Good Moral<br />
                </p>
              </div>
              <div class="carousel__nav--desktop">
                <button type="button" class="card__btn card__btn--prev">
                  <i class="fa-solid fa-arrow-left-long card__icon"></i>
                  PREVIOUS
                </button>
                <button type="button" class="card__btn card__btn--next">
                  NEXT
                  <i class="fa-solid fa-arrow-right-long card__icon"></i>
                </button>
              </div>
            </div>
          </li>
          <!-- Full Name -->
          <li class="carousel__slide">
            <div class="card">
              <div class="card__content">
                <h2 class="card__title" data-error="This field is required">Full Name</h2>
                <input required class="card__input" type="text" name="first-name" placeholder="First Name"
                  value="<?php echo $user["first_name"] ?? '' ?>" />
                <input required class="card__input" type="text" name="middle-name" placeholder="Middle Name"
                  value="<?php echo $user["middle_name"] ?? '' ?>" />
                <input required class="card__input" type="text" name="last-name" placeholder="Last Name"
                  value="<?php echo $user["last_name"] ?? '' ?>" />
              </div>
              <div class="carousel__nav--desktop">
                <button type="button" class="card__btn card__btn--prev">
                  <i class="fa-solid fa-arrow-left-long card__icon"></i>
                  PREVIOUS
                </button>
                <button type="button" class="card__btn card__btn--next">
                  NEXT
                  <i class="fa-solid fa-arrow-right-long card__icon"></i>
                </button>
                <p class="error error--nav">This field is required</p>
              </div>
            </div>
          </li>
          <!-- Birth Date -->
          <li class="carousel__slide">
            <div class="card">
              <div class="card__content">
                <h2 class="card__title" data-error="This field is required">Birth Date</h2>
                <input required class="card__input" type="date" name="birth-date"
                  value="<?php echo isset($user["birth_date"]) && $user["birth_date"] != '0000-00-00' ? $user["birth_date"] : '' ?>" />
              </div>
              <div class="carousel__nav--desktop">
                <button type="button" class="card__btn card__btn--prev">
                  <i class="fa-solid fa-arrow-left-long card__icon"></i>
                  PREVIOUS
                </button>
                <button type="button" class="card__btn card__btn--next">
                  NEXT
                  <i class="fa-solid fa-arrow-right-long card__icon"></i>
                </button>
                <p class="error error--nav">This field is required</p>
              </div>
            </div>
          </li>
          <!-- Gender -->
          <li class="carousel__slide">
            <div class="card">
              <div class="card__content">
                <h2 class="card__title">Gender</h2>
                <div class="card__input-container">
                  <div class="card__input card__input--gender">
                    <input required type="radio" id="male" name="gender" value="male" <?php echo !isset($user["gender"]) || $user["gender"] === "male" ? 'checked' : '' ?> />
                    <label for="male">Male</label>
                  </div>
                  <div class="card__input card__input--gender">
                    <input required type="radio" id="female" name="gender" value="female" <?php echo isset($user["gender"]) && $user["gender"] === "female" ? 'checked' : '' ?> />
                    <label for="female">Female</label>
                  </div>
                </div>
              </div>
              <div class="carousel__nav--desktop">
                <button type="button" class="card__btn card__btn--prev">
                  <i class="fa-solid fa-arrow-left-long card__icon"></i>
                  PREVIOUS
                </button>
                <button type="button" class="card__btn card__btn--next">
                  NEXT
                  <i class="fa-solid fa-arrow-right-long card__icon"></i>
                </button>
              </div>
            </div>
          </li>
          <!-- Email -->
          <li class="carousel__slide">
            <div class="card">
              <div class="card__content">
                <h2 class="card__title" data-error="Enter a valid e-mail address">Email</h2>
                <input required class="card__input" type="email" name="email" placeholder="e.g. myname@example.com"
                  value="<?php echo $user["email"] ?? '' ?>" />
              </div>
              <div class="carousel__nav--desktop">
                <button type="button" class="card__btn card__btn--prev">
                  <i class="fa-solid fa-arrow-left-long card__icon"></i>
                  PREVIOUS
                </button>
                <button type="button" class="card__btn card__btn--next">
                  NEXT
                  <i class="fa-solid fa-arrow-right-long card__icon"></i>
                </button>
                <p class="error error--nav">Enter a valid e-mail address</p>
              </div>
            </div>
          </li>
          <!-- Phone Number -->
          <li class="carousel__slide">
            <div class="card">
              <div class="card__content">
                <h2 class="card__title" data-error="Enter a valid phone number">Phone Number</h2>
                <input required class="card__input" type="text" name="phone" placeholder="e.g. 9123456789"
                  pattern="[0-9]{10}" value="<?php echo $user["phone_number"] ?? '' ?>" />
              </div>
              <div class="carousel__nav--desktop">
                <button type="button" class="card__btn card__btn--prev">
                  <i class="fa-solid fa-arrow-left-long card__icon"></i>
                  PREVIOUS
                </button>
                <button type="button" class="card__btn card__btn--next">
                  NEXT
                  <i class="fa-solid fa-arrow-right-long card__icon"></i>
                </button>
                <p class="error error--nav">Enter a valid phone number</p>
              </div>
            </div>
          </li>
          <!-- Present Address -->
          <li class="carousel__slide">
            <div class="card">
              <div class="card__content">
                <h2 class="card__title" data-error="This field is required">Address</h2>
                <input required class="card__input" type="text" name="street" placeholder="Street Address"
                  value="<?php echo $user["street_address"] ?? '' ?>" />
                <div class="card__input-container">
                  <div id="barangay" class="card__dropdown">
                    <div class="card__input-wrapper">
                      <input type="hidden" name="barangay" value="<?php echo $user["barangay"] ?? 'Barangay' ?>" />
                      <input class="card__input card__input--dropdown" type="button"
                        value="<?php echo !empty($user["barangay"]) ? $user["barangay"] : 'Barangay' ?>"
                        data-default="Barangay" />
                      <i class="fa-solid fa-chevron-down"></i>
                      <div class="card__dropdown-content">
                        <ul class="card__dropdown-items"></ul>
                      </div>
                    </div>
                  </div>
                  <div id="city" class="card__dropdown">
                    <div class="card__input-wrapper">
                      <input type="hidden" name="city" value="<?php echo $user["city"] ?? '' ?>" />
                      <input class="card__input card__input--dropdown" type="button"
                        value="<?php echo !empty($user["city"]) ? $user["city"] : 'City / Municipality' ?>"
                        data-default="City / Municipality" />
                      <i class="fa-solid fa-chevron-down"></i>
                      <div class="card__dropdown-content">
                        <ul class="card__dropdown-items"></ul>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card__input-container">
                  <div id="province" class="card__dropdown">
                    <div class="card__input-wrapper">
                      <input type="hidden" name="province" value="<?php echo $user["province"] ?? '' ?>" />
                      <input class="card__input card__input--dropdown" type="button"
                        value="<?php echo !empty($user["province"]) ? $user["province"] : 'State / Province' ?>"
                        data-default="State / Province" />
                      <i class="fa-solid fa-chevron-down"></i>
                      <div class="card__dropdown-content">
                        <ul class="card__dropdown-items"></ul>
                      </div>
                    </div>
                  </div>
                  <div id="region" class="card__dropdown">
                    <div class="card__input-wrapper">
                      <input type="hidden" name="region" value="<?php echo $user["region"] ?? '' ?>" />
                      <input class="card__input card__input--dropdown" type="button"
                        value="<?php echo !empty($user["region"]) ? $user["region"] : 'Region' ?>"
                        data-default="Region" />
                      <i class="fa-solid fa-chevron-down"></i>
                      <div class="card__dropdown-content card__dropdown-content--up">
                        <ul class="card__dropdown-items"></ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel__nav--desktop">
                <button type="button" class="card__btn card__btn--prev">
                  <i class="fa-solid fa-arrow-left-long card__icon"></i>
                  PREVIOUS
                </button>
                <button type="button" class="card__btn card__btn--next">
                  NEXT
                  <i class="fa-solid fa-arrow-right-long card__icon"></i>
                </button>
                <p class="error error--nav">This field is required</p>
              </div>
            </div>
          </li>
          <!-- Senior High School Name -->
          <li class="carousel__slide">
            <div class="card">
              <div class="card__content">
                <h2 class="card__title" data-error="This field is required">Senior High School Name</h2>
                <input required class="card__input" type="text" name="shs-name"
                  placeholder="e.g. Polytechnic University of the Philippines"
                  value="<?php echo $user["shs_name"] ?? ''; ?>" />
              </div>
              <div class="carousel__nav--desktop">
                <button type="button" class="card__btn card__btn--prev">
                  <i class="fa-solid fa-arrow-left-long card__icon"></i>
                  PREVIOUS
                </button>
                <button type="button" class="card__btn card__btn--next">
                  NEXT
                  <i class="fa-solid fa-arrow-right-long card__icon"></i>
                </button>
                <p class="error error--nav">This field is required</p>
              </div>
            </div>
          </li>
          <!-- Degree Program -->
          <li class="carousel__slide">
            <div class="card">
              <div class="card__content">
                <h2 class="card__title" data-error="This field is required">Course Program</h2>
                <div id="college" class="card__dropdown">
                  <div class="card__input-wrapper">
                    <input type="hidden" name="college" value="<?php echo $user["college"] ?? '' ?>" />
                    <input required class="card__input card__input--dropdown" type="button"
                      value="<?php echo !empty($user["college"]) ? $user["college"] : 'Please Select College' ?>"
                      data-default="Please Select College" />
                    <i class="fa-solid fa-chevron-down"></i>
                    <div class="card__dropdown-content">
                      <ul class="card__dropdown-items"></ul>
                    </div>
                  </div>
                </div>
                <div id="course" class="card__dropdown <?php echo !empty($user["course"]) ? "show" : '' ?>">
                  <div class="card__input-wrapper">
                    <input type="hidden" name="course" value="<?php echo $user["course"] ?? '' ?>" />
                    <input required class="card__input card__input--dropdown" type="button"
                      value="<?php echo !empty($user["course"]) ? $user["course"] : 'Please Select Course' ?>"
                      data-default="Please Select Course" />
                    <i class="fa-solid fa-chevron-down"></i>
                    <div class="card__dropdown-content">
                      <ul class="card__dropdown-items"></ul>
                    </div>
                  </div>
                </div>
                <div id="major"
                  class="card__dropdown <?php echo !empty($user["major"]) && $user["major"] !== "hidden" ? "show" : '' ?>">
                  <div class="card__input-wrapper">
                    <input type="hidden" name="major" value="<?php echo $user["major"] ?? 'hidden' ?>" />
                    <input required class="card__input card__input--dropdown" type="button"
                      value="<?php echo !empty($user["major"]) ? $user["major"] : 'Please Select Major' ?>"
                      data-default="Please Select Major" />
                    <i class="fa-solid fa-chevron-down"></i>
                    <div class="card__dropdown-content">
                      <ul class="card__dropdown-items"></ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel__nav--desktop">
                <button type="button" class="card__btn card__btn--prev">
                  <i class="fa-solid fa-arrow-left-long card__icon"></i>
                  PREVIOUS
                </button>
                <button type="submit" class="card__btn card__btn--next">SUBMIT</button>
                <p class="error error--nav">This field is required</p>
              </div>
            </div>
          </li>
          <li class="carousel__empty"></li>
        </ul>
      </div>
      <div class="carousel__nav--mobile">
        <button type="button" class="carousel__btn carousel__btn--prev hide">
          <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button type="button" class="carousel__btn carousel__btn--center"></button>
        <button type="button" class="carousel__btn carousel__btn--next">
          <i class="fa-solid fa-chevron-right"></i>
        </button>
      </div>
    </form>
    <!-- navigation pane -->
    <div class="navigation-pane">
      <div class="navigation-pane__header">
        <button class="navigation-pane__back">
          <i class="fa-solid fa-chevron-left"></i>
          Go Back
        </button>
        <p class="navigation-pane__incomplete">3 Incomplete Fields</p>
      </div>
      <ul class="navigation-pane__item-container">
        <li class="navigation-pane__item" data-tooltip="School Information">
          <button class="navigation-pane__btn navigation-pane__btn--active navigation-pane__btn--done">
            <span class="navigation-pane__label">School Information</span>
          </button>
        </li>
        <li class="navigation-pane__item" data-tooltip="Document Requirements">
          <button class="navigation-pane__btn navigation-pane__btn--done">
            <span class="navigation-pane__label">Document Requirements</span>
          </button>
        </li>
        <li class="navigation-pane__item" data-tooltip="Full Name">
          <button
            class="navigation-pane__btn <?php echo !empty($user["first_name"]) ? "navigation-pane__btn--done" : "" ?>">
            <span class="navigation-pane__label">Full Name</span>
          </button>
        </li>
        <li class="navigation-pane__item" data-tooltip="Birth Date">
          <button
            class="navigation-pane__btn <?php echo !empty($user["birth_date"]) && $user["birth_date"] != '0000-00-00' ? "navigation-pane__btn--done" : "" ?>">
            <span class="navigation-pane__label">Birth Date</span>
          </button>
        </li>
        <li class="navigation-pane__item" data-tooltip="Gender">
          <button
            class="navigation-pane__btn <?php echo $_SESSION["role"] === "applicant" || !empty($user["gender"]) ? "navigation-pane__btn--done" : "" ?>">
            <span class="navigation-pane__label">Gender</span>
          </button>
        </li>
        <li class="navigation-pane__item" data-tooltip="Email">
          <button class="navigation-pane__btn <?php echo !empty($user["email"]) ? "navigation-pane__btn--done" : "" ?>">
            <span class="navigation-pane__label">Email</span>
          </button>
        </li>
        <li class="navigation-pane__item" data-tooltip="Phone Number">
          <button
            class="navigation-pane__btn <?php echo !empty($user["phone_number"]) ? "navigation-pane__btn--done" : "" ?>">
            <span class="navigation-pane__label">Phone Number</span>
          </button>
        </li>
        <li class="navigation-pane__item" data-tooltip="Address">
          <button
            class="navigation-pane__btn <?php echo !empty($user["street_address"]) ? "navigation-pane__btn--done" : "" ?>">
            <span class="navigation-pane__label">Address</span>
          </button>
        </li>
        <li class="navigation-pane__item" data-tooltip="Senior High School Name">
          <button
            class="navigation-pane__btn <?php echo !empty($user["shs_name"]) ? "navigation-pane__btn--done" : "" ?>">
            <span class="navigation-pane__label">Senior High School Name</span>
          </button>
        </li>
        <li class="navigation-pane__item" data-tooltip="Degree Program">
          <button
            class="navigation-pane__btn <?php echo !empty($user["college"]) ? "navigation-pane__btn--done" : "" ?>">
            <span class="navigation-pane__label">Degree Program</span>
          </button>
        </li>
      </ul>
    </div>
  </div>
  <!-- scripts -->
  <script src="../js/script.js"></script>
  <script type="module" src="../js/registration_form_controller/index.js"></script>
  <script src="https://kit.fontawesome.com/ca6ab3fb40.js" crossorigin="anonymous"></script>
</body>

</html>