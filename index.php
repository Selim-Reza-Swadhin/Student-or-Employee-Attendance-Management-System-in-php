<?php
require_once 'inc/header.php';
require_once 'lib/Database.php';
require_once 'lib/Student.php';
?>

<script>
    // radio button or name=attend validation
    $(document).ready(function () {
        $("form").submit(function () {
            let roll = true;
            $(':radio').each(function (){
                name = $(this).attr('name');
                if (roll && !$(':radio[name="'+ name +'"]:checked').length){
                    //alert(name + ' Roll Missing !');
                    $('.alert').show();
                    roll = false;
                }
            });
            return roll;
        });
    });
</script>

<?php
error_reporting(0);//if any unexpected error, so use error_reporting(0)

$stu = new Student();
$cur_datee = date('d(D)-m(M)-Y h:i:s a');
$cur_date = date('Y-m-d');

//Attendance radio box
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //$attend = isset($_POST['attend']);
    $attend = $_POST['attend'];
    $insertattend = $stu->insertAttendance($cur_date, $attend);
}
?>

<?php
if (isset($insertattend)) {
    echo $insertattend;// return $attend_msg
}
?>

    <div class='alert alert-danger' style="display: none;"><strong> Error !</strong> Student Roll Missing ! Please Checked....</div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>
                <a class="btn btn-success" href="add.php">Add Student</a>
                <a class="btn btn-info pull-right" href="date_view.php">View All</a>
            </h2>
        </div>

        <div class="panel-body">
            <div class="well text-center" style="font-size: 20px;">
                <strong>Date : </strong><?= $cur_datee; ?>
            </div>
            <form action="" method="post">
                <table class="table table-striped bg-success">
                    <tr>
                        <th class="text-center" width="10%">Serial</th>
                        <th class="text-center" width="30%">Student Name</th>
                        <th class="text-center" width="25%">Student Roll</th>
                        <th class="text-center" width="15%">Attendance</th>
                        <th class="text-center" width="15%">Attend Time</th>
                    </tr>

                    <?php
                    $get_student = $stu->getStudents();
                    //print_r($get_student);
                    //exit();
                    if ($get_student) {
                        $i = 0;
                        while ($value = $get_student->fetch_assoc()) {
                            $i++; ?>


                            <tr class="text-center">
                                <td><?= $i; ?></td>
                                <td><?= ucwords($value['name']); ?></td>
                                <td><?= $value['roll']; ?></td>
                                <td>
                                    <input type="radio" name="attend[<?= $value['roll']; ?>]" value="present"> P |
                                    <input type="radio" name="attend[<?= $value['roll']; ?>]" value="absent"> A
                                </td>
                                <td></td>
                            </tr>
                        <?php }
                    } ?>
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
