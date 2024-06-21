<?php

class Model
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "oes";
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        $this->initialize_database();
    }

    public function __destruct()
    {
        $this->conn->close();
    }

    private function query($sql)
    {
        $result = $this->conn->query($sql);

        return $result;
    }
    public function performQuery($sql)
    {
        return $this->query($sql);
    }

    private function fetch($sql)
    {
        $result = $this->query($sql);

        $row = $result->fetch_assoc();

        return $row;
    }

    private function fetchAll($sql)
    {
        $result = $this->query($sql);

        $rows = array();

        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows;
    }

    private function insert($table, $data)
    {
        $fields = implode(", ", array_keys($data));

        $values = implode("', '", array_map(array($this, 'escapeString'), array_values($data)));

        $sql = "INSERT INTO $table ($fields) VALUES ('$values')";

        return $this->query($sql);
    }

    private function update($table, $data, $where)
    {
        $setValues = '';

        foreach ($data as $key => $value) {
            $setValues .= "$key = '" . $this->escapeString($value) . "', ";
        }

        $setValues = rtrim($setValues, ', ');

        $sql = "UPDATE $table SET $setValues WHERE $where";

        return $this->query($sql);
    }

    private function delete($table, $where)
    {
        $sql = "DELETE FROM $table WHERE $where";

        return $this->query($sql);
    }

    private function escapeString($string)
    {
        return $this->conn->real_escape_string($string);
    }

    public function initialize_database()
    {
        $sql = "CREATE DATABASE IF NOT EXISTS {$this->database}";

        if (!$this->conn->query($sql)) {
            die("Database creation failed: " . $this->conn->error);
        }

        $this->conn->select_db($this->database);

        $this->create_users_table();
        $this->create_courses_table();
        $this->create_subjects_table();
        $this->create_students_table();
        $this->create_enrolled_students_table();
        $this->insert_admin_data();
    }

    private function create_students_table()
    {
        $table = "
            CREATE TABLE IF NOT EXISTS `students` (
                `id` int(11) auto_increment primary key,
                `created_at` varchar(19) NOT NULL,
                `login_id` int(11) NOT NULL,
                `student_number` varchar(30) NOT NULL,
                `first_name` varchar(30) NOT NULL,
                `middle_name` varchar(30) NOT NULL,
                `last_name` varchar(30) NOT NULL,
                `sex` varchar(10) NOT NULL,
                `birthday` varchar(10) NOT NULL,
                `email` varchar(30) NOT NULL,
                `mobile_number` varchar(11) NOT NULL,
                `address` text NOT NULL,
                `course` varchar(30) NOT NULL,
                `year` varchar(10) NOT NULL,
                `section` varchar(10) NOT NULL,
                `is_enrolled` int(11) NOT NULL
            )
        ";

        if (!$this->conn->query($table)) {
            die("Table creation failed: " . $this->conn->error);
        }
    }

    private function create_courses_table()
    {
        $table = "
            CREATE TABLE IF NOT EXISTS `courses` (
                `id` int(11) auto_increment primary key,
                `created_at` varchar(19) NOT NULL,
                `code` varchar(30) NOT NULL,
                `name` varchar(100) NOT NULL,
                `duration` int(11) NOT NULL
            )
        ";

        if (!$this->conn->query($table)) {
            die("Table creation failed: " . $this->conn->error);
        }
    }

    private function create_subjects_table()
    {
        $table = "
            CREATE TABLE IF NOT EXISTS `subjects` (
                `id` int(11) auto_increment primary key,
                `created_at` varchar(19) NOT NULL,
                `code` varchar(30) NOT NULL,
                `description` varchar(100) NOT NULL,
                `units` int(11) NOT NULL
            )
        ";

        if (!$this->conn->query($table)) {
            die("Table creation failed: " . $this->conn->error);
        }
    }

    private function create_users_table()
    {
        $table = "
            CREATE TABLE IF NOT EXISTS `users` (
                `id` int(11) auto_increment primary key,
                `created_at` varchar(19) NOT NULL,
                `name` varchar(30) NOT NULL,
                `username` varchar(30) NOT NULL,
                `password` varchar(255) NOT NULL,
                `user_type` varchar(10) NOT NULL,
                `is_confirmed` int(11) NOT NULL
            )
        ";

        if (!$this->conn->query($table)) {
            die("Table creation failed: " . $this->conn->error);
        }
    }

    private function create_enrolled_students_table()
    {
        $table = "
            CREATE TABLE IF NOT EXISTS `enrolled_students` (
                `id` int(11) auto_increment primary key,
                `created_at` varchar(19) NOT NULL,
                `student_id` int(11) NOT NULL,
                `course_id` int(11) NOT NULL,
                `subjects_id` varchar(255) NOT NULL,
                `status` varchar(11) NOT NULL
            )
        ";

        if (!$this->conn->query($table)) {
            die("Table creation failed: " . $this->conn->error);
        }
    }

    private function insert_admin_data()
    {
        $admin_check_sql = "SELECT COUNT(*) as count FROM `users` WHERE `id` = 1";
        $result = $this->query($admin_check_sql);
        $count = $result->fetch_assoc()['count'];

        if ($count == 0) {
            date_default_timezone_set('Asia/Manila');

            $current_date = date('Y-m-d H:i:s');

            $data = array(
                "created_at" => $current_date,
                "name" => "Administrator",
                "username" => "admin",
                "password" => password_hash("admin123", PASSWORD_BCRYPT),
                "user_type" => "super_admin",
            );

            $this->insert("users", $data);
        }
    }

    public function MOD_GET_USER_DATA_BY_USERNAME($username)
    {
        $sql = "SELECT * FROM `users` WHERE `username` = '" . $this->escapeString($username) . "'";

        return $this->fetch($sql);
    }

    public function MOD_GET_USER_DATA_BY_ID($user_id)
    {
        $sql = "SELECT * FROM `users` WHERE `id` = '" . $this->escapeString($user_id) . "'";

        return $this->fetch($sql);
    }

    public function MOD_GET_STUDENT_DATA_BY_ID($id)
    {
        $sql = "SELECT * FROM `students` WHERE `id` = '" . $this->escapeString($id) . "'";

        return $this->fetch($sql);
    }

    public function MOD_GET_STUDENT_DATA_BY_STUDENT_NUMBER($student_number)
    {
        $sql = "SELECT * FROM `students` WHERE `student_number` = '" . $this->escapeString($student_number) . "'";

        return $this->fetch($sql);
    }

    public function MOD_GET_USERS()
    {
        $sql = "SELECT * FROM `users` WHERE `is_confirmed` = '0' ORDER BY `id` DESC";

        return $this->fetchAll($sql);
    }
    
    public function MOD_GET_COURSES_DATA()
    {
        $sql = "SELECT * FROM `courses` ORDER BY `id` DESC";

        return $this->fetchAll($sql);
    }

    public function MOD_GET_SUBJECTS_DATA()
    {
        $sql = "SELECT * FROM `subjects` ORDER BY `id` DESC";

        return $this->fetchAll($sql);
    }

    public function MOD_GET_SUBJECTS_DATA_ORDER_BY_DESCRIPTION()
    {
        $sql = "SELECT * FROM `subjects` ORDER BY `description` ASC";

        return $this->fetchAll($sql);
    }

    public function MOD_GET_STUDENTS_DATA()
    {
        $sql = "SELECT * FROM `students` ORDER BY `id` DESC";

        return $this->fetchAll($sql);
    }

    public function MOD_GET_NON_ENROLLED_STUDENTS_DATA()
    {
        $sql = "SELECT * FROM `students` WHERE `is_enrolled` = '0' ORDER BY `first_name` ASC";

        return $this->fetchAll($sql);
    }

    public function MOD_NEW_COURSE($data)
    {
        $this->insert("courses", $data);
    }

    public function MOD_NEW_STUDENT($data)
    {
        $this->insert("students", $data);
    }

    public function MOD_NEW_SUBJECT($data)
    {
        $this->insert("subjects", $data);
    }
    
    public function MOD_REGISTER($data)
    {
        $this->insert("users", $data);
    }
    
    public function MOD_ENROLL_STUDENT($enrolled_students_data)
    {
        $this->insert("enrolled_students", $enrolled_students_data);
    }

    public function MOD_DELETE_COURSE($id)
    {
        $this->delete("courses", "id = '" . $id . "'");
    }

    public function MOD_DELETE_STUDENT($id)
    {
        $this->delete("students", "id = '" . $id . "'");
    }

    public function MOD_DELETE_SUBJECT($id)
    {
        $this->delete("subjects", "id = '" . $id . "'");
    }
    
    public function MOD_DELETE_USER($id)
    {
        $this->delete("users", "id = '" . $id . "'");
    }

    public function MOD_EDIT_COURSE($data, $id)
    {
        $this->update("courses", $data, "id = '" . $id . "'");
    }

    public function MOD_EDIT_SUBJECT($data, $id)
    {
        $this->update("subjects", $data, "id = '" . $id . "'");
    }

    public function MOD_EDIT_STUDENT($data, $id)
    {
        $this->update("students", $data, "id = '" . $id . "'");
    }

    public function MOD_ACCOUNT_SETTINGS($data, $id)
    {
        $this->update("users", $data, "id = '" . $id . "'");
    }
    
    public function MOD_UPDATE_ENROLLED_STATUS($students_data, $student_id)
    {
        $this->update("students", $students_data, "id = '" . $student_id . "'");
    }
    
    public function MOD_USER_CONFIRMATION($data, $id)
    {
        $this->update("users", $data, "id = '" . $id . "'");
    }

    public function MOD_GET_STUDENT_SUBJECT_REPORT()
{
    $sql = "
        SELECT 
            students.first_name AS student_name, 
            students.student_number, 
            students.course, 
            students.section, 
            subjects.code AS subject_code, 
            subjects.description, 
            subjects.units
        FROM 
            students
        INNER JOIN 
            enrolled_students ON students.id = enrolled_students.student_id
        INNER JOIN 
            subjects ON FIND_IN_SET(subjects.id, enrolled_students.subjects_id)
    ";

    return $this->fetchAll($sql);
}


}
