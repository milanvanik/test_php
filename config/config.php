<?php
class config
{
    private $HOST = "localhost";
    private $USERNAME = "root";
    private $PASSWORD = "";
    private $DB_NAME = "try_php";

    private $conn;
    private $STUDENT_TABLE = "students";
    private $DEPARTMENT_TABLE = "departments";
    private $MEMBER_TABLE = "members";

    public function connectDB()
    {
        $this->conn = mysqli_connect($this->HOST, $this->USERNAME, $this->PASSWORD, $this->DB_NAME);
        return $this->conn;
    }

    public function insertStudents($name, $age, $course)
    {
        $this->connectDB();
        $query = "INSERT INTO $this->STUDENT_TABLE(name, age, course) VALUES ('$name', $age, '$course')";
        return mysqli_query($this->conn, $query);
    }

    public function fetchStudents()
    {
        $this->connectDB();
        $query = "SELECT * FROM $this->STUDENT_TABLE";
        return mysqli_query($this->conn, $query);
    }

    public function fetchSingleStudent($id)
    {
        $this->connectDB();
        $query = "SELECT * FROM $this->STUDENT_TABLE WHERE id=$id";
        return mysqli_query($this->conn, $query);
    }

    public function deleteStudent($id)
    {
        $this->connectDB();
        $result = $this->fetchSingleStudent($id);
        $single_student = mysqli_fetch_array($result);
        if ($single_student) {
            $query = "DELETE FROM $this->STUDENT_TABLE WHERE id=$id";
            return mysqli_query($this->conn, $query);
        } else {
            return false;
        }
    }

    public function updateStudent($name, $age, $course, $id)
    {
        $this->connectDB();

        $result = $this->fetchSingleStudent($id);

        $single_student = mysqli_fetch_assoc($result);

        if ($single_student) {
            $query = "UPDATE $this->STUDENT_TABLE SET name='$name', age=$age, course='$course' WHERE id=$id";
            return mysqli_query($this->conn, $query);
        } else {
            return false;
        }
    }

    public function insertDepartment($name)
    {
        $this->connectDB();
        $query = "INSERT INTO $this->DEPARTMENT_TABLE (dept_name) VALUES ('$name')";
        return mysqli_query($this->conn, $query);
    }

    public function insertMember($name, $id)
    {
        $this->connectDB();
        $query = "INSERT INTO $this->MEMBER_TABLE(member_name, dept_id) VALUES ('$name', $id)";
        return mysqli_query($this->conn, $query);
    }
}
?>