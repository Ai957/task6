<?php
include "includes/config.php";
session_start();
if (!isset($_SESSION["user_email"])) {
    header("Location: index.php");
    die();
}

if (isset($_GET["id"])) {
    $todoId = mysqli_real_escape_string($conn, $_GET["id"]);
    $currentDate= date('Y-m-d');

    // Get User Id based on user email
    $sql = "SELECT id FROM users WHERE email='{$_SESSION["user_email"]}'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if ($count > 0) {
        $row = mysqli_fetch_assoc($res);
        $user_id = $row["id"];
    } else {
        $user_id = 0;
    }

    $sql = "SELECT * FROM todos WHERE enddate= GETDATE('{$endDate}'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if ($count >= $currentDate) {
        echo 'Cant delete the todo';
    } else {
        $sql = "DELETE FROM todos WHERE id='{$todoId}' AND user_id='{$user_id}'";
    $res= mysqli_query($conn, $sql);
    header("Location: todos.php");
    }
} else {
    header("Location: todos.php");
}

?>