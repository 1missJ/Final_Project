<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

$_SESSION["current_tab"] = "Transaction";

include_once "header.php";
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h2>Enroll a Student</h2>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="javascript:void(0)" id="enroll_student_form">
                        <div class="mb-3">
                            <label for="enroll_student_student_id" class="form-label">Student Name</label>
                            <select id="enroll_student_student_id" class="form-select" required>
                                <option value selected disabled>-- Choose one --</option>
                                <?php $students = $model->MOD_GET_NON_ENROLLED_STUDENTS_DATA() ?>
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
                                        <option value="<?= $student["id"] ?>"><?= mergeNames($student["first_name"], $student["middle_name"], $student["last_name"]) ?></option>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="enroll_student_course_id" class="form-label">Course</label>
                            <select id="enroll_student_course_id" class="form-select" required>
                                <option value selected disabled>-- Choose one --</option>
                                <?php $courses = $model->MOD_GET_COURSES_DATA(); ?>
                                <?php if ($courses) : ?>
                                    <?php foreach ($courses as $course) : ?>
                                        <option value="<?= $course["id"] ?>"><?= $course["name"] ?></option>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="enroll_student_subjects_id" class="form-label">Subjects</label>
                            <select id="enroll_student_subjects_id" class="selectpicker form-control" multiple data-live-search="true" required>
                                <?php $subjects = $model->MOD_GET_SUBJECTS_DATA_ORDER_BY_DESCRIPTION(); ?>
                                <?php if ($subjects) : ?>
                                    <?php foreach ($subjects as $subject) : ?>
                                        <option value="<?= $subject["id"] ?>"><?= $subject["description"] ?></option>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100" id="enroll_student_submit">Enroll</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once "footer.php" ?>