<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

date_default_timezone_set('Asia/Manila');

$current_date = date('Y-m-d H:i:s');

require_once "model.php";

$model = new Model();

if (isset($_POST["login_admin"])) {
    $response = false;

    $username = $_POST["username"];
    $password = $_POST["password"];
    $remember_me = $_POST["remember_me"];

    $user = $model->MOD_GET_USER_DATA_BY_USERNAME($username);

    if ($user) {
        $db_password = $user["password"];

        if (password_verify($password, $db_password)) {
            $db_is_confirmed = $user["is_confirmed"];

            if ($db_is_confirmed == "1") {
                $_SESSION["user_id"] = $user["id"];

                if ($remember_me == "true") {
                    $_SESSION["remember_me_username"] = $username;
                    $_SESSION["remember_me_password"] = $password;
                    $_SESSION["remember_me"] = true;
                } else {
                    unset($_SESSION["remember_me_username"]);
                    unset($_SESSION["remember_me_password"]);
                    unset($_SESSION["remember_me"]);
                }

                $_SESSION["notification"] = array(
                    "title" => "Success!",
                    "text" => "Welcome, " . $user["name"] . "!",
                    "icon" => "success"
                );

                $response = true;
            } else {
                $_SESSION["notification"] = array(
                    "title" => "Oops..",
                    "text" => "This account needs to be confirmed first",
                    "icon" => "error"
                );
            }
        } else {
            $_SESSION["notification"] = array(
                "title" => "Oops..",
                "text" => "Invalid Username or Password",
                "icon" => "error"
            );
        }
    } else {
        $_SESSION["notification"] = array(
            "title" => "Oops..",
            "text" => "Invalid Username or Password",
            "icon" => "error"
        );
    }

    echo json_encode($response);
}

if (isset($_POST["new_course"])) {
    $code = $_POST["code"];
    $name = $_POST["name"];
    $duration = $_POST["duration"];

    $data = array(
        "created_at" => $current_date,
        "code" => $code,
        "name" => $name,
        "duration" => $duration,
    );

    $model->MOD_NEW_COURSE($data);

    $_SESSION["notification"] = array(
        "title" => "Success!",
        "text" => "New Course has been added to database.",
        "icon" => "success"
    );

    echo json_encode(true);
}

if (isset($_POST["edit_course"])) {
    $id = $_POST["id"];
    $code = $_POST["code"];
    $name = $_POST["name"];
    $duration = $_POST["duration"];

    $data = array(
        "created_at" => $current_date,
        "code" => $code,
        "name" => $name,
        "duration" => $duration,
    );

    $model->MOD_EDIT_COURSE($data, $id);

    $_SESSION["notification"] = array(
        "title" => "Success!",
        "text" => "A Course has been updated.",
        "icon" => "success"
    );

    echo json_encode(true);
}

if (isset($_POST["delete_course"])) {
    $id = $_POST["id"];

    $model->MOD_DELETE_COURSE($id);

    $_SESSION["notification"] = array(
        "title" => "Success!",
        "text" => "A course has been deleted from the database.",
        "icon" => "success"
    );

    echo json_encode(true);
}

if (isset($_POST["delete_subject"])) {
    $id = $_POST["id"];

    $model->MOD_DELETE_SUBJECT($id);

    $_SESSION["notification"] = array(
        "title" => "Success!",
        "text" => "A course has been deleted from the database.",
        "icon" => "success"
    );

    echo json_encode(true);
}

if (isset($_POST["new_subject"])) {
    $code = $_POST["code"];
    $description = $_POST["description"];
    $units = $_POST["units"];

    $data = array(
        "created_at" => $current_date,
        "code" => $code,
        "description" => $description,
        "units" => $units,
    );

    $model->MOD_NEW_SUBJECT($data);

    $_SESSION["notification"] = array(
        "title" => "Success!",
        "text" => "New Subject has been added to database.",
        "icon" => "success"
    );

    echo json_encode(true);
}

if (isset($_POST["edit_subject"])) {
    $id = $_POST["id"];
    $code = $_POST["code"];
    $description = $_POST["description"];
    $units = $_POST["units"];

    $data = array(
        "created_at" => $current_date,
        "code" => $code,
        "description" => $description,
        "units" => $units,
    );

    $model->MOD_EDIT_SUBJECT($data, $id);

    $_SESSION["notification"] = array(
        "title" => "Success!",
        "text" => "A Subject has been updated.",
        "icon" => "success"
    );

    echo json_encode(true);
}

if (isset($_POST["new_student"])) {
    $response = false;

    $student_number = $_POST["student_number"];
    $email = $_POST["email"];
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $last_name = $_POST["last_name"];
    $course = $_POST["course"];
    $year = $_POST["year"];
    $section = $_POST["section"];
    $birthday = $_POST["birthday"];
    $sex = $_POST["sex"];
    $mobile_number = $_POST["mobile_number"];
    $address = $_POST["address"];

    $student_number_exists = $model->MOD_GET_STUDENT_DATA_BY_STUDENT_NUMBER($student_number);

    if (!$student_number_exists) {
        $data = array(
            "created_at" => $current_date,
            "student_number" => $student_number,
            "email" => $email,
            "first_name" => $first_name,
            "middle_name" => $middle_name,
            "last_name" => $last_name,
            "course" => $course,
            "year" => $year,
            "section" => $section,
            "birthday" => $birthday,
            "sex" => $sex,
            "mobile_number" => $mobile_number,
            "address" => $address,
        );

        $model->MOD_NEW_STUDENT($data);

        $_SESSION["notification"] = array(
            "title" => "Success!",
            "text" => "A student has been added to the database.",
            "icon" => "success"
        );

        $response = true;
    }

    echo json_encode($response);
}

