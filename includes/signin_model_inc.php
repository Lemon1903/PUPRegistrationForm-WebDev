<?php
declare(strict_types=1);
header('Content-Type: application/json');

function getUser(object $mysqli, string $username): ?array
{
    $query = "SELECT * FROM users WHERE username = ? AND archived != 1;";
    $queryResult = executeQuery($mysqli, $query, "s", [$username]);
    return $queryResult['result'] ? $queryResult['result']->fetch_assoc() : null;
}

function verifyUsername(string $username, ?array $user)
{
    if (empty($username)) {
        return "This field is required";
    }
    if (!$user) {
        return "Incorrect username";
    }
    return null;
}

function verifyPassword(string $password, ?array $user)
{
    if (empty($password)) {
        return "This field is required";
    }
    if ($user && !password_verify($password, $user["pwd"])) {
        return "Incorrect password";
    }
    return null;
}

require_once 'dbh_inc.php';
require_once 'execute_query_inc.php';

// handle POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST["password"];

    $fieldErrors = [];
    $queryResult = null;
    $applicatn = getUser($mysqli, $username);

    $usernameError = verifyUsername($username, $applicatn);
    if ($usernameError) {
        $fieldErrors["username"] = $usernameError;
    }

    $passwordError = verifyPassword($password, $applicatn);
    if ($passwordError) {
        $fieldErrors["password"] = $passwordError;
    }

    if (empty($fieldErrors)) {
        require_once "config_session_inc.php";
        $_SESSION['user_id'] = $applicatn["id"];
        $_SESSION["submitted"] = $applicatn["submitted"];
        $_SESSION["role"] = $applicatn["role"];
    }

    echo json_encode([
        "user_role" => $applicatn["role"] ?? null,
        "fieldErrors" => $fieldErrors ?: null,
    ]);
}

// close the connection
$mysqli->close();
