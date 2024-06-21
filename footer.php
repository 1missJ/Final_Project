<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    header("HTTP/1.0 403 Forbidden");
    header("Location: access_forbidden.php");

    exit();
}
?>

<!-- Alert Modal -->
<div class="modal fade" id="alert_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body pt-4 pb-3">
                <div class="text-center">
                    <i class="fas fa-times-circle text-danger mb-4" id="alert_icon" style="font-size: 100px;"></i>

                    <h2 id="alert_title" class="mb-3"></h2>
                    <p id="alert_message" style="font-size: larger;" class="mb-4"></p>

                    <button class="btn btn-primary px-3" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About Us Modal -->


<!-- Account Settings Modal -->
<div class="modal fade" id="account_settings_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Account Settings</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="javascript:void(0)" id="account_settings_form">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="account_settings_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="account_settings_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="account_settings_username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="account_settings_username" required>
                    </div>
                    <div class="mb-3">
                        <label for="account_settings_password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="account_settings_password" placeholder="Password is hidden for security">
                        <small class="text-danger d-none" id="error_account_settings_password">Passwords do not match</small>
                    </div>
                    <div class="mb-3">
                        <label for="account_settings_confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="account_settings_confirm_password" placeholder="Password is hidden for security">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="account_settings_id">
                    <input type="hidden" id="account_settings_old_password">

                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="account_settings_submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- New Course Modal -->
<div class="modal fade" id="new_course_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">New Course</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="javascript:void(0)" id="new_course_form">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="new_course_code" class="form-label">Course Code</label>
                        <input type="text" class="form-control" id="new_course_code" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_course_name" class="form-label">Course Name</label>
                        <input type="text" class="form-control" id="new_course_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_course_duration" class="form-label">Duration</label>
                        <input type="number" class="form-control" id="new_course_duration" required>
                        <small class="text-danger d-none" id="error_new_course_duration">Duration must be greater than 0</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="new_course_submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Course Modal -->
<div class="modal fade" id="edit_course_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Course</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="javascript:void(0)" id="edit_course_form">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_course_code" class="form-label">Course Code</label>
                        <input type="text" class="form-control" id="edit_course_code" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_course_name" class="form-label">Course Name</label>
                        <input type="text" class="form-control" id="edit_course_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_course_duration" class="form-label">Duration</label>
                        <input type="number" class="form-control" id="edit_course_duration" required>
                        <small class="text-danger d-none" id="error_edit_course_duration">Duration must be greater than 0</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="edit_course_id">

                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="edit_course_submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Course Confirmation Modal -->
<div class="modal fade" id="delete_course_modal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Confirm Deletion</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this course?</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="delete_course_id">

                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="delete_course_submit">Yes, delete it!</button>
            </div>
        </div>
    </div>
</div>

<!-- User Confirmation Modal -->
<div class="modal fade" id="user_confirmation_modal" tabindex="-1" aria-labelledby="user_confirmation_title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="user_confirmation_title">User Confirmation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="user_confirmation_message">Are you sure you want to CONFIRM this user?</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="user_confirmation_id">
                <input type="hidden" id="user_confirmation_response">

                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="user_confirmation_submit">Yes, confirm it!</button>
            </div>
        </div>
    </div>
</div>

<!-- New Subject Modal -->
<div class="modal fade" id="new_subject_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">New Subject</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="javascript:void(0)" id="new_subject_form">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="new_subject_code" class="form-label">Subject Code</label>
                        <input type="text" class="form-control" id="new_subject_code" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_subject_description" class="form-label">Subject Description</label>
                        <input type="text" class="form-control" id="new_subject_description" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_subject_units" class="form-label">Units</label>
                        <input type="number" class="form-control" id="new_subject_units" required>
                        <small class="text-danger d-none" id="error_new_subject_units">Units must be greater than 0</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="new_subject_submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Subject Confirmation Modal -->
<div class="modal fade" id="delete_subject_modal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Confirm Deletion</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this subject?</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="delete_subject_id">

                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="delete_subject_submit">Yes, delete it!</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Subject Modal -->
