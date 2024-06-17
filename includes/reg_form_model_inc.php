<?php
header('Content-Type: application/json');

require_once 'config_session_inc.php';
require_once "dbh_inc.php";
require_once 'execute_query_inc.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_GET["user_id"] ?? $_SESSION["user_id"];
    $query = "UPDATE users SET first_name = ?, middle_name = ?, last_name = ?, birth_date = ?, gender = ?, email = ?, phone_number = ?, street_address = ?, barangay = ?, city = ?, province = ?, region = ?, shs_name = ?, college = ?, course = ?, major = ?, submitted = ? WHERE id = ?;";
    $queryResult = executeQuery($mysqli, $query, "ssssssssssssssssis", [...array_values($_POST), 1, $id]);

    if ($_SESSION["role"] === "applicant" && $queryResult['success']) {
        $_SESSION["submitted"] = 1;
    }

    // send json response to the client
    echo json_encode([
        "success" => $queryResult['success'],
        "error" => $queryResult['error'] ?: null,
        "role" => $_SESSION["role"],
    ]);

    $mysqli->close();
    return;
}

// close the connection
header("Location: ../pages/admin_dashboard.php");
