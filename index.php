<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

function base_url()
{
    $current_url = $_SERVER["REQUEST_URI"];
    $splitted_url = explode("/", $current_url);

    return $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"] . "/" . $splitted_url[1] . "/";
}

require_once "model.php";

$model = new Model();

$model->initialize_database();

if (isset($_SESSION["user_id"])) {
    header("location: dashboard");
} else {
    $_SESSION["current_tab"] = "Login";

    include_once "login.php";
}
