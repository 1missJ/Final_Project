<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

$_SESSION["current_tab"] = "Dashboard";

include_once "header.php";
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
           
        </div>
    </div>
</div>

<?php include_once "footer.php" ?>