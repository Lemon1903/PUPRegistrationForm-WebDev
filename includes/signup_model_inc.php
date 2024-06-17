<?php
declare(strict_types=1);
header('Content-Type: application/json');

function userAlreadyExists(object $mysqli, string $username)
{
    $query = "SELECT username FROM users WHERE username = ?;";
    $queryResult = executeQuery($mysqli, $query, "s", [$username]);
    return $queryResult['success'] && $queryResult['result']->num_rows > 0;
}

function validateUsername(object $mysqli, string $username)
{
    if (empty($username)) {
        return "This field is required";
    }
    if (userAlreadyExists($mysqli, $username)) {
        return "Username already exists";
    }
    return null;
}

function validatePassword(string $password)
{
    if (empty($password)) {
        return "This field is required";
    }
    if (strlen($password) < 8) {
        return "Password must be at least 8 characters";
    }
    if (!preg_match("/[a-z]/", $password)) {
        return "Password must contain at least one lowercase letter";
    }
    if (!preg_match("/[A-Z]/", $password)) {
        return "Password must contain at least one uppercase letter";
    }
    if (!preg_match("/[0-9]/", $password)) {
        return "Password must contain at least one number";
    }
    if (!preg_match("/[^a-zA-Z0-9]/", $password)) {
        return "Password must contain at least one special character";
    }
    return null;
}

function validateConfirmPassword(string $password, string $confirmPassword)
{
    if (empty($confirmPassword)) {
        return "This field is required";
    }
    if ($password !== $confirmPassword) {
        return "Passwords do not match";
    }
    return null;
}

require_once 'dbh_inc.php';
require_once 'execute_query_inc.php';

// handle POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm-password"];

    $fieldErrors = [];
    $queryResult = null;

    $usernameError = validateUsername($mysqli, $username);
    if ($usernameError) {
        $fieldErrors["username"] = $usernameError;
    }

    $passwordError = validatePassword($password);
    if ($passwordError) {
        $fieldErrors["password"] = $passwordError;
    }

    $confirmPasswordError = validateConfirmPassword($password, $confirmPassword);
    if ($confirmPasswordError) {
        $fieldErrors["confirm-password"] = $confirmPasswordError;
    }

    if (empty($fieldErrors)) {
        $hashedPwd = password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]);
        $query = "INSERT INTO users (username, pwd, role) VALUES (?, ?, ?);";
        $queryResult = executeQuery($mysqli, $query, "sss", [$username, $hashedPwd, "applicant"]);
    }

    echo json_encode([
        "success" => $queryResult ? $queryResult['success'] : false,
        "error" => $queryResult && $queryResult['error'] !== "" ? $queryResult["error"] : null,
        "fieldErrors" => empty($fieldErrors) ? null : $fieldErrors
    ]);
}

// close the connection
$mysqli->close();