<div class="modal fade" id="edit_subject_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Subject</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="javascript:void(0)" id="edit_subject_form">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_subject_code" class="form-label">Subject Code</label>
                        <input type="text" class="form-control" id="edit_subject_code" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_subject_description" class="form-label">Subject Description</label>
                        <input type="text" class="form-control" id="edit_subject_description" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_subject_units" class="form-label">Units</label>
                        <input type="number" class="form-control" id="edit_subject_units" required>
                        <small class="text-danger d-none" id="error_edit_subject_units">Units must be greater than 0</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="edit_subject_id">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="edit_subject_submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- New Student Modal -->
<div class="modal fade" id="new_student_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">New Student</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="javascript:void(0)" id="new_student_form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="new_student_student_number" class="form-label">Student Number</label>
                                <input type="text" class="form-control" id="new_student_student_number" required>
                                <small class="text-danger d-none" id="error_new_student_student_number">Student Number is already in use</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="new_student_email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="new_student_email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="new_student_first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="new_student_first_name" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="new_student_middle_name" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="new_student_middle_name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="new_student_last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="new_student_last_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="new_student_course" class="form-label">Course</label>
                                <select class="form-select" id="new_student_course" required>
                                    <option value disabled selected>-- Choose one --</option>
                                    <?php $courses = $model->MOD_GET_COURSES_DATA() ?>
                                    <?php if ($courses) : ?>
                                        <?php foreach ($courses as $course) : ?>
                                            <option value="<?= $course["code"] ?>"><?= $course["code"] ?></option>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="new_student_year" class="form-label">Year</label>
                                <select class="form-select" id="new_student_year" required>
                                    <option value disabled selected>-- Choose one --</option>
                                    <option value="1">1st Year</option>
                                    <option value="2">2nd Year</option>
                                    <option value="3">3rd Year</option>
                                    <option value="4">4th Year</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="new_student_section" class="form-label">Section</label>
                                <input type="text" id="new_student_section" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="new_student_birthday" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="new_student_birthday" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="new_student_sex" class="form-label">Sex</label>
                                <select class="form-select" id="new_student_sex" required>
                                    <option value disabled selected>-- Choose one --</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="new_student_mobile_number" class="form-label">Mobile Number</label>
                                <input type="number" class="form-control" id="new_student_mobile_number" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="new_student_address" class="form-label">Address</label>
                                <textarea id="new_student_address" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="new_student_submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Student Modal -->
<div class="modal fade" id="edit_student_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Student</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="javascript:void(0)" id="edit_student_form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_student_student_number" class="form-label">Student Number</label>
                                <input type="text" class="form-control" id="edit_student_student_number" required>
                                <small class="text-danger d-none" id="error_edit_student_student_number">Student Number is already in use</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_student_email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="edit_student_email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="edit_student_first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="edit_student_first_name" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="edit_student_middle_name" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="edit_student_middle_name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="edit_student_last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="edit_student_last_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="edit_student_course" class="form-label">Course</label>
                                <select class="form-select" id="edit_student_course" required>
                                    <option value disabled selected>-- Choose one --</option>
                                    <?php $courses = $model->MOD_GET_COURSES_DATA() ?>
                                    <?php if ($courses) : ?>
                                        <?php foreach ($courses as $course) : ?>
                                            <option value="<?= $course["code"] ?>"><?= $course["code"] ?></option>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="edit_student_year" class="form-label">Year</label>
                                <select class="form-select" id="edit_student_year" required>
                                    <option value disabled selected>-- Choose one --</option>
                                    <option value="1">1st Year</option>
                                    <option value="2">2nd Year</option>
                                    <option value="3">3rd Year</option>
                                    <option value="4">4th Year</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="edit_student_section" class="form-label">Section</label>
                                <input type="text" id="edit_student_section" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="edit_student_birthday" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="edit_student_birthday" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="edit_student_sex" class="form-label">Sex</label>
                                <select class="form-select" id="edit_student_sex" required>
                                    <option value disabled selected>-- Choose one --</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="edit_student_mobile_number" class="form-label">Mobile Number</label>
                                <input type="number" class="form-control" id="edit_student_mobile_number" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="edit_student_address" class="form-label">Address</label>
                                <textarea id="edit_student_address" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="edit_student_id">
                    <input type="hidden" id="edit_student_old_student_number">

                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="edit_student_submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Student Confirmation Modal -->
<div class="modal fade" id="delete_student_modal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Confirm Deletion</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this student?</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="delete_student_id">

                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="delete_student_submit">Yes, delete it!</button>
            </div>
        </div>
    </div>
