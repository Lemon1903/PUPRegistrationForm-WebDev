<?php
require_once '../includes/config_session_inc.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
  header("Location: ../index.php");
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
  <div class="container container--admin">
    <div class="dashboard__header">
      <div class="card__input-wrapper">
        <input type="text" class="card__input card__input--search" placeholder="Search">
        <i class='bx bx-search bx-sm'></i>
      </div>
      <form action="../includes/signout_model_inc.php" method="post">
        <button type="submit" class="action-btn" title="logout">
          <i class='bx bx-log-out bx-md'></i>
        </button>
      </form>
    </div>
    <div class="table-container">
      <table>
        <thead class="table-head">
          <tr class="table-row">
            <th class="table-head">Username</th>
            <th class="table-head">Full Name</th>
            <th class="table-head">Course</th>
            <th class="table-head text-center">Submitted</th>
            <th class="table-head text-center">Actions</th>
          </tr>
        </thead>
        <tbody class="table-body"></tbody>
      </table>
    </div>
  </div>
  <script src="js/script.js"></script>
  <script type="module" src="../js/admin_dashboard_controller/index.js"></script>
</body>

</html>