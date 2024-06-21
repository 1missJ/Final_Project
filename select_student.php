<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

include_once "header.php";
include_once "model.php"; // Include your model file

$model = new Model();

if (isset($_POST['select_student'])) {
    $selected_student_id = $_POST['student_id'];
    
    // Fetch student details
    $student = $model->MOD_GET_STUDENT_DATA_BY_ID($selected_student_id);
    
    // Fetch course details
    $course_query = "SELECT * FROM courses WHERE id = '" . $student['course'] . "'";
    $course_result = $model->performQuery($course_query);
    $course = $course_result->fetch_assoc();
    
    // Fetch enrolled subjects
    $subjects_query = "SELECT sub.code AS subject_code, sub.description, sub.units
                       FROM enrolled_students es
                       JOIN subjects sub ON FIND_IN_SET(sub.id, es.subjects_id)
                       WHERE es.student_id = '$selected_student_id'";
    $subjects_result = $model->performQuery($subjects_query);
?>
    <div class="boql text-center">
        <div style="display: flex; justify-content: center; align-items: center;">
            <img src="isu.png" alt="Left Image" style="height: 70px; margin-right: 20px;">
            <div>
                <h5>ISABELA STATE UNIVERSITY</h5>
                <h6>Cabagan Campus</h6>
                <h6>Garita, Cabagan Isabela</h6>
                <h5>ASSESSMENT FORM</h5>
            </div>
            <img src="students.png" alt="Right Image" style="height: 70px; margin-left: 20px;">
        </div>
    </div>

    <!-- Display student details -->
    <div style="margin-bottom: 50px;">
        <div style="display: flex; justify-content: space-between;">
            <div>
                <strong>Student ID:</strong> <span><?= htmlspecialchars($student['student_number']) ?></span>
            </div>
        </div>
        <div style="display: flex; justify-content: space-between; margin-top: 10px;">
            <div>
                <strong>Name:</strong> <span><?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) ?></span>
            </div>
            <div>
                <strong>Course & Section:</strong> <span><?= isset($student['course']) ? htmlspecialchars($student['course']) : 'Unknown' ?> - <?= htmlspecialchars($student['section']) ?></span>
            </div>
        </div>
    </div>

    <!-- Display enrolled subjects -->
    <div class="table-container">
        <table class="table table-bordered narrow-table">
            <thead>
                <tr>
                    <th>Subject Code</th>
                    <th>Subject Description</th>
                    <th>Units</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_units = 0;
                while ($subject = $subjects_result->fetch_assoc()) {
                    $total_units += $subject['units'];
                    echo "<tr>
                            <td>" . htmlspecialchars($subject['subject_code']) . "</td>
                            <td>" . htmlspecialchars($subject['description']) . "</td>
                            <td>" . htmlspecialchars($subject['units']) . "</td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div style="text-align: left; margin-right: 50px;">
        <strong>Total Units:</strong>
        <span><?= htmlspecialchars($total_units) ?></span>
    </div>

    <!-- Fees -->
    <div class="fees-section" style="text-align: left; font-size: 0.9em;">
        <h4>Fees</h4>
        <div class="fees-list">
            <h5>Miscellaneous</h5>
            <ul style="list-style-type: none; padding-left: 0;">
                <li>Registration Fee<span style="display: inline-block; width: 200px; text-align: right;">50.00</span></li>
                <li>Medical/Dental Fee<span style="display: inline-block; width: 180px; text-align: right;">50.00</span></li>
                <li>Library Fee<span style="display: inline-block; width: 240px; text-align: right;">100.00</span></li>
                <li>Socio-cultural Fee<span style="display: inline-block; width: 190px; text-align: right;">25.00</span></li>
                <li>SBO/SSC/SSCF<span style="display: inline-block; width: 210px; text-align: right;">60.00</span></li>
            </ul>
        </div>
        <div class="fees-list">
            <h5>Laboratory Fee</h5>
            <ul style="list-style-type: none; padding-left: 0;">
                <li>Computer Laboratory<span style="display: inline-block; width: 180px; text-align: right;">1,800.00</span></li>
            </ul>
        </div>
        <div class="fees-list">
            <h5>Tuition Fee</h5>
            <ul style="list-style-type: none; padding-left: 0;">
                <li>Tuition Fee<span style="display: inline-block; width: 245px; text-align: right;">2,600.00</span></li>
            </ul>
        </div>
        <div class="fees-list">
            <h5>Total</h5>
            <ul style="list-style-type: none; padding-left: 0;">
                <li>Total<span style="display: inline-block; width: 285px; text-align: right;">4,895.00</span></li>
            </ul>
        </div>
    </div>

    <div style="margin-top: 20px;" class="no-print">
        <button class="btn btn-primary" onclick="window.print()">Print</button>
    </div>
    
<?php
} else {
    echo "<p>No student selected.</p>";
}

include_once "footer.php";
?>

<style>
    @media print {
        .no-print {
            display: none;
        }
    }
    .boql {
        margin-bottom: 50px;
    }
    .form-group {
        margin-bottom: 10px;
    }
    .form-group label {
        font-weight: bold;
    }
    .form-group p {
        display: inline;
        margin-left: 10px;
    }
    .left-align {
        text-align: left;
    }
</style>