</div>

<footer class="bg-dark text-white text-center py-3 mt-auto">
    <div class="container">
        <p class="mb-0">© 2024 Online Enrollment System. All Rights Reserved.</p>
    </div>
</footer>

<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jquery/jquery-3.7.1.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/js/dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/js/dataTables.bootstrap5.js"></script>
<script src="<?= base_url() ?>assets/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>

<script>
    jQuery(document).ready(function() {
        const notification = <?= isset($_SESSION["notification"]) ? json_encode($_SESSION["notification"]) : json_encode(null) ?>;
        const base_url = "<?= base_url() ?>";

        if (notification) {
            display_alert(notification);
        }

        $('.selectpicker').selectpicker();

        $('.datatable').DataTable({
            paging: true,
            searching: true,
            ordering: false,
            info: true,
            dom: 'Bfrtip'
        })

        $("#logout").click(function() {
            var formData = new FormData();

            formData.append('logout', true);

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

        $("#new_subject_form").submit(function() {
            const code = $("#new_subject_code").val();
            const description = $("#new_subject_description").val();
            const units = $("#new_subject_units").val();

            if (parseInt(units) > 0) {
                $("#new_subject_submit").text("Please wait...");
                $("#new_subject_submit").attr("disabled", true);

                var formData = new FormData();

                formData.append('code', code);
                formData.append('description', description);
                formData.append('units', units);

                formData.append('new_subject', true);

                $.ajax({
                    url: 'server.php',
                    data: formData,
                    type: 'POST',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        location.href = base_url + "subjects";
                    },
                    error: function(_, _, error) {
                        console.error(error);
                    }
                });
            } else {
                $("#error_new_subject_units").removeClass("d-none");
                $("#new_subject_units").addClass("is-invalid");
            }
        })

        $("#new_course_form").submit(function() {
            const code = $("#new_course_code").val();
            const name = $("#new_course_name").val();
            const duration = $("#new_course_duration").val();

            if (parseInt(duration) > 0) {
                $("#new_course_submit").text("Please wait...");
                $("#new_course_submit").attr("disabled", true);

                var formData = new FormData();

                formData.append('code', code);
                formData.append('name', name);
                formData.append('duration', duration);

                formData.append('new_course', true);

                $.ajax({
                    url: 'server.php',
                    data: formData,
                    type: 'POST',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        location.href = base_url + "courses";
                    },
                    error: function(_, _, error) {
                        console.error(error);
                    }
                });
            } else {
                $("#error_new_course_duration").removeClass("d-none");
                $("#new_course_duration").addClass("is-invalid");
            }
        })

        $("#new_course_duration").keydown(function() {
            $("#error_new_course_duration").addClass("d-none");
            $("#new_course_duration").removeClass("is-invalid");
        })

        $(document).on("click", ".edit_course", function() {
            const id = $(this).attr("course_id");
            const code = $(this).attr("course_code");
            const name = $(this).attr("course_name");
            const duration = $(this).attr("course_duration");

            $("#edit_course_id").val(id);
            $("#edit_course_code").val(code);
            $("#edit_course_name").val(name);
            $("#edit_course_duration").val(duration);

            $("#edit_course_modal").modal("show");
        })

        $("#edit_course_form").submit(function() {
            const id = $("#edit_course_id").val();
            const code = $("#edit_course_code").val();
            const name = $("#edit_course_name").val();
            const duration = $("#edit_course_duration").val();

            if (parseInt(duration) > 0) {
                $("#edit_course_submit").text("Please wait...");
                $("#edit_course_submit").attr("disabled", true);

                var formData = new FormData();

                formData.append('id', id);
                formData.append('code', code);
                formData.append('name', name);
                formData.append('duration', duration);

                formData.append('edit_course', true);

                $.ajax({
                    url: 'server.php',
                    data: formData,
                    type: 'POST',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        location.href = base_url + "courses";
                    },
                    error: function(_, _, error) {
                        console.error(error);
                    }
                });
            } else {
                $("#error_edit_course_duration").removeClass("d-none");
                $("#edit_course_duration").addClass("is-invalid");
            }
        })

        $("#edit_course_duration").keydown(function() {
            $("#error_edit_course_duration").addClass("d-none");
            $("#edit_course_duration").removeClass("is-invalid");
        })

        $(document).on("click", ".delete_course", function() {
            const id = $(this).attr("course_id");

            $("#delete_course_id").val(id);

            $("#delete_course_modal").modal("show");
        })

        $("#delete_course_submit").click(function() {
            const id = $("#delete_course_id").val();

            $(this).text("Please wait...");
            $(this).attr("disabled", true);

            var formData = new FormData();

            formData.append('id', id);

            formData.append('delete_course', true);

            $.ajax({
                url: 'server.php',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    location.href = base_url + "courses";
                },
                error: function(_, _, error) {
                    console.error(error);
                }
            });
        })

        $("#delete_subject_submit").click(function() {
            const id = $("#delete_subject_id").val();

            $(this).text("Please wait...");
            $(this).attr("disabled", true);

            var formData = new FormData();

            formData.append('id', id);

            formData.append('delete_subject', true);

            $.ajax({
                url: 'server.php',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    location.href = base_url + "subjects";
                },
                error: function(_, _, error) {
                    console.error(error);
                }
            });
        })

        $(document).on("click", ".delete_subject", function() {
            const id = $(this).attr("subject_id");

            $("#delete_subject_id").val(id);

            $("#delete_subject_modal").modal("show");
        })

        $(document).on("click", ".edit_subject", function() {
            const id = $(this).attr("subject_id");
            const code = $(this).attr("subject_code");
            const description = $(this).attr("subject_description");
            const units = $(this).attr("subject_units");

            $("#edit_subject_id").val(id);
            $("#edit_subject_code").val(code);
            $("#edit_subject_description").val(description);
            $("#edit_subject_units").val(units);

            $("#edit_subject_modal").modal("show");
        })

        $("#edit_subject_form").submit(function() {
            const id = $("#edit_subject_id").val();
            const code = $("#edit_subject_code").val();
            const description = $("#edit_subject_description").val();
            const units = $("#edit_subject_units").val();

            if (parseInt(units) > 0) {
                $("#edit_subject_submit").text("Please wait...");
                $("#edit_subject_submit").attr("disabled", true);

                var formData = new FormData();

                formData.append('id', id);
                formData.append('code', code);
                formData.append('description', description);
                formData.append('units', units);

                formData.append('edit_subject', true);

                $.ajax({
                    url: 'server.php',
                    data: formData,
                    type: 'POST',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        location.href = base_url + "subjects";
                    },
                    error: function(_, _, error) {
                        console.error(error);
                    }
                });
            } else {
                $("#error_edit_subject_units").removeClass("d-none");
                $("#edit_subject_units").addClass("is-invalid");
            }
        })

        $("#new_subject_units").keydown(function() {
            $("#error_new_subject_units").addClass("d-none");
            $("#new_subject_units").removeClass("is-invalid");
        })

        $("#edit_subject_units").keydown(function() {
            $("#error_edit_subject_units").addClass("d-none");
            $("#edit_subject_units").removeClass("is-invalid");
        })

        $("#new_student_form").submit(function() {
            const student_number = $("#new_student_student_number").val();
            const email = $("#new_student_email").val();
            const first_name = $("#new_student_first_name").val();
            const middle_name = $("#new_student_middle_name").val();
            const last_name = $("#new_student_last_name").val();
            const course = $("#new_student_course").val();
            const year = $("#new_student_year").val();
            const section = $("#new_student_section").val();
            const birthday = $("#new_student_birthday").val();
            const sex = $("#new_student_sex").val();
            const mobile_number = $("#new_student_mobile_number").val();
            const address = $("#new_student_address").val();

            $("#new_student_submit").text("Please wait...");
            $("#new_student_submit").attr("disabled", true);

            var formData = new FormData();

            formData.append('student_number', student_number);
            formData.append('email', email);
            formData.append('first_name', first_name);
            formData.append('middle_name', middle_name);
            formData.append('last_name', last_name);
            formData.append('course', course);
            formData.append('year', year);
            formData.append('section', section);
            formData.append('birthday', birthday);
            formData.append('sex', sex);
            formData.append('mobile_number', mobile_number);
            formData.append('address', address);

            formData.append('new_student', true);

            $.ajax({
                url: 'server.php',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response) {
                        location.href = base_url + "students";
                    } else {
                        $("#new_student_student_number").addClass("is-invalid");
                        $("#error_new_student_student_number").removeClass("d-none");

                        $("#new_student_submit").text("Submit");
                        $("#new_student_submit").removeAttr("disabled");
                    }
                },
                error: function(_, _, error) {
                    console.error(error);
                }
            });
        })

        $("#new_student_student_number").keydown(function() {
            $("#new_student_student_number").removeClass("is-invalid");
            $("#error_new_student_student_number").addClass("d-none");
        })

        $(document).on("click", ".delete_student", function() {
            const id = $(this).attr("student_id");

            $("#delete_student_id").val(id);

            $("#delete_student_modal").modal("show");
        })

        $(document).on("click", ".edit_student", function() {
            const id = $(this).attr("student_id");

            $("#edit_student_id").val(id);

            var formData = new FormData();

            formData.append('id', id);

            formData.append('get_student_data', true);

            $.ajax({
                url: 'server.php',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    $("#edit_student_old_student_number").val(response.student_number);
                    $("#edit_student_student_number").val(response.student_number);
                    $("#edit_student_email").val(response.email);
                    $("#edit_student_first_name").val(response.first_name);
                    $("#edit_student_middle_name").val(response.middle_name);
                    $("#edit_student_last_name").val(response.last_name);
                    $("#edit_student_course").val(response.course);
                    $("#edit_student_year").val(response.year);
                    $("#edit_student_section").val(response.section);
                    $("#edit_student_birthday").val(response.birthday);
                    $("#edit_student_sex").val(response.sex);
                    $("#edit_student_mobile_number").val(response.mobile_number);
                    $("#edit_student_address").val(response.address);

                    $("#edit_student_modal").modal("show");
                },
                error: function(_, _, error) {
                    console.error(error);
                }
            });
        })

        $("#delete_student_submit").click(function() {
            const id = $("#delete_student_id").val();

            var formData = new FormData();

            formData.append('id', id);

            formData.append('delete_student', true);

            $.ajax({
                url: 'server.php',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    location.href = base_url + "students";
                },
                error: function(_, _, error) {
                    console.error(error);
                }
            });
        })

        $("#edit_student_form").submit(function() {
            const student_number = $("#edit_student_student_number").val();
            const email = $("#edit_student_email").val();
            const first_name = $("#edit_student_first_name").val();
            const middle_name = $("#edit_student_middle_name").val();
            const last_name = $("#edit_student_last_name").val();
            const course = $("#edit_student_course").val();
            const year = $("#edit_student_year").val();
            const section = $("#edit_student_section").val();
            const birthday = $("#edit_student_birthday").val();
            const sex = $("#edit_student_sex").val();
            const mobile_number = $("#edit_student_mobile_number").val();
            const address = $("#edit_student_address").val();
            const old_student_number = $("#edit_student_old_student_number").val();
            const id = $("#edit_student_id").val();

            $("#edit_student_submit").text("Please wait...");
            $("#edit_student_submit").attr("disabled", true);

            var formData = new FormData();

            formData.append('student_number', student_number);
            formData.append('email', email);
            formData.append('first_name', first_name);
            formData.append('middle_name', middle_name);
            formData.append('last_name', last_name);
            formData.append('course', course);
            formData.append('year', year);
            formData.append('section', section);
            formData.append('birthday', birthday);
            formData.append('sex', sex);
            formData.append('mobile_number', mobile_number);
            formData.append('address', address);
            formData.append('old_student_number', old_student_number);
            formData.append('id', id);

            formData.append('edit_student', true);

            $.ajax({
                url: 'server.php',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response) {
                        location.href = base_url + "students";
                    } else {
                        $("#edit_student_student_number").addClass("is-invalid");
                        $("#error_edit_student_student_number").removeClass("d-none");

                        $("#edit_student_submit").text("Submit");
                        $("#edit_student_submit").removeAttr("disabled");
                    }
                },
                error: function(_, _, error) {
                    console.error(error);
                }
            });
        })

        $("#edit_student_student_number").keydown(function() {
            $("#edit_student_student_number").removeClass("is-invalid");
            $("#error_edit_student_student_number").addClass("d-none");
        })

        $("#account_settings").click(function() {
            const id = $(this).attr("user_id");
            const name = $(this).attr("user_name");
            const username = $(this).attr("user_username");
            const password = $(this).attr("user_password");

            $("#account_settings_name").val(name);
            $("#account_settings_username").val(username);
            $("#account_settings_old_password").val(password);
            $("#account_settings_id").val(id);

            $("#account_settings_modal").modal("show");
        })

        $("#account_settings_form").submit(function() {
            const id = $("#account_settings_id").val();
            const name = $("#account_settings_name").val();
            const username = $("#account_settings_username").val();
            const password = $("#account_settings_password").val();
            const confirm_password = $("#account_settings_confirm_password").val();
            const old_password = $("#account_settings_old_password").val();

            if ((password || confirm_password) && (password != confirm_password)) {
                $("#account_settings_password").addClass("is-invalid");
                $("#account_settings_confirm_password").addClass("is-invalid");
                $("#error_account_settings_password").removeClass("d-none");
            } else {
                $("#account_settings_submit").text("Please wait...");
                $("#account_settings_submit").attr("disabled", true);

                var formData = new FormData();

                formData.append('id', id);
                formData.append('name', name);
                formData.append('username', username);
                formData.append('password', password);
                formData.append('old_password', old_password);

                formData.append('account_settings', true);

                $.ajax({
                    url: 'server.php',
                    data: formData,
                    type: 'POST',
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        location.href = location.href;
                    },
                    error: function(_, _, error) {
                        console.error(error);
                    }
                });
            }
        })

        $("#account_settings_password").keydown(function() {
            $("#account_settings_password").removeClass("is-invalid");
            $("#account_settings_confirm_password").removeClass("is-invalid");
            $("#error_account_settings_password").addClass("d-none");
        })

        $("#account_settings_confirm_password").keydown(function() {
            $("#account_settings_password").removeClass("is-invalid");
            $("#account_settings_confirm_password").removeClass("is-invalid");
            $("#error_account_settings_password").addClass("d-none");
        })

        $("#enroll_student_form").submit(function() {
            const student_id = $("#enroll_student_student_id").val();
            const course_id = $("#enroll_student_course_id").val();
            const subjects_id = $("#enroll_student_subjects_id").val();

            $("#enroll_student_submit").text("Please wait...");
            $("#enroll_student_submit").attr("disabled", true);

            var formData = new FormData();

            formData.append('student_id', student_id);
            formData.append('course_id', course_id);
            formData.append('subjects_id', subjects_id);

            formData.append('enroll_student', true);

            $.ajax({
                url: 'server.php',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(response) {
                    location.href = base_url + "transaction";
                },
                error: function(_, _, error) {
                    console.error(error);
                }
            });
        })

        $(".user_confirmation").click(function() {
            const id = $(this).attr("user_id");
            const response = $(this).attr("response");

            let user_account_message = "";
            let btn_submit_text = "";

            if (response == "confirm") {
                user_account_message = "Are you sure you want to CONFIRM this user?";
                btn_submit_text = "Yes, confirm it!";
            } else {
                user_account_message = "Are you sure you want to REJECT this user?";
                btn_submit_text = "Yes, reject it!";
            }

            $("#user_confirmation_message").text(user_account_message);
            $("#user_confirmation_submit").text(btn_submit_text);

            $("#user_confirmation_id").val(id);
            $("#user_confirmation_response").val(response);

            $("#user_confirmation_modal").modal("show");
        })

        $("#user_confirmation_submit").click(function() {
            const id = $("#user_confirmation_id").val();
            const response = $("#user_confirmation_response").val();

            let is_confirmed = response == "confirm" ? 1 : 0;

            $("#user_confirmation_submit").text("Please wait...");
            $("#user_confirmation_submit").attr("disabled", true);

            var formData = new FormData();
            
            formData.append('id', id);
            formData.append('is_confirmed', is_confirmed);

            formData.append('user_confirmation', true);
            
            $.ajax({
                url: 'server.php',
                data: formData,
                type: 'POST',
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function(promise) {
                    location.href = base_url + "users";
                },
                error: function(_, _, error) {
                    console.error(error);
                }
            });
        })

        function display_alert(notification) {
            const icon = notification.icon == "success" ? "fas fa-check-circle text-success mb-4" : "fas fa-times-circle text-danger mb-4";

            $("#alert_icon").attr("class", icon);
            $("#alert_title").text(notification.title);
            $("#alert_message").text(notification.text);

            $("#alert_modal").modal("show");
        }
    })
</script>
</body>

</html>

<?php unset($_SESSION["notification"]) ?>