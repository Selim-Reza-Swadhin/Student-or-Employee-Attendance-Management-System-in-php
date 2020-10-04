<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/Database.php');
?>

<?php

class Student
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getStudents()
    {
        $query = "SELECT * FROM tbl_student";
        $result = $this->db->select($query);
        return $result;
    }

    public function insertStudents($name, $roll)
    {
        $name = mysqli_real_escape_string($this->db->link, $name);
        $roll = mysqli_real_escape_string($this->db->link, $roll);
        if (empty($name) || empty($roll)) {
            $msg = "<div class='alert alert-danger'><strong> Error !</strong> Field must not be empty.</div>";
            return $msg;
        } else {
            //primary key table
            $stu_query = "INSERT INTO tbl_student(name, roll) VALUES ('$name', '$roll')";
            $stu_insert = $this->db->insert($stu_query);

            //foreign key table
            $att_query = "INSERT INTO tbl_attendance(roll) VALUES ('$roll')";
            $att_insert = $this->db->insert($att_query);

            if ($stu_query) {
                $msg = "<div class='alert alert-success'><strong> Success !</strong> Data inserted successfully.</div>";
                return $msg;
            } else {
                $msg = "<div class='alert alert-danger'><strong> Error !</strong> Data inserted not successfully.</div>";
                return $msg;
            }
        }
    }


    public function insertAttendance($cur_date, $attend = array())
    {
        $query = "select distinct attend_time from tbl_attendance";
        $getdata = $this->db->select($query);
        while ($result = $getdata->fetch_assoc()) {
            $db_date = $result['attend_time'];
            if ($cur_date == $db_date) {
                $attend_msg = "<div class='alert alert-danger'><strong> Error !</strong> Attendance already taken today !</div>";
                return $attend_msg;
            }
        }

        foreach ($attend as $atn_key => $atn_value) {
            /* <input type="radio" name="attend[<?= $value['roll']; ?>]" value="present">*/
            //key->roll value="present"
            if (!empty($atn_value == "present")) {
                $stu_query = "insert into tbl_attendance(roll, attend, attend_time) values ('$atn_key', 'present', NOW())";
                $data_insert = $this->db->insert($stu_query);

            } elseif (!empty($atn_value == "absent")) {
                $stu_query = "insert into tbl_attendance(roll, attend, attend_time) values ('$atn_key', 'absent', NOW())";
                $data_insert = $this->db->insert($stu_query);
            }
        }

        if (isset($data_insert)) {
            $attend_msg = "<div class='alert alert-success'><strong> Success !</strong> Attendance inserted successfully.</div>";
            return $attend_msg;
        } else {
            $attend_msg = "<div class='alert alert-danger'><strong> Error !</strong> Attendance inserted not successfully.</div>";
            return $attend_msg;
        }

    }

    public function getDateList()
    {
        $query = "select distinct attend_time from tbl_attendance order by id desc";
        $getdata = $this->db->select($query);
        return $getdata;
    }


//    inner join table function
    public function getAllData($get_date)
    {
        $query = "select tbl_student.name, tbl_attendance.*
                  from tbl_student
                  inner join tbl_attendance
                  on 
                  tbl_student.roll = tbl_attendance.roll
                  where attend_time = '$get_date'   
                  ";
        $getdata = $this->db->select($query);
        return $getdata;
    }

    public function updateAttendance($get_date, $attend = array())
    {

        foreach ($attend as $atn_key => $atn_value) {
            /* <input type="radio" name="attend[<?= $value['roll']; ?>]" value="present">*/
            //key->roll value="present"
            if ($atn_value == "present") {
                $query = "update tbl_attendance
                          set attend = 'present'
                          where roll= '" . $atn_key . "' and attend_time='" . $get_date . "'
                          ";
                $update_data = $this->db->update($query);

            } elseif ($atn_value == "absent") {
                $query = "update tbl_attendance
                          set attend = 'absent'
                          where roll= '" . $atn_key . "' and attend_time='" . $get_date . "'
                          ";
                $update_data = $this->db->update($query);
            }
        }

        if (isset($update_data)) {
            $attend_msg = "<div class='alert alert-success'><strong> Success !</strong> Attendance data updated inserted successfully.</div>";
            return $attend_msg;
        } else {
            $attend_msg = "<div class='alert alert-danger'><strong> Error !</strong> Attendance data not updated inserted successfully.</div>";
            return $attend_msg;
        }
    }

}