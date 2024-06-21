<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

$_SESSION["current_tab"] = "Users";

include_once "header.php";
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h2>User Confirmation</h2>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $users = $model->MOD_GET_USERS(); ?>
                                <?php if ($users) : ?>
                                    <?php foreach ($users as $individual_user) : ?>
                                        <tr>
                                            <td><?= $individual_user["name"] ?></td>
                                            <td><?= $individual_user["username"] ?></td>
                                            <td class="text-muted">Password is hidden for security</td>
                                            <td class="text-center">
                                                <i class="fas fa-thumbs-up text-success me-1 user_confirmation" user_id="<?= $individual_user["id"] ?>" response="confirm" role="button"></i>
                                                <i class="fas fa-thumbs-down text-danger user_confirmation" user_id="<?= $individual_user["id"] ?>" response="reject" role="button"></i>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once "footer.php" ?>