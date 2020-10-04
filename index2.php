<?php
require_once 'inc/header.php';
require_once 'lib/Database.php';
require_once 'lib/Student.php';
?>

<?php
$stu = new Student();
$cur_date = date('d(D)-m(M)-Y h:i:s a');
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h2>
            <a class="btn btn-success" href="add.php">Add Student</a>
            <a class="btn btn-info pull-right" href="">View All</a>
        </h2>
    </div>

    <div class="panel-body">
        <div class="well text-center" style="font-size: 20px;">
            <strong>Date : </strong><?= $cur_date; ?>
        </div>
        <form action="" method="post">
            <table class="table table-striped bg-success">
                <tr>
                    <th class="text-center" width="8%">Serial</th>
                    <th class="text-center" width="30%">Student Name</th>
                    <th class="text-center" width="10%">Student Roll</th>
                    <th class="text-center" width="15%">Attend Taken</th>
                    <th class="text-center" width="15%">Attendance</th>
                    <th class="text-center" width="15%">Attend Time</th>
                </tr>

                <?php
                $link = new mysqli('localhost', 'root', '', 'student_or_employee_attendance_management_system');
                $query = "select * 
                          from tbl_student
                          inner join tbl_attendance
                          on 
                            tbl_student.roll = tbl_attendance.roll";
                $get_student = mysqli_query($link, $query);

                if ($get_student){
                    $i = 0;
                    while ($value = mysqli_fetch_assoc($get_student)){
                        $i++;?>


                <tr class="text-center">
                    <td><?= $i; ?></td>
                    <td><?= ucwords($value['name']); ?></td>
                    <td><?= $value['roll']; ?></td>
                    <td>
                        <input type="radio" name="attend[<?= $value['roll']; ?>]" value="present"> P |
                        <input type="radio" name="attend[<?= $value['roll']; ?>]" value="absent"> A
                    </td>
                    <td><?= ucwords($value['attend']); ?></td>
                    <td><?= date('d-m-Y', strtotime($value['attend_time'])); ?></td>
                </tr>
                        <?php }} ?>
                <tr>
                    <td colspan="">
                        <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php require_once 'inc/footer.php';
