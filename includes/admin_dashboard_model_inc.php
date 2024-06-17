<?php
require_once 'config_session_inc.php';

if ($_SESSION["role"] !== "admin") {
    header('Location: ../index.php');
    die();
}

function getAllApplicants($mysqli)
{
    $query = "SELECT * FROM users WHERE role = 'applicant' AND archived != 1;";
    $queryResult = executeQuery($mysqli, $query);
    return $queryResult['result'] ? $queryResult['result']->fetch_all(MYSQLI_ASSOC) : [];
}

require_once '../includes/dbh_inc.php';
require_once '../includes/execute_query_inc.php';

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $users = getAllApplicants($mysqli);
    echo json_encode($users);
    return;
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $query = "UPDATE users SET archived = 1 WHERE id = ?";
    $queryResult = executeQuery($mysqli, $query, "s", [$_POST["user_id"]]);

    echo json_encode([
        "success" => $queryResult['success'],
        "error" => $queryResult['error'] ?: null,
    ]);
    return;
}

$mysqli->close();
