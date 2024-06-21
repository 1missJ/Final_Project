<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
$_SESSION["current_tab"] = "Reports";

include_once "header.php";
include_once "model.php"; // Include your model file

$model = new Model();
$students = $model->MOD_GET_STUDENTS_DATA();

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2>Select Student</h2>
            <form method="post" action="select_student.php">
                <div class="form-group">
                    <label for="student_id">Student Name:</label>
                    <select class="form-control" id="student_id" name="student_id" required>
                        <?php foreach ($students as $student) : ?>
                            <option value="<?= $student['id'] ?>"><?= $student['first_name'] . ' ' . $student['last_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" name="select_student" class="btn btn-primary">Generate Report</button>
            </form>
        </div>
    </div>
</div>

<?php include_once "footer.php"; ?>