if (isset($_POST["edit_student"])) {
    $response = false;

    $student_number = $_POST["student_number"];
    $email = $_POST["email"];
    $first_name = $_POST["first_name"];
    $middle_name = $_POST["middle_name"];
    $last_name = $_POST["last_name"];
    $course = $_POST["course"];
    $year = $_POST["year"];
    $section = $_POST["section"];
    $birthday = $_POST["birthday"];
    $sex = $_POST["sex"];
    $mobile_number = $_POST["mobile_number"];
    $address = $_POST["address"];

    $id = $_POST["id"];
    $old_student_number = $_POST["old_student_number"];

    $student_number_exists = $model->MOD_GET_STUDENT_DATA_BY_STUDENT_NUMBER($student_number);

    if (!($student_number_exists && $student_number != $old_student_number)) {
        $data = array(
            "created_at" => $current_date,
            "student_number" => $student_number,
            "email" => $email,
            "first_name" => $first_name,
            "middle_name" => $middle_name,
            "last_name" => $last_name,
            "course" => $course,
            "year" => $year,
            "section" => $section,
            "birthday" => $birthday,
            "sex" => $sex,
            "mobile_number" => $mobile_number,
            "address" => $address,
        );

        $model->MOD_EDIT_STUDENT($data, $id);

        $_SESSION["notification"] = array(
            "title" => "Success!",
            "text" => "A student has been updated.",
            "icon" => "success"
        );

        $response = true;
    }

    echo json_encode($response);
}

if (isset($_POST["delete_student"])) {
    $id = $_POST["id"];

    $model->MOD_DELETE_STUDENT($id);

    $_SESSION["notification"] = array(
        "title" => "Success!",
        "text" => "A student has been deleted from the database.",
        "icon" => "success"
    );

    echo json_encode(true);
}

if (isset($_POST["get_student_data"])) {
    $id = $_POST["id"];

    $student = $model->MOD_GET_STUDENT_DATA_BY_ID($id);

    echo json_encode($student);
}

if (isset($_POST["account_settings"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"] ? password_hash($_POST["password"], PASSWORD_BCRYPT) : $_POST["old_password"];

    $data = array(
        "created_at" => $current_date,
        "name" => $name,
        "username" => $username,
        "password" => $password,
    );

    $model->MOD_ACCOUNT_SETTINGS($data, $id);

    $_SESSION["notification"] = array(
        "title" => "Success!",
        "text" => "Account has been updated.",
        "icon" => "success"
    );

    echo json_encode(true);
}

if (isset($_POST["enroll_student"])) {
    $student_id = $_POST["student_id"];
    $course_id = $_POST["course_id"];
    $subjects_id = $_POST["subjects_id"];

    $enrolled_students_data = array(
        "created_at" => $current_date,
        "student_id" => $student_id,
        "course_id" => $course_id,
        "subjects_id" => $subjects_id,
        "status" => "active",
    );

    $students_data = array(
        "is_enrolled" => 1,
    );

    $model->MOD_ENROLL_STUDENT($enrolled_students_data);
    $model->MOD_UPDATE_ENROLLED_STATUS($students_data, $student_id);

    $_SESSION["notification"] = array(
        "title" => "Success!",
        "text" => "A student has been enrolled.",
        "icon" => "success"
    );

    echo json_encode(true);
}

if (isset($_POST["register"])) {
    $response = false;

    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $username_exists = $model->MOD_GET_USER_DATA_BY_USERNAME($username);

    if (!$username_exists) {
        $data = array(
            "created_at" => $current_date,
            "name" => $name,
            "username" => $username,
            "password" => password_hash($password, PASSWORD_BCRYPT),
            "user_type" => "user",
        );

        $model->MOD_REGISTER($data);

        $_SESSION["notification"] = array(
            "title" => "Success!",
            "text" => "Your account has been registered. Please wait for the Administrator to confirm it before you can start using it.",
            "icon" => "success"
        );

        $response = true;
    }

    echo json_encode($response);
}

if (isset($_POST["user_confirmation"])) {
    $id = $_POST["id"];
    $is_confirmed = $_POST["is_confirmed"];

    $response = $is_confirmed == 1 ? "confirmed" : "rejected";

    $data = array(
        "is_confirmed" => $is_confirmed,
    );

    if ($is_confirmed == 1) {
        $model->MOD_USER_CONFIRMATION($data, $id);
    }
    else{
        $model->MOD_DELETE_USER($id);
    }

    $_SESSION["notification"] = array(
        "title" => "Success!",
        "text" => "A user account has been " . $response . ".",
        "icon" => "success"
    );

    echo json_encode(true);
}

if (isset($_POST["logout"])) {
    unset($_SESSION["user_id"]);

    $_SESSION["notification"] = array(
        "title" => "Success!",
        "text" => "You had been signed out",
        "icon" => "success"
    );

    echo json_encode(true);
}
