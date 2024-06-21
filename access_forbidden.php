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

if (isset($_SESSION["user_id"])) {
    $base_page = "dashboard";
    $page = "Dashboard";
} else {
    $base_page = base_url();
    $page = "Homepage";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Access Forbidden</title>

    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/icon.png" type="image/x-icon">
    
    <link href="<?= base_url() ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/dist/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid forbidden-page">
        <div class="row">
            <div class="col-12 forbidden-content">
                <h1>403</h1>
                <h2>Access Forbidden</h2>
                <p>You do not have permission to access this page.</p>
                <a href="<?= $base_page ?>" class="btn btn-danger">Go to <?= $page ?></a>
            </div>
        </div>
    </div>

    <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>