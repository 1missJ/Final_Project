<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

$_SESSION["current_tab"] = "Courses";

include_once "header.php";
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h2>Courses</h2>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#new_course_modal"><i class="fas fa-plus me-1"></i> New Course</button>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>Course Code</th>
                                    <th>Course Name</th>
                                    <th>Duration</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $courses = $model->MOD_GET_COURSES_DATA(); ?>
                                <?php if ($courses) : ?>
                                    <?php foreach ($courses as $course) : ?>
                                        <tr>
                                            <td><?= $course["code"] ?></td>
                                            <td><?= $course["name"] ?></td>
                                            <td><?= $course["duration"] ?> Years</td>
                                            <td class="text-center">
                                                <i class="fas fa-edit text-success me-1 edit_course" course_id="<?= $course["id"] ?>" course_code="<?= $course["code"] ?>" course_name="<?= $course["name"] ?>" course_duration="<?= $course["duration"] ?>" role="button"></i>
                                                <i class="fas fa-trash-alt text-danger delete_course" course_id="<?= $course["id"] ?>" role="button"></i>
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