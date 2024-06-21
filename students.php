<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

$_SESSION["current_tab"] = "Students";

include_once "header.php";
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h2>Students</h2>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#new_student_modal"><i class="fas fa-plus me-1"></i> New Student</button>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered datatable">
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Student Name</th>
                                    <th>Sex</th>
                                    <th>Date of Birth</th>
                                    <th>Mobile Number</th>
                                    <th>CYS</th>
                                    <th>Enrollment Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $students = $model->MOD_GET_STUDENTS_DATA() ?>
                                <?php if ($students) : ?>
                                    <?php
                                    function mergeNames($firstName, $middleName, $lastName)
                                    {
                                        $firstName = trim($firstName);
                                        $middleName = trim($middleName);
                                        $lastName = trim($lastName);

                                        if (!empty($middleName)) {
                                            $middleInitial = strtoupper($middleName[0]) . '.';

                                            $fullName = "$firstName $middleInitial $lastName";
                                        } else {
                                            $fullName = "$firstName $lastName";
                                        }

                                        return $fullName;
                                    }
                                    ?>
                                    <?php foreach ($students as $student) : ?>
                                        <tr>
                                            <td><?= $student["student_number"] ?></td>
                                            <td><?= mergeNames($student["first_name"], $student["middle_name"], $student["last_name"]) ?></td>
                                            <td><?= $student["sex"] ?></td>
                                            <td><?= (new DateTime($student["birthday"]))->format('F j, Y') ?></td>
                                            <td><?= $student["mobile_number"] ?></td>
                                            <td><?= $student["course"] . " " . $student["year"] . "-" . $student["section"] ?></td>
                                            <td class="<?= $student["is_enrolled"] == 1 ? "text-success" : "text-danger" ?>"><?= $student["is_enrolled"] == 1 ? "Enrolled" : "Not Yet Enrolled" ?></td>
                                            <td class="text-center">
                                                <i class="fas fa-edit text-success me-1 edit_student" student_id="<?= $student["id"] ?>" role="button"></i>
                                                <i class="fas fa-trash-alt text-danger delete_student" student_id="<?= $student["id"] ?>" role="button"></i>
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