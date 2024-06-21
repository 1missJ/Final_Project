<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_SESSION["user_id"])) {
    header("location: dashboard");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Online Enrollment System - Login</title>

    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/icon.png" type="image/x-icon">

    <link href="<?= base_url() ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/dist/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="login-page">
        <div style="max-width: 450px;">
            <div class="alert alert-danger text-center d-none" id="login_admin_alert_message">Invalid Username or Password</div>

            <div class="card" style="max-width: 450px;">
                <div class="card-header text-center">
                    <img src="<?= base_url() ?>assets/img/icon.png" class="mb-2">
                    <h1>Major Examination Scheduling</h1>
                </div>
                <div class="card-body">
                    <p class="text-center">Please login to proceed</p>

                    <form action="javascript:void(0)" id="login_admin_form">
                        <div class="mb-3">
                            <label for="login_admin_username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="login_admin_username" value="<?= isset($_SESSION["remember_me_username"]) ? $_SESSION["remember_me_username"] : null ?>" required>
                        </div>
                        <div class="mb-1">
                            <label for="login_admin_password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="login_admin_password" value="<?= isset($_SESSION["remember_me_password"]) ? $_SESSION["remember_me_password"] : null ?>" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="login_admin_remember_me" <?= isset($_SESSION["remember_me"]) ? "checked" : null ?>>
                            <label class="form-check-label" for="login_admin_remember_me">Remember Me</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100" id="login_admin_submit">Submit</button>
                    </form>

                    <p class="mt-2 mb-0">
                        <span>Need an Account?</span>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#register_modal">Register</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal fade" id="register_modal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Create an Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="javascript:void(0)" id="register_form">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="register_name" class="form-label">Name</label>
                            <input type="text" id="register_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="register_username" class="form-label">Username</label>
                            <input type="text" id="register_username" class="form-control" required>
                            <small class="text-danger d-none" id="error_register_username">Username is already in use</small>
                        </div>
                        <div class="mb-3">
                            <label for="register_password" class="form-label">Password</label>
                            <input type="password" id="register_password" class="form-control" required>
                            <small class="text-danger d-none" id="error_register_password">Passwords do not match</small>
                        </div>
                        <div class="mb-3">
                            <label for="register_confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" id="register_confirm_password" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="register_submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/jquery/jquery-3.7.1.min.js"></script>

    <script>
        jQuery(document).ready(function() {
            const notification = <?= isset($_SESSION["notification"]) ? json_encode($_SESSION["notification"]) : json_encode(null) ?>;
            const base_url = "<?= base_url() ?>";

            $("#login_admin_alert_message").removeClass("alert-success");
            $("#login_admin_alert_message").removeClass("alert-danger");

            if (notification) {
                display_alert(notification);
            }

            $("#login_admin_form").submit(function() {
                const username = $("#login_admin_username").val();
                const password = $("#login_admin_password").val();
                const remember_me = $("#login_admin_remember_me").prop("checked");

                $("#login_admin_submit").text("Please wait...");
                $("#login_admin_submit").attr("disabled", true);

                $("#login_admin_alert_message").addClass("d-none");

                var formData = new FormData();

                formData.append('username', username);
                formData.append('password', password);
                formData.append('remember_me', remember_me);

                formData.append('login_admin', true);

                $.ajax({
                    url: 'server.php',
                    data: formData,
                    type: 'POST',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        location.href = base_url;
                    },
                    error: function(_, _, error) {
                        console.error(error);
                    }
                });
            })

            $("#register_form").submit(function() {
                const name = $("#register_name").val();
                const username = $("#register_username").val();
                const password = $("#register_password").val();
                const confirm_password = $("#register_confirm_password").val();

                if (password == confirm_password) {
                    $("#register_submit").text("Please wait...");
                    $("#register_submit").attr("disabled", true);

                    var formData = new FormData();

                    formData.append('name', name);
                    formData.append('username', username);
                    formData.append('password', password);

                    formData.append('register', true);

                    $.ajax({
                        url: 'server.php',
                        data: formData,
                        type: 'POST',
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response) {
                                location.href = base_url;
                            } else {
                                $("#register_username").addClass("is-invalid");
                                $("#error_register_username").removeClass("d-none");

                                $("#register_submit").text("Submit");
                                $("#register_submit").removeAttr("disabled");
                            }
                        },
                        error: function(_, _, error) {
                            console.error(error);
                        }
                    });
                } else {
                    $("#register_password").addClass("is-invalid");
                    $("#register_confirm_password").addClass("is-invalid");
                    $("#error_register_password").removeClass("d-none");
                }
            })

            $("#register_username").keydown(function() {
                $("#register_username").removeClass("is-invalid");
                $("#error_register_username").addClass("d-none");
            })
            
            $("#register_password").keydown(function() {
                $("#register_password").removeClass("is-invalid");
                $("#register_confirm_password").removeClass("is-invalid");
                $("#error_register_password").addClass("d-none");
            })

            $("#register_confirm_password").keydown(function() {
                $("#register_password").removeClass("is-invalid");
                $("#register_confirm_password").removeClass("is-invalid");
                $("#error_register_password").addClass("d-none");
            })

            function display_alert(notification) {
                let icon = notification.icon == "success" ? "success" : "danger";

                $("#login_admin_alert_message").addClass("alert-" + icon);
                $("#login_admin_alert_message").text(notification.text);

                $("#login_admin_alert_message").removeClass("d-none");
            }
        })
    </script>
</body>

</html>

<?php unset($_SESSION["notification"]) ?>