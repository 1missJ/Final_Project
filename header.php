<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header("HTTP/1.0 403 Forbidden");
    header("location: access_forbidden.php");
    exit();
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user_id"])) {
    $_SESSION["notification"] = array(
        "title" => "Oops..",
        "text" => "You must login first",
        "icon" => "error"
    );
    header("location: index");
    exit();
}

function base_url()
{
    $current_url = $_SERVER["REQUEST_URI"];
    $splitted_url = explode("/", $current_url);
    return $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["SERVER_NAME"] . "/" . $splitted_url[1] . "/";
}

require_once "model.php";

$model = new Model();

$user = $model->MOD_GET_USER_DATA_BY_ID($_SESSION["user_id"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Online Enrollment System - <?= $_SESSION["current_tab"] ?></title>

    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/icon.png" type="image/x-icon">

    <link href="<?= base_url() ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/plugins/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/plugins/datatables/css/dataTables.bootstrap5.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/dist/css/style.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url() ?>dashboard">OES</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= $_SESSION["current_tab"] == "Dashboard" ? "active" : null ?>" href="<?= base_url() ?>dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= ($_SESSION["current_tab"] == "Courses") || ($_SESSION["current_tab"] == "Subjects") || ($_SESSION["current_tab"] == "Students") ? "active" : null ?>" href="javascript:void(0)" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Setup
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item <?= $_SESSION["current_tab"] == "Courses" ? "active" : null ?>" href="<?= base_url() ?>courses"><i class="fas fa-list me-2"></i> Courses</a></li>
                            <li><a class="dropdown-item <?= $_SESSION["current_tab"] == "Subjects" ? "active" : null ?>" href="<?= base_url() ?>subjects"><i class="fas fa-book me-2"></i> Subjects</a></li>
                            <li><a class="dropdown-item <?= $_SESSION["current_tab"] == "Students" ? "active" : null ?>" href="<?= base_url() ?>students"><i class="fas fa-graduation-cap me-1"></i> Students</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $_SESSION["current_tab"] == "Transaction" ? "active" : null ?>" href="<?= base_url() ?>transaction">Transaction</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $_SESSION["current_tab"] == "Reports" ? "active" : null ?>" href="<?= base_url() ?>reports">Reports</a>
                    </li>
                    <?php if ($user["user_type"] == "admin") : ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $_SESSION["current_tab"] == "Users" ? "active" : null ?>" href="<?= base_url() ?>users">Users</a>
                        </li>
                    <?php endif ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $_SESSION["current_tab"] == "Members" ? "active" : null ?>" href="members.php">About</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="javascript:void(0)" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= base_url() ?>assets/img/default-user-image.png" class="rounded-circle me-2 bg-light" style="width: 24px; height: 24px;" alt="User Image">
                            <?= $user["name"] ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="javascript:void(0)" id="account_settings" user_id="<?= $user["id"] ?>" user_name="<?= $user["name"] ?>" user_username="<?= $user["username"] ?>" user_password="<?= $user["password"] ?>"><i class="fas fa-cog me-1"></i> Account Settings</a></li>
                            
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="javascript:void(0)" id="logout"><i class="fas fa-sign-out-alt me-1"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>
</html>
