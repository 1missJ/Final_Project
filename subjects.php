<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

$_SESSION["current_tab"] = "Subjects";

include_once "header.php";
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h2>Subjects</h2>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#new_subject_modal"><i class="fas fa-plus me-1"></i> New Subject</button>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>Subject Code</th>
                                    <th>Subject Description</th>
                                    <th>Units</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $subjects = $model->MOD_GET_SUBJECTS_DATA(); ?>
                                <?php if ($subjects) : ?>
                                    <?php foreach ($subjects as $subject) : ?>
                                        <tr>
                                            <td><?= $subject["code"] ?></td>
                                            <td><?= $subject["description"] ?></td>
                                            <td><?= $subject["units"] ?> Units</td>
                                            <td class="text-center">
                                                <i class="fas fa-edit text-success me-1 edit_subject" subject_id="<?= $subject["id"] ?>" subject_code="<?= $subject["code"] ?>" subject_description="<?= $subject["description"] ?>" subject_units="<?= $subject["units"] ?>" role="button"></i>
                                                <i class="fas fa-trash-alt text-danger delete_subject" subject_id="<?= $subject["id"] ?>" role="button"></i>
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